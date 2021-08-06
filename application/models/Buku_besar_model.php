<?php

class Buku_besar_model extends CI_model
{
    public function getBuku_besar($dari, $sampai, $akun_id)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        * 
                                    FROM 
                                        transaksi 
                                    WHERE 
                                        perusahaan_id = $perusahaan_id AND
                                        akun_id = $akun_id AND 
                                        created BETWEEN '$dari' AND '$sampai'
                                    ")->result_array();
    }
}