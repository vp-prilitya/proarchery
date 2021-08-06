<?php

class User_model extends CI_model
{
   public function getUser()
   {
    $perusahaan_id = $this->session->userdata('perusahaan_id');
    return $this->db->query("SELECT a.*, b.id as user_id, c.nama as divisi FROM karyawan a JOIN user b ON a.id = b.karyawan_id JOIN divisi c ON a.divisi_id = c.id WHERE a.perusahaan_id = $perusahaan_id")->result_array();
   }

   public function getKaryawan()
   {
       return $this->db->query("SELECT  a.*, c.nama as divisi
                                FROM karyawan a 
                                JOIN divisi c ON a.divisi_id = c.id
                                WHERE NOT EXISTS
                                        (
                                        SELECT 1 
                                        FROM    user b
                                        WHERE   b.karyawan_id = a.id
                                        )")->result_array();
    }

   public function save()
   {
        $data = [
            'karyawan_id' => $this->input->post('karyawan_id'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'),PASSWORD_BCRYPT)
        ];

        $this->db->insert('user', $data);
        $user_id = $this->db->insert_id();

        $perusahaan_id = $this->input->post('karyawan_id');
        $cek = $this->db->query("SELECT a.* FROM akses a JOIN user b ON a.user_id = b.id JOIN karyawan c ON b.karyawan_id = c.id WHERE c.perusahaan_id = $perusahaan_id")->num_rows();
        if($cek === 0){
            $akses = [
                [
                    'user_id' => $user_id,
                    'menu_id' => '504'
                ],
                [
                    'user_id' => $user_id,
                    'menu_id' => '505'
                ],
            ];
            $this->db->insert_batch('akses', $akses);
        }
   }

   public function getUserById($id)
   {
        return $this->db->query("SELECT a.*, b.id as user_id, c.nama as divisi FROM karyawan a JOIN user b ON a.id = b.karyawan_id JOIN divisi c ON a.divisi_id = c.id WHERE b.id = $id")->row_array();
   }
   
   public function update($id)
   {
        $data = [
            'password' => password_hash($this->input->post('password'),PASSWORD_BCRYPT)
        ];

       $this->db->update('user', $data, ['id'=>$id]);
   }

   public function delete($id)
   {
       $this->db->delete('user', ['id'=>$id]);
   }

}