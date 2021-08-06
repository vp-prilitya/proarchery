<?php

class Kuota_model extends CI_model
{
    public function getKuota()
    {
        return $this->db->get_where('kuota', ['user_created' => $this->session->userdata('id')])->result_array();
    }

    public function getAllKuota()
    {
        return $this->db->query("SELECT 
                                            a.*, 
                                            a.nama, 
                                            GROUP_CONCAT(
                                            CONCAT(
                                                c.nama, ' @ ', b.quantity, ' ', c.satuan
                                            ) SEPARATOR ' - '
                                            ) as detail 
                                        FROM 
                                            barang_jual a 
                                            LEFT JOIN barang_jual_detail b ON a.id = b.barang_jual_id 
                                            LEFT JOIN barang_jual c ON b.barang_id = c.id 
                                        WHERE 
                                            a.jadwal = 1
                                        ")->result_array();
    }

    public function save()
    {
        $rule = $this->db->get_where('setting', ['id' => 4])->row_array();
        $var = '+ ' . $rule['value'] . ' days';
        $tgl_jatuh_tempo = date('Y-m-d', strtotime($var, strtotime(date('Y-m-d'))));

        $qty = htmlspecialchars($this->input->post('qty'));

        $data = [
            'no_faktur' => pesananKuota(),
            'barang_jual_id' => htmlspecialchars($this->input->post('barang_jual_id')),
            'qty' => $qty,
            'qty_sisa' => $qty,
            'total_tagihan' => str_replace('.', '', htmlspecialchars($this->input->post('total_tagihan'))),
            'tgl_bayar' => date('Y-m-d'),
            'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('kuota', $data);
    }

    public function getKuotaById($id)
    {
        return $this->db->get_where('kuota', ['id'=>$id])->result_array();
    }

    public function upload()
    {
        $img1 = $_FILES['file_bukti']['name'];
        if($img1){
            $config['upload_path']          = './assets/bukti/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);
            if($this->upload->do_upload('file_bukti')) {
                $img = $this->upload->data('file_name');
                $data = [
                    'bukti' => 'bukti/' . $img,
                ];
        
                $this->db->update('kuota', $data, ['id'=>$this->input->post('id')]);
            } else {
                echo $this->upload->display_errors();
            }
        }
    }

    public function delete($id)
    {
        $this->db->delete('kuota',['id'=>$id]);
    }
}