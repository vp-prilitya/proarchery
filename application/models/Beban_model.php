<?php

class Beban_model extends CI_model
{
    public function getBeban($dari, $sampai)
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.nama as karyawan, 
                                    c.nama as pelanggan, 
                                    d.nama as vendor,
                                    e.nama  
                                FROM 
                                    beban a 
                                    LEFT JOIN karyawan b ON a.foreign_id = b.id AND a.type_id = 1 
                                    LEFT JOIN pelanggan c ON a.foreign_id = c.id AND a.type_id = 2 
                                    LEFT JOIN vendor d ON a.foreign_id = d.id AND a.type_id = 3 
                                    JOIN akun e ON a.akun_id = e.id
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' 
                                ")->result_array();
    }

    public function getAkunBeban()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT * FROM akun WHERE kelompok_id IN (5,6,9) AND perusahaan_id = $id")->result_array();
    }

    public function save()
    {
        $akun_id = htmlspecialchars($this->input->post('akun_id'));
        $total_tagihan = htmlspecialchars($this->input->post('total_tagihan'));
        $total_bayar = htmlspecialchars($this->input->post('total_bayar'));
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = htmlspecialchars($this->input->post('created'));
        $user_created = $this->session->userdata('id');

        $data = [
            'akun_id' => $akun_id,
            'foreign_id' => htmlspecialchars($this->input->post('foreign_id')),
            'type_id' => htmlspecialchars($this->input->post('type_id')),
            'total_tagihan' => $total_tagihan,
            'total_bayar' => $total_bayar,
            'rincian' => htmlspecialchars($this->input->post('rincian')),
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('beban', $data);
        $id = $this->db->insert_id();

        // CREATE TRANSAKSI
        $this->insertTransaksi($id, $akun_id, $total_bayar, $created, $user_created, $perusahaan_id);
        // AKHIR
    }

    public function insertTransaksi($id, $akun_id, $total_bayar, $created, $user_created, $perusahaan_id)
    {
        $data = [
            'akun_id' => $akun_id,
            'debit' => $total_bayar,
            'kredit' => 0,
            'rincian' => 'Transaksi dilakukan dari beban pengeluaran',
            'url' => 'beban',
            'foreign_id' => $id,
            'created' => $created,
            'user_created' => $user_created,
            'perusahaan_id' => $perusahaan_id,
        ];

        $this->db->insert('transaksi', $data);
    }

    public function getBebanById($id)
    {
        return $this->db->get_where('beban', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('beban', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('beban',['id'=>$id]);
    }
}