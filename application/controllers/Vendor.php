<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Vendor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Vendor';
        $data['data'] = $this->Vendor_model->getVendor();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('vendor/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Vendor';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('vendor/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Vendor_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('vendor');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Vendor';
        $data['data'] = $this->Vendor_model->getVendorById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('vendor/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Vendor_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('vendor');
    }
    
    public function delete($id)
    {   
        $this->Vendor_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('vendor');
    }

}