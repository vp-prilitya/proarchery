<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuota extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Kuota_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Beli Kuota';
        $data['data'] = $this->Kuota_model->getKuota();

        $this->load->view('templates_pelanggan/header');
        $this->load->view('templates_pelanggan/sidebar');
        $this->load->view('kuota/index', $data);
        $this->load->view('templates_pelanggan/footer');
    }

    public function create()
    {
        $data['judul'] = 'Beli Kuota';
        $data['data'] = $this->Kuota_model->getAllKuota();

        $this->load->view('templates_pelanggan/header');
        $this->load->view('templates_pelanggan/sidebar');
        $this->load->view('kuota/create', $data);
        $this->load->view('templates_pelanggan/footer');
    }

    public function save()
    {   
        $this->Kuota_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('kuota');
    }

    public function detail($id)
    {
        $data['data'] = $this->Kuota_model->getKuotaById($id);
        $this->load->view('kuota/modal', $data);
    }

    public function upload()
    {   
        $this->Kuota_model->upload();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('kuota');
    }
    
    public function delete($id)
    {   
        $this->Kuota_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('kuota');
    }

}