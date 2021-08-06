<?php

class Akun_model extends CI_model
{

    public function getKelompok()
    {
        return $this->db->query("SELECT * FROM kelompok ORDER BY kode ASC")->result_array();
    }

    public function getAkun()
    {
        $id =  $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama as kelompok FROM akun a JOIN kelompok b ON a.kelompok_id = b.id WHERE a.perusahaan_id = $id ORDER BY a.kode ASC")->result_array();
    }

    public function getAkun1()
    {
        $id =  $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama as kelompok FROM akun a JOIN kelompok b ON a.kelompok_id = b.id WHERE a.perusahaan_id = $id AND kelompok_id = 1 ORDER BY a.kode ASC")->result_array();
    }

    public function getAkunKasBank()
    {
        $id =  $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama as kelompok FROM akun a JOIN kelompok b ON a.kelompok_id = b.id WHERE a.perusahaan_id = $id AND kelompok_id = 1 AND a.kode LIKE '%101%' OR a.kode LIKE '%102%' ORDER BY a.kode ASC")->result_array();
    }

    public function getAkun123()
    {
        $id =  $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama as kelompok FROM akun a JOIN kelompok b ON a.kelompok_id = b.id WHERE a.perusahaan_id = $id AND (kelompok_id = 1 OR kelompok_id = 2 OR kelompok_id = 3) ORDER BY a.nama ASC")->result_array();
    }

    public function save()
    {
        $data = [
            'kode' => htmlspecialchars($this->input->post('kode')),
            'parent' => htmlspecialchars($this->input->post('parent'))??null,
            'nama' => htmlspecialchars($this->input->post('nama')),
            'tipe' => htmlspecialchars($this->input->post('tipe')),
            'kelompok_id' => htmlspecialchars($this->input->post('kelompok_id')),
            'saldo' => 0,
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('akun', $data);
    }

    public function getAkunById($id)
    {
        return $this->db->query("SELECT a.*, b.nama as kelompok FROM akun a JOIN kelompok b ON a.kelompok_id = b.id WHERE a.id = $id")->row_array();
    }

    public function update()
    {
        $data = [
            'kode' => htmlspecialchars($this->input->post('kode')),
            'parent' => htmlspecialchars($this->input->post('parent'))??null,
            'nama' => htmlspecialchars($this->input->post('nama')),
            'kelompok_id' => htmlspecialchars($this->input->post('kelompok_id')),
            'tipe' => htmlspecialchars($this->input->post('tipe')),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('akun', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('akun',['id'=>$id]);
    }

    public function getKode()
    {
        $data = $this->db->get_where('akun', ['parent' => $this->input->post('akun_id')[0]])->num_rows();
        return $this->input->post('akun_id')[1] .'-'. ($data+1);
        // return $this->input->post('akun_id')[0];
    }
}