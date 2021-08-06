<?php

class Retur_pembelian_model extends CI_model
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
                                    COUNT(b.retur_pembelian_id) as item, 
                                    c.nama, 
                                    c.telp as contact,
                                    d.no_faktur as no_po 
                                FROM 
                                    retur_pembelian a 
                                    JOIN retur_pembelian_detail b ON a.id = b.retur_pembelian_id AND a.no_faktur = b.no_faktur 
                                    JOIN penerimaan_pembelian d ON a.penerimaan_pembelian_id = d.id
                                    JOIN pesanan_pembelian e ON d.pesanan_pembelian_id = e.id
                                    JOIN vendor c ON e.vendor_id = c.id 
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
                                    COUNT(b.retur_pembelian_id) as item, 
                                    c.nama, 
                                    c.telp as contact,
                                    d.no_faktur as no_po 
                                FROM 
                                    retur_pembelian a 
                                    JOIN retur_pembelian_detail b ON a.id = b.retur_pembelian_id 
                                    AND a.no_faktur = b.no_faktur
                                    JOIN penerimaan_pembelian d ON a.penerimaan_pembelian_id = d.id 
                                    JOIN pesanan_pembelian e ON d.pesanan_pembelian_id = e.id
                                    JOIN vendor c ON e.vendor_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.no_faktur = '$no_faktur'
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function getPJ()
    {
        $cari = $this->input->post('po');
        $data = [];

        $po = $this->db->query("SELECT 
                                    b.id AS penerimaan_pembelian_id,
                                    b.pesanan_pembelian_id,
                                    e.vendor_id,
                                    a.barang_jual_id,
                                    a.harga,
                                    a.quantity,
                                    c.nama as nama_jual, c.need_raw, c.is_paket,
                                    d.nama as nama_mentah
                                FROM penerimaan_pembelian_detail a
                                    LEFT JOIN penerimaan_pembelian b ON a.penerimaan_pembelian_id = b.id
                                    LEFT JOIN barang_jual c ON a.barang_jual_id = c.id AND a.type = 1
                                    LEFT JOIN barang_mentah d ON a.barang_jual_id = d.id AND a.type = 0
                                    LEFT JOIN pesanan_pembelian e ON e.id = b.pesanan_pembelian_id
                                WHERE 
                                    b.no_faktur = '$cari'")->result_array();

        foreach ($po as $key => $db) {
            $push = [
                'penerimaan_pembelian_id' => $db['penerimaan_pembelian_id'],
                'vendor_id' => $db['vendor_id'],
                'barang_jual_id' => $db['barang_jual_id'],
                'nama' => $db['nama_jual']??$db['nama_mentah'],
                'qty' => $db['quantity'],
                'harga' => $db['harga'],
            ];

            if($db['need_raw'] == null AND $db['is_paket'] == null){
                $qty = $this->db->query("SELECT 
                                            b.quantity
                                        FROM 
                                            pesanan_pembelian_detail b 
                                        WHERE 
                                            b.pesanan_pembelian_id = $db[pesanan_pembelian_id] AND
                                            b.barang_jual_id = $db[barang_jual_id] AND
                                            b.type = 0")->row_array();
                
                $push['need_raw'] = 1;
                $push['is_paket'] = 0;
                $push['quantity'] = $qty['quantity'];

            } else {
                $qty = $this->db->query("SELECT 
                                            b.quantity
                                        FROM 
                                            pesanan_pembelian_detail b 
                                        WHERE 
                                            b.pesanan_pembelian_id = $db[pesanan_pembelian_id] AND
                                            b.barang_jual_id = $db[barang_jual_id] AND
                                            b.type = 1")->row_array();
                
                $push['need_raw'] = 0;
                $push['is_paket'] = 0;
                $push['quantity'] = $qty['quantity'];
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
        $nodaktur = returPembelian();

        $data = [
            'no_faktur' => $nodaktur,
            'penerimaan_pembelian_id' => htmlspecialchars($this->input->post('penerimaan_pembelian_id')),
            'total_gross' => $total_gross,
            'diskon' => htmlspecialchars($this->input->post('diskon')),
            'total_tagihan' => $total_tagihan,
            'total_bayar' => 0,
            'status' => 0,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('retur_pembelian', $data);
        $retur_id = $this->db->insert_id();

        $barang_id = $this->input->post('id')??[];
        $quantity = $this->input->post('quantity');
        $harga = $this->input->post('harga');
        $insert = [];
        
        for ($i=0; $i < count($barang_id); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_id[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $hrg = htmlspecialchars($harga[$i]);

            $dataInsert = [
                'retur_pembelian_id' => $retur_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => $hrg,
                'quantity' => $qty,
                'type' => 1
            ];

            array_push($insert, $dataInsert);
            $update = "UPDATE barang_jual SET stok = stok - $qty WHERE id = $barang_jual_id AND is_paket = 0 AND need_raw = 0";
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
                'retur_pembelian_id' => $retur_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
                'type' => 0
            ];

            array_push($insert, $dataInsert);
            $update = "UPDATE barang_mentah SET stok = stok - $qty WHERE id = $barang_jual_id";
            $this->db->query($update);
        }

        count($insert)>0? $this->db->insert_batch('retur_pembelian_detail', $insert) : null;

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
                                    retur_pembelian a 
                                    JOIN retur_pembelian_detail b ON a.id = b.retur_pembelian_id 
                                    AND a.no_faktur = b.no_faktur
                                    JOIN penerimaan_pembelian h ON a.penerimaan_pembelian_id = h.id
                                    JOIN pesanan_pembelian i ON h.pesanan_pembelian_id = i.id
                                    JOIN vendor c ON i.vendor_id = c.id 
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
                $update = "UPDATE barang_jual SET stok = stok + $db[quantity] WHERE id = $db[barang_jual_id]";
            } else {
                $update = "UPDATE barang_mentah SET stok = stok + $db[quantity] WHERE id = $db[barang_jual_id]";
            }
            $this->db->query($update);
        }

        $this->db->delete('retur_pembelian',['id'=>$id]);
        $this->db->delete('retur_pembelian_detail',['retur_pembelian_id'=>$id]);
    }
   
}