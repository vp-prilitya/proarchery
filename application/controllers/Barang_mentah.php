<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_mentah extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        
        $this->load->model('Barang_mentah_model');
        $this->load->model('Kategori_model');
        $this->load->model('Satuan_model');
        $this->load->model('Gudang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = "Barang Mentah";
        $data['data'] = $this->Barang_mentah_model->getBarang_mentah();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_mentah/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = "Barang Mentah";
        $data['data'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['gudang'] = $this->Gudang_model->getGudang();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_mentah/create', $data);
        $this->load->view('templates/footer');
    }

    // public function getHargaPokok()
    // {
    //     $data = $this->Barang_mentah_model->getHargaPokok();
    //     echo json_encode($data);
    // }

    public function save()
    {   
        $this->Barang_mentah_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('barang_mentah');
    }

    public function edit($id)
    { 
        $data['judul'] = "Barang Mentah";
        $data['kat'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['gudang'] = $this->Gudang_model->getGudang();
        $data['data'] = $this->Barang_mentah_model->getBarang_mentahById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_mentah/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Barang_mentah_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('barang_mentah');
    }
    
    public function delete($id)
    {   
        $this->Barang_mentah_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('barang_mentah');
    }

}