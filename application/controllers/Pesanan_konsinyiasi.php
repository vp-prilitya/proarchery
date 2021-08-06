<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_konsinyiasi extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Pesanan_konsinyiasi_model');
        $this->load->model('Barang_konsinyiasi_model');
        $this->load->model('Vendor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Pesanan Konsinyiasi';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $no_faktur = htmlspecialchars($this->input->get('no_faktur'));

        if($no_faktur){
            $data['data'] = $this->Pesanan_konsinyiasi_model->getKonsinyiasiByNoFaktur($no_faktur);
        } else {
            $data['data'] = $this->Pesanan_konsinyiasi_model->getKonsinyiasi($dari, $sampai);
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pesanan_konsinyiasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Pesanan Konsinyiasi';
        $data['produk'] = $this->Barang_konsinyiasi_model->getBarang_konsinyiasi();
        $data['vendor'] = $this->Vendor_model->getVendor();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pesanan_konsinyiasi/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        if($this->input->post('id') == null){
            redirect("pesanan_konsinyiasi");
        }
        
        $this->Pesanan_konsinyiasi_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("pesanan_konsinyiasi");
    }

    
    public function print($id)
    {
        $data['judul'] = 'Pesanan Konsinyiasi';
        $data['data'] = $this->Pesanan_konsinyiasi_model->getKonsinyiasiById($id);
        $this->load->view('pesanan_konsinyiasi/print',$data);
    }

    public function delete($id)
    {   
        $this->Pesanan_konsinyiasi_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('pesanan_konsinyiasi');
    }

}