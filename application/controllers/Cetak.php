<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Penjualan_model');
        $this->load->model('Piutang_model');
        $this->load->library('form_validation');
    }

    public function penjualan($id)
    {
        $data['judul'] = 'Penjualan';
        $data['data'] = $this->Penjualan_model->getPenjualanById($id);
        $this->load->view('penjualan/print',$data);
    }

    public function piutang($id)
    {
        $data['judul'] = 'Piutang';
        $data['data'] = $this->Piutang_model->getPembayaranById($id);
        $this->load->view('piutang/print',$data);
    }

    public function test_email()
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'ggalmair@gmail.com',
            'smtp_pass' => 'g1i2a3n4',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
      ];
   
      $this->email->initialize($config);
      $this->load->library('email', $config);
   
      $this->email->from('ggalmair@gmail.com', 'Pro-Archery');
      $this->email->to('riway.restu@gmail.com');
      $subject = 'Test Email';
      $this->email->subject($subject);
   
      $body = 'Lorem ipsum dolor sit amet consectetur adipisithisng elit. Laboriosam dolorum nostrum consequatur itaque praesentium eum odio ut totam nihil, enim atque cupiditate temporibus saepe ipsa, dicta unde velit repudiandae. Rerum.';
      $this->email->message($body);
      $this->email->send();
    }


}