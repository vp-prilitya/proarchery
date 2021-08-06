<?php

class Satuan_model extends CI_model
{
    public function getSatuan()
    {
        return $this->db->get_where('satuan', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }

    public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('satuan', $data);
    }

    public function getSatuanById($id)
    {
        return $this->db->get_where('satuan', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('satuan', $data, ['id'=>$this->input->post('id')]);

        $satuan = [
            'satuan' => htmlspecialchars($this->input->post('nama'))
        ];
        $this->db->update('barang_jual', $satuan, ['satuan'=>$this->input->post('nama_lama')]);
        $this->db->update('barang_mentah', $satuan, ['satuan'=>$this->input->post('nama_lama')]);
    }

    public function delete($id)
    {
        $this->db->delete('satuan',['id'=>$id]);
    }
}