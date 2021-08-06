<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update", "getSJ"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Saldo_model');
        $this->load->model('Akun_model');
        $this->load->library('form_validation');
    }

    public function create()
    {
        $data['judul'] = 'Saldo';
        $data['data'] = $this->Akun_model->getAkun();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('saldo/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Saldo_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('saldo/create');
    }
}