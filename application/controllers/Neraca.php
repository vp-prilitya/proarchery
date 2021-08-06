<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neraca extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Neraca_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Neraca';
        $data['download'] = 1;

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        
        if($dari!='' AND $sampai!=''){
            $dari = date('Y-m-d', strtotime($dari));
            $sampai = date('Y-m-d', strtotime($sampai));

            $data['data'] = 1;
            $data['harta'] =  $this->Neraca_model->getData($dari, $sampai, 1);
            $data['utang'] = $this->Neraca_model->getData($dari, $sampai, 2);
            $data['modal'] = $this->Neraca_model->getData($dari, $sampai, 3);
        } else {
            $data['harta'] = [];
            $data['utang'] = [];
            $data['modal'] = [];
        }
        // var_dump($data['harta']); die;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('neraca/index', $data);
        $this->load->view('templates/footer');
    }

    public function index2()
    {
        $data['judul'] = 'Neraca';
        $data['download'] = 1;

        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d'));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d'));
        $akun = $this->input->get('akun_id')??[];
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));
        if($dari!='' AND $sampai!='' AND count($akun) == 0){
            // $dari = date('Y-m-d', strtotime($dari));
            $dari = date('Y-m-d', strtotime('2021-07-28'));
            $sampai = date('Y-m-d', strtotime($sampai));

            $data['data'] = 1;
            $data['harta'] =  $this->Neraca_model->getData($dari, $sampai, 1);
            $data['utang'] = $this->Neraca_model->getData($dari, $sampai, 2);
            $data['modal'] = $this->Neraca_model->getData($dari, $sampai, 3);
            $data['pendapatan'] = $this->Neraca_model->getData($dari, $sampai, 4);
            $data['beban'] = $this->Neraca_model->getData($dari, $sampai, 5);
            $data['beban_umum'] = $this->Neraca_model->getData($dari, $sampai, 6);
            $data['pendapatan_lain'] = $this->Neraca_model->getData($dari, $sampai, 8);
            $data['beban_lain'] = $this->Neraca_model->getData($dari, $sampai, 9);
        } 

        if($dari!='' AND $sampai!='' AND count($akun) > 0){
            $data['data'] = $this->Neraca_model->getDataByAkun($dari, $sampai, $akun);
        }
        
        // else {
        //     $data['harta'] = [];
        //     $data['utang'] = [];
        //     $data['modal'] = [];
        //     $data['pendapatan'] = [];
        //     $data['beban'] = [];
        //     $data['beban_umum'] = [];
        //     $data['pendapatan_lain'] = [];
        //     $data['beban_lain'] = [];
        // }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        if($dari!='' AND $sampai!='' AND count($akun) > 0){
            $this->load->view('neraca/index4', $data);
        } else {
            $this->load->view('neraca/index3', $data);
        }
        // $this->load->view('neraca/index2', $data);
        $this->load->view('templates/footer');
    }

}