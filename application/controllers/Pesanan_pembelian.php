<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_pembelian extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Pesanan_pembelian_model');
        $this->load->model('Barang_jual_model');
        $this->load->model('Barang_mentah_model');
        $this->load->model('Vendor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Pesanan Pembelian';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $no_faktur = htmlspecialchars($this->input->get('no_faktur'));

        if($no_faktur){
            $data['data'] = $this->Pesanan_pembelian_model->getPembelianByNoFaktur($no_faktur);
        } else {
            $data['data'] = $this->Pesanan_pembelian_model->getPembelian($dari, $sampai);
        }
        
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pesanan_pembelian/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Pesanan Pembelian';
        $data['produk'] = $this->Barang_jual_model->getBarangJualSatuan();
        $data['paket'] = $this->Barang_mentah_model->getBarang_mentah();
        $data['vendor'] = $this->Vendor_model->getVendor();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pesanan_pembelian/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        if($this->input->post('id') == null AND $this->input->post('idRaw') == null){
            redirect("pesanan_pembelian");
        }
        
        $this->Pesanan_pembelian_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("pesanan_pembelian");
    }

    
    public function print($id)
    {
        $data['judul'] = 'Pesanan Pembelian';
        $data['data'] = $this->Pesanan_pembelian_model->getPembelianById($id);
        $this->load->view('pesanan_pembelian/print',$data);
    }

    public function delete($id)
    {   
        $this->Pesanan_pembelian_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('pesanan_pembelian');
    }

}