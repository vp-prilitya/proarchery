<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_pembelian extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "getPO"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Penerimaan_pembelian_model');
        $this->load->model('Barang_jual_model');
        $this->load->model('Pesanan_pembelian_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Pengiriman Pembelian';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $no_faktur = htmlspecialchars($this->input->get('no_faktur'));

        if($no_faktur){
            $data['data'] = $this->Penerimaan_pembelian_model->getPembelianByNoFaktur($no_faktur);
        } else {
            $data['data'] = $this->Penerimaan_pembelian_model->getPembelian($dari, $sampai);
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penerimaan_pembelian/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Pengiriman Pembelian';
        $data['produk'] = $this->Barang_jual_model->getBarangJualSatuan();
        $data['paket'] = $this->Barang_jual_model->getBarang_jual();
        $data['po'] = $this->Pesanan_pembelian_model->getPembelian(date('Y-m-d'), date('Y-m-d'));

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penerimaan_pembelian/create', $data);
        $this->load->view('templates/footer');
    }

    public function getPO()
    {
        $data = $this->Penerimaan_pembelian_model->getPO();
        echo json_encode($data);
    }

    public function save()
    {   
        if($this->input->post('id') == null AND $this->input->post('idRaw') == null){
            redirect("penerimaan_pembelian");
        }
        
        $this->Penerimaan_pembelian_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("penerimaan_pembelian");
    }

    
    public function print($id)
    {
        $data['judul'] = 'Pengiriman Pembelian';
        $data['data'] = $this->Penerimaan_pembelian_model->getPembelianById($id);
        $this->load->view('penerimaan_pembelian/print',$data);
    }

    public function delete($id)
    {   
        $this->Penerimaan_pembelian_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('Penerimaan_pembelian');
    }

}