<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_pembelian extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update", "getPJ"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Retur_pembelian_model');
        $this->load->model('Barang_jual_model');
        $this->load->model('Penerimaan_pembelian_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Retur Pembelian';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $no_faktur = htmlspecialchars($this->input->get('no_faktur'));

        if($no_faktur){
            $data['data'] = $this->Retur_pembelian_model->getPembelianByNoFaktur($no_faktur);
        } else {
            $data['data'] = $this->Retur_pembelian_model->getPembelian($dari, $sampai);
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('retur_pembelian/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Retur Pembelian';
        $data['produk'] = $this->Barang_jual_model->getBarangJualSatuan();
        $data['paket'] = $this->Barang_jual_model->getBarang_jual();
        $data['po'] = $this->Penerimaan_pembelian_model->getPembelian(date('Y-m-d'), date('Y-m-d'));

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('retur_pembelian/create', $data);
        $this->load->view('templates/footer');
    }

    public function getPJ()
    {
        $data = $this->Retur_pembelian_model->getPJ();
        echo json_encode($data);
    }

    public function save()
    {   
        if($this->input->post('id') == null ){
            redirect("retur_pembelian");
        }
        
        $this->Retur_pembelian_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("retur_pembelian");
    }

    
    public function print($id)
    {
        $data['judul'] = 'Retur Pembelian';
        $data['data'] = $this->Retur_pembelian_model->getPembelianById($id);
        $this->load->view('retur_pembelian/print',$data);
    }

    public function delete($id)
    {   
        $this->Retur_pembelian_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('retur_pembelian');
    }

}