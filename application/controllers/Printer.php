<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printer extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Printer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // var_dump(date('Y-m-d', strtotime('last monday', strtotime('2021-03-25')))); die;
        $data['judul'] = 'Printer';
        $data['data'] = $this->Printer_model->getPrinter();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('printer/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Printer';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('printer/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Printer_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('printer');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Printer';
        $data['data'] = $this->Printer_model->getPrinterById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('printer/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Printer_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('printer');
    }
    
    public function delete($id)
    {   
        $this->Printer_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('printer');
    }

}