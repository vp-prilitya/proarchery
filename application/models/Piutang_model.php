<?php

class Piutang_model extends CI_model
{
    public function getAllPiutang()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    SUM(a.piutang) as mytotal,
                                    SUM(b.piutang) as total,
                                    SUM(b.bayar) as bayar,
                                    c.nama,
                                    e.tgl_jatuh_tempo  
                                FROM 
                                    piutang a
                                    LEFT JOIN pembayaran_piutang b ON a.id = b.piutang_id 
                                    JOIN pelanggan c ON a.pelanggan_id = c.id
                                    LEFT JOIN pengiriman_penjualan d ON a.penjualan_id = d.id 
                                    LEFT JOIN pesanan_penjualan e ON d.pesanan_penjualan_id = e.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.piutang > 0
                                GROUP BY
                                    a.pelanggan_id,
                                    b.piutang_id
                                ")->result_array();
    }

    public function getAllPiutang2()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    SUM(a.piutang) as mytotal,
                                    SUM(b.piutang) as total,
                                    SUM(b.bayar) as bayar,
                                    c.nama,
                                    e.tgl_jatuh_tempo  
                                FROM 
                                    piutang a
                                    LEFT JOIN pembayaran_piutang b ON a.id = b.piutang_id 
                                    JOIN pelanggan c ON a.pelanggan_id = c.id
                                    LEFT JOIN pesanan_penjualan e ON a.penjualan_id = e.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.piutang > 0
                                GROUP BY
                                    a.pelanggan_id,
                                    b.piutang_id
                                ")->result_array();
    }

    public function getDetailPiutang($pelanggan_id)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*, 
                                        b.no_faktur as sj, 
                                        b.total_tagihan, 
                                        c.no_faktur as so, 
                                        c.tgl_jatuh_tempo 
                                    FROM 
                                        piutang a 
                                        LEFT JOIN pengiriman_penjualan b ON a.penjualan_id = b.id 
                                        LEFT JOIN pesanan_penjualan c ON b.pesanan_penjualan_id = c.id 
                                    WHERE 
                                        a.perusahaan_id = $perusahaan_id AND
                                        a.pelanggan_id = $pelanggan_id AND 
                                        a.piutang > 0
                                    ")->result_array();
    }

    public function getDetailPiutang2($pelanggan_id)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.no_faktur as so, 
                                    b.total_tagihan, 
                                    b.tgl_jatuh_tempo, 
                                    c.no_faktur as sj
                                FROM 
                                    piutang a 
                                    LEFT JOIN pesanan_penjualan b ON a.penjualan_id = b.id
                                    LEFT JOIN pengiriman_penjualan c ON c.pesanan_penjualan_id = b.id 
                                    
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.pelanggan_id = $pelanggan_id AND 
                                    a.piutang > 0")->result_array();
    }

    public function getPiutangHistory()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $tgl = date('Y-m-d');
        return $this->db->query("SELECT 
                                    a.*, 
                                    c.nama
                                FROM 
                                    pembayaran_piutang a 
                                    JOIN piutang b ON a.piutang_id = b.id 
                                    JOIN pelanggan c ON b.pelanggan_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created = '$tgl'
                                ")->result_array();
    }

    public function getPiutang()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    b.total_tagihan,
                                    c.nama 
                                FROM 
                                    piutang a 
                                    JOIN penjualan b ON a.penjualan_id = b.id AND b.status = 0 
                                    JOIN pelanggan c ON a.pelanggan_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id
                                ")->result_array();
    }

    public function getPiutangById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.total_tagihan, 
                                    c.nama, c.alamat, c.contact, c.email, 
                                    d.bayar, d.piutang as sisa, d.created as tgl, d.id as pembayaran_id, d.no_transaksi 
                                FROM 
                                    piutang a 
                                    JOIN penjualan b ON a.penjualan_id = b.id  
                                    JOIN pelanggan c ON a.pelanggan_id = c.id 
                                    LEFT JOIN pembayaran_piutang d ON a.id = d.piutang_id 
                                WHERE 
                                    a.id = $id
                                ")->result_array();
    }

    public function getSO()
    {
        $cari = $this->input->post('po');
        $data = [];

        return $this->db->query("SELECT 
                                    c.*,
                                    b.no_faktur
                                FROM  pesanan_penjualan a
                                    JOIN pengiriman_penjualan b ON a.id = b.pesanan_penjualan_id
                                    LEFT JOIN piutang c ON a.id = c.penjualan_id
                                WHERE  
                                    a.no_faktur = '$cari' AND
                                    c.piutang > 0")->result_array();
    }

    public function savePembayaran()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $jenis_pembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));
        $total_bayar = str_replace('.','',htmlspecialchars($this->input->post('total_bayar2')));
        $pelanggan_id = str_replace('.','',htmlspecialchars($this->input->post('pelanggan_id')));
        $bank_id = htmlspecialchars($this->input->post('bank_id'));

         // INPUT UANG MUKA
         if($jenis_pembayaran == 'uang muka'){
            $cut_um = $this->transaksiUM($total_bayar, $perusahaan_id, $pelanggan_id);
        }
        // AKHIR

        $piutang_id = $this->input->post('id')??[];
        $bayar = $this->input->post('bayar')??[];
        $subtotal = $this->input->post('subtotal')??[];
        $diskon_idr = $this->input->post('diskon_idr')??[];

        $insert = [];
        $bank = [];
        for ($i=0; $i < count($piutang_id); $i++) { 
            $disc = $diskon_idr[$i]!=''?$diskon_idr[$i]:0;

            $data = [
                'piutang_id' => $piutang_id[$i],
                'no_transaksi' => notransaksiPiutang(),
                'piutang' => $subtotal[$i],
                'diskon_idr' => $disc,
                'bayar' => $bayar[$i],
                'jenis_pembayaran' => $jenis_pembayaran,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);
            
            $update = [
                'piutang' => $subtotal[$i] - $bayar[$i] - $disc
            ];
            $this->db->update('piutang', $update, ['id'=>$piutang_id[$i]]);
        }

        $this->db->insert_batch('pembayaran_piutang', $insert);


        // INPUT TRANSAKSI
        $this->transaksiPembayaran($insert, $pelanggan_id);
        // AKHIR

        // INPUT TRANSAKSI BANK
        if($jenis_pembayaran == 'transfer'){
            $this->transaksiBank($insert, $bank_id);
        }
        // AKHIR
    }

    public function transaksiPembayaran($data, $pelanggan_id)
    {
        // var_dum($data); die;
        $rule = $this->db->get_where('pengaturan', ['variable'=>'piutang', 'perusahaan_id'=>$data[0]['perusahaan_id']])->result_array();

        $insert = [];
        foreach ($rule as $key => $db) {
            foreach ($data as $key => $dt) {
                $dataku = [
                    'akun_id' => $db['akun_id'],
                    'debit' => $db['is_debit'] == 1 ? $dt['bayar'] : 0,
                    'kredit' => $db['is_debit'] == 0 ? $dt['bayar'] : 0,
                    'rincian' => 'Transaksi dilakukan dari pembayaran piutang penjualan pelanggan_id : ' . $pelanggan_id,
                    'url' => 'piutang',
                    'foreign_id' => $dt['piutang_id'],
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
                'rincian' => 'Transaksi dilakukan dari Pembayaran Piutang',
                'url' => 'piutang',
                'foreign_id' => $db['piutang_id'],
                'created' => $db['created'],
                'user_created' => $db['user_created'],
                'perusahaan_id' => $db['perusahaan_id']
            ];

            array_push($insert, $dataTransaksi);
        }

        $this->db->insert_batch('transaksi_bank', $insert);
    }

    public function transaksiUM($total_bayar, $perusahaan_id, $pelanggan_id)
    {
        $data = $this->db->get_where('uang_muka', ['user_id' => $pelanggan_id, 'perusahaan_id' => $perusahaan_id, 'jenis' => 'penjualan'])->row_array();

        if($total_bayar <= $data['jumlah']){
            $this->db->query("UPDATE uang_muka SET jumlah = jumlah - $total_bayar WHERE user_id = $pelanggan_id AND perusahaan_id = $perusahaan_id AND jenis = 'penjualan'");
            return 1;
        } else {
            $this->session->set_flashdata('gagal', 'Uang Muka Tidak Mencukupi');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function getPembayaranById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    c.*, 
                                    d.nama as perusahaan, d.alamat as alamat_perusahaan, d.telp, d.email as email_perusahaan,
                                    e.no_faktur as no_sj
                                FROM 
                                    pembayaran_piutang a 
                                    JOIN piutang b ON a.piutang_id = b.id 
                                    JOIN pelanggan c ON b.pelanggan_id = c.id 
                                    JOIN perusahaan d ON b.perusahaan_id = d.id
                                    JOIN pengiriman_penjualan e ON b.penjualan_id = e.id
                                WHERE 
                                    a.id = $id
                                ")->result_array();
    }

    public function delete($id)
    {
        $data = $this->db->get_where('pembayaran_piutang', ['id'=>$id])->row_array();

        $query = "UPDATE piutang SET piutang = piutang + $data[bayar] WHERE id = $data[piutang_id]";
        $this->db->query($query);

        if($data['jenis_pembayaran'] == 'uang muka'){
            $db = $this->db->get_where('piutang', ['id'=>$data['piutang_id']])->row_array();

            $this->db->query("UPDATE uang_muka SET jumlah = jumlah + $data[bayar] WHERE user_id = $db[pelanggan_id] AND perusahaan_id = $db[perusahaan_id] AND jenis = 'penjualan'");
        }
        
        $this->db->delete('pembayaran_piutang',['id'=>$id]);
        $this->db->delete('transaksi',['foreign_id'=>$data['piutang_id'], 'url' => 'piutang']);
    }

    public function getAllLebihBayar()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*,
                                    d.no_faktur as no_sj,
                                    c.nama
                                FROM 
                                    pembayaran_piutang a
                                    LEFT JOIN piutang b ON b.id = a.piutang_id 
                                    LEFT JOIN pengiriman_penjualan d ON d.id = b.penjualan_id 
                                    JOIN pelanggan c ON b.pelanggan_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.piutang < a.bayar
                                ")->result_array();
    }

    // public function save()
    // {
    //     $piutang = htmlspecialchars($this->input->post('piutang'));
    //     $bayar = htmlspecialchars($this->input->post('bayar'));
    //     $id = htmlspecialchars($this->input->post('id'));
    //     $perusahaan_id = $this->session->userdata('perusahaan_id');
    //     $created = date('Y-m-d');
    //     $user_created = $this->session->userdata('id');

    //     $data = [
    //         'piutang_id' => $id,
    //         'no_transaksi' => notransaksiPiutang(),
    //         'piutang' => $piutang,
    //         'bayar' => $bayar,
    //         'created' => $created,
    //         'user_created' => $user_created,
    //         'perusahaan_id' => $perusahaan_id
    //     ];

    //     $this->db->insert('pembayaran_piutang', $data);

    //     $update = [
    //         'piutang' => $piutang - $bayar
    //     ];
    //     $this->db->update('piutang', $update, ['id'=>$id]);

    //     if($bayar >= $piutang){
    //         $status = [
    //             'status' => 1
    //         ];

    //         $this->db->update('penjualan', $status, ['id'=>htmlspecialchars($this->input->post('penjualan_id'))]);
    //     }

    //     // INPUT TRANSAKSI
    //     $this->transaksi($id, $bayar, $created, $user_created, $perusahaan_id);
    //     // AKHIR
    // }

    // public function transaksi($piutang_id, $total_bayar, $created, $user_created, $perusahaan_id)
    // {
    //     $rule = $this->db->get_where('pengaturan', ['variable'=>'piutang', 'perusahaan_id'=>$perusahaan_id])->result_array();

    //     $insert = [];
    //     foreach ($rule as $key => $db) {
    //         $data = [
    //             'akun_id' => $db['akun_id'],
    //             'debit' => $db['is_debit'] == 1 ? $total_bayar : 0,
    //             'kredit' => $db['is_debit'] == 0 ? $total_bayar : 0,
    //             'rincian' => 'Transaksi dilakukan dari pembayaran piutang',
    //             'url' => 'piutang',
    //             'foreign_id' => $piutang_id,
    //             'created' => $created,
    //             'user_created' => $user_created,
    //             'perusahaan_id' => $perusahaan_id
    //         ];

    //         array_push($insert, $data);
    //     }

    //     $this->db->insert_batch('transaksi', $insert);
    // }

    // public function getPembayaranById($id)
    // {
    //     return $this->db->query("SELECT 
    //                                 a.*, 
    //                                 c.*, 
    //                                 d.nama as perusahaan, d.alamat as alamat_perusahaan, d.telp, d.email as email_perusahaan,
    //                                 e.total_tagihan 
    //                             FROM 
    //                                 pembayaran_piutang a 
    //                                 JOIN piutang b ON a.piutang_id = b.id 
    //                                 JOIN pelanggan c ON b.pelanggan_id = c.id 
    //                                 JOIN perusahaan d ON b.perusahaan_id = d.id
    //                                 JOIN penjualan e ON b.penjualan_id = e.id 
    //                             WHERE 
    //                                 a.id = $id
    //                             ")->result_array();
    // }

    // public function update()
    // {
    //     $data = [
    //         'nama' => htmlspecialchars($this->input->post('nama')),
    //         'perusahaan_id' => $this->session->userdata('perusahaan_id'),
    //         'created' => date('Y-m-d'),
    //         'user_created' => $this->session->userdata('id'),
    //     ];

    //     $this->db->update('piutang', $data, ['id'=>$this->input->post('id')]);
    // }

}