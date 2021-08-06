<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Pengaturan_model');
        $this->load->model('Akun_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Pengaturan Umum';
        $data['data'] = $this->Pengaturan_model->getPengaturan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pengaturan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Pengaturan Umum';
        $data['data'] = $this->Akun_model->getAkun();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pengaturan/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Pengaturan_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('pengaturan');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Pengaturan Umum';
        $data['data'] = $this->Pengaturan_model->getPengaturanById($id);
        $data['akun'] = $this->Akun_model->getAkun();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pengaturan/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Pengaturan_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('pengaturan');
    }
    
    public function delete($id)
    {   
        $this->Pengaturan_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('pengaturan');
    }

}