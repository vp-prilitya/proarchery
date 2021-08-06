<?php

class Pesanan_penjualan_model extends CI_model
{
    public function getPenjualan($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.id, 
                                    a.no_faktur, 
                                    a.total_tagihan, 
                                    a.ppn, 
                                    a.jenis_ppn, 
                                    a.tgl_jatuh_tempo, 
                                    a.status,
                                    a.created, 
                                    COUNT(b.pesanan_penjualan_id) as item, 
                                    c.nama, 
                                    c.contact 
                                FROM 
                                    pesanan_penjualan a 
                                    JOIN pesanan_penjualan_detail b ON a.id = b.pesanan_penjualan_id 
                                    AND a.no_faktur = b.no_faktur 
                                    JOIN pelanggan c ON a.pelanggan_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' 
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function getPenjualanByNoFaktur($no_faktur)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.id, 
                                    a.no_faktur, 
                                    a.total_tagihan, 
                                    a.ppn, 
                                    a.jenis_ppn, 
                                    a.tgl_jatuh_tempo,  
                                    a.status,
                                    a.created, 
                                    COUNT(b.pesanan_penjualan_id) as item, 
                                    c.nama, 
                                    c.contact 
                                FROM 
                                    pesanan_penjualan a 
                                    JOIN pesanan_penjualan_detail b ON a.id = b.pesanan_penjualan_id 
                                    AND a.no_faktur = b.no_faktur 
                                    JOIN pelanggan c ON a.pelanggan_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.no_faktur = '$no_faktur'
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function getBarang()
    {
        $cari = $this->input->post('cari');
        return $this->db->query("SELECT * FROM barang_jual WHERE nama LIKE '%$cari%' AND need_raw=0")->result_array();
    }

    public function save()
    {
        $total_gross = str_replace('.', '', htmlspecialchars($this->input->post('total_gross')));
        $total_tagihan = str_replace('.', '', htmlspecialchars($this->input->post('total_tagihan')));
        $ppn = str_replace(',', '.', str_replace('.', '', htmlspecialchars($this->input->post('ppn'))));
        $jenis_ppn = htmlspecialchars($this->input->post('jenis_ppn'));
        $total_bayar = $total_tagihan;
        $pelanggan_id = htmlspecialchars($this->input->post('pelanggan_id'));
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $nodaktur = pesanan();

        $data = [
            'no_faktur' => $nodaktur,
            'pelanggan_id' => $pelanggan_id,
            'total_gross' => $total_gross,
            'diskon' => htmlspecialchars($this->input->post('diskon')),
            'total_tagihan' => $total_tagihan,
            'total_bayar' => $total_bayar,
            'ppn' => $ppn,
            'jenis_ppn' => $jenis_ppn,
            'tgl_jatuh_tempo' => htmlspecialchars($this->input->post('tgl_jatuh_tempo')),
            'bank_id' => htmlspecialchars($this->input->post('bank_id')),
            'status' => 0,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('pesanan_penjualan', $data);
        $penjualan_id = $this->db->insert_id();

        $barang_id = $this->input->post('id')??[];
        $quantity = $this->input->post('quantity');
        $harga = $this->input->post('harga');
        $diskon = $this->input->post('disc');
        $insert = [];
        
        for ($i=0; $i < count($barang_id); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_id[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $hrg = htmlspecialchars($harga[$i]);
            $disc = htmlspecialchars($diskon[$i]);

            $dataInsert = [
                'pesanan_penjualan_id' => $penjualan_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
                'diskon' => $disc,
            ];

            array_push($insert, $dataInsert);
        }

        count($insert)>0? $this->db->insert_batch('pesanan_penjualan_detail', $insert) : null;
        $this->piutang($penjualan_id, $pelanggan_id, $total_tagihan, $created, $user_created, $perusahaan_id);
        $this->transaksi($penjualan_id, $total_tagihan, $ppn, $created, $user_created, $perusahaan_id, $pelanggan_id);
    }

    public function piutang($penjualan_id, $pelanggan_id, $total_tagihan, $created, $user_created, $perusahaan_id)
    {
        $data = [
            'penjualan_id' => $penjualan_id,
            'pelanggan_id' => $pelanggan_id,
            'piutang' => $total_tagihan,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('piutang', $data);
    }

    public function transaksi($penjualan_id, $total_bayar, $ppn, $created, $user_created, $perusahaan_id, $pelanggan_id)
    {
        $rule = $this->db->get_where('pengaturan', ['variable'=>'penjualan', 'perusahaan_id'=>$perusahaan_id])->result_array();

        $insert = [];
        foreach ($rule as $key => $db) {
            $data = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['is_debit'] == 1 ? ($total_bayar) : 0,
                'kredit' => $db['is_debit'] == 0 ? ($total_bayar - $ppn) : 0,
                'rincian' => 'Transaksi dilakukan dari Penjualan pelanggan_id : ' . $pelanggan_id,
                'url' => 'pesanan_penjualan',
                'foreign_id' => $penjualan_id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);
        }

        $rule2 = $this->db->get_where('pengaturan', ['variable'=>'pajak keluaran', 'perusahaan_id'=>$perusahaan_id])->result_array();
        foreach ($rule2 as $key => $db) {
            $data = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['is_debit'] == 1 ? $ppn : 0,
                'kredit' => $db['is_debit'] == 0 ? $ppn : 0,
                'rincian' => 'Transaksi (Pajak) dilakukan dari Penjualan pelanggan_id : ' . $pelanggan_id,
                'url' => 'pesanan_penjualan',
                'foreign_id' => $penjualan_id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);
        }

        $this->db->insert_batch('transaksi', $insert);
    }

    public function getPenjualanById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.barang_jual_id, 
                                    b.quantity, 
                                    b.harga,
                                    b.diskon as disc, 
                                    c.nama as pelanggan, 
                                    c.alamat, 
                                    c.contact, 
                                    c.email, 
                                    d.nama as item, d.harga_jual, d.satuan,
                                    GROUP_CONCAT(
                                    CONCAT(g.nama, ' @ ', e.quantity, g.satuan) SEPARATOR '<br>'
                                    ) as paket, 
                                    f.nama as perusahaan, 
                                    f.email as email_perusahaan, 
                                    f.telp, 
                                    f.alamat as alamat_perusahaan,
                                    h.nama as bank, h.no_rek, h.nama_pemilik 
                                FROM 
                                    pesanan_penjualan a 
                                    JOIN pesanan_penjualan_detail b ON a.id = b.pesanan_penjualan_id 
                                    AND a.no_faktur = b.no_faktur 
                                    JOIN pelanggan c ON a.pelanggan_id = c.id 
                                    LEFT JOIN barang_jual d ON d.id = b.barang_jual_id 
                                    LEFT JOIN barang_jual_detail e ON e.barang_jual_id = b.barang_jual_id 
                                    LEFT JOIN barang_jual g ON g.id = e.barang_id AND d.is_paket = 1
                                    JOIN perusahaan f ON a.perusahaan_id = f.id
                                    LEFT JOIN bank h ON a.bank_id = h.id 
                                WHERE 
                                    a.id = $id 
                                GROUP BY 
                                    b.barang_jual_id
                                ")->result_array();
    }

    public function delete($id)
    {
        $this->db->delete('pesanan_penjualan',['id'=>$id]);
        $this->db->delete('pesanan_penjualan_detail',['pesanan_penjualan_id'=>$id]);
    }
   
}