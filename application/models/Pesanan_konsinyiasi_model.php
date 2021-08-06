<?php

class Pesanan_konsinyiasi_model extends CI_model
{
    public function getKonsinyiasi($dari, $sampai)
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
                                    COUNT(b.pesanan_konsinyiasi_id) as item
                                FROM 
                                    pesanan_konsinyiasi a 
                                    JOIN pesanan_konsinyiasi_detail b ON a.id = b.pesanan_konsinyiasi_id 
                                    AND a.no_faktur = b.no_faktur 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' 
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function getKonsinyiasiByNoFaktur($no_faktur)
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
                                    COUNT(b.pesanan_konsinyiasi_id) as item, 
                                    c.nama, 
                                    c.telp as contact 
                                FROM 
                                    pesanan_konsinyiasi a 
                                    JOIN pesanan_konsinyiasi_detail b ON a.id = b.pesanan_konsinyiasi_id 
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
        $vendor_id = htmlspecialchars($this->input->post('vendor_id'));
        $total_bayar = $total_tagihan;
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $nodaktur = pesananKonsinyiasi();

        $data = [
            'no_faktur' => $nodaktur,
            'vendor_id' => $vendor_id,
            'total_gross' => $total_gross,
            'diskon' => 0,
            'total_tagihan' => $total_tagihan,
            'total_bayar' => 0,
            'ppn' => 0,
            'jenis_ppn' => '',
            'status' => 0,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('pesanan_konsinyiasi', $data);
        $konsinyiasi_id = $this->db->insert_id();
        
        $insert = [];

        $barang_id = $this->input->post('id')??[];
        $quantity = $this->input->post('quantity');
        $harga = $this->input->post('harga');
        $diskon = $this->input->post('disc');
        $update = [];
        for ($i=0; $i < count($barang_id); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_id[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $hrg = htmlspecialchars($harga[$i]);
            $disc = htmlspecialchars($diskon[$i]);

            $dataInsert = [
                'pesanan_konsinyiasi_id' => $konsinyiasi_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'harga' => str_replace('.', '', $hrg),
                'quantity' => $qty,
                'diskon' => $disc,
                'type' => 0
            ];

            array_push($insert, $dataInsert);
            array_push($update, $dataInsert);

            $updateQuery = "UPDATE barang_konsinyiasi SET stok = stok + $qty WHERE id = $barang_jual_id";
            $this->db->query($updateQuery);
        }

        count($insert)>0? $this->db->insert_batch('pesanan_konsinyiasi_detail', $insert) : null;
        $this->updateHargaPokokBarangKonsinyiasi($update);
        $this->hutang($konsinyiasi_id, $vendor_id, $total_tagihan, $created, $user_created, $perusahaan_id);
    }

    public function updateHargaPokokBarangKonsinyiasi($data)
    {
        foreach ($data as $key => $db) {
            $cek = $this->db->get_where('barang_konsinyiasi', ['id' => $db['barang_jual_id']])->row_array();
            
            if($cek['jenis_harga_pokok'] == 'FIFO'){
                $hrg = $this->db->query("SELECT * FROM pesanan_konsinyiasi_detail WHERE barang_jual_id = $db[barang_jual_id] AND type = 0 ORDER BY id ASC")->row_array();

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
                $hrg = $this->db->query("SELECT AVG(harga) as harga FROM pesanan_konsinyiasi_detail WHERE barang_jual_id = $db[barang_jual_id] AND type = 0 GROUP BY barang_jual_id")->row_array();

                $update = [
                    'harga_pokok' => $hrg['harga']
                ];
            }

            $this->db->update('barang_konsinyiasi', $update, ['id' => $db['barang_jual_id']]);
        }
    }

    public function hutang($konsinyiasi_id, $vendor_id, $total_tagihan, $created, $user_created, $perusahaan_id)
    {
        $data = [
            'pesanan_konsinyiasi_id' => $konsinyiasi_id,
            'vendor_id' => $vendor_id,
            'hutang' => $total_tagihan,
            'created' => $created,
            'user_created' => $user_created,
            'perusahaan_id' => $perusahaan_id
        ];

        $this->db->insert('konsinyiasi', $data);
    }

    public function getKonsinyiasiById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.barang_jual_id, 
                                    b.quantity,
                                    b.diskon as disc, 
                                    b.harga,
                                    d.nama as item_jual,  d.satuan as satuan_jual,
                                    f.nama as perusahaan, 
                                    f.email as email_perusahaan, 
                                    f.telp, 
                                    f.alamat as alamat_perusahaan 
                                FROM 
                                    pesanan_konsinyiasi a 
                                    JOIN pesanan_konsinyiasi_detail b ON a.id = b.pesanan_konsinyiasi_id 
                                    AND a.no_faktur = b.no_faktur 
                                    LEFT JOIN barang_konsinyiasi d ON d.id = b.barang_jual_id
                                    JOIN perusahaan f ON a.perusahaan_id = f.id 
                                WHERE 
                                    a.id = $id 
                                ")->result_array();
    }

    public function delete($id)
    {
        $item = $this->getKonsinyiasiById($id);
        // var_dump($item); die;

        foreach ($item as $key => $db) {
            $update = "UPDATE barang_konsinyiasi SET stok = stok - $db[quantity] WHERE id = $db[barang_jual_id]";
            $this->db->query($update);
        }

        $this->db->delete('pesanan_konsinyiasi',['id'=>$id]);
        $this->db->delete('pesanan_konsinyiasi_detail',['pesanan_konsinyiasi_id'=>$id]);
    }
   
}