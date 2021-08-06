<?php

class Neraca_model extends CI_model
{
    public function getTransaksi($dari, $sampai, $akun_id)
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

    public function getData($dari, $sampai, $kelompok_id)
    {
        $keybefore = '';
        $data = [];
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $this->db->order_by('kode', 'ASC');
        $akun = $this->db->get_where('akun', ['kelompok_id'=> $kelompok_id, 'perusahaan_id'=>$perusahaan_id])->result_array();

        // foreach ($akun as $key => $db) {
        //     $data[$db['kode'].'|'.$db['nama'].'|'.$db['parent']] = $this->getTransaksi($dari, $sampai, $db['id']);
        //     // $data[$db['nama']] = $this->getTransaksi($dari, $sampai, $db['id']);
        // }

        foreach ($akun as $key => $db) {
            $data[$db['kode'].'|'.$db['nama'].'|'.$db['parent']] = $this->getTransaksi($dari, $sampai, $db['id']);

            if($db['parent'] === null){
                $keybefore = $db['kode'].'|'.$db['nama'].'|'.$db['parent'];
            } else {
                $transaksi = $this->getTransaksi($dari, $sampai, $db['id']);
                $data[$db['kode'].'|'.$db['nama'].'|'.$db['parent']] = $transaksi;

                if($keybefore !== ''){ 
                    foreach ($transaksi as $key => $dt) {
                        // array_push($data[$keybefore], $dt);
                        $data[$keybefore][0]['debit'] = $data[$keybefore][0]['debit'] + $dt['debit'];
                        $data[$keybefore][0]['kredit'] = $data[$keybefore][0]['kredit'] + $dt['kredit'];
                    }
                }
            }
            // $data[$db['nama']] = $this->getTransaksi($dari, $sampai, $db['id']);
        }

        return $data;
    }

    public function getDataByAkun($dari, $sampai, $akun)
    {
        $keybefore = '';
        $data = [];
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        
        for ($i=0; $i < count($akun); $i++) { 
            $kode = htmlspecialchars($akun[$i]);
           $dataAkun = $this->db->query("SELECT * FROM akun WHERE perusahaan_id = $perusahaan_id AND kode LIKE '%$kode%' ORDER BY kode ASC")->result_array();

           foreach ($dataAkun as $key => $db) {
                $data[$db['kode'].'|'.$db['nama'].'|'.$db['parent']] = $this->getTransaksi($dari, $sampai, $db['id']);

                if($db['parent'] === null){
                    $keybefore = $db['kode'].'|'.$db['nama'].'|'.$db['parent'];
                } else {
                    $transaksi = $this->getTransaksi($dari, $sampai, $db['id']);
                    $data[$db['kode'].'|'.$db['nama'].'|'.$db['parent']] = $transaksi;

                    if($keybefore !== ''){ 
                        foreach ($transaksi as $key => $dt) {
                            // array_push($data[$keybefore], $dt);
                            $data[$keybefore][0]['debit'] = $data[$keybefore][0]['debit'] + $dt['debit'];
                            $data[$keybefore][0]['kredit'] = $data[$keybefore][0]['kredit'] + $dt['kredit'];
                        }
                    }
                }
                // $data[$db['nama']] = $this->getTransaksi($dari, $sampai, $db['id']);
            }
        }

        return $data;
    }
}