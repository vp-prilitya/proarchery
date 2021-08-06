<?php

class Karyawan_model extends CI_model
{
    public function getKaryawan()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*, 
                                        b.nama as divisi,
                                        c.nama as perusahaan 
                                    FROM 
                                        karyawan a 
                                        JOIN divisi b ON a.divisi_id = b.id
                                        JOIN perusahaan c ON a.perusahaan_id = c.id 
                                    WHERE 
                                        a.perusahaan_id = $perusahaan_id
                                    ")->result_array();
    }

    public function save()
    {
        //  var_dump("$urut");
        $tgl = date('Y');
        $perusahaan_id = $this->input->post('perusahaan_id');
        $p = strlen(htmlspecialchars($perusahaan_id)) == 1 ? '0'.htmlspecialchars($perusahaan_id) : htmlspecialchars($perusahaan_id);
        $n = explode('|', $this->input->post('jabatan'));
        // $urut = $this->db->query("SELECT * FROM karyawan WHERE YEAR(created) = '$tgl' AND perusahaan_id = $perusahaan_id")->num_rows() + 1;
        
        $urut = $this->db->query("SELECT * FROM karyawan WHERE YEAR(created) = '$tgl' AND perusahaan_id = $perusahaan_id ORDER BY id DESC")->row_array();
        
        if((int)substr($urut['nip'], -2) > 10){
            $urut = (int)substr($urut['nip'], -4) + 1;
           
        } else {
            $urut = (int)substr($urut['nip'], -2) + 1;
        }
        
        if(strlen($urut) === 1){
            $urut = '000'.$urut;
        }

        if(strlen($urut) === 2){
            $urut = '00'.$urut;
        }

        if(strlen($urut) === 3){
            $urut = '0'.$urut;
        }
        
        // var_dump($urut); die;

        $nip = $p . substr(date('Y'), -2) . $n[0] . $urut;
        $data = [
            'nip' => $nip,
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'contact' => htmlspecialchars($this->input->post('contact')),
            'email' => htmlspecialchars($this->input->post('email')),
            'jabatan' => htmlspecialchars($n[1]),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'perusahaan_id' => htmlspecialchars($perusahaan_id),
            'divisi_id' => htmlspecialchars($this->input->post('divisi_id')),
            'gaji' => str_replace('.','', htmlspecialchars($this->input->post('gaji'))),
            'telkom' => str_replace('.','', htmlspecialchars($this->input->post('telkom'))),
            'transport' => str_replace('.','', htmlspecialchars($this->input->post('transport'))),
            'makan' => str_replace('.','', htmlspecialchars($this->input->post('makan'))),
            'lainnya' => str_replace('.','', htmlspecialchars($this->input->post('lainnya'))),
        ];

        $this->db->insert('karyawan', $data);
        
        

        $json = [
            'qr_code' => $nip,
        ];
        qr_code($json);
        //  var_dump('MASUK');
        //  var_dump($data); die;
    }

    public function getKaryawanById($id)
    {
        return $this->db->get_where('karyawan', ['id'=>$id])->row_array();
    }

    public function update()
    {
        // $db = $this->getKaryawanById($id);
        // unlink(FCPATH . 'assets/poto/' . $db['nip'] . '.png');
        $n = explode('|', $this->input->post('jabatan'));
        $data = [
            // 'nip' => htmlspecialchars($this->input->post('nip')),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'contact' => htmlspecialchars($this->input->post('contact')),
            'email' => htmlspecialchars($this->input->post('email')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'perusahaan_id' => htmlspecialchars($this->input->post('perusahaan_id')),
            'divisi_id' => htmlspecialchars($this->input->post('divisi_id')),
            'gaji' => str_replace('.','', htmlspecialchars($this->input->post('gaji'))),
            'telkom' => str_replace('.','', htmlspecialchars($this->input->post('telkom'))),
            'transport' => str_replace('.','', htmlspecialchars($this->input->post('transport'))),
            'makan' => str_replace('.','', htmlspecialchars($this->input->post('makan'))),
            'lainnya' => str_replace('.','', htmlspecialchars($this->input->post('lainnya'))),
            'jabatan' => htmlspecialchars($n[1]),
        ];

        $this->db->update('karyawan', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $data = $this->getKaryawanById($id);
        unlink(FCPATH . 'assets/poto/' . $data['nip'] . '.png');
        $this->db->delete('karyawan',['id'=>$id]);
    }

    public function getSales()
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->get_where('karyawan', ['perusahaan_id' => $id, 'divisi_id'=> 6])->result_array();
    }
}