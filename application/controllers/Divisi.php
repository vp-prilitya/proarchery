<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisi extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Divisi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Divisi';
        $data['data'] = $this->Divisi_model->getDivisi();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('divisi/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Divisi';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('divisi/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Divisi_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('divisi');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Divisi';
        $data['data'] = $this->Divisi_model->getDivisiById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('divisi/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Divisi_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('divisi');
    }
    
    public function delete($id)
    {   
        $this->Divisi_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('divisi');
    }

}