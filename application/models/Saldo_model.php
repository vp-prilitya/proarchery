<?php

class Saldo_model extends CI_model
{
    public function save()
    {
        $created = htmlspecialchars($this->input->post('created')??date('Y-m-d'));
        $rincian = htmlspecialchars($this->input->post('rincian'));
        $jenis = htmlspecialchars($this->input->post('jenis'));
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $user_created = $this->session->userdata('id');

        $data = [
            'akun_id' => htmlspecialchars($this->input->post("akun_id")),
            'debit' => $jenis==1?htmlspecialchars($this->input->post("jumlah")) : 0,
            'kredit' => $jenis==2?htmlspecialchars($this->input->post("jumlah")) : 0,
            'rincian' => $rincian,
            'url' => 'saldo',
            'created' => $created,
            'user_created' => $user_created,
            'perusahaan_id' => $perusahaan_id,
        ];

        $this->db->insert('transaksi', $data);
    }
    
}