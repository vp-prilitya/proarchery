<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_besar extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Buku_besar_model');
        $this->load->model('Akun_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        redirect('buku_besar/index2');
        $data['judul'] = 'Buku Besar';
        // $data['data'] = $this->Buku_besar_model->getBuku_besar();
        $data['akun'] = $this->Akun_model->getAkun();
        $data['download'] = 1;

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $id = htmlspecialchars($this->input->get('akun'));

        if($dari!='' AND $sampai!='' AND $id!=''){
            $data['data'] = $this->Buku_besar_model->getBuku_besar($dari, $sampai, $id);
            $data['kelompok'] = $this->Akun_model->getAkunById($id);
        } else {
            $data['data'] = [];
            $data['kelompok'] = [];
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        // var_dump($dari); die;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('buku_besar/index', $data);
        $this->load->view('templates/footer');
    }

    public function index2()
    {
        $data['judul'] = 'Buku Besar';
        // $data['data'] = $this->Buku_besar_model->getBuku_besar();
        $data['akun'] = $this->Akun_model->getAkun();
        $data['download'] = 1;

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));

        if($dari!='' AND $sampai!=''){
            $kelompok = $this->Akun_model->getAkun();
            $datanya = [];

            foreach ($kelompok as $key => $db) {
               $datanya[$db['kode'] .' '. $db['nama']] = $this->Buku_besar_model->getBuku_besar($dari, $sampai, $db['id']);
            }
            $data['data'] = $datanya;
            $data['kelompok'] = $kelompok;

            // var_dump($datanya['1100 Kas Ubah']); die;
        } else {
            $data['data'] = [];
            $data['kelompok'] = [];
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        // var_dump($dari); die;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('buku_besar/index2', $data);
        $this->load->view('templates/footer');
    }

}