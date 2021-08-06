<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_pelanggan extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_pelanggan_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('auth_pelanggan/index');
    }

	public function register()
	{
		$this->load->view('auth_pelanggan/register');
    }

    public function save()
    {   
        $this->Auth_pelanggan_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('auth_pelanggan');
    }

    public function login(){

        $username = htmlspecialchars($this->input->post('email'));

        $user = $this->db->query("SELECT a.* FROM user a WHERE a.email = '$username' AND a.karyawan_id = 0")->row_array();

        if($user){
            if(password_verify(htmlspecialchars($this->input->post('password')), $user['password'])){
                $data =  [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'nama' => $user['nama'],
                ];

                $this->session->set_userdata($data);
                redirect('kuota');
            } else {
                $this->session->set_flashdata('gagal', 'Password Anda Salah');
                redirect('auth_pelanggan');
            }
            
        } else {
            $this->session->set_flashdata('warning', 'Username Tidak Ditemukan');
            redirect('auth_pelanggan');
        }

        
    }

        public function logout(){
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('nama');
        
            redirect('auth_pelanggan');
        }
    }

