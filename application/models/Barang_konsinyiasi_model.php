<?php

class Barang_konsinyiasi_model extends CI_model
{
    public function getBarang_konsinyiasi()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama as gudang, c.nama as kategori, d.nama as vendor FROM barang_konsinyiasi a LEFT JOIN gudang b ON a.gudang_id = b.id LEFT JOIN kategori c ON a.kategori_id = c.id LEFT JOIN vendor d ON a.vendor_id = d.id WHERE a.perusahaan_id = $id")->result_array();
    }

    public function save()
    {
        $data = [
            'kode_barang' => kodeMentah(),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'no_part' => htmlspecialchars($this->input->post('no_part')),
            'jenis_harga_pokok' => htmlspecialchars($this->input->post('jenis_harga_pokok')),
            // 'harga_pokok' => htmlspecialchars($this->input->post('harga_pokok'))??0,
            'harga_jual' => htmlspecialchars($this->input->post('harga_jual'))??0,
            'satuan' => htmlspecialchars($this->input->post('satuan')),
            'stok' => htmlspecialchars($this->input->post('stok')),
            'min_stok' => htmlspecialchars($this->input->post('min_stok')),
            'gudang_id' => htmlspecialchars($this->input->post('gudang_id')),
            'kategori_id' => htmlspecialchars($this->input->post('kategori_id')),
            'vendor_id' => htmlspecialchars($this->input->post('vendor_id')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('barang_konsinyiasi', $data);
    }

    public function getBarang_konsinyiasiById($id)
    {
        return $this->db->get_where('barang_konsinyiasi', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'no_part' => htmlspecialchars($this->input->post('no_part')),
            'jenis_harga_pokok' => htmlspecialchars($this->input->post('jenis_harga_pokok')),
            // 'harga_pokok' => htmlspecialchars($this->input->post('harga_pokok'))??0,
            'harga_jual' => htmlspecialchars($this->input->post('harga_jual'))??0,
            'satuan' => htmlspecialchars($this->input->post('satuan')),
            'stok' => htmlspecialchars($this->input->post('stok')),
            'min_stok' => htmlspecialchars($this->input->post('min_stok')),
            'gudang_id' => htmlspecialchars($this->input->post('gudang_id')),
            'vendor_id' => htmlspecialchars($this->input->post('vendor_id')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('barang_konsinyiasi', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('barang_konsinyiasi',['id'=>$id]);
    }
}