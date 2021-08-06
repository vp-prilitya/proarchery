<?php

class Pengiriman_penjualan_model extends CI_model
{
    public function getPenjualan($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.id, 
                                    a.no_faktur, 
                                    a.total_tagihan, 
                                    a.total_bayar, 
                                    a.status,
                                    a.created, 
                                    COUNT(b.pengiriman_penjualan_id) as item, 
                                    c.nama, 
                                    c.contact,
                                    d.no_faktur as no_po 
                                FROM 
                                    pengiriman_penjualan a 
                                    JOIN pengiriman_penjualan_detail b ON a.id = b.pengiriman_penjualan_id AND a.no_faktur = b.no_faktur 
                                    JOIN pesanan_penjualan d ON a.pesanan_penjualan_id = d.id
                                    JOIN pelanggan c ON d.pelanggan_id = c.id 
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
                                    a.total_bayar, 
                                    a.status,
                                    a.created, 
                                    COUNT(b.pengiriman_penjualan_id) as item, 
                                    c.nama, 
                                    c.contact,
                                    d.no_faktur as no_po 
                                FROM 
                                    pengiriman_penjualan a 
                                    JOIN pengiriman_penjualan_detail b ON a.id = b.pengiriman_penjualan_id 
                                    AND a.no_faktur = b.no_faktur
                                    JOIN pesanan_penjualan d ON a.pesanan_penjualan_id = d.id 
                                    JOIN pelanggan c ON d.pelanggan_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.no_faktur = '$no_faktur'
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function getSO()
    {
        $cari = $this->input->post('po');
        $data = [];

        $po = $this->db->query("SELECT 
                                    b.id AS pesanan_penjualan_id,
                                    b.pelanggan_id,
                                    a.barang_jual_id,
                                    a.harga,
                                    a.quantity,
                                    c.*
                                FROM pesanan_penjualan_detail a
                                    LEFT JOIN pesanan_penjualan b ON a.pesanan_penjualan_id = b.id
                                    LEFT JOIN barang_jual c ON a.barang_jual_id = c.id
                                WHERE 
                                    b.no_faktur = '$cari'")->result_array();

        foreach ($po as $key => $db) {
            $qty = $this->db->query("SELECT 
                                        SUM(b.quantity) AS qty
                                    FROM pengiriman_penjualan a
                                        LEFT JOIN pengiriman_penjualan_detail b ON a.id = b.pengiriman_penjualan_id
                                    WHERE 
                                        a.pesanan_penjualan_id = $db[pesanan_penjualan_id] AND
                                        b.barang_jual_id = $db[barang_jual_id]
                                    GROUP BY 
                                        b.barang_jual_id")->row_array();
            $push = [
                'pesanan_penjualan_id' => $db['pesanan_penjualan_id'],
                'pelanggan_id' => $db['pelanggan_id'],
                'barang_jual_id' => $db['barang_jual_id'],
                'nama' => $db['nama'],
                'quantity' => $db['quantity'],
                'qty' => $qty['qty']??0,
                'need_raw' => $db['need_raw'],
                'is_paket' => $db['is_paket'],
                'harga' => $db['harga'],
            ];

            array_push($data, $push);
        }

        return $data;
    }

    public function save()
    {
        $total_gross = str_replace('.', '', htmlspecialchars($this->input->post('total_gross')));
        $total_tagihan = str_replace('.', '', htmlspecialchars($this->input->post('total_tagihan')));
        $pelanggan_id = htmlspecialchars($this->input->post('pelanggan_id'));
        $total_bayar = $total_tagihan;
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $nodaktur = pengiriman();

        $data = [
            'no_faktur' => $nodaktur,
            'pesanan_penjualan_id' => htmlspecialchars($this->input->post('pesanan_penjualan_id')),
            'total_gross' => $total_gross,
            'diskon' => htmlspecialchars($this->input->post('diskon')),
            'total_tagihan' => $total_tagihan,
            'total_bayar' => 0,
            'status' => 0,
            'is_valid' => 0,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('pengiriman_penjualan', $data);
        $pengiriman_id = $this->db->insert_id();

        $barang_id = $this->input->post('id')??[];
        $quantity = $this->input->post('quantity');
        $harga = $this->input->post('harga');
        $insert = [];
        
        for ($i=0; $i < count($barang_id); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_id[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $hrg = htmlspecialchars($harga[$i]);

            $dataInsert = [
                'pengiriman_penjualan_id' => $pengiriman_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
            ];

            array_push($insert, $dataInsert);
            $update = "UPDATE barang_jual SET stok = stok - $qty WHERE id = $barang_jual_id AND is_paket = 0 AND need_raw = 0";
            $this->db->query($update);
        }

        $paket = $this->input->post('idPaket')??[];
        for ($i=0; $i < count($paket); $i++) {
            $idPaket = htmlspecialchars($paket[$i]);

            $brg_id = $this->input->post("barangJualId$idPaket");
            $quantityBarangJualId = $this->input->post("quantityBarangJualId$idPaket");
            $qtyPaket = $this->input->post("quantityPaket$idPaket");

            for ($i=0; $i < count($brg_id); $i++) { 
                $qty = htmlspecialchars($quantityBarangJualId[$i]);
                $id = htmlspecialchars($brg_id[$i]);

                // JIKA DALAM PAKET ADA BARANG MENTAH
                if(htmlspecialchars($this->input->post("need_raw$id")) == 1){
                    $this->updateBarangMentah($id, $qtyPaket);
                } 
                // AKHIR
                else {
                    $update = "UPDATE barang_jual SET stok = stok - ($qty * $qtyPaket) WHERE id = $id AND is_paket = 0 AND need_raw=0";
                    $this->db->query($update);
                }
            }
        }

        count($insert)>0? $this->db->insert_batch('pengiriman_penjualan_detail', $insert) : null;

        // $this->piutang($pengiriman_id, $pelanggan_id, $total_tagihan, $created, $user_created, $perusahaan_id);
        // $this->transaksi($pengiriman_id, $total_tagihan, $created, $user_created, $perusahaan_id);
        // $this->transaksiPengiriman($pengiriman_id, $total_tagihan, $created, $user_created, $perusahaan_id);
    }

    public function updateBarangMentah($id, $qty)
    {
        $item = $this->db->query("SELECT 
                                        a.quantity,
                                        a.barang_id
                                    FROM 
                                        barang_jual_detail a 
                                        JOIN barang_jual b ON a.barang_jual_id = b.id 
                                        JOIN barang_mentah c ON a.barang_id = c.id 
                                    WHERE 
                                        a.barang_jual_id = $id")->result_array();
        
        foreach ($item as $key => $db) {
            $update = "UPDATE barang_mentah SET stok = stok - ($db[quantity] * $qty) WHERE id = $db[barang_id]";
            $this->db->query($update);
        }
    }

    public function piutang($pengiriman_id, $pelanggan_id, $total_tagihan, $created, $user_created, $perusahaan_id)
    {
        $data = [
            'penjualan_id' => $pengiriman_id,
            'pelanggan_id' => $pelanggan_id,
            'piutang' => $total_tagihan,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('piutang', $data);
    }

    public function transaksi($pengiriman_id, $total_bayar, $created, $user_created, $perusahaan_id)
    {
        $rule = $this->db->get_where('pengaturan', ['variable'=>'penjualan', 'jenis'=>'kredit', 'perusahaan_id'=>$perusahaan_id])->result_array();

        $insert = [];
        foreach ($rule as $key => $db) {
            $data = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['is_debit'] == 1 ? $total_bayar : 0,
                'kredit' => $db['is_debit'] == 0 ? $total_bayar : 0,
                'rincian' => 'Transaksi dilakukan dari Pengiriman Penjualan',
                'url' => 'pengiriman_penjualan',
                'foreign_id' => $pengiriman_id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);
        }

        $this->db->insert_batch('transaksi', $insert);
    }

    public function transaksiPengiriman($pengiriman_id, $total_bayar, $created, $user_created, $perusahaan_id)
    {
        $data = [
            'pengiriman_penjualan_id' => $pengiriman_id,
            'jumlah' => $total_bayar,
            'rincian' => 'Transaksi dilakukan dari Pengiriman Penjualan',
            'url' => 'pengiriman_penjualan',
            'foreign_id' => $pengiriman_id,
            'created' => $created,
            'user_created' => $user_created,
            'perusahaan_id' => $perusahaan_id
        ];

        $this->db->insert('transaksi_pengiriman_penjualan', $data);
    }

    public function getPenjualanById($id)
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
                                    ) as paket, 
                                    f.nama as perusahaan, 
                                    f.email as email_perusahaan, 
                                    f.telp, 
                                    f.alamat as alamat_perusahaan 
                                FROM 
                                    pengiriman_penjualan a 
                                    JOIN pengiriman_penjualan_detail b ON a.id = b.pengiriman_penjualan_id 
                                    AND a.no_faktur = b.no_faktur
                                    JOIN pesanan_penjualan h ON a.pesanan_penjualan_id = h.id
                                    JOIN pelanggan c ON h.pelanggan_id = c.id 
                                    LEFT JOIN barang_jual d ON d.id = b.barang_jual_id 
                                    LEFT JOIN barang_jual_detail e ON e.barang_jual_id = b.barang_jual_id 
                                    LEFT JOIN barang_jual g ON g.id = e.barang_id AND d.is_paket = 1
                                    JOIN perusahaan f ON a.perusahaan_id = f.id 
                                WHERE 
                                    a.id = $id 
                                GROUP BY 
                                    b.barang_jual_id
                                ")->result_array();
    }

    public function delete($id)
    {
        $pengiriman_penjualan = $this->db->query("SELECT a.*, b.*, c.is_paket, c.need_raw FROM pengiriman_penjualan a JOIN pengiriman_penjualan_detail b ON a.id = b.pengiriman_penjualan_id AND a.no_faktur = b.no_faktur JOIN barang_jual c ON b.barang_jual_id = c.id WHERE a.id = $id")->result_array();

        foreach ($pengiriman_penjualan as $key => $db) {

            // JIKA BUKAN PAKET
            if($db['need_raw'] == 0 AND $db['is_paket'] == 0){
                $update = "UPDATE barang_jual SET stok = stok + ($db[quantity]) WHERE id = $db[barang_jual_id] AND is_paket = 0";
                $this->db->query($update);
            }
            // AKHIR

            // JIKA PAKET
            if($db['need_raw'] == 0 AND $db['is_paket'] == 1){
                $item = $this->db->query("SELECT a.*, b.*, c.nama, c.need_raw as is_raw FROM barang_jual a JOIN barang_jual_detail b ON a.id = b.barang_jual_id LEFT JOIN barang_jual c on b.barang_id = c.id WHERE a.id = $db[barang_jual_id]")->result_array();

                foreach ($item as $key => $dt) {

                    if($dt['is_raw'] == 1){
                        $this->updateBarangMentahPlus($dt['barang_id'], $db['quantity']);
                    } else {
                        $update = "UPDATE barang_jual SET stok = stok + ($dt[quantity] * $db[quantity]) WHERE id = $dt[barang_id] AND is_paket = 0";
                        $this->db->query($update);
                    }
                }
            }
            // AKHIR

            // JIKA BARANG MENTAH
            if($db['need_raw'] == 1 AND $db['is_paket'] == 0){
                $item = $this->db->query("SELECT a.*, b.* FROM barang_jual a JOIN barang_jual_detail b ON a.id = b.barang_jual_id WHERE a.id = $db[barang_jual_id]")->result_array();

                foreach ($item as $key => $dt2) {
                    $update = "UPDATE barang_mentah SET stok = stok + ($dt2[quantity] * $db[quantity]) WHERE id = $dt2[barang_id]";
                    $this->db->query($update);
                }
            }
            // AKHIR
        }

        $this->db->delete('pengiriman_penjualan',['id'=>$id]);
        $this->db->delete('pengiriman_penjualan_detail',['pengiriman_penjualan_id'=>$id]);
        $this->db->delete('piutang',['penjualan_id'=>$id]);
        $this->db->delete('transaksi',['foreign_id'=>$id, 'url'=>'pengiriman_penjualan']);
    }
   
}