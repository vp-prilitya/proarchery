<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $publicMethods  = array("save"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }
        $this->load->model('Menu_model');
        $this->load->model('Divisi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Role Akses';
        // $data['data'] = $this->Divisi_model->getDivisi();
        $data['data'] = $this->Menu_model->getUser();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function create($id)
    {
        $data['judul'] = 'Role Akses';
        // $data['menu'] = $this->Menu_model->getMenu();
        $menu = $this->Menu_model->getMenu();
        // $data['mymenu'] = $this->Menu_model->getMenuByDivisi($id);
        $data['mymenu'] = $this->Menu_model->getMenuByUser($id);
        // $data['divisi'] = $this->Divisi_model->getDivisiById($id);
        $data['user_id'] = $id;
        $data_menu = [];
        foreach ($menu as $key => $db) {
            if(array_key_exists("$db[menu]", $data_menu)){
                array_push($data_menu[$db['menu']], $db);
            } else {
                $data_menu[$db['menu']][] = $db;
            }
        }
        $data['menu'] = $data_menu;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('menu/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Menu_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('menu');
    }

}