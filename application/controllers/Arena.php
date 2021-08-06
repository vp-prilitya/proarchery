<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arena extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        $publicMethods  = array("save", "update", "saveTanggal", "saveJam", "deleteTanggal", "deleteJam", "saveSetting", "saveTanggalPanahan", "settingPanahan", "saveJamPanahan","deleteTanggalPanahan", "deleteJamPanahan", "savePanahan", "updatePanahan", "deletePanahan"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }

        $this->load->model('Arena_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Arena Berkuda';
        $data['data'] = $this->Arena_model->getArena();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('arena/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Arena Berkuda';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('arena/create', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {   
        $this->Arena_model->save();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('arena');
    }

    public function setting($id)
    { 
        $data['judul'] = 'Atur Jadwal Arena Berkuda';
        $data['data'] = $this->Arena_model->getArenaById($id);
        $data['tanggal'] = $this->Arena_model->getTanggalArenaById($id);
        $data['jam'] = $this->Arena_model->getJamArenaById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('arena/setting', $data);
        $this->load->view('templates/footer');
    }
    
    public function saveTanggal()
    {   
        $id = $this->input->post('arena_id');
        $this->Arena_model->saveTanggal();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("arena/setting/$id");
    }
    
    public function saveJam()
    {   
        $id = $this->input->post('arena_id');
        $this->Arena_model->saveJam();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("arena/setting/$id");
    }
    
    public function deleteTanggal($id, $arena_id)
    {   
        $this->Arena_model->deleteTanggal($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect("arena/setting/$arena_id");
    }
    
    public function deleteJam($id, $arena_id)
    {   
        $this->Arena_model->deleteJam($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect("arena/setting/$arena_id");
    }

    public function set_rule()
    {
        $rule = $this->Arena_model->getRule();
        $data = [];
        foreach ($rule as $key => $db) {
            $data[$db['nama']] = $db['value'];
        }

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('arena/set_rule', $data);
        $this->load->view('templates/footer');
    }
    
    public function saveSetting()
    {   
        $this->Arena_model->saveSetting();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('arena/set_rule');
    }

    public function edit($id)
    { 
        $data['judul'] = 'Arena Berkuda';
        $data['data'] = $this->Arena_model->getArenaById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('arena/edit', $data);
        $this->load->view('templates/footer');
    }

    
    public function update()
    {   
        $this->Arena_model->update();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('arena');
    }
    
    public function delete($id)
    {   
        $this->Arena_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('arena');
    }

    public function panahan()
    {
        $data['judul'] = 'Arena Panahan';
        $data['data'] = $this->Arena_model->getArenaPanahan();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('arena/panahan', $data);
        $this->load->view('templates/footer');
    }

    public function settingPanahan($id)
    { 
        $data['judul'] = 'Atur Jadwal Arena Panahan';
        $data['data'] = $this->Arena_model->getArenaPanahanById($id);
        $data['tanggal'] = $this->Arena_model->getTanggalArenaPanahanById($id);
        $data['jam'] = $this->Arena_model->getJamArenaPanahanById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('arena/settingPanahan', $data);
        $this->load->view('templates/footer');
    }
    
    public function saveTanggalPanahan()
    {   
        $id = $this->input->post('arena_id');
        $this->Arena_model->saveTanggalPanahan();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("arena/settingPanahan/$id");
    }
    
    public function saveJamPanahan()
    {   
        $id = $this->input->post('arena_id');
        $this->Arena_model->saveJamPanahan();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect("arena/settingPanahan/$id");
    }

    public function deleteTanggalPanahan($id, $arena_id)
    {   
        $this->Arena_model->deleteTanggalPanahan($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect("arena/settingPanahan/$arena_id");
    }
    
    public function deleteJamPanahan($id, $arena_id)
    {   
        $this->Arena_model->deleteJamPanahan($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect("arena/settingPanahan/$arena_id");
    }

    public function createPanahan()
    {
        $data['judul'] = 'Arena Panahan';

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('arena/createPanahan', $data);
        $this->load->view('templates/footer');
    }
    
    public function savePanahan()
    {   
        $this->Arena_model->savePanahan();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('arena/panahan');
    }
    
    public function editPanahan($id)
    { 
        $data['judul'] = 'Arena Panahan';
        $data['data'] = $this->Arena_model->getArenaPanahanById($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('arena/editPanahan', $data);
        $this->load->view('templates/footer');
    }

    
    public function updatePanahan()
    {   
        $this->Arena_model->updatePanahan();
        $this->session->set_flashdata('info', 'Data Berhasil Diubah');
        redirect('arena/panahan');
    }
    
    public function deletePanahan($id)
    {   
        $this->Arena_model->deletePanahan($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('arena/panahan');
    }

}