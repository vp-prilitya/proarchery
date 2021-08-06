<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_konsinyiasi extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }

        $this->load->model('Barang_konsinyiasi_model');
        $this->load->model('Kategori_model');
        $this->load->model('Satuan_model');
        $this->load->model('Gudang_model');
        $this->load->model('Vendor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = "Barang Konsinyiasi";
        $data['data'] = $this->Barang_konsinyiasi_model->getBarang_konsinyiasi();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_konsinyiasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = "Barang Konsinyiasi";
        $data['data'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['gudang'] = $this->Gudang_model->getGudang();
        $data['vendor'] = $this->Vendor_model->getVendor();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_konsinyiasi/create', $data);
        $this->load->view('templates/footer');
    }

    // public function getHargaPokok()
    // {
    //     $data = $this->Barang_konsinyiasi_model->getHargaPokok();
    //     echo json_encode($data);
    // }

    public function save()
    {   
        $this->Barang_konsinyiasi_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('barang_konsinyiasi');
    }

    public function edit($id)
    { 
        $data['judul'] = "Barang Konsinyiasi";
        $data['kat'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['gudang'] = $this->Gudang_model->getGudang();
        $data['data'] = $this->Barang_konsinyiasi_model->getBarang_konsinyiasiById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_konsinyiasi/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Barang_konsinyiasi_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('barang_konsinyiasi');
    }
    
    public function delete($id)
    {   
        $this->Barang_konsinyiasi_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('barang_konsinyiasi');
    }

}