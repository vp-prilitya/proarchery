<?php

class Booking_model extends CI_model
{
    public function getBooking()
    {
        $id = $this->session->userdata('id');
        return $this->db->query("SELECT a.*, b.nama FROM booking a LEFT JOIN arena b ON a.arena_id = b.id WHERE a.user_created = $id")->result_array();
    }

    public function getJadwal()
    {
        $id = $this->session->userdata('perusahaan_id');
        $arena_id = htmlspecialchars($this->input->post('arena_id'));
        $tanggal = htmlspecialchars($this->input->post('tanggal'));

        $cek = $this->db->get_where('tanggal_arena', ['arena_id' => $arena_id, 'tanggal' => $tanggal])->num_rows();
        
        if($cek > 0){
            return $this->db->query("SELECT  a.*
                                    FROM jam_arena a
                                    WHERE NOT EXISTS
                                            (
                                            SELECT 1 
                                            FROM    booking b
                                            WHERE   b.jam = a.jam AND b.tanggal = '$tanggal' AND b.arena_id = $arena_id
                                            ) AND
                                            a.arena_id = $arena_id AND perusahaan_id = $id")->result_array();
        } else {
            return 0;
        }

    }

    public function save()
    {
        $id = $this->session->userdata('id');
        $tgl = date('Y-m-d');
        $qty = $this->db->query("SELECT * FROM kuota WHERE user_created = $id AND tgl_jatuh_tempo > $tgl AND qty_sisa > 0 ORDER BY id ASC ")->row_array();

        if(count($qty)>0){
            // UPDATE KUOTA SISA
            $update = "UPDATE kuota SET qty_sisa = qty_sisa - 1 WHERE id = $qty[id]";
            $this->db->query($update);

            $data = [
                'no_booking' => noBooking(),
                'arena_id' => htmlspecialchars($this->input->post('arena_id')),
                'tanggal' => htmlspecialchars($this->input->post('tanggal')),
                'jam' => htmlspecialchars($this->input->post('jam')),
                'status' => 0,
                'user_created' => $id,
                'created' => $tgl,
                'is_booking' => 1
            ];
    
            $this->db->insert('booking', $data);
            return true;
        } else {
            return false;
        }
    }

    public function valid($id)
    {
        $this->db->update('booking', ['status' => 1], ['id'=>$id]);
    }

    public function delete($id)
    {
        $data = $this->db->get_where('booking', ['id'=>$id])->row_array();

        $tgl = date('Y-m-d');
        $qty = $this->db->query("SELECT * FROM kuota WHERE user_created = $data[user_created] AND tgl_jatuh_tempo > $tgl ORDER BY id ASC")->row_array();
        $update = "UPDATE kuota SET qty_sisa = qty_sisa + 1 WHERE id = $qty[id]";
        $this->db->query($update);
        
        $this->db->delete('booking',['id'=>$id]);
    }

    public function deleteManual($id)
    {
        $this->db->delete('booking',['id'=>$id]);
    }

    public function getBookingManualKuda($dari, $sampai)
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*, 
                                        b.nama, 
                                        c.nama as arena, 
                                        d.nama as kuda, 
                                        e.nama as pelatih 
                                    FROM 
                                        booking a 
                                        LEFT JOIN pelanggan b ON a.pelanggan_id = b.id 
                                        LEFT JOIN arena c ON a.arena_id = c.id 
                                        LEFT JOIN kuda d ON a.kuda_id = d.id 
                                        LEFT JOIN pelatih e ON a.pelatih_id = e.id 
                                    WHERE 
                                        a.perusahaan_id = $id AND
                                        a.tanggal BETWEEN '$dari' AND '$sampai' AND
                                        a.is_booking = 0 AND
                                        a.jenis_arena = 'kuda'
                                    ")->result_array();
    }

    public function getBookingManualPanahan($dari, $sampai)
    {
        $id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                        a.*, 
                                        b.nama, 
                                        c.nama as arena, 
                                        e.nama as pelatih 
                                    FROM 
                                        booking a 
                                        LEFT JOIN pelanggan b ON a.pelanggan_id = b.id 
                                        LEFT JOIN arena_panahan c ON a.arena_id = c.id 
                                        LEFT JOIN pelatih e ON a.pelatih_id = e.id 
                                    WHERE 
                                        a.perusahaan_id = $id AND
                                        a.tanggal BETWEEN '$dari' AND '$sampai' AND
                                        a.is_booking = 0 AND
                                        a.jenis_arena = 'panah'
                                    ")->result_array();
    }

    public function getJam()
    {
        $arena_id = htmlspecialchars($this->input->post('arena_id'));
        $tanggal = htmlspecialchars($this->input->post('tanggal'));

        return $this->db->query("SELECT  a.*
                                FROM jam_arena a
                                WHERE NOT EXISTS
                                        (
                                        SELECT 1 
                                        FROM    booking b
                                        WHERE   b.jam = a.jam AND b.tanggal = '$tanggal' AND b.arena_id = $arena_id
                                        ) AND
                                        a.arena_id = $arena_id")->result_array();

    }

    public function getTanggalAndJam()
    {
        $arena_id = htmlspecialchars($this->input->post('arena_id'));
        $tanggal = htmlspecialchars($this->input->post('tanggal'));

        $cek = $this->db->get_where('tanggal_arena', ['arena_id'=>$arena_id, 'tanggal'=>$tanggal, 'jenis_arena'=>'kuda'])->num_rows();

        if($cek >= 1){
            return [];
        } else {
            return $this->db->get_where('jam_arena', ['arena_id'=>$arena_id, 'jenis_arena'=>'kuda'])->result_array();
        }
    }

    public function getKuda()
    {
        $jam = htmlspecialchars($this->input->post('jam'));
        $tanggal = htmlspecialchars($this->input->post('tanggal'));
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT  a.*
                                FROM kuda a
                                WHERE NOT EXISTS
                                        (
                                        SELECT 1 
                                        FROM    booking b
                                        WHERE   b.kuda_id = a.id AND b.tanggal = '$tanggal' AND b.jam = '$jam'
                                        ) AND a.perusahaan_id = $id")->result_array();

    }

    public function saveManual()
    {
        $data = [
            'no_booking' => noBooking(),
            'pelanggan_id' => htmlspecialchars($this->input->post('pelanggan_id')),
            'arena_id' => htmlspecialchars($this->input->post('arena_id')),
            'jenis_arena' => 'kuda',
            'tanggal' => htmlspecialchars($this->input->post('tanggal')),
            'jam' => htmlspecialchars($this->input->post('jam')),
            'kuda_id' => htmlspecialchars($this->input->post('kuda')),
            'pelatih_id' => htmlspecialchars($this->input->post('pelatih')),
            'status' => 1,
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
            'is_booking' => 0
        ];

        $this->db->insert('booking', $data);
    }
    
    public function getTanggalAndJamPanahan()
    {
        $arena_id = htmlspecialchars($this->input->post('arena_id'));
        $tanggal = htmlspecialchars($this->input->post('tanggal'));

        $cek = $this->db->get_where('tanggal_arena', ['arena_id'=>$arena_id, 'tanggal'=>$tanggal, 'jenis_arena'=>'panah'])->num_rows();

        if($cek >= 1){
            return [];
        } else {
            return $this->db->get_where('jam_arena', ['arena_id'=>$arena_id, 'jenis_arena'=>'panah'])->result_array();
        }
    }

    public function getPanahan()
    {
        $jam = htmlspecialchars($this->input->post('jamPanahan'));
        $tanggal = htmlspecialchars($this->input->post('tanggalPanahan'));
        $arena_id = htmlspecialchars($this->input->post('arena_idPanahan'));

        $arena = $this->db->get_where('arena_panahan', ['id' => $arena_id])->row_array();
        $cek = $this->db->get_where('booking', ['arena_id'=>$arena_id, 'tanggal'=>$tanggal, 'jenis_arena'=>'panah', 'jam'=>$jam])->num_rows();

        if(intval($arena['kapasitas_maks']) > $cek){
            // return [1];
            return [$cek, $arena['kapasitas_maks']];
        } else {
            return [];
        }
    }

    
    public function saveManualPanahan()
    {
        $cek = $this->getPanahan();
        
        if(count($cek) < 0){
            return 0;
        } else {
            $data = [
                'no_booking' => noBooking(),
                'pelanggan_id' => htmlspecialchars($this->input->post('pelanggan_id')),
                'arena_id' => htmlspecialchars($this->input->post('arena_idPanahan')),
                'jenis_arena' => 'panah',
                'tanggal' => htmlspecialchars($this->input->post('tanggalPanahan')),
                'jam' => htmlspecialchars($this->input->post('jamPanahan')),
                'kuda_id' => 0,
                'pelatih_id' => htmlspecialchars($this->input->post('pelatih')),
                'status' => 1,
                'perusahaan_id' => $this->session->userdata('perusahaan_id'),
                'created' => date('Y-m-d'),
                'user_created' => $this->session->userdata('id'),
                'is_booking' => 0
            ];

            $this->db->insert('booking', $data);
            return 1;
        }
    }
}