<?php

class Penerimaan_pembelian_model extends CI_model
{
    public function getPembelian($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.id, 
                                    a.no_faktur, 
                                    a.total_tagihan, 
                                    a.total_bayar, 
                                    a.status,
                                    a.created, 
                                    COUNT(b.penerimaan_pembelian_id) as item, 
                                    c.nama, 
                                    c.telp as contact,
                                    d.no_faktur as no_po 
                                FROM 
                                    penerimaan_pembelian a 
                                    JOIN penerimaan_pembelian_detail b ON a.id = b.penerimaan_pembelian_id AND a.no_faktur = b.no_faktur 
                                    JOIN pesanan_pembelian d ON a.pesanan_pembelian_id = d.id
                                    JOIN vendor c ON d.vendor_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' 
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function getPembelianByNoFaktur($no_faktur)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.id, 
                                    a.no_faktur, 
                                    a.total_tagihan, 
                                    a.total_bayar, 
                                    a.status,
                                    a.created, 
                                    COUNT(b.penerimaan_pembelian_id) as item, 
                                    c.nama, 
                                    c.telp as contact,
                                    d.no_faktur as no_po 
                                FROM 
                                    penerimaan_pembelian a 
                                    JOIN penerimaan_pembelian_detail b ON a.id = b.penerimaan_pembelian_id 
                                    AND a.no_faktur = b.no_faktur
                                    JOIN pesanan_pembelian d ON a.pesanan_pembelian_id = d.id 
                                    JOIN vendor c ON d.vendor_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.no_faktur = '$no_faktur'
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function getPO()
    {
        $cari = $this->input->post('po');
        $data = [];

        $po = $this->db->query("SELECT 
                                    b.id AS pesanan_pembelian_id,
                                    b.vendor_id,
                                    a.barang_jual_id,
                                    a.harga,
                                    a.quantity,
                                    c.nama as nama_jual, c.need_raw, c.is_paket,
                                    d.nama as nama_mentah
                                FROM pesanan_pembelian_detail a
                                    LEFT JOIN pesanan_pembelian b ON a.pesanan_pembelian_id = b.id
                                    LEFT JOIN barang_jual c ON a.barang_jual_id = c.id AND a.type = 1
                                    LEFT JOIN barang_mentah d ON a.barang_jual_id = d.id AND a.type = 0
                                WHERE 
                                    b.no_faktur = '$cari'")->result_array();

        foreach ($po as $key => $db) {
            $push = [
                'pesanan_pembelian_id' => $db['pesanan_pembelian_id'],
                'vendor_id' => $db['vendor_id'],
                'barang_jual_id' => $db['barang_jual_id'],
                'nama' => $db['nama_jual']??$db['nama_mentah'],
                'quantity' => $db['quantity'],
                'harga' => $db['harga'],
            ];

            if($db['need_raw'] == null AND $db['is_paket'] == null){
                $qty = $this->db->query("SELECT 
                                        SUM(b.quantity) AS qty
                                    FROM penerimaan_pembelian a
                                        LEFT JOIN penerimaan_pembelian_detail b ON a.id = b.penerimaan_pembelian_id
                                    WHERE 
                                        a.pesanan_pembelian_id = $db[pesanan_pembelian_id] AND
                                        b.barang_jual_id = $db[barang_jual_id] AND
                                        b.type = 0
                                    GROUP BY 
                                        b.barang_jual_id ")->row_array();
                
                $push['need_raw'] = 1;
                $push['is_paket'] = 0;
                $push['qty'] = $qty['qty']??0;

            } else {
                $qty = $this->db->query("SELECT 
                                        SUM(b.quantity) AS qty
                                    FROM penerimaan_pembelian a
                                        LEFT JOIN penerimaan_pembelian_detail b ON a.id = b.penerimaan_pembelian_id
                                    WHERE 
                                        a.pesanan_pembelian_id = $db[pesanan_pembelian_id] AND
                                        b.barang_jual_id = $db[barang_jual_id] AND
                                        b.type = 1
                                    GROUP BY 
                                        b.barang_jual_id ")->row_array();
                
                $push['need_raw'] = 0;
                $push['is_paket'] = 0;
                $push['qty'] = $qty['qty']??0;
            }
            
            array_push($data, $push);
        }

        return $data;
    }

    public function save()
    {
        $total_gross = str_replace('.', '', htmlspecialchars($this->input->post('total_gross')));
        $total_tagihan = str_replace('.', '', htmlspecialchars($this->input->post('total_tagihan')));
        $vendor_id = htmlspecialchars($this->input->post('vendor_id'));
        $total_bayar = $total_tagihan;
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $nodaktur = penerimaanPembelian();

        $data = [
            'no_faktur' => $nodaktur,
            'pesanan_pembelian_id' => htmlspecialchars($this->input->post('pesanan_pembelian_id')),
            'total_gross' => $total_gross,
            'diskon' => htmlspecialchars($this->input->post('diskon')),
            'total_tagihan' => $total_tagihan,
            'total_bayar' => 0,
            'status' => 0,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('penerimaan_pembelian', $data);
        $pengiriman_id = $this->db->insert_id();
        
        $insert = [];

        $barang_id = $this->input->post('id')??[];
        $quantity = $this->input->post('quantity');
        $harga = $this->input->post('harga');
        for ($i=0; $i < count($barang_id); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_id[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $hrg = htmlspecialchars($harga[$i]);

            $dataInsert = [
                'penerimaan_pembelian_id' => $pengiriman_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
                'type' => 1
            ];

            array_push($insert, $dataInsert);
            $update = "UPDATE barang_jual SET stok = stok + $qty WHERE id = $barang_jual_id AND is_paket = 0 AND need_raw = 0";
            $this->db->query($update);
        }

        $barang_idRaw = $this->input->post('idRaw')??[];
        $quantityRaw = $this->input->post('quantityRaw');
        $hargaRaw = $this->input->post('hargaRaw');
        for ($i=0; $i < count($barang_idRaw); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_idRaw[$i]);
            $qty = htmlspecialchars($quantityRaw[$i]);
            $hrg = htmlspecialchars($hargaRaw[$i]);

            $dataInsert = [
                'penerimaan_pembelian_id' => $pengiriman_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
                'type' => 0
            ];

            array_push($insert, $dataInsert);
            $update = "UPDATE barang_mentah SET stok = stok + $qty WHERE id = $barang_jual_id";
            $this->db->query($update);
        }


        count($insert)>0? $this->db->insert_batch('penerimaan_pembelian_detail', $insert) : null;

        // $this->hutang($pengiriman_id, $vendor_id, $total_tagihan, $created, $user_created, $perusahaan_id);
        // $this->transaksi($pengiriman_id, $total_tagihan, $created, $user_created, $perusahaan_id);
    }

    public function hutang($penerimaan_id, $vendor_id, $total_tagihan, $created, $user_created, $perusahaan_id)
    {
        $data = [
            'pembelian_id' => $penerimaan_id,
            'vendor_id' => $vendor_id,
            'hutang' => $total_tagihan,
            'created' => $created,
            'user_created' => $user_created,
            'perusahaan_id' => $perusahaan_id
        ];

        $this->db->insert('hutang', $data);
    }

    public function transaksi($penerimaan_id, $total_tagihan, $created, $user_created, $perusahaan_id)
    {
        $rule = $this->db->get_where('pengaturan', ['variable'=>'pembelian', 'jenis'=>'kredit', 'perusahaan_id'=>$perusahaan_id])->result_array();

        $insert = [];
        foreach ($rule as $key => $db) {
            $data = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['is_debit'] == 1 ? $total_tagihan : 0,
                'kredit' => $db['is_debit'] == 0 ? $total_tagihan : 0,
                'rincian' => 'Transaksi dilakukan dari Pembelian',
                'url' => 'penerimaan_pembelian',
                'foreign_id' => $penerimaan_id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);
        }

        $this->db->insert_batch('transaksi', $insert);
    }

    public function getPembelianById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.barang_jual_id, 
                                    b.quantity,
                                    b.harga,
                                    b.type, 
                                    c.nama as pelanggan, 
                                    c.alamat, 
                                    c.telp as contact, 
                                    c.email, 
                                    d.nama as item_jual, d.satuan as satuan_jual,
                                    e.nama as item_mentah, e.satuan as satuan_mentah,
                                    f.nama as perusahaan, 
                                    f.email as email_perusahaan, 
                                    f.telp, 
                                    f.alamat as alamat_perusahaan 
                                FROM 
                                    penerimaan_pembelian a 
                                    JOIN penerimaan_pembelian_detail b ON a.id = b.penerimaan_pembelian_id 
                                    AND a.no_faktur = b.no_faktur
                                    JOIN pesanan_pembelian h ON a.pesanan_pembelian_id = h.id
                                    JOIN vendor c ON h.vendor_id = c.id 
                                    LEFT JOIN barang_jual d ON d.id = b.barang_jual_id AND b.type = 1
                                    LEFT JOIN barang_mentah e ON e.id = b.barang_jual_id AND b.type = 0
                                    JOIN perusahaan f ON a.perusahaan_id = f.id 
                                WHERE 
                                    a.id = $id
                                ")->result_array();
    }

    public function delete($id)
    {
        $item = $this->getPembelianById($id);
        // var_dump($item); die;

        foreach ($item as $key => $db) {
            if($db['type'] == 1){
                $update = "UPDATE barang_jual SET stok = stok - $db[quantity] WHERE id = $db[barang_jual_id]";
            } else {
                $update = "UPDATE barang_mentah SET stok = stok - $db[quantity] WHERE id = $db[barang_jual_id]";
            }
            $this->db->query($update);
        }

        $this->db->delete('penerimaan_pembelian',['id'=>$id]);
        $this->db->delete('penerimaan_pembelian_detail',['penerimaan_pembelian_id'=>$id]);
        $this->db->delete('hutang',['pembelian_id'=>$id]);
        $this->db->delete('transaksi',['foreign_id'=>$id, 'url'=>'penerimaan_pembelian']);
    }
   
}