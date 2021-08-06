<?php

class Kategori_model extends CI_model
{
    public function getKategori()
    {
        return $this->db->get_where('kategori', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }

    public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('kategori', $data);
    }

    public function getKategoriById($id)
    {
        return $this->db->get_where('kategori', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('kategori', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('kategori',['id'=>$id]);
    }
}