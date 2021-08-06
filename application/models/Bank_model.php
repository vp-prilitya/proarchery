<?php

class Bank_model extends CI_model
{
    public function getBank()
    {
        return $this->db->get_where('bank', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }

    public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'no_rek' => htmlspecialchars($this->input->post('no_rek')),
            'nama_pemilik' => htmlspecialchars($this->input->post('nama_pemilik')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('bank', $data);
    }

    public function getBankById($id)
    {
        return $this->db->get_where('bank', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'no_rek' => htmlspecialchars($this->input->post('no_rek')),
            'nama_pemilik' => htmlspecialchars($this->input->post('nama_pemilik')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('bank', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('bank',['id'=>$id]);
    }
}