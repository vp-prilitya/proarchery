<?php

class Transaksi_kas_model extends CI_model
{
    public function getPengeluaran()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*, 
                                        c.nama 
                                    FROM 
                                        transaksi_kas a 
                                        LEFT JOIN pelanggan c ON a.user_id = c.id 
                                    WHERE 
                                        a.perusahaan_id = $id 
                                        AND a.url = 'pengeluaran'
                                    ")->result_array();
    }

    public function savePengeluaran()
    {
        $user_id = htmlspecialchars($this->input->post('user_id'));
        $akun_id_from = htmlspecialchars($this->input->post('akun_id_from'));
        $rincian = htmlspecialchars($this->input->post('rincian'));
        $total = str_replace('.', '', htmlspecialchars($this->input->post('total_kredit')));
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');

        $transaksi_kas = [
                'no_transaksi' => pengeluaran(),
                'akun_id' => 0,
                'jumlah' => $total,
                'akun_id_from' => $akun_id_from,
                'user_id' => $user_id,
                'rincian' => $rincian,
                'url' => 'pengeluaran',
                'perusahaan_id' => $perusahaan_id,
                'created' => $created,
                'user_created' => $user_created,
        ];
        $this->db->insert('transaksi_kas', $transaksi_kas);
        $transaksi_kas_id = $this->db->insert_id();

        $akun_id = $this->input->post('akun_id')??[];
        $kredit = $this->input->post('kredit')??[];

        $insert = [];
        // $total = 0;
        for ($i=0; $i < count($akun_id); $i++) { 

            $akun = htmlspecialchars($akun_id[$i]);
            $jumlah = htmlspecialchars($kredit[$i]);
            // $total += $jumlah;

            $data = [
                'transaksi_kas_id' => $transaksi_kas_id,
                'akun_id' => $akun,
                'jumlah' => $jumlah,
            ];

            array_push($insert, $data);
        }

        $this->transaksiPengeluaran($akun_id_from, $total, $insert, $rincian, $transaksi_kas_id, $user_id, $user_created, $created, $perusahaan_id);
        $this->db->insert_batch('transaksi_kas_detail', $insert);
        // $this->db->update('transaksi_kas', ['jumlah' => $total], ['id' => $transaksi_kas_id]);
        $update = "UPDATE akun SET saldo = saldo - $total WHERE id = $akun_id_from";
        $this->db->query($update);
    }

    public function transaksiPengeluaran($akun_id_from, $total, $insert2, $deskripsi, $foreign_id, $pelanggan_id, $user_created, $created, $perusahaan_id)
    {
        $rincian = "Transaksi Kas Keluar pelanggan_id : $pelanggan_id ($deskripsi)";
        $insert = [];
        $data = [
            'akun_id' => $akun_id_from,
            'debit' => 0,
            'kredit' => $total,
            'rincian' => $rincian,
            'url' => 'transaksi_kas/createPengeluaran',
            'foreign_id' => $foreign_id,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];
        array_push($insert, $data);

        foreach ($insert2 as $key => $db) {
            $data2 = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['jumlah'],
                'kredit' =>0,
                'rincian' => $rincian,
                'url' => 'transaksi_kas/createPengeluaran',
                'foreign_id' => $foreign_id,
                'perusahaan_id' => $perusahaan_id,
                'created' => $created,
                'user_created' => $user_created,
            ];
            array_push($insert, $data2);
        }
        $this->db->insert_batch('transaksi', $insert);
    }

    public function getPenerimaan()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*, 
                                        c.nama 
                                    FROM 
                                        transaksi_kas a 
                                        LEFT JOIN vendor c ON a.user_id = c.id 
                                    WHERE 
                                        a.perusahaan_id = $id 
                                        AND a.url = 'penerimaan'
                                    ")->result_array();
    }

    public function savePenerimaan()
    {
        $user_id = htmlspecialchars($this->input->post('user_id'));
        $akun_id_from = htmlspecialchars($this->input->post('akun_id_from'));
        $rincian = htmlspecialchars($this->input->post('rincian'));
        $total = str_replace('.', '', htmlspecialchars($this->input->post('total_kredit')));
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');

        $transaksi_kas = [
            'no_transaksi' => penerimaan(),
            'akun_id' => 0,
            'jumlah' => $total,
            'akun_id_from' => $akun_id_from,
            'user_id' => $user_id,
            'rincian' => $rincian,
            'url' => 'penerimaan',
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];
        $this->db->insert('transaksi_kas', $transaksi_kas);
        $transaksi_kas_id = $this->db->insert_id();

        $akun_id = $this->input->post('akun_id')??[];
        $kredit = $this->input->post('kredit')??[];

        $insert = [];
        // $total = 0;
        for ($i=0; $i < count($akun_id); $i++) { 

            $akun = htmlspecialchars($akun_id[$i]);
            $jumlah = htmlspecialchars($kredit[$i]);
            // $total += $jumlah;

            $data = [
                'transaksi_kas_id' => $transaksi_kas_id,
                'akun_id' => $akun,
                'jumlah' => $jumlah,
            ];

            array_push($insert, $data);
        }

        $this->transaksiPenerimaan($akun_id_from, $total, $insert, $rincian, $user_id, $transaksi_kas_id, $user_created, $created, $perusahaan_id);
        $this->db->insert_batch('transaksi_kas_detail', $insert);
        $update = "UPDATE akun SET saldo = saldo + $total WHERE id = $akun_id_from";
        $this->db->query($update);
    }

    public function transaksiPenerimaan($akun_id_from, $total, $insert2, $deskripsi, $vendor_id, $foreign_id, $user_created, $created, $perusahaan_id)
    {
        $rincian = "Transaksi Kas Masuk vendor_id : $vendor_id ($deskripsi)";
        $insert = [];
        $data = [
            'akun_id' => $akun_id_from,
            'debit' => $total,
            'kredit' => 0,
            'rincian' => $rincian,
            'url' => 'transaksi_kas/createPenerimaan',
            'foreign_id' => $foreign_id,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];
        array_push($insert, $data);

        foreach ($insert2 as $key => $db) {
            $data2 = [
                'akun_id' => $db['akun_id'],
                'debit' => 0,
                'kredit' => $db['jumlah'],
                'rincian' => $rincian,
                'url' => 'transaksi_kas/createPenerimaan',
                'foreign_id' => $foreign_id,
                'perusahaan_id' => $perusahaan_id,
                'created' => $created,
                'user_created' => $user_created,
            ];
            array_push($insert, $data2);
        }
        $this->db->insert_batch('transaksi', $insert);

    }

    public function getTransfer()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*
                                    FROM 
                                        transaksi_kas a 
                                    WHERE 
                                        a.perusahaan_id = $id 
                                        AND a.url = 'transfer'
                                    ")->result_array();
    }

    public function saveTransfer()
    {
        $akun_id = htmlspecialchars($this->input->post('akun_id'));
        $akun_id_from = htmlspecialchars($this->input->post('akun_id_from'));
        $rincian = htmlspecialchars($this->input->post('rincian'));
        $jumlah = htmlspecialchars($this->input->post('kredit'));
        $jumlah = date('Y-m-d', strtotime(htmlspecialchars($this->input->post('created'))));
        $perusahaan_id = $this->session->userdata('perusahaan_id');


        $data = [
            'no_transaksi' => transfer(),
            'akun_id' => $akun_id,
            'jumlah' => $jumlah,
            'akun_id_from' => $akun_id_from,
            'user_id' => 0,
            'rincian' => $rincian,
            'url' => 'transfer',
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        
        
        $this->db->insert('transaksi_kas', $data);
        
        $update = "UPDATE akun SET saldo = saldo - $jumlah WHERE id = $akun_id_from";
        $this->db->query($update);
        
        $update = "UPDATE akun SET saldo = saldo + $jumlah WHERE id = $akun_id";
        $this->db->query($update);
    }

    public function delete($id)
    {
        $this->db->delete('transaksi_kas',['id'=>$id]);
        $this->db->delete('transaksi_kas_detail',['transaksi_kas_id'=>$id]);
        $this->db->delete('transaksi',['foreign_id'=>$id]);
    }

    public function getInfo()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*,
                                        b.nama as kelompok
                                    FROM 
                                        akun a 
                                        LEFT JOIN kelompok b ON a.kelompok_id = b.id
                                    WHERE 
                                        a.perusahaan_id = $id AND 
                                        a.kelompok_id = 1
                                    ")->result_array();
    }
}