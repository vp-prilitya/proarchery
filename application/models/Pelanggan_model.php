<?php

class Pelanggan_model extends CI_model
{
    public function getPelanggan()
    {
        return $this->db->get_where('pelanggan', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }

    public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'contact' => htmlspecialchars($this->input->post('contact')),
            'telp_darurat' => htmlspecialchars($this->input->post('telp_darurat')),
            'email' => htmlspecialchars($this->input->post('email')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
        ];

        $this->db->insert('pelanggan', $data);
    }

    public function getPelangganById($id)
    {
        return $this->db->get_where('pelanggan', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'contact' => htmlspecialchars($this->input->post('contact')),
            'telp_darurat' => htmlspecialchars($this->input->post('telp_darurat')),
            'email' => htmlspecialchars($this->input->post('email')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
        ];

        $this->db->update('pelanggan', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('pelanggan',['id'=>$id]);
    }
}