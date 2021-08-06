<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Jurnal_model');
        $this->load->model('Akun_model');
        $this->load->model('Divisi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Input Jurnal';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $data['data'] = $this->Jurnal_model->getJurnal($dari, $sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('jurnal/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Jurnal';
        $data['data'] = $this->Akun_model->getAkun();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('jurnal/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Jurnal_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('jurnal');
    }

    public function edit($time)
    {
        $data['judul'] = 'Jurnal';
        $data['data'] = $this->Akun_model->getAkun();
        $data['jurnal'] = $this->Jurnal_model->getJurnalByTime($time);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('jurnal/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {   
        $this->Jurnal_model->update();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('jurnal');
    }

    public function delete($time)
    {   
        $this->Jurnal_model->delete($time);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('jurnal');
    }

    public function penjualan()
    {
        $data['judul'] = 'Jurnal Penjualan';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $data['data'] = $this->Jurnal_model->getJurnalPenjualan($dari, $sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $data['download'] =1;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('jurnal/penjualan', $data);
        $this->load->view('templates/footer');
    }

    public function pembelian()
    {
        $data['judul'] = 'Jurnal Pembelian';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $data['data'] = $this->Jurnal_model->getJurnalPembelian($dari, $sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $data['download'] =1;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('jurnal/pembelian', $data);
        $this->load->view('templates/footer');
    }

    public function umum()
    {
        $data['judul'] = 'Jurnal Umum';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $data['data'] = $this->Jurnal_model->getJurnalUmum($dari, $sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $data['download'] =1;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('jurnal/umum', $data);
        $this->load->view('templates/footer');
    }
}