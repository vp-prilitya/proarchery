<?php

class Konsinyiasi_model extends CI_model
{

    public function getKonsinyiasiHistory()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    c.nama
                                FROM 
                                    pembayaran_konsinyiasi a 
                                    JOIN konsinyiasi b ON a.konsinyiasi_id = b.id 
                                    JOIN vendor c ON b.vendor_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id
                                ")->result_array();
    }

    public function getKO()
    {
        $cari = $this->input->post('po');
        $data = [];

        return $this->db->query("SELECT 
                                    a.total_tagihan,
                                    a.total_bayar,
                                    a.vendor_id as pelanggan_id,
                                    b.harga, b.quantity, b.diskon,
                                    c.nama, c.no_part,
                                    d.hutang as sisa, d.id 
                                FROM  pesanan_konsinyiasi a
                                    JOIN pesanan_konsinyiasi_detail b ON a.id = b.pesanan_konsinyiasi_id
                                    JOIN barang_konsinyiasi c ON b.barang_jual_id = c.id
                                    LEFT JOIN konsinyiasi d ON a.id = d.pesanan_konsinyiasi_id
                                WHERE  
                                    a.no_faktur = '$cari' AND
                                    d.hutang > 0")->result_array();
    }

    public function savePembayaran()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $konsinyiasi_id = htmlspecialchars($this->input->post('konsinyiasi_id'));
        $total_tagihan = str_replace('.','', htmlspecialchars($this->input->post('total_tagihan')));
        $total_bayar = htmlspecialchars($this->input->post('total_bayar'));
        $jenis_pembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));
        $bank_id = htmlspecialchars($this->input->post('bank_id'));

        $insert = [];
        $data = [
            'konsinyiasi_id' => $konsinyiasi_id,
            'no_transaksi' => notransaksiKonsinyiasi(),
            'hutang' => $total_tagihan,
            'bayar' => $total_bayar,
            'jenis_pembayaran' => $jenis_pembayaran,
            'created' => $created,
            'user_created' => $user_created,
            'perusahaan_id' => $perusahaan_id
        ];

        array_push($insert, $data);
        $update = [
            'hutang' => $total_tagihan - $total_bayar
        ];
        $this->db->update('konsinyiasi', $update, ['id'=>$konsinyiasi_id]);

        $this->db->insert_batch('pembayaran_konsinyiasi', $insert);


        // INPUT TRANSAKSI
        $this->transaksiPembayaran($insert);
        // AKHIR

        // INPUT TRANSAKSI BANK
        if($jenis_pembayaran == 'transfer'){
            $this->transaksiBank($insert, $bank_id);
        }
        // AKHIR
    }

    public function transaksiPembayaran($data)
    {
        $rule = $this->db->get_where('pengaturan', ['variable'=>'hutang', 'perusahaan_id'=>$data[0]['perusahaan_id']])->result_array();

        $insert = [];
        foreach ($rule as $key => $db) {
            foreach ($data as $key => $dt) {
                $dataku = [
                    'akun_id' => $db['akun_id'],
                    'debit' => $db['is_debit'] == 1 ? $dt['bayar'] : 0,
                    'kredit' => $db['is_debit'] == 0 ? $dt['bayar'] : 0,
                    'rincian' => 'Transaksi dilakukan dari pembayaran konsinyiasi pembelian',
                    'url' => 'konsinyiasi',
                    'foreign_id' => $dt['konsinyiasi_id'],
                    'created' => $dt['created'],
                    'user_created' => $dt['user_created'],
                    'perusahaan_id' => $dt['perusahaan_id']
                ];
    
                array_push($insert, $dataku);
            }
        }

        $this->db->insert_batch('transaksi', $insert);
    }

    public function transaksiBank($data, $bank_id)
    {
        $insert = [];
        foreach ($data as $key => $db) {
            $dataTransaksi = [
                'bank_id' => $bank_id,
                'jumlah' => $db['bayar'],
                'jenis' => $db['jenis_pembayaran'],
                'rincian' => 'Transaksi dilakukan dari Pembayaran Konsinyiasi',
                'url' => 'konsinyiasi',
                'foreign_id' => $db['konsinyiasi_id'],
                'created' => $db['created'],
                'user_created' => $db['user_created'],
                'perusahaan_id' => $db['perusahaan_id']
            ];

            array_push($insert, $dataTransaksi);
        }

        $this->db->insert_batch('transaksi_bank', $insert);
    }

    public function getPembayaranById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    c.*, c.telp as contact, 
                                    d.nama as perusahaan, d.alamat as alamat_perusahaan, d.telp, d.email as email_perusahaan,
                                    e.no_faktur as no_sj
                                FROM 
                                    pembayaran_konsinyiasi a 
                                    JOIN konsinyiasi b ON a.konsinyiasi_id = b.id 
                                    JOIN vendor c ON b.vendor_id = c.id 
                                    JOIN perusahaan d ON b.perusahaan_id = d.id
                                    JOIN pesanan_konsinyiasi e ON b.pesanan_konsinyiasi_id = e.id
                                WHERE 
                                    a.id = $id
                                ")->result_array();
    }
    
    public function delete($id)
    {
        $data = $this->db->get_where('pembayaran_konsinyiasi', ['id'=>$id])->row_array();

        $query = "UPDATE konsinyiasi SET hutang = hutang + $data[bayar] WHERE id = $data[konsinyiasi_id]";
        $this->db->query($query);
        
        $this->db->delete('pembayaran_konsinyiasi',['id'=>$id]);
        $this->db->delete('transaksi',['foreign_id'=>$data['konsinyiasi_id'], 'url' => 'konsinyiasi']);
    }
}