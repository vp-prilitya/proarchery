<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        $publicMethods  = array("save", "update"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Bank_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Bank';
        $data['data'] = $this->Bank_model->getBank();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('bank/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Bank';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('bank/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Bank_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('bank');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Bank';
        $data['data'] = $this->Bank_model->getBankById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('bank/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Bank_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('bank');
    }
    
    public function delete($id)
    {   
        $this->Bank_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('bank');
    }

}