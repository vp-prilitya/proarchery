<?php

class Auth_pelanggan_model extends CI_model
{
   public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telp' => htmlspecialchars($this->input->post('telp')),
            'email' => htmlspecialchars($this->input->post('email')),
            'password' => password_hash(htmlspecialchars($this->input->post('password')),PASSWORD_BCRYPT),
            'karyawan_id' => 0,
        ];

        $this->db->insert('user', $data);
        
        $data['subjek'] = 'Akun Anda Berhasil Dibuat';
        $data['pw'] = htmlspecialchars($this->input->post('password'));
        $data['template'] = 'auth_pelanggan/email';
        send_mail($data);
    }
}