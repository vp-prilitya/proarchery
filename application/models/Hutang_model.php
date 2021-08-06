<?php

class Hutang_model extends CI_model
{

    public function getAllHutang()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    SUM(a.hutang) as mytotal,
                                    SUM(b.hutang) as total,
                                    SUM(b.bayar) as bayar,
                                    c.nama,
                                    e.tgl_jatuh_tempo 
                                FROM 
                                    hutang a
                                    LEFT JOIN pembayaran_hutang b ON a.id = b.hutang_id 
                                    JOIN vendor c ON a.vendor_id = c.id 
                                    LEFT JOIN penerimaan_pembelian d ON a.pembelian_id = d.id 
                                    LEFT JOIN pesanan_pembelian e ON d.pesanan_pembelian_id = e.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.hutang > 0
                                GROUP BY
                                    a.vendor_id,
                                    b.hutang_id
                                ")->result_array();
    }

    public function getAllHutang2()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    SUM(a.hutang) as mytotal,
                                    SUM(b.hutang) as total,
                                    SUM(b.bayar) as bayar,
                                    c.nama,
                                    e.tgl_jatuh_tempo 
                                FROM 
                                    hutang a
                                    LEFT JOIN pembayaran_hutang b ON a.id = b.hutang_id 
                                    JOIN vendor c ON a.vendor_id = c.id 
                                    LEFT JOIN pesanan_pembelian e ON a.pembelian_id = e.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.hutang > 0
                                GROUP BY
                                    a.vendor_id,
                                    b.hutang_id
                                ")->result_array();
    }

    public function getDetailHutang($pelanggan_id)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*, 
                                        b.no_faktur as sj, 
                                        b.total_tagihan, 
                                        c.no_faktur as so, 
                                        c.tgl_jatuh_tempo 
                                    FROM 
                                        hutang a 
                                        LEFT JOIN penerimaan_pembelian b ON a.pembelian_id = b.id 
                                        LEFT JOIN pesanan_pembelian c ON b.pesanan_pembelian_id = c.id 
                                    WHERE 
                                        a.perusahaan_id = $perusahaan_id AND
                                        a.vendor_id = $pelanggan_id AND 
                                        a.hutang > 0
                                    ")->result_array();
    }

    public function getDetailHutang2($pelanggan_id)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*, 
                                        b.no_faktur as sj, 
                                        c.total_tagihan, 
                                        c.no_faktur as so, 
                                        c.tgl_jatuh_tempo 
                                    FROM 
                                        hutang a 
                                        LEFT JOIN pesanan_pembelian c ON a.pembelian_id = c.id 
                                        LEFT JOIN penerimaan_pembelian b ON b.pesanan_pembelian_id = c.id 
                                    WHERE 
                                        a.perusahaan_id = $perusahaan_id AND
                                        a.vendor_id = $pelanggan_id AND 
                                        a.hutang > 0
                                    ")->result_array();
    }

    public function getHutangHistory()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $tgl = date('Y-m-d');
        return $this->db->query("SELECT 
                                    a.*, 
                                    c.nama
                                FROM 
                                    pembayaran_hutang a 
                                    JOIN hutang b ON a.hutang_id = b.id 
                                    JOIN vendor c ON b.vendor_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created = '$tgl'
                                ")->result_array();
    }

    public function getHutang()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.total_tagihan, b.no_faktur,
                                    c.nama 
                                FROM 
                                    hutang a 
                                    JOIN pembelian b ON a.pembelian_id = b.id AND b.status = 0 
                                    JOIN vendor c ON a.vendor_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id
                                ")->result_array();
    }

    public function getHutangById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.total_tagihan, 
                                    c.nama, c.alamat, c.telp, c.email, 
                                    d.bayar, d.hutang as sisa, d.created as tgl, d.id as pembayaran_id, d.no_transaksi 
                                FROM 
                                    hutang a 
                                    JOIN pembelian b ON a.pembelian_id = b.id  
                                    JOIN vendor c ON a.vendor_id = c.id 
                                    LEFT JOIN pembayaran_hutang d ON a.id = d.hutang_id 
                                WHERE 
                                    a.id = $id
                                ")->result_array();
    }

    public function getPO()
    {
        $cari = $this->input->post('po');
        $data = [];

        return $this->db->query("SELECT 
                                    c.*,
                                    b.no_faktur
                                FROM  pesanan_pembelian a
                                    JOIN penerimaan_pembelian b ON a.id = b.pesanan_pembelian_id
                                    LEFT JOIN hutang c ON a.id = c.pembelian_id
                                WHERE  
                                    a.no_faktur = '$cari' AND
                                    c.hutang > 0")->result_array();
    }

    public function savePembayaran()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $jenis_pembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));
        $total_bayar = str_replace('.','',htmlspecialchars($this->input->post('total_bayar2')));
        $vendor_id = str_replace('.','',htmlspecialchars($this->input->post('vendor_id')));
        $bank_id = htmlspecialchars($this->input->post('bank_id'));

         // INPUT UANG MUKA
         if($jenis_pembayaran == 'uang muka'){
            $cut_um = $this->transaksiUM($total_bayar, $perusahaan_id, $vendor_id);
        }
        // AKHIR

        $hutang_id = $this->input->post('id')??[];
        $bayar = $this->input->post('bayar')??[];
        $subtotal = $this->input->post('subtotal')??[];
        $diskon_idr = $this->input->post('diskon_idr')??[];

        $insert = [];
        for ($i=0; $i < count($hutang_id); $i++) {
            $disc = $diskon_idr[$i]!=''?$diskon_idr[$i]:0;

            $data = [
                'hutang_id' => $hutang_id[$i],
                'no_transaksi' => notransaksiHutang(),
                'hutang' => $subtotal[$i],
                'diskon_idr' => $disc,
                'bayar' => $bayar[$i],
                'jenis_pembayaran' => $jenis_pembayaran,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);

            $update = [
                'hutang' => $subtotal[$i] - $bayar[$i] - $disc
            ];
            $this->db->update('hutang', $update, ['id'=>$hutang_id[$i]]);
        }

        $this->db->insert_batch('pembayaran_hutang', $insert);


        // INPUT TRANSAKSI
        $this->transaksiPembayaran($insert, $vendor_id);
        // AKHIR

        // INPUT TRANSAKSI BANK
        if($jenis_pembayaran == 'transfer'){
            $this->transaksiBank($insert, $bank_id);
        }
        // AKHIR
    }

    public function transaksiPembayaran($data)
    {
        // var_dum($data); die;
        $rule = $this->db->get_where('pengaturan', ['variable'=>'hutang', 'perusahaan_id'=>$data[0]['perusahaan_id']])->result_array();

        $insert = [];
        foreach ($rule as $key => $db) {
            foreach ($data as $key => $dt) {
                $dataku = [
                    'akun_id' => $db['akun_id'],
                    'debit' => $db['is_debit'] == 1 ? $dt['bayar'] : 0,
                    'kredit' => $db['is_debit'] == 0 ? $dt['bayar'] : 0,
                    'rincian' => 'Transaksi dilakukan dari pembayaran hutang pembelian vendor_id : '.$vendor_id,
                    'url' => 'hutang',
                    'foreign_id' => $dt['hutang_id'],
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
                'rincian' => 'Transaksi dilakukan dari Pembayaran Hutang',
                'url' => 'hutang',
                'foreign_id' => $db['hutang_id'],
                'created' => $db['created'],
                'user_created' => $db['user_created'],
                'perusahaan_id' => $db['perusahaan_id']
            ];

            array_push($insert, $dataTransaksi);
        }

        $this->db->insert_batch('transaksi_bank', $insert);
    }

    public function transaksiUM($total_bayar, $perusahaan_id, $vendor_id)
    {
        $data = $this->db->get_where('uang_muka', ['user_id' => $vendor_id, 'perusahaan_id' => $perusahaan_id, 'jenis' => 'pembelian'])->row_array();

        if($total_bayar <= $data['jumlah']){
            $this->db->query("UPDATE uang_muka SET jumlah = jumlah - $total_bayar WHERE user_id = $vendor_id AND perusahaan_id = $perusahaan_id AND jenis = 'pembelian'");
        } else {
            $this->session->set_flashdata('gagal', 'Uang Muka Tidak Mencukupi');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function getPembayaranById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, 
                                    c.*, c.telp as contact, 
                                    d.nama as perusahaan, d.alamat as alamat_perusahaan, d.telp, d.email as email_perusahaan,
                                    e.no_faktur as no_sj
                                FROM 
                                    pembayaran_hutang a 
                                    JOIN hutang b ON a.hutang_id = b.id 
                                    JOIN vendor c ON b.vendor_id = c.id 
                                    JOIN perusahaan d ON b.perusahaan_id = d.id
                                    JOIN penerimaan_pembelian e ON b.pembelian_id = e.id
                                WHERE 
                                    a.id = $id
                                ")->result_array();
    }
    
    public function delete($id)
    {
        $data = $this->db->get_where('pembayaran_hutang', ['id'=>$id])->row_array();

        $query = "UPDATE hutang SET hutang = hutang + $data[bayar] WHERE id = $data[hutang_id]";
        $this->db->query($query);

        if($data['jenis_pembayaran'] == 'uang muka'){
            $db = $this->db->get_where('hutang', ['id'=>$data['hutang_id']])->row_array();

            $this->db->query("UPDATE uang_muka SET jumlah = jumlah + $data[bayar] WHERE user_id = $db[vendor_id] AND perusahaan_id = $db[perusahaan_id] AND jenis = 'pembelian'");
        }
        
        $this->db->delete('pembayaran_hutang',['id'=>$id]);
        $this->db->delete('transaksi',['foreign_id'=>$data['hutang_id'], 'url' => 'hutang']);
    }

    public function getAllLebihBayar()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*,
                                    d.no_faktur as no_sj,
                                    c.nama
                                FROM 
                                    pembayaran_hutang a
                                    LEFT JOIN hutang b ON b.id = a.hutang_id 
                                    LEFT JOIN penerimaan_pembelian d ON d.id = b.pembelian_id 
                                    JOIN vendor c ON b.vendor_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.hutang < a.bayar
                                ")->result_array();
    }

    // public function save()
    // {
    //     $hutang = htmlspecialchars($this->input->post('hutang'));
    //     $bayar = htmlspecialchars($this->input->post('bayar'));
    //     $id = htmlspecialchars($this->input->post('id'));
    //     $perusahaan_id = $this->session->userdata('perusahaan_id');
    //     $created = date('Y-m-d');
    //     $user_created = $this->session->userdata('id');

    //     $data = [
    //         'hutang_id' => $id,
    //         'no_transaksi' => notransaksiHutang(),
    //         'hutang' => $hutang,
    //         'bayar' => $bayar,
    //         'created' => $created,
    //         'user_created' => $user_created,
    //         'perusahaan_id' => $perusahaan_id
    //     ];

    //     $this->db->insert('pembayaran_hutang', $data);

    //     $update = [
    //         'hutang' => $hutang - $bayar
    //     ];
    //     $this->db->update('hutang', $update, ['id'=>$id]);

    //     if($bayar >= $hutang){
    //         $status = [
    //             'status' => 1
    //         ];

    //         $this->db->update('pembelian', $status, ['id'=>htmlspecialchars($this->input->post('pembelian_id'))]);
    //     }

    //     // INPUT TRANSAKSI
    //     $this->transaksi($id, $bayar, $created, $user_created, $perusahaan_id);
    //     // AKHIR
    // }

    // public function transaksi($hutang_id, $total_bayar, $created, $user_created, $perusahaan_id)
    // {
    //     $rule = $this->db->get_where('pengaturan', ['variable'=>'hutang', 'perusahaan_id'=>$perusahaan_id])->result_array();

    //     $insert = [];
    //     foreach ($rule as $key => $db) {
    //         $data = [
    //             'akun_id' => $db['akun_id'],
    //             'debit' => $db['is_debit'] == 1 ? $total_bayar : 0,
    //             'kredit' => $db['is_debit'] == 0 ? $total_bayar : 0,
    //             'rincian' => 'Transaksi dilakukan dari pembayaran hutang',
    //             'url' => 'hutang',
    //             'foreign_id' => $hutang_id,
    //             'created' => $created,
    //             'user_created' => $user_created,
    //             'perusahaan_id' => $perusahaan_id
    //         ];

    //         array_push($insert, $data);
    //     }

    //     $this->db->insert_batch('transaksi', $insert);
    // }

    // public function update()
    // {
    //     $data = [
    //         'nama' => htmlspecialchars($this->input->post('nama')),
    //         'perusahaan_id' => $this->session->userdata('perusahaan_id'),
    //         'created' => date('Y-m-d'),
    //         'user_created' => $this->session->userdata('id'),
    //     ];

    //     $this->db->update('hutang', $data, ['id'=>$this->input->post('id')]);
    // }
}