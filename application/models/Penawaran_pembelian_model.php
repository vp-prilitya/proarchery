<?php

class Penawaran_pembelian_model extends CI_model
{
    public function getPembelian($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.id, 
                                    a.no_faktur, 
                                    a.total_tagihan, 
                                    a.total_bayar, 
                                    a.ppn, 
                                    a.jenis_ppn, 
                                    a.status,
                                    a.created, 
                                    COUNT(b.penawaran_pembelian_id) as item, 
                                    c.nama, 
                                    c.telp as contact 
                                FROM 
                                    penawaran_pembelian a 
                                    JOIN penawaran_pembelian_detail b ON a.id = b.penawaran_pembelian_id 
                                    AND a.no_faktur = b.no_faktur 
                                    JOIN vendor c ON a.vendor_id = c.id 
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
                                    a.ppn, 
                                    a.jenis_ppn,  
                                    a.status,
                                    a.created, 
                                    COUNT(b.penawaran_pembelian_id) as item, 
                                    c.nama, 
                                    c.telp as contact 
                                FROM 
                                    penawaran_pembelian a 
                                    JOIN penawaran_pembelian_detail b ON a.id = b.penawaran_pembelian_id 
                                    AND a.no_faktur = b.no_faktur 
                                    JOIN vendor c ON a.vendor_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.no_faktur = '$no_faktur'
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function save()
    {
        $total_gross = str_replace('.', '', htmlspecialchars($this->input->post('total_gross')));
        $total_tagihan = str_replace('.', '', htmlspecialchars($this->input->post('total_tagihan')));
        $ppn = str_replace(',','.', str_replace('.','',htmlspecialchars($this->input->post('ppn'))));
        $total_bayar = $total_tagihan;
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $nodaktur = penawaranPembelian();

        $data = [
            'no_faktur' => $nodaktur,
            'vendor_id' => htmlspecialchars($this->input->post('vendor_id')),
            'total_gross' => $total_gross,
            'diskon' => htmlspecialchars($this->input->post('diskon')),
            'total_tagihan' => $total_tagihan,
            'total_bayar' => 0,
            'ppn' => $ppn,
            'jenis_ppn' => htmlspecialchars($this->input->post('jenis_ppn')),
            'status' => 0,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        
        $this->db->insert('penawaran_pembelian', $data);
        $pembelian_id = $this->db->insert_id();
        
        $insert = [];

        $barang_id = $this->input->post('id')??[];
        $quantity = $this->input->post('quantity');
        $harga = $this->input->post('harga');
        $diskon = $this->input->post('disc');
        for ($i=0; $i < count($barang_id); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_id[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $hrg = htmlspecialchars($harga[$i]);
            $disc = htmlspecialchars($diskon[$i]);

            $dataInsert = [
                'penawaran_pembelian_id' => $pembelian_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
                'diskon' => $disc,
                'type' => 1
            ];

            array_push($insert, $dataInsert);
        }

        $barang_idRaw = $this->input->post('idRaw')??[];
        $quantityRaw = $this->input->post('quantityRaw');
        $hargaRaw = $this->input->post('hargaRaw');
        $diskonRaw = $this->input->post('discRaw');
        for ($i=0; $i < count($barang_idRaw); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_idRaw[$i]);
            $qty = htmlspecialchars($quantityRaw[$i]);
            $hrg = htmlspecialchars($hargaRaw[$i]);
            $disc = htmlspecialchars($diskonRaw[$i]);

            $dataInsert = [
                'penawaran_pembelian_id' => $pembelian_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
                'diskon' => $disc,
                'type' => 0
            ];

            array_push($insert, $dataInsert);
        }

        count($insert)>0? $this->db->insert_batch('penawaran_pembelian_detail', $insert) : null;
    }

    public function getPembelianById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.barang_jual_id, 
                                    b.quantity, 
                                    b.harga, 
                                    b.diskon as disc,
                                    c.nama as pelanggan, 
                                    c.alamat, 
                                    c.telp as contact, 
                                    c.email, 
                                    d.nama as item_jual,  d.satuan as satuan_jual,
                                    e.nama as item_mentah, e.satuan as satuan_mentah,
                                    f.nama as perusahaan, 
                                    f.email as email_perusahaan, 
                                    f.telp, 
                                    f.alamat as alamat_perusahaan 
                                FROM 
                                    penawaran_pembelian a 
                                    JOIN penawaran_pembelian_detail b ON a.id = b.penawaran_pembelian_id 
                                    AND a.no_faktur = b.no_faktur 
                                    JOIN vendor c ON a.vendor_id = c.id 
                                    LEFT JOIN barang_jual d ON d.id = b.barang_jual_id AND b.type = 1
                                    LEFT JOIN barang_mentah e ON e.id = b.barang_jual_id AND b.type = 0
                                    JOIN perusahaan f ON a.perusahaan_id = f.id 
                                WHERE 
                                    a.id = $id 
                                ")->result_array();
    }

    public function delete($id)
    {
        $this->db->delete('penawaran_pembelian',['id'=>$id]);
        $this->db->delete('penawaran_pembelian_detail',['penawaran_pembelian_id'=>$id]);
    }
   
}