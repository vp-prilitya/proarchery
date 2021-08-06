<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuda extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Kuda_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Kuda';
        $data['data'] = $this->Kuda_model->getKuda();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kuda/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Kuda';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kuda/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Kuda_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('kuda');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Kuda';
        $data['data'] = $this->Kuda_model->getKudaById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kuda/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Kuda_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('kuda');
    }
    
    public function delete($id)
    {   
        $this->Kuda_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('kuda');
    }

}