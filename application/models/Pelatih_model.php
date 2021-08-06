<?php

class Pelatih_model extends CI_model
{
    public function getPelatih()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->get_where('pelatih', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }
    
    public function getKaryawan()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT  *
                                FROM karyawan e
                                WHERE NOT EXISTS
                                        (
                                        SELECT  null 
                                        FROM    pelatih d
                                        WHERE   d.nama = e.nama
                                        ) AND perusahaan_id = $id")->result_array();
    }

    public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('pelatih', $data);
    }

    public function getPelatihById($id)
    {
        return $this->db->get_where('pelatih', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('pelatih', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('pelatih',['id'=>$id]);
    }
}