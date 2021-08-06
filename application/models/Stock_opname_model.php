<?php

class Stock_opname_model extends CI_model
{
    public function save()
    {
        $created = date('Y-m-d');
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $user_created = $this->session->userdata('id');
        $insert=[];
        
        $id = $this->input->post('id');
        for ($i=0; $i<count($id); $i++) { 
            if($this->input->post("qty$id[$i]") != ""){
                $update = ['stok' => htmlspecialchars($this->input->post("qty$id[$i]"))];
                $this->db->update('barang_jual', $update, ['id' => $id[$i]]);
            }
        }

        $idRaw = $this->input->post('idRaw');
        for ($i=0; $i<count($idRaw); $i++) { 
            if($this->input->post("qtyRaw$idRaw[$i]") != ""){
                $update = ['stok' => htmlspecialchars($this->input->post("qtyRaw$idRaw[$i]"))];
                $this->db->update('barang_mentah', $update, ['id' => $idRaw[$i]]);
            }
        }
    }

    public function getBarang()
    {
        $gudang_id = $this->input->post('id');
        $perusahaan_id = $this->session->userdata('perusahaan_id');

        $jual = $this->db->get_where('barang_jual', ['gudang_id' => $gudang_id, 'perusahaan_id' => $perusahaan_id, 'need_raw'=>0, 'is_paket'=>0])->result_array();
        $mentah = $this->db->get_where('barang_mentah', ['gudang_id' => $gudang_id, 'perusahaan_id' => $perusahaan_id])->result_array();

        return ['jual'=>$jual,'mentah'=>$mentah];
    }

    public function saveGudang()
    {
        $gudang_id = htmlspecialchars($this->input->post('gudang_tujuan'));
        $update = ['gudang_id' => $gudang_id];

        $id = $this->input->post('id');
        for ($i=0; $i<count($id); $i++) { 
            $this->db->update('barang_jual', $update, ['id' => $id[$i]]);
        }

        $idRaw = $this->input->post('idRaw');
        for ($i=0; $i<count($idRaw); $i++) { 
            $this->db->update('barang_mentah', $update, ['id' => $idRaw[$i]]);
        }
    }
    
}