<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penawaran_penjualan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "getBarang"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Penawaran_penjualan_model');
        $this->load->model('Barang_jual_model');
        $this->load->model('Pelanggan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Penawaran Penjualan';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $no_faktur = htmlspecialchars($this->input->get('no_faktur'));

        if($no_faktur){
            $data['data'] = $this->Penawaran_penjualan_model->getPenjualanByNoFaktur($no_faktur);
        } else {
            $data['data'] = $this->Penawaran_penjualan_model->getPenjualan($dari, $sampai);
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penawaran_penjualan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Penawaran Penjualan';
        $data['produk'] = $this->Barang_jual_model->getBarangJualSatuan();
        $data['paket'] = $this->Barang_jual_model->getBarang_jual();
        $data['data'] = $this->Pelanggan_model->getPelanggan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penawaran_penjualan/create', $data);
        $this->load->view('templates/footer');
    }

    public function getBarang()
    {
        $data = $this->Penawaran_penjualan_model->getBarang();
        echo json_encode($data);
    }

    public function save()
    {   
        if($this->input->post('id') == null ){
            redirect("penawaran_penjualan");
        }
        
        $this->Penawaran_penjualan_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("penawaran_penjualan");
    }

    
    public function print($id)
    {
        $data['judul'] = 'Penawaran Penjualan';
        $data['data'] = $this->Penawaran_penjualan_model->getPenjualanById($id);
        $this->load->view('penawaran_penjualan/print',$data);
    }

    public function delete($id)
    {   
        $this->Penawaran_penjualan_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('penawaran_penjualan');
    }

}