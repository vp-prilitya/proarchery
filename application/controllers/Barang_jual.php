<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_jual extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        $publicMethods  = array("save", "update", "getBarangMentah", "getBarangJual", "updateFnb", "updatePaket", "saveFnb", "updateFnb", "savePaket", "updatePaket"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }

        $this->load->model('Barang_jual_model');
        $this->load->model('Kategori_model');
        $this->load->model('Satuan_model');
        $this->load->model('Gudang_model');
        $this->load->model('Barang_mentah_model');
        $this->load->model('Akun_model');
        $this->load->library('form_validation');
    }

    public function fnb()
    {
        $data['judul'] = "Food And Beverages";
        $data['data'] = $this->Barang_jual_model->getBarang_jualFnb();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_jual/fnb', $data);
        $this->load->view('templates/footer');
    }

    public function createFnb()
    {
        $data['judul'] = "Food And Beverages";
        $data['data'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['barang_mentah'] = $this->Barang_mentah_model->getBarang_mentah();
        $data['akun'] = $this->Akun_model->getAkun();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_jual/createFnb', $data);
        $this->load->view('templates/footer');
    }

    public function getBarangMentah()
    {
        $id = $this->input->post('id');
        $data = $this->Barang_mentah_model->getBarang_mentahById($id);
        echo json_encode($data);
    }

    public function saveFnb()
    {   
        // var_dump($this->input->post('idBarangMentah') === null); die;
        if($this->input->post('idBarangMentah')=== null){
            $this->session->set_flashdata('gagal', 'Anda Tidak Memilih Ingredient');
            redirect('barang_jual/fnb');
        }

        $this->Barang_jual_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('barang_jual/fnb');
    }

    public function editFnb($id)
    { 
        $data['judul'] = "Food And Beverages";
        $data['kat'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['data'] = $this->Barang_jual_model->getBarang_jualById($id);
        // $data['json'] = json_encode($data['data']);
        $data['barang_mentah'] = $this->Barang_mentah_model->getBarang_mentah();
        $data_akun = $this->Barang_jual_model->getAkunByBarangJualId($id);
        $data['akun'] = $this->Akun_model->getAkun();

        $akun_edit = [];
        foreach ($data_akun as $key => $db) {
            $akun_edit[$db['keterangan']] = $db;
        }
        $data['data_akun'] = $akun_edit;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_jual/editFnb', $data);
        $this->load->view('templates/footer');
    }

    
    public function updateFnb()
    {   
        if($this->input->post('idBarangMentah')=== null){
            $this->session->set_flashdata('gagal', 'Anda Tidak Memilih Ingredient');
            redirect('barang_jual/fnb');
        }

        $this->Barang_jual_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('barang_jual/fnb');
    }

    
    public function index()
    {
        $data['judul'] = "Produk Jual";
        $data['data'] = $this->Barang_jual_model->getBarangJualSatuan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_jual/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {
        $data['judul'] = "Produk Jual";
        $data['data'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['gudang'] = $this->Gudang_model->getGudang();
        $data['barang_jual'] = $this->Barang_jual_model->getBarangJualSatuan();
        $data['akun'] = $this->Akun_model->getAkun();
        // $data['barang_mentah'] = $this->Barang_mentah_model->getBarang_mentah();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_jual/create', $data);
        $this->load->view('templates/footer');
    }
    

    public function getBarangJual()
    {
        $id = $this->input->post('id');
        $data = $this->Barang_jual_model->getBarangJualByIdJson($id);
        echo json_encode($data);
    }

    public function save()
    {   
        $this->Barang_jual_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('barang_jual');
    }

    public function edit($id)
    { 
        $data['judul'] = "Produk Jual";
        $data['kat'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['gudang'] = $this->Gudang_model->getGudang();
        $data['data'] = $this->Barang_jual_model->getBarang_jualById($id);
        // $data['json'] = json_encode($data['data']);
        $data['barang_jual'] = $this->Barang_jual_model->getBarangJualSatuan();
        $data['barang_mentah'] = $this->Barang_mentah_model->getBarang_mentah();
        $data_akun = $this->Barang_jual_model->getAkunByBarangJualId($id);
        $data['akun'] = $this->Akun_model->getAkun();

        $akun_edit = [];
        foreach ($data_akun as $key => $db) {
            $akun_edit[$db['keterangan']] = $db;
        }
        $data['data_akun'] = $akun_edit;
        // var_dump($akun_edit); die;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_jual/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Barang_jual_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('barang_jual');
    }
    
    public function paket()
    {
        $data['judul'] = "Set Paket Produk";
        $data['data'] = $this->Barang_jual_model->getBarang_jual();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_jual/paket', $data);
        $this->load->view('templates/footer');
    }

    
    public function createPaket()
    {
        $data['judul'] = "Set Paket Produk";
        $data['data'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['barang_jual'] = $this->Barang_jual_model->getBarangJualSatuan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_jual/createPaket', $data);
        $this->load->view('templates/footer');
    }

    
    public function savePaket()
    {  
        if($this->input->post('idBarangJual')=== null){
            $this->session->set_flashdata('gagal', 'Anda Tidak Memilih Produk Tambahan');
            redirect('barang_jual/paket');
        }

        $this->Barang_jual_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('barang_jual/paket');
    }

    public function editPaket($id)
    { 
        $data['judul'] = "Set Paket Produk";
        $data['kat'] = $this->Kategori_model->getKategori();
        $data['satuan'] = $this->Satuan_model->getSatuan();
        $data['data'] = $this->Barang_jual_model->getBarang_jualById($id);
        $data['json'] = json_encode($data['data']);
        $data['barang_jual'] = $this->Barang_jual_model->getBarangJualSatuan();
        $data_akun = $this->Barang_jual_model->getAkunByBarangJualId($id);
        $data['akun'] = $this->Akun_model->getAkun();

        $akun_edit = [];
        foreach ($data_akun as $key => $db) {
            $akun_edit[$db['keterangan']] = $db;
        }
        $data['data_akun'] = $akun_edit;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_jual/editPaket', $data);
        $this->load->view('templates/footer');
    }

    
    public function updatePaket()
    {   
        if($this->input->post('idBarangJual')=== null){
            $this->session->set_flashdata('gagal', 'Anda Tidak Memilih Produk Tambahan');
            redirect('barang_jual/paket');
        }

        $this->Barang_jual_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('barang_jual/paket');
    }
    
    public function delete($id)
    {   
        $this->Barang_jual_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('barang_jual');
    }

}