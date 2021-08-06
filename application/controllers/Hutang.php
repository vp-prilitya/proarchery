<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("savePembayaran", "getPO", "detailHutang", "detailHutang2"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Hutang_model');
        $this->load->model('Pembelian_model');
        $this->load->model('Bank_model');
        $this->load->model('Pesanan_pembelian_model');
        $this->load->library('form_validation');
    }

    public function daftar()
    {
        $data['judul'] = 'Hutang Usaha';
        // $data['data'] = $this->Hutang_model->getAllHutang();
        $data['data'] = $this->Hutang_model->getAllHutang2();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('hutang/daftar', $data);
        $this->load->view('templates/footer');
    }

    public function detailHutang($id)
    {
        $data['data'] = $this->Hutang_model->getDetailHutang($id);
        $this->load->view('hutang/modalForDaftar', $data);
    }

    public function detailHutang2($id)
    {
        $data['data'] = $this->Hutang_model->getDetailHutang2($id);
        $this->load->view('hutang/modalForDaftar', $data);
    }

    public function index()
    {
        $data['judul'] = 'Pembayaran Hutang Usaha';
        $data['data'] = $this->Hutang_model->getHutangHistory();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('hutang/index', $data);
        $this->load->view('templates/footer');
    }

    // public function index()
    // {
    //     $data['judul'] = 'Hutang';
    //     $data['data'] = $this->Hutang_model->getHutang();

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('hutang/index', $data);
    //     $this->load->view('templates/footer');
    // }

    public function create()
    {
        $data['judul'] = 'Pembayaran Hutang';
        $data['bank'] = $this->Bank_model->getBank();
        $data['po'] = $this->Pesanan_pembelian_model->getPembelian(date('Y-m-d'), date('Y-m-d'));

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('hutang/create', $data);
        $this->load->view('templates/footer');
    }

    public function getPO()
    {
        $data = $this->Hutang_model->getPO();
        echo json_encode($data);
    }

    public function savePembayaran()
    {   
        if($this->input->post('id') == null ){
            redirect("hutang");
        }

        $this->Hutang_model->savePembayaran();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("hutang");
    }

    public function print($id)
    {
        $data['judul'] = 'Hutang';
        $data['data'] = $this->Hutang_model->getPembayaranById($id);
        $this->load->view('hutang/print',$data);
    }

    public function delete($id)
    {   
        $this->Hutang_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('hutang');
    }

    public function lebih_bayar()
    {
        $data['judul'] = 'Kelebihan Pembayaran Hutang';
        $data['data'] = $this->Hutang_model->getAllLebihBayar();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('hutang/lebih_bayar', $data);
        $this->load->view('templates/footer');
    }

    // public function bayar($id){
    //     $data['judul'] = 'Hutang';
    //     $data['data'] = $this->Hutang_model->getHutangById($id);

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('hutang/bayar', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function detail($id)
    // {
    //     $data['data'] = $this->Pembelian_model->getPembelianById($id);
    //     $this->load->view('hutang/modal', $data);
    // }

    // public function save()
    // {   
    //     $id = htmlspecialchars($this->input->post('id'));
    //     $this->Hutang_model->save();
    //     $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
    //     redirect("hutang/bayar/$id");
    // }

    // public function edit($id)
    // { 
    //     $data['judul'] = 'Hutang';
    //     $data['data'] = $this->Hutang_model->getHutangById($id);

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('hutang/edit', $data);
    //     $this->load->view('templates/footer');
    // }

    
    // public function update()
    // {   
    //     $this->Hutang_model->update();
    //     $this->session->set_flashdata('info', 'Data Berhasil Diubah');
    //     redirect('Hutang');
    // }

}