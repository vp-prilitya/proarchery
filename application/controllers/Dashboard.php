<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Dashboard_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['saldo'] = $this->Dashboard_model->getSaldo();
        $data['hutang'] = $this->Dashboard_model->getHutang();
        $data['piutang'] = $this->Dashboard_model->getPiutang();
        $data['stok'] = $this->Dashboard_model->getStok();
        
        $data['penjualan_hariPOS'] = $this->Dashboard_model->getPenjualanHariPOS();
        $data['penjualan_bulanPOS'] = $this->Dashboard_model->getPenjualanBulanPOS();

        $data['penjualan_hari'] = $this->Dashboard_model->getPenjualanHari();
        $data['penjualan_bulan'] = $this->Dashboard_model->getPenjualanBulan();

        $data['pembelian_hari'] = $this->Dashboard_model->getPembelianHari();
        $data['pembelian_bulan'] = $this->Dashboard_model->getPembelianBulan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
    
     public function menu()
    {
        $menu = $this->session->userdata('menu');
        var_dump($menu); die;
    }

}