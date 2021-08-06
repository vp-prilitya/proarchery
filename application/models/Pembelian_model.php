<?php

class Pembelian_model extends CI_model
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
                                    COUNT(b.pembelian_id) as item, 
                                    c.nama, 
                                    c.telp 
                                FROM 
                                    pembelian a 
                                    JOIN pembelian_detail b ON a.id = b.pembelian_id 
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
                                    a.status,
                                    a.created, 
                                    COUNT(b.pembelian_id) as item, 
                                    c.nama, 
                                    c.telp 
                                FROM 
                                    pembelian a 
                                    JOIN pembelian_detail b ON a.id = b.pembelian_id 
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
        $total_bayar = str_replace('.', '', htmlspecialchars($this->input->post('total_bayar')));
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $nofaktur = nofakturPembelian();

        $data = [
            'no_faktur' => $nofaktur,
            'vendor_id' => htmlspecialchars($this->input->post('vendor_id')),
            'total_gross' => $total_gross,
            'diskon' => htmlspecialchars($this->input->post('diskon')),
            'total_tagihan' => $total_tagihan,
            'total_bayar' => $total_bayar >= $total_tagihan ? $total_tagihan : $total_bayar,
            'status' => $total_bayar >= $total_tagihan ? 1 : 0,
            'created' => $created,
            'user_created' => $user_created,
            'perusahaan_id' => $perusahaan_id,
        ];

        $this->db->insert('pembelian', $data);
        $pembelian_id = $this->db->insert_id();

        $barang_id = $this->input->post('id')??[];
        $quantity = $this->input->post('quantity');
        $harga = $this->input->post('harga');
        $insert = [];
        
        for ($i=0; $i < count($barang_id); $i++) { 
            $brg_id = htmlspecialchars($barang_id[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $harga_beli = htmlspecialchars($harga[$i]);

            $dataInsert = [
                'pembelian_id' => $pembelian_id,
                'no_faktur' => $nofaktur,
                'barang_id' => $brg_id,
                'harga_beli' => str_replace(".", "", $harga_beli),
                'quantity' => $qty,
                'is_barang_jual' => 1
            ];

            array_push($insert, $dataInsert);
            $update = "UPDATE barang_jual SET stok = stok + $qty WHERE id = $brg_id AND is_paket = 0 AND need_raw = 0";
            $this->db->query($update);
        }

        $barang_idMentah = $this->input->post('idRaw')??[];
        $quantityMentah = $this->input->post('quantityRaw');
        $hargaMentah = $this->input->post('hargaRaw');

        for ($i=0; $i < count($barang_idMentah); $i++) { 
            $brg_id = htmlspecialchars($barang_idMentah[$i]);
            $qty = htmlspecialchars($quantityMentah[$i]);
            $harga_beli = htmlspecialchars($hargaMentah[$i]);

            $dataInsert = [
                'pembelian_id' => $pembelian_id,
                'no_faktur' => $nofaktur,
                'barang_id' => $brg_id,
                'harga_beli' => str_replace(".", "", $harga_beli),
                'quantity' => $qty,
                'is_barang_jual' => 0
            ];

            array_push($insert, $dataInsert);
            $update = "UPDATE barang_mentah SET stok = stok + $qty WHERE id = $brg_id";
            $this->db->query($update);
        }

        count($insert)>0? $this->db->insert_batch('pembelian_detail', $insert) : null;

        // JIKA HUTANG
        if($total_bayar < $total_tagihan){
            $this->hutang($pembelian_id, htmlspecialchars($this->input->post('vendor_id')), $total_tagihan, $total_bayar, $created, $user_created, $perusahaan_id);
        }
        // AKHIR

        // INSERT TRANSAKSI
        $this->transaksi($pembelian_id, $total_tagihan, $total_bayar, $created, $user_created, $perusahaan_id);
        // AKHIR

        return $pembelian_id;
    }

    public function hutang($pembelian_id, $vendor_id, $total_tagihan, $total_bayar, $created, $user_created, $perusahaan_id)
    {
        $data = [
            'pembelian_id' => $pembelian_id,
            'vendor_id' => $vendor_id,
            'hutang' => $total_tagihan - $total_bayar,
            'created' => $created,
            'user_created' => $user_created,
            'perusahaan_id' => $perusahaan_id
        ];

        $this->db->insert('hutang', $data);
    }

    public function transaksi($pembelian_id, $total_tagihan, $total_bayar, $created, $user_created, $perusahaan_id)
    {
        if($total_bayar >= $total_tagihan){
            $rule = $this->db->get_where('pengaturan', ['variable'=>'pembelian', 'jenis'=>'tunai', 'perusahaan_id'=>$perusahaan_id])->result_array();
        } else {
            $rule = $this->db->get_where('pengaturan', ['variable'=>'pembelian', 'jenis'=>'kredit', 'perusahaan_id'=>$perusahaan_id])->result_array();
        }

        $insert = [];
        foreach ($rule as $key => $db) {
            $data = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['is_debit'] == 1 ? $total_bayar : 0,
                'kredit' => $db['is_debit'] == 0 ? $total_bayar : 0,
                'rincian' => 'Transaksi dilakukan dari POS pembelian',
                'url' => 'pembelian',
                'foreign_id' => $pembelian_id,
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
                                        b.*, 
                                        c.nama as barang_jual, 
                                        c.satuan as satuan_jual, 
                                        d.nama as barang_mentah, 
                                        d.satuan as satuan_mentah,
                                        e.nama, e.alamat, e.telp, e.email,
                                        f.nama as perusahaan, f.alamat as alamat_perusahaan, f.telp as telp_perusahaan, f.email as email_perusahaan 
                                    FROM 
                                        pembelian a 
                                        JOIN pembelian_detail b ON a.id = b.pembelian_id 
                                        LEFT JOIN barang_jual c ON b.barang_id = c.id AND b.is_barang_jual = 1 
                                        LEFT JOIN barang_mentah d ON b.barang_id = d.id AND b.is_barang_jual = 0 
                                        JOIN vendor e ON a.vendor_id = e.id
                                        JOIN perusahaan f ON a.perusahaan_id = f.id
                                    WHERE 
                                        a.id = $id
                                    ")->result_array();
    }

    public function delete($id)
    {
        $item = $this->getPembelianById($id);

        foreach ($item as $key => $db) {
            if($db['is_barang_jual'] == 1){
                $update = "UPDATE barang_jual SET stok = stok - $db[quantity] WHERE id = $db[barang_id]";
            } else {
                $update = "UPDATE barang_mentah SET stok = stok - $db[quantity] WHERE id = $db[barang_id]";
            }
            $this->db->query($update);
        }
        
        $this->db->delete('pembelian',['id'=>$id]);
        $this->db->delete('pembelian_detail',['pembelian_id'=>$id]);

        // HAPUS HUTANG
        $this->deleteHutang($id);
        // AKHIR

        // HAPUS TRANSAKSI
        $this->deleteTransaksi($id);
        // AKHIR
    }

    public function deleteHutang($id)
    {
        $data = $this->db->get_where('hutang', ['pembelian_id' => $id])->row_array();
        
        $this->db->delete('pembayaran_hutang', ['hutang_id'=>$data['id']]);
        $this->db->delete('hutang',['pembelian_id'=>$id]);
    }

    public function deleteTransaksi($pembelian_id)
    {
        $this->db->delete('transaksi',['foreign_id'=>$pembelian_id, 'url'=>'pembelian']);
    }

    
    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('pembelian', $data, ['id'=>$this->input->post('id')]);
    }
}