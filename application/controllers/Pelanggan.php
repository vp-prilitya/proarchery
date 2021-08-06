<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Pelanggan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = "Pelanggan";
        $data['data'] = $this->Pelanggan_model->getPelanggan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pelanggan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = "Pelanggan";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pelanggan/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Pelanggan_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('pelanggan');
    }

    public function edit($id)
    { 
        $data['judul'] = "Pelanggan";
        $data['data'] = $this->Pelanggan_model->getPelangganById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pelanggan/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Pelanggan_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('pelanggan');
    }
    
    public function delete($id)
    {   
        $this->Pelanggan_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('pelanggan');
    }

}