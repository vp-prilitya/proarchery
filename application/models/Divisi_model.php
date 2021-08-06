<?php

class Divisi_model extends CI_model
{
    public function getDivisi()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT * FROM divisi WHERE perusahaan_id = 0 OR perusahaan_id = $id")->result_array();
        // return $this->db->get_where('divisi', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }

    public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('divisi', $data);
    }

    public function getDivisiById($id)
    {
        return $this->db->get_where('divisi', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('divisi', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('divisi',['id'=>$id]);
    }
}