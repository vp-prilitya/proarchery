<?php

class Uang_muka_penjualan_model extends CI_model
{
    public function getDaftarUangMuka()
    {
        $id = $this->session->userdata('perusahaan_id');
        // return $this->db->query("SELECT 
        //                             SUM(a.jumlah) as jumlah,
        //                             b.nama
        //                         FROM 
        //                             uang_muka_penjualan a 
        //                             LEFT JOIN pelanggan b ON a.pelanggan_id = b.id 
        //                         WHERE 
        //                             a.perusahaan_id = $id
        //                         GROUP BY
        //                             a.pelanggan_id
        //                         ")->result_array();
        return $this->db->query("SELECT 
                                    a.*,
                                    b.nama
                                FROM 
                                    uang_muka a 
                                    LEFT JOIN pelanggan b ON a.user_id = b.id 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    a.jenis = 'penjualan'
                                ")->result_array();
    }

    public function getUangMuka()
    {
        $id = $this->session->userdata('perusahaan_id');
        $tgl = date('Y-m-d');
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.nama, 
                                    c.nama as akun 
                                FROM 
                                    uang_muka_penjualan a 
                                    LEFT JOIN pelanggan b ON a.pelanggan_id = b.id 
                                    LEFT JOIN akun c ON a.akun_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    a.created = '$tgl'
                                ")->result_array();
    }

    public function getUangMukaById($id)
    {
        return $this->db->get_where('uang_muka_penjualan', ['id' => $id])->row_array();
    }

    public function save()
    {
        $data = [
            'no_transaksi' => noUMS(),
            'pelanggan_id' => htmlspecialchars($this->input->post('pelanggan_id')),
            'akun_id' => htmlspecialchars($this->input->post('akun_id')),
            'jumlah' => htmlspecialchars($this->input->post('jumlah')),
            'jenis_ppn' => htmlspecialchars($this->input->post('jenis_ppn')),
            'ppn' => str_replace(',','.', str_replace('.','',htmlspecialchars($this->input->post('ppn')))),
            'catatan' => htmlspecialchars($this->input->post('catatan')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('uang_muka_penjualan', $data);

        $this->updateUangMuka($data, 'save');
    }

    public function update()
    {
        $data = [
            'pelanggan_id' => htmlspecialchars($this->input->post('pelanggan_id')),
            'akun_id' => htmlspecialchars($this->input->post('akun_id')),
            'jumlah' => htmlspecialchars($this->input->post('jumlah')),
            'jenis_ppn' => htmlspecialchars($this->input->post('jenis_ppn')),
            'ppn' => str_replace(',','.', str_replace('.','',htmlspecialchars($this->input->post('ppn')))),
            'catatan' => htmlspecialchars($this->input->post('catatan')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
        ];

        $this->updateUangMuka($data, 'update', htmlspecialchars($this->input->post('id')));
        $this->db->update('uang_muka_penjualan', $data, ['id' => htmlspecialchars($this->input->post('id'))]);
    }

    public function updateUangMuka($data, $jenis, $id=0)
    {
        if ($jenis === 'save'){
            $cek = $this->db->get_where('uang_muka', ['jenis' => 'penjualan', 'user_id'=>$data['pelanggan_id'], 'perusahaan_id'=>$data['perusahaan_id']])->num_rows();

            if ($data['jenis_ppn'] === 'exclude'){
                $jumlah = $data['jumlah'] - $data['ppn'];
            } else {
                $jumlah = $data['jumlah'];
            }

            if($cek > 0){
                $this->db->query("UPDATE uang_muka SET jumlah = jumlah + $jumlah WHERE user_id = $data[pelanggan_id] AND perusahaan_id = $data[perusahaan_id] AND jenis = 'penjualan'");
            } else {
                $insert = [
                    'jenis' => 'penjualan',
                    'user_id'=>$data['pelanggan_id'],
                    'perusahaan_id'=>$data['perusahaan_id'],
                    'jumlah' => $jumlah,
                ];
                $this->db->insert('uang_muka', $insert);
            }
        }

        if ($jenis === 'update'){
            if ($data['jenis_ppn'] === 'exclude'){
                $jumlah = $data['jumlah'] - $data['ppn'];
            } else {
                $jumlah = $data['jumlah'];
            }

            $db = $this->getUangMukaById($id);
            if ($db['jenis_ppn'] === 'exclude'){
                $jumlah2 = $db['jumlah'] - $db['ppn'];
            } else {
                $jumlah2 = $db['jumlah'];
            }
            
            $this->db->query("UPDATE uang_muka SET jumlah = jumlah - $jumlah2 WHERE user_id = $data[pelanggan_id] AND perusahaan_id = $data[perusahaan_id] AND jenis = 'penjualan'");

            $this->db->query("UPDATE uang_muka SET jumlah = jumlah + $jumlah WHERE user_id = $data[pelanggan_id] AND perusahaan_id = $data[perusahaan_id] AND jenis = 'penjualan'");
        }
    }

    public function delete($id)
    {
        $data = $this->getUangMukaById($id);

        if ($data['jenis_ppn'] === 'exclude'){
            $jumlah = $data['jumlah'] - $data['ppn'];
        } else {
            $jumlah = $data['jumlah'];
        }

        $this->db->query("UPDATE uang_muka SET jumlah = jumlah - $jumlah WHERE user_id = $data[pelanggan_id] AND perusahaan_id = $data[perusahaan_id] AND jenis = 'penjualan'");
        $this->db->delete('uang_muka_penjualan',['id'=>$id]);
    }
}