<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        $publicMethods  = array("save", "update", "getKode"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }

        $this->load->model('Akun_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Akun';
        $data['data'] = $this->Akun_model->getAkun();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('akun/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Akun';
        $data['data'] = $this->Akun_model->getAkun();
        // $data['data'] = $this->Akun_model->getKelompok();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('akun/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Akun_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('akun');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Akun';
        $data['data'] = $this->Akun_model->getAkunById($id);
        $data['data2'] = $this->Akun_model->getAkun();
        // $data['kel'] = $this->Akun_model->getKelompok();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('akun/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Akun_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('akun');
    }
    
    public function delete($id)
    {   
        $this->Akun_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('akun');
    }

    public function getKode()
    {
        $data = $this->Akun_model->getKode();
        echo json_encode($data);
    }

}