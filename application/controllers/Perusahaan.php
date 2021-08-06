<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Perusahaan_model');
        $this->load->library('form_validation');
    }

    public function tes()
    {
        $this->Perusahaan_model->saveAkun('1', '1', date('Y-m-d'));
    }
    public function index()
    {
        $data['judul'] = 'Perusahaan';
        $data['data'] = $this->Perusahaan_model->getPerusahaan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('perusahaan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Perusahaan';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('perusahaan/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Perusahaan_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('perusahaan');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Perusahaan';
        $data['data'] = $this->Perusahaan_model->getPerusahaanById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('perusahaan/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Perusahaan_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('perusahaan');
    }
    
    public function delete($id)
    {   
        $this->Perusahaan_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('perusahaan');
    }

}