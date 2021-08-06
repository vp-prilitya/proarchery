<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update", "print", "getBarang", "getBarangDetail", "getCust", "cekBarang"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Penjualan_model');
        $this->load->model('Pelanggan_model');
        $this->load->model('Bank_model');
        $this->load->model('Karyawan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Penjualan';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $no_faktur = htmlspecialchars($this->input->get('no_faktur'));

        if($no_faktur){
            $data['data'] = $this->Penjualan_model->getPenjualanByNoFaktur($no_faktur);
        } else {
            $data['data'] = $this->Penjualan_model->getPenjualan($dari, $sampai);
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        
        // var_dump($data['data']); die;
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penjualan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Penjualan';
        $data['toko'] = $this->Penjualan_model->getBarangPopulerToko();
        // var_dump($data['toko']); die;
        $data['jasa'] = $this->Penjualan_model->getBarangPopulerJasa();
        $data['data1'] = $this->Pelanggan_model->getPelanggan();
        $data['bank'] = $this->Bank_model->getBank();
        $data['sales'] = $this->Karyawan_model->getSales();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penjualan/create', $data);
        $this->load->view('templates/footer');
    }

    public function getBarang()
    {
        $data = $this->Penjualan_model->getBarang();
        echo json_encode($data);
    }

    public function getBarangDetail()
    {
        $data = $this->Penjualan_model->getBarangDetail();
        echo json_encode($data);
    }

    public function getCust()
    {
        $data = $this->Penjualan_model->getCust();
        echo json_encode($data);
    }

    public function cekBarang()
    {
        $data = $this->Penjualan_model->cekBarang();
        echo json_encode($data);
    }

    public function save()
    {   
        $data = $this->Penjualan_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("penjualan/print/$data");
    }

    
    public function print($id)
    {
        $data['judul'] = 'Penjualan';
        $data['data'] = $this->Penjualan_model->getPenjualanById($id);
        $this->load->view('penjualan/print',$data);
    }

    public function delete($id)
    {   
        $this->Penjualan_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('penjualan');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Penjualan';
        $data['data'] = $this->Penjualan_model->getPenjualanById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penjualan/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Penjualan_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('penjualan');
    }
}