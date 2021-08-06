<?php

class Barang_mentah_model extends CI_model
{
    public function getBarang_mentah()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama as gudang, c.nama as kategori FROM barang_mentah a LEFT JOIN gudang b ON a.gudang_id = b.id LEFT JOIN kategori c ON a.kategori_id = c.id WHERE a.perusahaan_id = $id")->result_array();
    }

    // public function getHargaPokok()
    // {
    //     $jenis = $this->input->post('jenis');

    //     if($jenis == 'FIFO'){
    //         $barang = $this->db->query;
    //     }
    // }

    public function save()
    {
        $data = [
            'kode_barang' => kodeMentah(),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'no_part' => htmlspecialchars($this->input->post('no_part')),
            'jenis_harga_pokok' => htmlspecialchars($this->input->post('jenis_harga_pokok')),
            // 'harga_pokok' => htmlspecialchars($this->input->post('harga_pokok'))??0,
            // 'harga_jual' => htmlspecialchars($this->input->post('harga_jual'))??0,
            'satuan' => htmlspecialchars($this->input->post('satuan')),
            'stok' => htmlspecialchars($this->input->post('stok'))??0,
            'min_stok' => htmlspecialchars($this->input->post('min_stok'))??0,
            'gudang_id' => htmlspecialchars($this->input->post('gudang_id')),
            'kategori_id' => htmlspecialchars($this->input->post('kategori_id')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        // var_dump($data); die;

        $this->db->insert('barang_mentah', $data);
    }

    public function getBarang_mentahById($id)
    {
        return $this->db->get_where('barang_mentah', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'no_part' => htmlspecialchars($this->input->post('no_part')),
            'jenis_harga_pokok' => htmlspecialchars($this->input->post('jenis_harga_pokok')),
            // 'harga_pokok' => htmlspecialchars($this->input->post('harga_pokok'))??0,
            // 'harga_jual' => htmlspecialchars($this->input->post('harga_jual'))??0,
            'satuan' => htmlspecialchars($this->input->post('satuan')),
            'stok' => htmlspecialchars($this->input->post('stok')),
            'min_stok' => htmlspecialchars($this->input->post('min_stok')),
            'gudang_id' => htmlspecialchars($this->input->post('gudang_id')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('barang_mentah', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('barang_mentah',['id'=>$id]);
    }
}