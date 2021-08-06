<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsinyiasi extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("savePembayaran", "getKO"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Konsinyiasi_model');
        $this->load->model('Pembelian_model');
        $this->load->model('Bank_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Pembayaran Konsinyiasi';
        $data['data'] = $this->Konsinyiasi_model->getKonsinyiasiHistory();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('konsinyiasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Pembayaran Hutang';
        $data['bank'] = $this->Bank_model->getBank();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('konsinyiasi/create', $data);
        $this->load->view('templates/footer');
    }

    public function getKO()
    {
        $data = $this->Konsinyiasi_model->getKO();
        echo json_encode($data);
    }

    public function savePembayaran()
    {   
        $this->Konsinyiasi_model->savePembayaran();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("konsinyiasi");
    }

    public function print($id)
    {
        $data['judul'] = 'Konsinyiasi';
        $data['data'] = $this->Konsinyiasi_model->getPembayaranById($id);
        $this->load->view('konsinyiasi/print',$data);
    }

    public function delete($id)
    {   
        $this->Hutang_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('hutang');
    }


}