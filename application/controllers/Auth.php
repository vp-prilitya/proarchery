<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        // $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('auth/index');
    }

    public function login(){

        $username = htmlspecialchars($this->input->post('email'));

        $user = $this->db->query("SELECT b.*, a.password, a.id as user_id, c.nama as divisi FROM user a JOIN karyawan b ON a.karyawan_id = b.id JOIN divisi c ON b.divisi_id = c.id WHERE a.email = '$username'")->row_array();

        if($user){
            if(password_verify(htmlspecialchars($this->input->post('password')), $user['password'])){
                $menu = $this->db->query("SELECT GROUP_CONCAT(b.url) as menu FROM akses a JOIN menu b ON a.menu_id = b.id WHERE a.user_id = $user[user_id]")->row_array();

                $data =  [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'divisi' => $user['divisi'],
                    'nama' => $user['nama'],
                    'perusahaan_id' => $user['perusahaan_id'],
                    'menu' => explode(',', $menu['menu'])
                ];

                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('gagal', 'Password Anda Salah');
                redirect('auth');
            }
            
        } else {
            $this->session->set_flashdata('warning', 'Username Tidak Ditemukan');
            redirect('auth');
        }

        
    }

        public function logout(){
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('divisi');
            $this->session->unset_userdata('nama');
            $this->session->unset_userdata('perusahaan_id');
            $this->session->unset_userdata('menu');
        
            redirect('auth');
        }
    }

