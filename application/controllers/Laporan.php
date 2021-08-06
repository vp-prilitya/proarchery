<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("penjualan"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Laporan_model');
        $this->load->model('Barang_jual_model');
        $this->load->model('Barang_mentah_model');
        $this->load->library('form_validation');
    }

    public function penjualan()
    {
        redirect('laporan/penjualan_sales');
        $data['judul'] = 'Penjualan';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));

        $result = [];
        $item = $this->Barang_jual_model->getBarang_jualFnb();
        foreach ($item as $key => $db) {
            $qty1 = $this->Laporan_model->getQtyPOS($dari, $sampai, $db['id']);
            // $qty2 = $this->Laporan_model->getQty($dari, $sampai, $db['id']);
            $dt = [
                'nama' => $db['nama'],
                'qty' => ($qty1['qty']??0),
                'satuan' => $db['satuan'],
                'harga_pokok' => $db['harga_pokok'],
                'harga_jual' => $db['harga_jual'],
            ];

            array_push($result, $dt);
        }

        $item = $this->Barang_jual_model->getBarangJualSatuan();
        foreach ($item as $key => $db) {
            $qty1 = $this->Laporan_model->getQtyPOS($dari, $sampai, $db['id']);
            $qty2 = $this->Laporan_model->getQty($dari, $sampai, $db['id']);
            $dt = [
                'nama' => $db['nama'],
                'qty' => ($qty1['qty']??0) + ($qty2['qty']??0),
                'satuan' => $db['satuan'],
                'harga_pokok' => $db['harga_pokok'],
                'harga_jual' => $db['harga_jual'],
            ];

            array_push($result, $dt);
        }

        $item = $this->Barang_jual_model->getBarang_jual();
        foreach ($item as $key => $db) {
            $qty1 = $this->Laporan_model->getQtyPOS($dari, $sampai, $db['id']);
            $qty2 = $this->Laporan_model->getQty($dari, $sampai, $db['id']);
            $dt = [
                'nama' => $db['nama'],
                'qty' => ($qty1['qty']??0) + ($qty2['qty']??0),
                'satuan' => $db['satuan'],
                'harga_pokok' => $db['harga_pokok'],
                'harga_jual' => $db['harga_jual'],
            ];

            array_push($result, $dt);
        }
        $data['data'] = $result;
        $data['download'] = 1;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/penjualan', $data);
        $this->load->view('templates/footer');
    }

    public function penjualan_sales()
    {
        $data['judul'] = 'Penjualan';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $data['data'] = $this->Laporan_model->getPenjualanSales($dari, $sampai);
        $data['download'] = 1;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/penjualan_sales', $data);
        $this->load->view('templates/footer');
    }

    public function penjualan_salesDetail($sales_id, $dari, $sampai)
    {
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $data['data'] = $this->Laporan_model->getPenjualanSalesDetail($sales_id, $dari, $sampai);
        $this->load->view('laporan/modal', $data);
    }

    public function pembelian()
    {
        $data['judul'] = 'Pembelian';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));

        $data['data'] = $this->Laporan_model->getPembelian($dari, $sampai);
        $data['download'] = 1;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/pembelian', $data);
        $this->load->view('templates/footer');
    }

    public function piutang()
    {
        $data['judul'] = 'Piutang';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));

        $data['data'] = $this->Laporan_model->getPiutang($dari, $sampai);
        $data['download'] = 1;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/piutang', $data);
        $this->load->view('templates/footer');
    }

    public function hutang()
    {
        $data['judul'] = 'Hutang';

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));

        $data['data'] = $this->Laporan_model->getHutang($dari, $sampai);
        $data['download'] = 1;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/hutang', $data);
        $this->load->view('templates/footer');
    }

    public function stok()
    {
        $data['judul'] = 'Stok Produk';

        $data['barang_jual'] = $this->Barang_jual_model->getBarangJualSatuan();
        $data['barang_mentah'] = $this->Barang_mentah_model->getBarang_mentah();
        $data['download'] = 1;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/stok', $data);
        $this->load->view('templates/footer');
    }

}