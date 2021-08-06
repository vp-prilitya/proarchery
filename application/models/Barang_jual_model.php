<?php

class Barang_jual_model extends CI_model
{
    public function getBarang_jual()
    {
        return $this->db->get_where('barang_jual', ['perusahaan_id' => $this->session->userdata('perusahaan_id'), 'need_raw'=>0, 'is_paket'=>1])->result_array();
    }

    public function getBarang_jualFnb()
    {
        return $this->db->get_where('barang_jual', ['perusahaan_id' => $this->session->userdata('perusahaan_id'), 'need_raw'=>1])->result_array();
    }

    public function getBarangJualSatuan()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama as gudang FROM barang_jual a LEFT JOIN gudang b ON a.gudang_id = b.id WHERE a.perusahaan_id = $id AND a.is_paket = 0 AND a.need_raw = 0")->result_array();
    }

    public function save()
    {
        // var_dump(htmlspecialchars($this->input->post('jenis_barang'))); die;
        $kode = kodeJual();
        $qr_code = date('Y') . date('m') . date('d') . $kode[1];

        $img = '';
        $img1 = $_FILES['poto']['name'];
        if($img1){
            $config['upload_path']          = './assets/poto/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);
            if($this->upload->do_upload('poto')) {
                $img = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $data = [
            'kode_barang' => $kode[0],
            'nama' => htmlspecialchars($this->input->post('nama')),
            'no_part' => htmlspecialchars($this->input->post('no_part')),
            'jenis_harga_pokok' => htmlspecialchars($this->input->post('jenis_harga_pokok')),
            'jenis_barang' => htmlspecialchars($this->input->post('jenis_barang'))==""?'toko' : htmlspecialchars($this->input->post('jenis_barang')),
            'harga_pokok' => htmlspecialchars($this->input->post('harga_pokok'))??htmlspecialchars($this->input->post('harga_jual')),
            'harga_jual' => htmlspecialchars($this->input->post('harga_jual')),
            'satuan' => htmlspecialchars($this->input->post('satuan')),
            'stok' => htmlspecialchars($this->input->post('stok'))??0,
            'min_stok' => htmlspecialchars($this->input->post('min_stok'))??0,
            'gudang_id' => htmlspecialchars($this->input->post('gudang_id'))??0,
            'poto' => $img == ''? null : "poto/$img",
            'sifat' => implode(",",$this->input->post('sifat')),
            'kategori_id' => htmlspecialchars($this->input->post('kategori_id')),
            'jadwal' => htmlspecialchars($this->input->post('jadwal'))??0,
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'qr_code' => $qr_code .'.png',
        ];

        $paket = $this->input->post('quantityBarangJual');
        $paket_id = $this->input->post('idBarangJual');
        
        $mentah = $this->input->post('quantityBarangMentah');
        $mentah_id = $this->input->post('idBarangMentah');
        // var_dump($this->input->post()); die;
        // var_dump($mentah_id); die;

        if($this->input->post('quantityBarangJual')){
            $data['is_paket'] = 1;
        }

        if($this->input->post('quantityBarangMentah')){
            $data['need_raw'] = 1;
        }

        // var_dump($data); die;
        $this->db->insert('barang_jual', $data);
        $barang_id = $this->db->insert_id();
        $insert = [];

        if($this->input->post('quantityBarangJual')){
            for ($i=0; $i < count($paket); $i++) { 
                $mydata = [
                    'barang_jual_id' => $barang_id,
                    'barang_id' => $paket_id[$i],
                    'quantity' => $paket[$i],
                    'type' => 1
                ];

                array_push($insert, $mydata);
            }
        }

        if($this->input->post('quantityBarangMentah')){
            for ($i=0; $i < count($mentah); $i++) { 
                $mydata = [
                    'barang_jual_id' => $barang_id,
                    'barang_id' => $mentah_id[$i],
                    'quantity' => $mentah[$i],
                    'type' => 0
                ];

                array_push($insert, $mydata);
            }
        }

        count($insert)>0? $this->db->insert_batch('barang_jual_detail', $insert) : null;

        // INSERT BARANG_JUAL_AKUN
        $akun_id = $this->input->post('akun_id');
        $jenis = $this->input->post('jenis');
        $keterangan = $this->input->post('keterangan');
        $sifat = $this->input->post('sifat');
        $insertToBarang_jual_akun = [];

        // if($this->input->post('akun_id')){
        //     for ($i=0; $i < count($akun_id); $i++) { 
        //         $dataInsert = [
        //             'barang_jual_id' => $barang_id,
        //             'akun_id' => $akun_id[$i],
        //             'jenis' => $jenis[$i],
        //             'keterangan' => $keterangan[$i],
        //         ];

        //         array_push($insertToBarang_jual_akun, $dataInsert);
        //     }
        // }

        if(in_array('simpan', $sifat)){
            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id3')),
                'jenis' => htmlspecialchars($this->input->post('jenis3')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan3')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);

            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id5')),
                'jenis' => htmlspecialchars($this->input->post('jenis5')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan5')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);
        }

        if(in_array('beli', $sifat)){
            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id1')),
                'jenis' => htmlspecialchars($this->input->post('jenis1')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan1')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);

            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id4')),
                'jenis' => htmlspecialchars($this->input->post('jenis4')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan4')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);
        }

        if(in_array('jual', $sifat)){
            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id2')),
                'jenis' => htmlspecialchars($this->input->post('jenis2')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan2')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);
        }
        count($insertToBarang_jual_akun)>0? $this->db->insert_batch('barang_jual_akun', $insertToBarang_jual_akun) : null;
        // AKHIR

        // $json = [
        //     'qr_code' => $qr_code,
        // ];
        // qr_code($json);
    }

    public function getBarangJualByIdJson($id)
    {
        $barang = $this->db->get_where('barang_jual', ['id'=>$id])->row_array();
        return $barang;
    }

    public function getBarang_jualById($id)
    {
        $barang = $this->db->get_where('barang_jual', ['id'=>$id])->result_array();
        if($barang[0]['need_raw']==0 AND $barang[0]['is_paket']==1){
            $barang = $this->db->query("SELECT 
                                            a.quantity,
                                            a.barang_id, 
                                            b.*, 
                                            c.nama as paket,
                                            c.satuan as p_satuan
                                        FROM 
                                            barang_jual_detail a 
                                            JOIN barang_jual b ON a.barang_jual_id = b.id 
                                            JOIN barang_jual c ON a.barang_id = c.id 
                                        WHERE 
                                            a.barang_jual_id = $id
                                        ")->result_array();
        }

        if($barang[0]['need_raw']==1 AND $barang[0]['is_paket']==0){
            $barang = $this->db->query("SELECT 
                                            a.quantity,
                                            a.barang_id, 
                                            b.*, 
                                            c.nama as paket,
                                            c.satuan as p_satuan
                                        FROM 
                                            barang_jual_detail a 
                                            JOIN barang_jual b ON a.barang_jual_id = b.id 
                                            JOIN barang_mentah c ON a.barang_id = c.id 
                                        WHERE 
                                            a.barang_jual_id = $id
                                        ")->result_array();
        }
        // var_dump($barang); die;
        return $barang;
    }

    public function update()
    {
        $id = htmlspecialchars($this->input->post('id'));
        $img = '';
        $img1 = $_FILES['poto']['name'];
        if($img1){
            $config['upload_path']          = './assets/poto/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);
            if($this->upload->do_upload('poto')) {
                $img = $this->upload->data('file_name');
                $barang_jual = $this->db->get_where('barang_jual', ['id'=>$id])->row_array();
                // unlink(FCPATH . 'assets/poto/' . $barang_jual['poto']);
                $filename = FCPATH . 'assets/poto/' . $barang_jual['poto'];
                if (file_exists($filename)) {
                    unlink($filename);
                } 
            } else {
                echo $this->upload->display_errors();
            }
        }

        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'no_part' => htmlspecialchars($this->input->post('no_part')),
            'jenis_barang' => htmlspecialchars($this->input->post('jenis_barang'))??'toko',
            'jenis_harga_pokok' => htmlspecialchars($this->input->post('jenis_harga_pokok')),
            'harga_jual' => htmlspecialchars($this->input->post('harga_jual')),
            'satuan' => htmlspecialchars($this->input->post('satuan')),
            'stok' => htmlspecialchars($this->input->post('stok'))??0,
            'min_stok' => htmlspecialchars($this->input->post('min_stok'))??0,
            'gudang_id' => htmlspecialchars($this->input->post('gudang_id'))??0,
            'poto' => $img == ''? null : "poto/$img",
            'sifat' => implode(",",$this->input->post('sifat')),
            'kategori_id' => htmlspecialchars($this->input->post('kategori_id')),
            'jadwal' => htmlspecialchars($this->input->post('jadwal'))??0,
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $paket = $this->input->post('quantityBarangJual');
        $paket_id = $this->input->post('idBarangJual');

        $mentah = $this->input->post('quantityBarangMentah');
        $mentah_id = $this->input->post('idBarangMentah');

        if($this->input->post('quantityBarangJual')){
            $data['is_paket'] = 1;
        }

        if($this->input->post('quantityBarangMentah')){
            $data['need_raw'] = 1;
        }
        $this->db->update('barang_jual', $data, ['id'=>$id]);
        
        $this->db->delete('barang_jual_detail', ['barang_jual_id'=>$id]);
        $insert = [];
        if($this->input->post('quantityBarangJual')){
            for ($i=0; $i < count($paket); $i++) { 
                $mydata = [
                    'barang_jual_id' => $id,
                    'barang_id' => $paket_id[$i],
                    'quantity' => $paket[$i],
                    'type' => 1
                ];

                array_push($insert, $mydata);
            }
        }

        if($this->input->post('quantityBarangMentah')){
            for ($i=0; $i < count($mentah); $i++) { 
                $mydata = [
                    'barang_jual_id' => $id,
                    'barang_id' => $mentah_id[$i],
                    'quantity' => $mentah[$i],
                    'type' => 0
                ];

                array_push($insert, $mydata);
            }
        }

        count($insert)>0? $this->db->insert_batch('barang_jual_detail', $insert) : null;

        // INSERT BARANG_JUAL_AKUN
        $akun_id = $this->input->post('akun_id');
        $jenis = $this->input->post('jenis');
        $keterangan = $this->input->post('keterangan');
        $sifat = $this->input->post('sifat');
        $insertToBarang_jual_akun = [];
        
        $this->db->delete('barang_jual_akun', ['barang_jual_id'=>$id]);
        // if($this->input->post('akun_id')){
        //     for ($i=0; $i < count($akun_id); $i++) { 
        //         $dataInsert = [
        //             'barang_jual_id' => $id,
        //             'akun_id' => $akun_id[$i],
        //             'jenis' => $jenis[$i],
        //             'keterangan' => $keterangan[$i],
        //         ];

        //         array_push($insertToBarang_jual_akun, $dataInsert);
        //     }
        // }
        if(in_array('simpan', $sifat)){
            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id3')),
                'jenis' => htmlspecialchars($this->input->post('jenis3')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan3')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);

            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id5')),
                'jenis' => htmlspecialchars($this->input->post('jenis5')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan5')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);
        }

        if(in_array('beli', $sifat)){
            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id1')),
                'jenis' => htmlspecialchars($this->input->post('jenis1')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan1')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);

            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id4')),
                'jenis' => htmlspecialchars($this->input->post('jenis4')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan4')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);
        }

        if(in_array('jual', $sifat)){
            $dataInsert = [
                'barang_jual_id' => $barang_id,
                'akun_id' => htmlspecialchars($this->input->post('akun_id2')),
                'jenis' => htmlspecialchars($this->input->post('jenis2')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan2')),
            ];
            array_push($insertToBarang_jual_akun, $dataInsert);
        }
        count($insertToBarang_jual_akun)>0? $this->db->insert_batch('barang_jual_akun', $insertToBarang_jual_akun) : null;
        // AKHIR
    }

    public function delete($id)
    {
        $barang_jual = $this->db->get_where('barang_jual', ['id'=>$id])->row_array();
        unlink(FCPATH . 'assets/qr_code/' . $barang_jual['qr_code']);
        unlink(FCPATH . 'assets/poto/' . $barang_jual['poto']);

        $this->db->delete('barang_jual',['id'=>$id]);
        $this->db->delete('barang_jual_akun', ['barang_jual_id'=>$id]);
        $this->db->delete('barang_jual_detail', ['barang_jual_id'=>$id]);
    }

    public function getAkunByBarangJualId($id)
    {
        return $this->db->get_where('barang_jual_akun', ['barang_jual_id' => $id])->result_array();
    }
}