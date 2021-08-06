<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatih extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Pelatih_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Pelatih';
        $data['data'] = $this->Pelatih_model->getPelatih();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pelatih/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Pelatih';
        $data['pelatih'] = $this->Pelatih_model->getKaryawan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pelatih/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Pelatih_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('pelatih');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Pelatih';
        $data['data'] = $this->Pelatih_model->getPelatihById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pelatih/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Pelatih_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('pelatih');
    }
    
    public function delete($id)
    {   
        $this->Pelatih_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('pelatih');
    }

}