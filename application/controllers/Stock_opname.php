<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_opname extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update", "getBarang", "saveGudang"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Barang_mentah_model');
        $this->load->model('Barang_jual_model');
        $this->load->model('Stock_opname_model');
        $this->load->model('Gudang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Stock Opname';
        $data['barang_mentah'] = $this->Barang_mentah_model->getBarang_mentah();
        $data['data'] = $this->Barang_jual_model->getBarangJualSatuan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('stock_opname/index', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Stock_opname_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('stock_opname');
    }

    public function pindah_gudang()
    {
        $data['judul'] = 'Pindah Gudang';
        $data['data'] = $this->Gudang_model->getGudang();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('stock_opname/pindah_gudang', $data);
        $this->load->view('templates/footer');
    }

    public function getBarang()
    {
        $data =  $this->Stock_opname_model->getBarang();
        echo json_encode($data);
    }

    public function saveGudang()
    {
        $this->Stock_opname_model->saveGudang();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('stock_opname/pindah_gudang');
    }
}