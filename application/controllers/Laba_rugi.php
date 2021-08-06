<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Neraca_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Laba Rugi';
        $data['download'] = 1;

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        
        if($dari!='' AND $sampai!=''){
            $dari = date('Y-m-d', strtotime($dari));
            $sampai = date('Y-m-d', strtotime($sampai));

            $data['data'] = 1;
            $data['pendapatan'] =  $this->Neraca_model->getData($dari, $sampai, 4);
            $data['beban'] = $this->Neraca_model->getData($dari, $sampai, 5);
            $data['beban_umum'] = $this->Neraca_model->getData($dari, $sampai, 6);
            $data['pendapatan_lain'] = $this->Neraca_model->getData($dari, $sampai, 8);
            $data['beban_lain'] = $this->Neraca_model->getData($dari, $sampai, 9);
        } else {
            $data['pendapatan'] = [];
            $data['beban'] = [];
            $data['beban_umum'] = [];
            $data['pendapatan_lain'] = [];
            $data['beban_lain'] = [];
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        // var_dump($data['pendapatan']); die;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laba_rugi/index', $data);
        $this->load->view('templates/footer');
    }

}