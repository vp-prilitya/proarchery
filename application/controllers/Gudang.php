<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Gudang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Gudang';
        $data['data'] = $this->Gudang_model->getGudang();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('gudang/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Gudang';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('gudang/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Gudang_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('gudang');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Gudang';
        $data['data'] = $this->Gudang_model->getGudangById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('gudang/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Gudang_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('gudang');
    }
    
    public function delete($id)
    {   
        $this->Gudang_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('gudang');
    }

}