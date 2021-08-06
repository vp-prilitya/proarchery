<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_kas extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("savePengeluaran", "savePenerimaan", "saveTransfer", "deleteMasuk", "deleteKeluar"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Transaksi_kas_model');
        $this->load->model('Akun_model');
        $this->load->model('Pelanggan_model');
        $this->load->model('Vendor_model');
        $this->load->library('form_validation');
    }

    public function pengeluaran()
    {
        $data['judul'] = 'Kas Keluar';
        $data['data'] = $this->Transaksi_kas_model->getPengeluaran();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pengeluaran/index', $data);
        $this->load->view('templates/footer');
    }

    public function createPengeluaran()
    {
        $data['judul'] = 'Kas Keluar';
        // $data['akun_from'] = $this->Akun_model->getAkun1();
        $data['akun_from'] = $this->Akun_model->getAkunKasBank();
        // $data['data'] = $this->Akun_model->getAkun123();
        $data['data'] = $this->Akun_model->getAkun();
        $data['pelanggan'] = $this->Pelanggan_model->getPelanggan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pengeluaran/create', $data);
        $this->load->view('templates/footer');
    }

    public function savePengeluaran()
    {   
        $this->Transaksi_kas_model->savePengeluaran();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('transaksi_kas/pengeluaran');
    }

    public function penerimaan()
    {
        $data['judul'] = 'Kas Masuk';
        $data['data'] = $this->Transaksi_kas_model->getPenerimaan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penerimaan/index', $data);
        $this->load->view('templates/footer');
    }

    public function createPenerimaan()
    {
        $data['judul'] = 'Kas Masuk';
        // $data['akun_from'] = $this->Akun_model->getAkun1();
        $data['akun_from'] = $this->Akun_model->getAkunKasBank();
        $data['data'] = $this->Akun_model->getAkun();
        $data['pelanggan'] = $this->Vendor_model->getVendor();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penerimaan/create', $data);
        $this->load->view('templates/footer');
    }

    public function savePenerimaan()
    {   
        $this->Transaksi_kas_model->savePenerimaan();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('transaksi_kas/penerimaan');
    }

    public function transfer()
    {
        $data['judul'] = 'Transfer';
        $data['data'] = $this->Transaksi_kas_model->getTransfer();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('transfer/index', $data);
        $this->load->view('templates/footer');
    }

    public function createTransfer()
    {
        $data['judul'] = 'Transfer';
        $data['data'] = $this->Akun_model->getAkun1();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('transfer/create', $data);
        $this->load->view('templates/footer');
    }

    public function saveTransfer()
    {   
        $this->Transaksi_kas_model->saveTransfer();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('transaksi_kas/transfer');
    }
    
    public function deleteKeluar($id)
    {   
        $this->Transaksi_kas_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('transaksi_kas/pengeluaran');
    }
    
    public function deleteMasuk($id)
    {   
        $this->Transaksi_kas_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('transaksi_kas/penerimaan');
    }

    public function info()
    {
        $data['judul'] = 'Info Kas';
        $data['data'] = $this->Transaksi_kas_model->getInfo();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('transfer/info', $data);
        $this->load->view('templates/footer');
    }

}