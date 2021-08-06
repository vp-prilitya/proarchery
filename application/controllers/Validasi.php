<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Validasi_model');
        $this->load->model('Bank_model');
        $this->load->model('Akun_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));

        $data['judul'] = 'Validasi';
        $data['data'] = $this->Validasi_model->getTransaksiPenjualan($dari, $sampai);
        $data['unpost'] = $this->Validasi_model->getTransaksiPenjualanValid($dari, $sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        // $data['data2'] = $this->Validasi_model->getTransaksiPengirimanPenjualan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit($kasir, $id)
    { 
        $data['judul'] = 'Validasi';
        $data['akun'] = $this->Akun_model->getAkun();

        if($kasir == 1){
            $transaksi = $this->Validasi_model->getTransaksiPenjualanById($id);
            // var_dump($transaksi);
            $data['data'] = $transaksi;;
            $data['is_kasir'] = 1;
            $data['bank'] = $this->Bank_model->getBank();
            $data_akun = [];

            foreach ($transaksi as $key => $db) {
                if($db['is_paket'] == 1){
                    $paket = $this->Validasi_model->getBarangJualAkunByPaketId($db['barang_jual_id']);

                    foreach ($paket as $key => $dt) {
                        $barang_jual_akun = $this->Validasi_model->getBarangJualAkun($dt['barang_id']);
                        foreach ($barang_jual_akun as $key2 => $dt2) {
                            array_push($data_akun, $dt2);
                        }
                    }
                } else {
                    $barang_jual_akun = $this->Validasi_model->getBarangJualAkun($db['barang_jual_id']);
                    foreach ($barang_jual_akun as $key3 => $dt3) {
                        array_push($data_akun, $dt3);
                    }
                }
            }
            $data['data_akun'] = $data_akun;
            // var_dump($data_akun);
            // die;
        } else {
            $data['data'] = $this->Validasi_model->getTransaksiPengirimanPenjualanById($id);
            $data['is_kasir'] = 0;
        }

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function save()
    {   
        $this->Validasi_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Divalidasi');
        redirect('validasi');
    }

    public function delete($kasir, $id)
    {   
        $this->Validasi_model->delete($kasir, $id);
        $this->session->set_flashdata('warning', 'Data Berhasil Diunpost');
        redirect('validasi');
    }

}