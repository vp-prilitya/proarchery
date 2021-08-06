<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beban extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        
        $this->load->model('Beban_model');
        $this->load->model('Karyawan_model');
        $this->load->model('Pelanggan_model');
        $this->load->model('Vendor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Beban Pengeluaran';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));

        $data['data'] = $this->Beban_model->getBeban($dari, $sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('beban/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Beban Pengeluaran';
        $data['akun'] = $this->Beban_model->getAkunBeban();
        $data['karyawan'] = $this->Karyawan_model->getKaryawan();
        $data['pelanggan'] = $this->Pelanggan_model->getPelanggan();
        $data['vendor'] = $this->Vendor_model->getVendor();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('beban/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Beban_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('beban');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Beban Pengeluaran';
        $data['data'] = $this->Beban_model->getBebanById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('beban/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Beban_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('beban');
    }
    
    public function delete($id)
    {   
        $this->Beban_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('beban');
    }

}