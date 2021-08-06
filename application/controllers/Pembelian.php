<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Pembelian_model');
        $this->load->model('Barang_jual_model');
        $this->load->model('Barang_mentah_model');
        $this->load->model('Vendor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Pembelian';
        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $no_faktur = htmlspecialchars($this->input->get('no_faktur'));

        if($no_faktur){
            $data['data'] = $this->Pembelian_model->getPembelianByNoFaktur($no_faktur);
        } else {
            $data['data'] = $this->Pembelian_model->getPembelian($dari, $sampai);
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pembelian/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Pembelian';
        $data['barang_jual'] = $this->Barang_jual_model->getBarangJualSatuan();
        $data['barang_mentah'] = $this->Barang_mentah_model->getBarang_mentah();
        $data['vendor'] = $this->Vendor_model->getVendor();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pembelian/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $data = $this->Pembelian_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("pembelian/print/$data");
    }

    public function print($id)
    {
        $data['judul'] = 'Pembelian';
        $data['data'] = $this->Pembelian_model->getPembelianById($id);
        $this->load->view('pembelian/print',$data);
    }

    public function delete($id)
    {   
        $this->Pembelian_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('pembelian');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Pembelian';
        $data['data'] = $this->Pembelian_model->getPembelianById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pembelian/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Pembelian_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('pembelian');
    }
    

}