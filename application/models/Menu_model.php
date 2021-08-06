<?php

class Menu_model extends CI_model
{
   public function getUser()
   {
        $perusahaan_id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT a.*, b.nama, b.nip FROM user a JOIN karyawan b ON a.karyawan_id = b.id WHERE b.perusahaan_id = $perusahaan_id ")->result_array();
   }

   public function getMenu()
   {
       return $this->db->get_where('menu')->result_array();
   }

   public function getMenuByDivisi($id)
   {
       return $this->db->query("SELECT GROUP_CONCAT(menu_id) as menu FROM akses WHERE divisi_id = $id")->row_array();
   }

   public function getMenuByUser($id)
   {
       return $this->db->query("SELECT GROUP_CONCAT(menu_id) as menu FROM akses WHERE user_id = $id")->row_array();
   }

   public function save()
   {
        $menu_id = $this->input->post('menu_id');
        // $divisi_id = $this->input->post('divisi_id');
        $user_id = $this->input->post('user_id');

        // $this->db->delete('akses', ['divisi_id' => $divisi_id]);
        $this->db->delete('akses', ['user_id' => $user_id]);
        $insert = [];

        for ($i=0; $i < count($menu_id); $i++) {
            $data = [
                // 'divisi_id' => $divisi_id,
                'user_id' => $user_id,
                'menu_id' => $menu_id[$i]
            ];

            array_push($insert, $data);
        }

        if(count($insert)>0){
            $this->db->insert_batch('akses', $insert);
        }

   }

}