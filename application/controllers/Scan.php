<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "getBarangDetail", "getKaryawan"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Scan_model');
        // $this->load->model('Akun_model');
        // $this->load->model('Divisi_model');
        $this->load->library('form_validation');
    }

    public function create()
    {
        $data['judul'] = 'Scan';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('scan/create', $data);
        $this->load->view('templates/footer');
    }

    public function getBarangDetail()
    {
        $data = $this->Scan_model->getBarangDetail();
        
        echo json_encode($data);
    }

    public function getKaryawan()
    {
        $data = $this->Scan_model->getKaryawan();
        echo json_encode($data);
    }

    public function save()
    {   
        $data = $this->Scan_model->save();

        if($data > 0){
            $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        } else {
            $this->session->set_flashdata('gagal', 'Invoice Sudah Digunakan');
        }
        redirect('scan/create');
    }
}