<?php

class Validasi_model extends CI_model
{
    public function getTransaksiPenjualan($dari, $sampai)
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.nama 
                                FROM 
                                    penjualan a 
                                    LEFT JOIN pelanggan b ON a.pelanggan_id = b.id 
                                WHERE 
                                    a.is_valid = 0 AND
                                    a.perusahaan_id = $id AND
                                    a.created BETWEEN '$dari' AND '$sampai'
                                ")->result_array();
    }

    public function getTransaksiPenjualanValid($dari, $sampai)
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.nama 
                                FROM 
                                    penjualan a 
                                    LEFT JOIN pelanggan b ON a.pelanggan_id = b.id 
                                WHERE 
                                    a.is_valid = 1 AND
                                    a.perusahaan_id = $id AND
                                    a.created BETWEEN '$dari' AND '$sampai'
                                ")->result_array();
    }

    public function getTransaksiPengirimanPenjualan()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    c.nama 
                                FROM 
                                    pengiriman_penjualan a 
                                    LEFT JOIN pesanan_penjualan b ON a.pesanan_penjualan_id = b.id
                                    LEFT JOIN pelanggan c ON b.pelanggan_id = c.id 
                                WHERE 
                                    a.is_valid = 0 AND
                                    a.perusahaan_id = $id
                                ")->result_array();
    }

    public function getTransaksiPenjualanById($id)
    {
        return $this->db->query("SELECT 
                                        a.*, 
                                        b.barang_jual_id, 
                                        b.quantity, 
                                        c.nama as pelanggan, 
                                        d.nama as item, 
                                        d.harga_jual, 
                                        d.satuan,
                                        d.is_paket,
                                        GROUP_CONCAT(
                                        CONCAT(
                                            g.nama, ' @ ', e.quantity, g.satuan
                                        ) SEPARATOR '<br>'
                                        ) as paket, 
                                        h.jenis, 
                                        h.id as transaksi_bank_id,
                                        h.bank_id
                                    FROM 
                                        penjualan a 
                                        JOIN penjualan_detail b ON a.id = b.penjualan_id 
                                        AND a.no_faktur = b.no_faktur 
                                        LEFT JOIN pelanggan c ON a.pelanggan_id = c.id 
                                        LEFT JOIN barang_jual d ON d.id = b.barang_jual_id 
                                        LEFT JOIN barang_jual_detail e ON e.barang_jual_id = b.barang_jual_id 
                                        LEFT JOIN barang_jual g ON g.id = e.barang_id AND d.is_paket = 1 
                                        LEFT JOIN transaksi_bank h ON a.id = h.foreign_id AND a.is_bank = 1 AND h.url = 'penjualan' 
                                        LEFT JOIN bank i ON h.bank_id = i.id 
                                    WHERE 
                                        a.id = $id
                                    GROUP BY 
                                        b.barang_jual_id")->result_array();
    }

    public function getTransaksiPengirimanPenjualanById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.barang_jual_id, 
                                    b.quantity,
                                    b.harga, 
                                    c.nama as pelanggan, 
                                    c.alamat, 
                                    c.contact, 
                                    c.email, 
                                    d.nama as item, d.harga_jual, d.satuan,
                                    GROUP_CONCAT(
                                    CONCAT(g.nama, ' @ ', e.quantity, g.satuan) SEPARATOR '<br>'
                                    ) as paket
                                FROM 
                                    pengiriman_penjualan a 
                                    JOIN pengiriman_penjualan_detail b ON a.id = b.pengiriman_penjualan_id 
                                    AND a.no_faktur = b.no_faktur
                                    JOIN pesanan_penjualan h ON a.pesanan_penjualan_id = h.id
                                    JOIN pelanggan c ON h.pelanggan_id = c.id 
                                    LEFT JOIN barang_jual d ON d.id = b.barang_jual_id 
                                    LEFT JOIN barang_jual_detail e ON e.barang_jual_id = b.barang_jual_id 
                                    LEFT JOIN barang_jual g ON g.id = e.barang_id AND d.is_paket = 1
                                WHERE 
                                    a.id = $id 
                                GROUP BY 
                                    b.barang_jual_id
                                ")->result_array();
    }

    public function save()
    {
        $total_gross = str_replace('.', '', htmlspecialchars($this->input->post('total_gross')));
        $total_tagihan = str_replace('.', '', htmlspecialchars($this->input->post('total_tagihan')));
        $biaya_lain = str_replace('.', '', htmlspecialchars($this->input->post('biaya_lain')));
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');

        $is_kasir = htmlspecialchars($this->input->post('is_kasir'));
        $id = htmlspecialchars($this->input->post('id'));


        if($is_kasir == 1){
            $total_bayar = str_replace('.', '', htmlspecialchars($this->input->post('total_bayar')));
            $is_bank_before = htmlspecialchars($this->input->post('is_bank_before'));
            $jenis_pembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));

            if($is_bank_before == 1 AND $jenis_pembayaran=='cash'){
                $transaksi_bank_id = htmlspecialchars($this->input->post('transaksi_bank_id'));
                $this->db->delete('transaksi_bank_id', ['id' => $transaksi_bank_id]);
            }

            if($is_bank_before == 1 AND $jenis_pembayaran!='cash'){
                $transaksi_bank_id = htmlspecialchars($this->input->post('transaksi_bank_id'));
                $bank_id = htmlspecialchars($this->input->post('bank_id'));

                $updateBank = [
                    'bank_id' => $bank_id,
                    'jenis' => $jenis_pembayaran,
                ];
                $this->db->update('transaksi_bank', $updateBank, ['id' => $transaksi_bank_id]);
            }

            $updatePenjualan = [
                'is_valid' => 1,
                'biaya_lain' => $biaya_lain
            ];
            $this->db->update('penjualan', $updatePenjualan, ['id'=>$id]);

        } else {
            $data = [
                'is_valid' => 1
            ];

            $this->db->update('pengiriman_penjualan', $data, ['id'=>$id]);
            $total_bayar = $total_tagihan;
        }

        // $this->transaksi($id, $total_bayar, $biaya_lain, $created, $user_created, $perusahaan_id, $is_kasir);

        $akun_id = $this->input->post('akun_id');
        $keterangan = $this->input->post('keterangan');
        $debit = $this->input->post('debit');
        $kredit = $this->input->post('kredit');
        $this->inputTransaksi($id, $akun_id, $keterangan, $debit, $kredit, $created, $user_created, $perusahaan_id, $is_kasir);

    }

    public function transaksi($id, $total_bayar, $biaya_lain, $created, $user_created, $perusahaan_id, $is_kasir)
    {
        $rule = $this->db->get_where('pengaturan', ['variable'=>'penjualan', 'jenis'=>'kredit', 'perusahaan_id'=>$perusahaan_id])->result_array();

        $insert = [];
        foreach ($rule as $key => $db) {
            $data = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['is_debit'] == 1 ? (intval($total_bayar)-intval($biaya_lain)) : 0,
                'kredit' => $db['is_debit'] == 0 ? (intval($total_bayar)-intval($biaya_lain)) : 0,
                'rincian' => $is_kasir == 1 ? 'Transaksi dilakukan dari POS penjualan / Kasir' : 'Transaksi dilakukan dari Pengiriman Penjualan',
                'url' => $is_kasir == 1 ? 'penjualan' : 'pengiriman_penjualan',
                'foreign_id' => $id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);
        }

        $this->db->insert_batch('transaksi', $insert);
    }

    public function inputTransaksi($id, $akun_id, $keterangan, $debit, $kredit, $created, $user_created, $perusahaan_id, $is_kasir)
    {
        $insert = [];
        for ($i=0; $i < count($akun_id); $i++) { 
            $data = [
                'akun_id' => $akun_id[$i],
                'debit' => $debit[$i],
                'kredit' => $kredit[$i],
                'rincian' => $keterangan[$i],
                'url' => $is_kasir == 1 ? 'penjualan' : 'pengiriman_penjualan',
                'foreign_id' => $id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id,
            ];

            array_push($insert, $data);
        }

        $this->db->insert_batch('transaksi', $insert);
    }

    public function getBarangJualAkunByPaketId($id)
    {
        return $this->db->get_where('barang_jual_detail', ['barang_jual_id' => $id])->result_array();
    }

    public function getBarangJualAkun($id)
    {
        return $this->db->query("SELECT a.*, b.kode, b.nama, c.harga_jual FROM barang_jual_akun a JOIN akun b ON a.akun_id = b.id JOIN barang_jual c ON a.barang_jual_id = c.id WHERE a.barang_jual_id = $id")->result_array();
        // return $this->db->get_where('barang_jual_akun', ['barang_jual_id' => $id])->row_array();
    }

    public function delete($kasir, $id)
   {
       if($kasir == 1){
            $updatePenjualan = [
                'is_valid' =>0,
                'biaya_lain' => 0
            ];
            // $this->db->update('penjualan', $updatePenjualan, ['id'=>$id]);
            $this->db->delete('penjualan', ['id'=>$id]);
            $this->db->delete('penjualan_detail', ['penjualan_id'=>$id]);
            $this->db->delete('transaksi', ['foreign_id'=>$id, 'url' => 'penjualan']);
       } else {
            $data = [
                'is_valid' => 0
            ];

            $this->db->update('pengiriman_penjualan', $data, ['id'=>$id]);
            $this->db->delete('transaksi', ['foreign_id'=>$id, 'url' => 'pengiriman_penjualan']);
       }
   }
}