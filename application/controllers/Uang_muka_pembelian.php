<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uang_muka_pembelian extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Uang_muka_pembelian_model');
        $this->load->model('Vendor_model');
        $this->load->model('Akun_model');
        $this->load->library('form_validation');
    }

    public function daftar()
    {
        $data['judul'] = 'Daftar Uang Muka Pembelian';
        $data['data'] = $this->Uang_muka_pembelian_model->getDaftarUangMuka();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('uang_muka_pembelian/daftar', $data);
        $this->load->view('templates/footer');
    }

    public function index()
    {
        $data['judul'] = 'Uang Muka Pembelian';
        $data['data'] = $this->Uang_muka_pembelian_model->getUangMuka();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('uang_muka_pembelian/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Uang Muka Pembelian';
        $data['pelanggan'] = $this->Vendor_model->getVendor();
        $data['akun'] = $this->Akun_model->getAkun();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('uang_muka_pembelian/create', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['judul'] = 'Uang Muka Penjualan';
        $data['pelanggan'] = $this->Vendor_model->getVendor();
        $data['akun'] = $this->Akun_model->getAkun();
        $data['data'] =$this->Uang_muka_pembelian_model->getUangMukaById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('uang_muka_pembelian/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {   
        $this->Uang_muka_pembelian_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('uang_muka_pembelian');
    }

    public function save()
    {   
        $this->Uang_muka_pembelian_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('uang_muka_pembelian');
    }

    public function delete($id)
    {   
        $this->Uang_muka_pembelian_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('uang_muka_pembelian');
    }

}