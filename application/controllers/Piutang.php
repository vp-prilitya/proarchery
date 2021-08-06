<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("savePembayaran", "update", "detailPiutang", "detailPiutang2", "getSO"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Piutang_model');
        $this->load->model('Penjualan_model');
        $this->load->model('Bank_model');
        $this->load->model('Pesanan_penjualan_model');
        $this->load->library('form_validation');
    }

    public function daftar()
    {
        $data['judul'] = 'Piutang Usaha';
        // $data['data'] = $this->Piutang_model->getAllPiutang();
        $data['data'] = $this->Piutang_model->getAllPiutang2();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('piutang/daftar', $data);
        $this->load->view('templates/footer');
    }

    public function detailPiutang($id)
    {
        $data['data'] = $this->Piutang_model->getDetailPiutang($id);
        $this->load->view('piutang/modalForDaftar', $data);
    }

    public function detailPiutang2($id)
    {
        $data['data'] = $this->Piutang_model->getDetailPiutang2($id);
        $this->load->view('piutang/modalForDaftar', $data);
    }

    public function index()
    {
        $data['judul'] = 'Pembayaran Piutang Usaha';
        $data['data'] = $this->Piutang_model->getPiutangHistory();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('piutang/index', $data);
        $this->load->view('templates/footer');
    }

    // public function index()
    // {
    //     $data['judul'] = 'Pembayaran Piutang Usaha';
    //     $data['data'] = $this->Piutang_model->getPiutang();

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('piutang/index', $data);
    //     $this->load->view('templates/footer');
    // }

    public function create()
    {
        $data['judul'] = 'Pembayaran Piutang Usaha';
        $data['bank'] = $this->Bank_model->getBank();
        $data['so'] = $this->Pesanan_penjualan_model->getPenjualan(date('Y-m-d'), date('Y-m-d'));

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('piutang/create', $data);
        $this->load->view('templates/footer');
    }

    public function getSO()
    {
        $data = $this->Piutang_model->getSO();
        echo json_encode($data);
    }

    public function savePembayaran()
    {   
        if($this->input->post('id') == null ){
            redirect("piutang");
        }

        $this->Piutang_model->savePembayaran();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("piutang");
    }
    
    public function print($id)
    {
        $data['judul'] = 'Piutang';
        $data['data'] = $this->Piutang_model->getPembayaranById($id);
        
        $item = $data['data'];
        $email = [
            'email' => $item[0]['email'],
            'subjek' => 'Invoice Piutang',
            'nama' => $item[0]['nama'],
            'link' => base_url("cetak/piutang/") . $id,
            'template' => 'piutang/email',
        ];
        send_mail($email);

        $this->load->view('piutang/print',$data);
    }

    public function delete($id)
    {   
        $this->Piutang_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('piutang');
    }

    public function lebih_bayar()
    {
        $data['judul'] = 'Kelebihan Pembayaran Piutang';
        $data['data'] = $this->Piutang_model->getAllLebihBayar();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('piutang/lebih_bayar', $data);
        $this->load->view('templates/footer');
    }

    // public function bayar($id){
    //     $data['judul'] = 'Piutang';
    //     $data['data'] = $this->Piutang_model->getPiutangById($id);

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('piutang/bayar', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function detail($id)
    // {
    //     $data['data'] = $this->Penjualan_model->getPenjualanById($id);
    //     $this->load->view('piutang/modal', $data);
    // }

    // public function save()
    // {   
    //     $id = htmlspecialchars($this->input->post('id'));
    //     $this->Piutang_model->save();
    //     $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
    //     redirect("piutang/bayar/$id");
    // }


    // public function create()
    // {
    //     $data['judul'] = 'Piutang';

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('piutang/create', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function edit($id)
    // { 
    //     $data['judul'] = 'Piutang';
    //     $data['data'] = $this->Piutang_model->getPiutangById($id);

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('piutang/edit', $data);
    //     $this->load->view('templates/footer');
    // }

    
    // public function update()
    // {   
    //     $this->Piutang_model->update();
    //     $this->session->set_flashdata('info', 'Data Berhasil Diubah');
    //     redirect('piutang');
    // }

}