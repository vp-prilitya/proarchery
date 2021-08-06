<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Cabang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Cabang';
        $data['data'] = $this->Cabang_model->getCabang();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('cabang/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Cabang';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('cabang/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Cabang_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('cabang');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Cabang';
        $data['data'] = $this->Cabang_model->getCabangById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('cabang/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Cabang_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('cabang');
    }
    
    public function delete($id)
    {   
        $this->Cabang_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('cabang');
    }

}