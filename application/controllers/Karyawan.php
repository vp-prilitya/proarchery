<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Karyawan_model');
        $this->load->model('Divisi_model');
        $this->load->model('Perusahaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Karyawan';
        $data['data'] = $this->Karyawan_model->getKaryawan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('karyawan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Karyawan';
        $data['div'] = $this->Divisi_model->getDivisi();
        $data['perusahaan'] = $this->Perusahaan_model->getPerusahaan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('karyawan/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Karyawan_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('karyawan');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Karyawan';
        $data['data'] = $this->Karyawan_model->getKaryawanById($id);
        $data['div'] = $this->Divisi_model->getDivisi();
        $data['perusahaan'] = $this->Perusahaan_model->getPerusahaan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('karyawan/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Karyawan_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('karyawan');
    }
    
    public function delete($id)
    {   
        $this->Karyawan_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('karyawan');
    }

}