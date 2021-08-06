<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        $publicMethods  = array("save", "update", "getJadwal", "getJam", "getTanggalAndJam", "getKuda", "getTanggalAndJamPanahan", "getPanahan", "deleteManual", "saveManual", "saveManualPanahan"); 
        $router = &load_class('Router');
        $currentMethod = $router->fetch_method();
        if(in_array($currentMethod,$publicMethods) == false){
            is_login();
        }

        $this->load->model('Booking_model');
        $this->load->model('Pelatih_model');
        $this->load->model('Pelanggan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Booking';
        $data['data'] = $this->Booking_model->getBooking();

        $this->load->view('templates_pelanggan/header');
        $this->load->view('templates_pelanggan/sidebar');
        $this->load->view('booking/index', $data);
        $this->load->view('templates_pelanggan/footer');
    }

    public function create()
    {
        $data['judul'] = 'Booking';
        $data['data'] = $this->db->get('arena')->result_array();

        $this->load->view('templates_pelanggan/header');
        $this->load->view('templates_pelanggan/sidebar');
        $this->load->view('booking/create', $data);
        $this->load->view('templates_pelanggan/footer');
    }

    public function getJadwal()
    {
        $data = $this->Booking_model->getJadwal();
        echo json_encode($data);
    }

    public function save()
    {   
        $data = $this->Booking_model->save();
        if($data == true){
            $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        } else {
            $this->session->set_flashdata('gagal', 'Anda Tidak memiliki kuota');
        }
        redirect('booking');
    }

    
    public function valid($id)
    {   
        $this->Booking_model->valid($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Divalidasi');
        redirect('booking');
    }

    
    public function delete($id)
    {   
        $this->Booking_model->delete($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('booking');
    }
    
    public function deleteManual($id)
    {   
        $this->Booking_model->deleteManual($id);
        $this->session->set_flashdata('warning', 'Data Berhasil Dihapus');
        redirect('booking/manual');
    }

    public function manual()
    {
        $dari = htmlspecialchars($this->input->get('dari')?? date('Y-m-d', strtotime('last monday')));
        $sampai = htmlspecialchars($this->input->get('sampai')?? date('Y-m-d', strtotime('next sunday')));
        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));

        $data['judul'] = 'Jadwal Latihan';
        $data['data1'] = $this->Booking_model->getBookingManualKuda($dari, $sampai);
        $data['data2'] = $this->Booking_model->getBookingManualPanahan($dari, $sampai);
        $data['download'] = 1;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('booking_manual/index', $data);
        $this->load->view('templates/footer');
    }

    public function createManual()
    {
        $data['judul'] = 'Booking';
        $id = $this->session->userdata('perusahaan_id');
        $data['data'] = $this->db->get_where('arena', ['perusahaan_id' => $id])->result_array();
        $data['data2'] = $this->db->get_where('arena_panahan', ['perusahaan_id' => $id])->result_array();
        $data['pelatih'] = $this->Pelatih_model->getPelatih();
        $data['pelanggan'] = $this->Pelanggan_model->getPelanggan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('booking_manual/create', $data);
        $this->load->view('templates/footer');
    }

    public function getJam()
    {
        $data['jam'] = $this->Booking_model->getJam();
        echo json_encode($data);
    }

    public function getTanggalAndJam()
    {
        $data['jam'] = $this->Booking_model->getTanggalAndJam();
        echo json_encode($data);
    }

    public function getKuda()
    {
        $data = $this->Booking_model->getKuda();
        echo json_encode($data);
    }

    public function saveManual()
    {   
        $data = $this->Booking_model->saveManual();
        $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        redirect('booking/manual');
    }

    public function getTanggalAndJamPanahan()
    {
        $data['jam'] = $this->Booking_model->getTanggalAndJamPanahan();
        echo json_encode($data);
    }

    public function getPanahan()
    {
        $data = $this->Booking_model->getPanahan();
        echo json_encode($data);
    }

    public function saveManualPanahan()
    {   
        $data = $this->Booking_model->saveManualPanahan();
        if($data == 1){
            $this->session->set_flashdata('sukses', 'Data Berhasil Simpan');
        } else {
            $this->session->set_flashdata('gagal', 'Arena Sudah Penuh');
        }
        redirect('booking/manual');
    }
}