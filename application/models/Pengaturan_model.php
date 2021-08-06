<?php

class Pengaturan_model extends CI_model
{
    public function getPengaturan()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama, c.nama as kelompok FROM pengaturan a JOIN akun b ON a.akun_id = b.id JOIN kelompok c ON b.kelompok_id = c.id WHERE a.perusahaan_id = $id")->result_array();
    }

    public function save()
    {
        $variable = htmlspecialchars($this->input->post('variable'));
        $jenis = ($variable=='piutang' OR $variable=='hutang')?'-':htmlspecialchars($this->input->post('jenis'));

        $data = [
            'variable' => $variable,
            'jenis' => $jenis,
            'akun_id' => htmlspecialchars($this->input->post('akun_id')),
            'is_debit' => htmlspecialchars($this->input->post('is_debit')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
        ];

        $this->db->insert('pengaturan', $data);
    }

    public function getPengaturanById($id)
    {
        return $this->db->get_where('pengaturan', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $variable = htmlspecialchars($this->input->post('variable'));
        $jenis = ($variable=='piutang' OR $variable=='hutang')?'-':htmlspecialchars($this->input->post('jenis'));

        $data = [
            'variable' => $variable,
            'jenis' => $jenis,
            'akun_id' => htmlspecialchars($this->input->post('akun_id')),
            'is_debit' => htmlspecialchars($this->input->post('is_debit')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
        ];

        $this->db->update('pengaturan', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('pengaturan',['id'=>$id]);
    }
}