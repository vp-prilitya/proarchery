<?php

class Arena_model extends CI_model
{
    public function getArena()
    {
        return $this->db->get_where('arena', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }

    public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('arena', $data);
    }

    public function getArenaById($id)
    {
        return $this->db->get_where('arena', ['id'=>$id])->row_array();
    }

    public function getTanggalArenaById($id)
    {
        return $this->db->get_where('tanggal_arena', ['arena_id'=>$id, 'jenis_arena' => 'kuda'])->result_array();
    }

    public function getjamArenaById($id)
    {
        return $this->db->get_where('jam_arena', ['arena_id'=>$id, 'jenis_arena' => 'kuda'])->result_array();
    }

    public function saveTanggal()
    {
        $tgl = htmlspecialchars($this->input->post('tanggal'));
        $tgl = date('Y-m-d', strtotime($tgl));
        $id = htmlspecialchars($this->input->post('arena_id'));

        $this->db->delete('tanggal_arena',['arena_id'=>$id, 'tanggal' => $tgl, 'jenis_arena' => 'kuda']);

        $data = [
            'arena_id' => $id,
            'jenis_arena' => 'kuda',
            'tanggal' => $tgl,
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('tanggal_arena', $data);
    }

    public function saveJam()
    {
        $jam = htmlspecialchars($this->input->post('jam'));
        $jam = date('H:i', strtotime($jam));
        $id = htmlspecialchars($this->input->post('arena_id'));

        $this->db->delete('jam_arena',['arena_id'=>$id, 'jam' => $jam, 'jenis_arena' => 'kuda']);

        $data = [
            'arena_id' => $id,
            'jenis_arena' => 'kuda',
            'jam' => $jam,
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('jam_arena', $data);
    }
    
    public function deleteTanggal($id)
    {
        $this->db->delete('tanggal_arena',['id'=>$id, 'jenis_arena' => 'kuda']);
    }
    
    public function deleteJam($id)
    {
        $this->db->delete('jam_arena',['id'=>$id, 'jenis_arena' => 'kuda']);
    }

    public function getRule()
    {
        return $this->db->get('setting')->result_array();
    }

    public function saveSetting()
    {
        $tgl_jam = htmlspecialchars($this->input->post('tgl_jam'));
        $id = htmlspecialchars($this->input->post('id'));

        $data = [
            'value' => htmlspecialchars($this->input->post('value')),
        ];

        $this->db->update('setting', $data, ['id' => $id]);
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('arena', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('arena',['id'=>$id]);
        $this->db->delete('tanggal_arena',['arena_id'=>$id, 'jenis_arena' => 'kuda']);
        $this->db->delete('jam_arena',['arena_id'=>$id, 'jenis_arena' => 'kuda']);
    }

    public function getArenaPanahan()
    {
        return $this->db->get_where('arena_panahan', ['perusahaan_id' => $this->session->userdata('perusahaan_id')])->result_array();
    }

    public function getArenaPanahanById($id)
    {
        return $this->db->get_where('arena_panahan', ['id'=>$id])->row_array();
    }

    public function getTanggalArenaPanahanById($id)
    {
        return $this->db->get_where('tanggal_arena', ['arena_id'=>$id, 'jenis_arena' => 'panah'])->result_array();
    }

    public function getjamArenaPanahanById($id)
    {
        return $this->db->get_where('jam_arena', ['arena_id'=>$id, 'jenis_arena' => 'panah'])->result_array();
    }

    public function saveTanggalPanahan()
    {
        $tgl = htmlspecialchars($this->input->post('tanggal'));
        $tgl = date('Y-m-d', strtotime($tgl));
        $id = htmlspecialchars($this->input->post('arena_id'));

        $this->db->delete('tanggal_arena',['arena_id'=>$id, 'tanggal' => $tgl, 'jenis_arena' => 'panah']);

        $data = [
            'arena_id' => $id,
            'jenis_arena' => 'panah',
            'tanggal' => $tgl,
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('tanggal_arena', $data);
    }

    public function saveJamPanahan()
    {
        $jam = htmlspecialchars($this->input->post('jam'));
        $jam = date('H:i', strtotime($jam));
        $id = htmlspecialchars($this->input->post('arena_id'));

        $this->db->delete('jam_arena',['arena_id'=>$id, 'jam' => $jam, 'jenis_arena' => 'panah']);

        $data = [
            'arena_id' => $id,
            'jenis_arena' => 'panah',
            'jam' => $jam,
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('jam_arena', $data);
    }

    public function deleteTanggalPanahan($id)
    {
        $this->db->delete('tanggal_arena',['id'=>$id, 'jenis_arena' => 'panah']);
    }
    
    public function deleteJamPanahan($id)
    {
        $this->db->delete('jam_arena',['id'=>$id, 'jenis_arena' => 'panah']);
    }
    
    public function savePanahan()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'jumlah' => htmlspecialchars($this->input->post('jumlah')),
            'kapasitas' => htmlspecialchars($this->input->post('kapasitas')),
            'kapasitas_maks' => htmlspecialchars($this->input->post('kapasitas_maks')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('arena_panahan', $data);
    }

    public function updatePanahan()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'jumlah' => htmlspecialchars($this->input->post('jumlah')),
            'kapasitas' => htmlspecialchars($this->input->post('kapasitas')),
            'kapasitas_maks' => htmlspecialchars($this->input->post('kapasitas_maks')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('arena_panahan', $data, ['id'=>$this->input->post('id')]);
    }

    public function deletePanahan($id)
    {
        $this->db->delete('arena_panahan',['id'=>$id, 'jenis_arena' => 'panah']);
        $this->db->delete('tanggal_arena',['arena_id'=>$id, 'jenis_arena' => 'panah']);
        $this->db->delete('jam_arena',['arena_id'=>$id, 'jenis_arena' => 'panah']);
    }
}