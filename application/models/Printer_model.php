<?php

class Printer_model extends CI_model
{
    public function getPrinter()
    {
        return $this->db->get_where('printer', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }

    public function save()
    {
        if(htmlspecialchars($this->input->post('is_default')) == 1){
            $update = [
                'is_default' => 0,
            ];
            $this->db->update('printer', $update, ['perusahaan_id' => $this->session->userdata('perusahaan_id')]);
        }

        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'is_default' => htmlspecialchars($this->input->post('is_default')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('printer', $data);
    }

    public function getPrinterById($id)
    {
        return $this->db->get_where('printer', ['id'=>$id])->row_array();
    }

    public function update()
    {
        if(htmlspecialchars($this->input->post('is_default')) == 1){
            $update = [
                'is_default' => 0,
            ];
            $this->db->update('printer', $update, ['perusahaan_id' => $this->session->userdata('perusahaan_id')]);
        }

        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'is_default' => htmlspecialchars($this->input->post('is_default')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('printer', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('printer',['id'=>$id]);
    }
}