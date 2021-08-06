<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }

        $this->load->model('Satuan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Satuan';
        $data['data'] = $this->Satuan_model->getSatuan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('satuan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Satuan';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('satuan/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Satuan_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('satuan');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Satuan';
        $data['data'] = $this->Satuan_model->getSatuanById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('satuan/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Satuan_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('satuan');
    }
    
    public function delete($id)
    {   
        $this->Satuan_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('satuan');
    }

}