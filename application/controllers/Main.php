<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function master()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('main/master');
        $this->load->view('templates/footer');
    }

    public function penjualan()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('main/penjualan');
        $this->load->view('templates/footer');
    }

    public function pembelian()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('main/pembelian');
        $this->load->view('templates/footer');
    }

    public function konsinyiasi()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('main/konsinyiasi');
        $this->load->view('templates/footer');
    }

    public function jadwal()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('main/jadwal');
        $this->load->view('templates/footer');
    }

    public function bank()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('main/bank');
        $this->load->view('templates/footer');
    }

    public function barang()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('main/barang');
        $this->load->view('templates/footer');
    }

    public function laporan()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('main/laporan');
        $this->load->view('templates/footer');
    }

    public function statement()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('main/statement');
        $this->load->view('templates/footer');
    }

}