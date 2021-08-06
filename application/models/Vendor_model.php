<?php

class Vendor_model extends CI_model
{
    public function getVendor()
    {
        return $this->db->get_where('vendor', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }

    public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telp' => htmlspecialchars($this->input->post('telp')),
            'email' => htmlspecialchars($this->input->post('email')),
            'website' => htmlspecialchars($this->input->post('website')),
            'nama_pic' => htmlspecialchars($this->input->post('nama_pic')),
            'bagian_pic' => htmlspecialchars($this->input->post('bagian_pic')),
            'telp_pic' => htmlspecialchars($this->input->post('telp_pic')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
        ];

        $this->db->insert('vendor', $data);
    }

    public function getVendorById($id)
    {
        return $this->db->get_where('vendor', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telp' => htmlspecialchars($this->input->post('telp')),
            'email' => htmlspecialchars($this->input->post('email')),
            'website' => htmlspecialchars($this->input->post('website')),
            'nama_pic' => htmlspecialchars($this->input->post('nama_pic')),
            'bagian_pic' => htmlspecialchars($this->input->post('bagian_pic')),
            'telp_pic' => htmlspecialchars($this->input->post('telp_pic')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
        ];

        $this->db->update('vendor', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('vendor',['id'=>$id]);
    }
}