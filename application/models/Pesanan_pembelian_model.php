<?php

class Pesanan_pembelian_model extends CI_model
{
    public function getPembelian($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.id, 
                                    a.no_faktur, 
                                    a.total_tagihan, 
                                    a.ppn, 
                                    a.jenis_ppn,  
                                    a.status,
                                    a.created, 
                                    COUNT(b.pesanan_pembelian_id) as item, 
                                    c.nama, 
                                    c.telp as contact 
                                FROM 
                                    pesanan_pembelian a 
                                    JOIN pesanan_pembelian_detail b ON a.id = b.pesanan_pembelian_id 
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
                                    a.ppn, 
                                    a.jenis_ppn,  
                                    a.status,
                                    a.created, 
                                    COUNT(b.pesanan_pembelian_id) as item, 
                                    c.nama, 
                                    c.telp as contact 
                                FROM 
                                    pesanan_pembelian a 
                                    JOIN pesanan_pembelian_detail b ON a.id = b.pesanan_pembelian_id 
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
        $ppn = str_replace(',', '.', str_replace('.', '', htmlspecialchars($this->input->post('ppn'))));
        $jenis_ppn = htmlspecialchars($this->input->post('jenis_ppn'));
        $total_bayar = $total_tagihan;
        $vendor_id = htmlspecialchars($this->input->post('vendor_id'));
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $nodaktur = pesananPembelian();

        $data = [
            'no_faktur' => $nodaktur,
            'vendor_id' => $vendor_id,
            'total_gross' => $total_gross,
            'diskon' => htmlspecialchars($this->input->post('diskon')),
            'total_tagihan' => $total_tagihan,
            'total_bayar' => 0,
            'ppn' => $ppn,
            'jenis_ppn' => $jenis_ppn,
            'status' => 0,
            'tgl_jatuh_tempo' => htmlspecialchars($this->input->post('tgl_jatuh_tempo')),
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('pesanan_pembelian', $data);
        $pembelian_id = $this->db->insert_id();
        
        $insert = [];

        $barang_id = $this->input->post('id')??[];
        $quantity = $this->input->post('quantity');
        $harga = $this->input->post('harga');
        $diskon = $this->input->post('disc');
        $updateBarangJual = [];
        for ($i=0; $i < count($barang_id); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_id[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $hrg = htmlspecialchars($harga[$i]);
            $disc = htmlspecialchars($diskon[$i]);

            $dataInsert = [
                'pesanan_pembelian_id' => $pembelian_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
                'diskon' => $disc,
                'type' => 1
            ];

            array_push($insert, $dataInsert);
            array_push($updateBarangJual, $dataInsert);
        }

        $barang_idRaw = $this->input->post('idRaw')??[];
        $quantityRaw = $this->input->post('quantityRaw');
        $hargaRaw = $this->input->post('hargaRaw');
        $diskonRaw = $this->input->post('discRaw');
        $updateBarangMentah = [];
        for ($i=0; $i < count($barang_idRaw); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_idRaw[$i]);
            $qty = htmlspecialchars($quantityRaw[$i]);
            $hrg = htmlspecialchars($hargaRaw[$i]);
            $disc = htmlspecialchars($diskonRaw[$i]);

            $dataInsert = [
                'pesanan_pembelian_id' => $pembelian_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
                'diskon' => $disc,
                'type' => 0
            ];

            array_push($insert, $dataInsert);
            array_push($updateBarangMentah, $dataInsert);
        }

        count($insert)>0? $this->db->insert_batch('pesanan_pembelian_detail', $insert) : null;
        $this->updateHargaPokokBarangMentah($updateBarangMentah);
        $this->updateHargaPokokBarangJual($updateBarangJual);

        $this->hutang($pembelian_id, $vendor_id, $total_tagihan, $created, $user_created, $perusahaan_id);
        $this->transaksi($pembelian_id, $total_tagihan, $ppn, $created, $user_created, $perusahaan_id, $vendor_id);
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

    public function transaksi($penerimaan_id, $total_tagihan, $ppn, $created, $user_created, $perusahaan_id, $vendor_id)
    {
        $rule = $this->db->get_where('pengaturan', ['variable'=>'pembelian', 'jenis'=>'kredit', 'perusahaan_id'=>$perusahaan_id])->result_array();

        $insert = [];
        foreach ($rule as $key => $db) {
            $data = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['is_debit'] == 1 ? ($total_tagihan - $ppn) : 0,
                'kredit' => $db['is_debit'] == 0 ? ($total_tagihan) : 0,
                'rincian' => 'Transaksi dilakukan dari Pembelian vendor_id :' . $vendor_id,
                'url' => 'pesanan_pembelian',
                'foreign_id' => $penerimaan_id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);
        }

        $rule2 = $this->db->get_where('pengaturan', ['variable'=>'pajak masukan', 'jenis'=>'kredit', 'perusahaan_id'=>$perusahaan_id])->result_array();

        
        foreach ($rule2 as $key => $db) {
            $data = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['is_debit'] == 1 ? $ppn : 0,
                'kredit' => $db['is_debit'] == 0 ? $ppn : 0,
                'rincian' => 'Transaksi (Pajak) dilakukan dari Pembelian vendor_id :' . $vendor_id,
                'url' => 'pesanan_pembelian',
                'foreign_id' => $penerimaan_id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);
        }

        $this->db->insert_batch('transaksi', $insert);
    }

    public function updateHargaPokokBarangMentah($data)
    {
        foreach ($data as $key => $db) {
            $cek = $this->db->get_where('barang_mentah', ['id' => $db['barang_jual_id']])->row_array();
            
            if($cek['jenis_harga_pokok'] == 'FIFO'){
                $hrg = $this->db->query("SELECT * FROM pesanan_pembelian_detail WHERE barang_jual_id = $db[barang_jual_id] AND type = 0 ORDER BY id ASC")->row_array();

                $update = [
                    'harga_pokok' => $hrg['harga']
                ];
            }

            if($cek['jenis_harga_pokok'] == 'LIFO'){
                $update = [
                    'harga_pokok' => $db['harga']
                ];
            }

            if($cek['jenis_harga_pokok'] == 'AVERAGE'){
                $hrg = $this->db->query("SELECT AVG(harga) as harga FROM pesanan_pembelian_detail WHERE barang_jual_id = $db[barang_jual_id] AND type = 0 GROUP BY barang_jual_id")->row_array();

                $update = [
                    'harga_pokok' => $hrg['harga']
                ];
            }

            $this->db->update('barang_mentah', $update, ['id' => $db['barang_jual_id']]);
        }
    }

    public function updateHargaPokokBarangJual($data)
    {
        foreach ($data as $key => $db) {
            $cek = $this->db->get_where('barang_jual', ['id' => $db['barang_jual_id']])->row_array();

            if($cek['jenis_harga_pokok'] == 'FIFO'){
                $hrg = $this->db->query("SELECT * FROM pesanan_pembelian_detail WHERE barang_jual_id = $db[barang_jual_id] AND type = 1 ORDER BY id ASC")->row_array();

                $update = [
                    'harga_pokok' => $hrg['harga']
                ];
            }

            if($cek['jenis_harga_pokok'] == 'LIFO'){
                $update = [
                    'harga_pokok' => $db['harga']
                ];
            }

            if($cek['jenis_harga_pokok'] == 'AVERAGE'){
                $hrg = $this->db->query("SELECT AVG(harga) as harga FROM pesanan_pembelian_detail WHERE barang_jual_id = $db[barang_jual_id] AND type = 1 GROUP BY barang_jual_id")->row_array();

                $update = [
                    'harga_pokok' => $hrg['harga']
                ];
            }

            $this->db->update('barang_jual', $update, ['id' => $db['barang_jual_id']]);
        }
    }

    public function getPembelianById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.barang_jual_id, 
                                    b.quantity,
                                    b.diskon as disc, 
                                    b.harga, 
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
                                    pesanan_pembelian a 
                                    JOIN pesanan_pembelian_detail b ON a.id = b.pesanan_pembelian_id 
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
        $this->db->delete('pesanan_pembelian',['id'=>$id]);
        $this->db->delete('pesanan_pembelian_detail',['pesanan_pembelian_id'=>$id]);
    }
   
}