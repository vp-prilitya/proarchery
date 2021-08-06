<?php

class Scan_model extends CI_model
{
    public function getBarangDetail()
    {
        $invoice = htmlspecialchars($this->input->post('invoice'));

        return $this->db->query("SELECT 
                                    a.*, 
                                    b.barang_jual_id, 
                                    b.quantity,
                                    b.diskon as disc, 
                                    c.nama as pelanggan, 
                                    c.alamat, 
                                    c.contact, 
                                    c.email, 
                                    d.nama as item, d.harga_jual, d.satuan,
                                    GROUP_CONCAT(
                                    CONCAT(g.nama, ' @ ', e.quantity, g.satuan) SEPARATOR '<br>'
                                    ) as paket, 
                                    f.nama as perusahaan, 
                                    f.email as email_perusahaan, 
                                    f.telp, 
                                    f.alamat as alamat_perusahaan 
                                FROM 
                                    penjualan a 
                                    JOIN penjualan_detail b ON a.id = b.penjualan_id 
                                    AND a.no_faktur = b.no_faktur 
                                    LEFT JOIN pelanggan c ON a.pelanggan_id = c.id 
                                    LEFT JOIN barang_jual d ON d.id = b.barang_jual_id 
                                    LEFT JOIN barang_jual_detail e ON e.barang_jual_id = b.barang_jual_id  AND d.jenis_barang = 'jasa'
                                    LEFT JOIN barang_jual g ON g.id = e.barang_id AND d.is_paket = 1
                                    JOIN perusahaan f ON a.perusahaan_id = f.id 
                                WHERE 
                                    a.no_faktur = '$invoice'
                                GROUP BY 
                                    b.barang_jual_id
                                ")->result_array();
    }

    public function getKaryawan()
    {
        $nip = htmlspecialchars($this->input->post('nip'));
        return $this->db->get_where('karyawan', ['nip' => $nip])->row_array();
    }
    public function save()
    {
        $created = date('Y-m-d');
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $user_created = $this->session->userdata('id');
        $barang_jual_id = $this->input->post('barang_jual_id');
        $quantity = $this->input->post('quantity');
        $invoice = htmlspecialchars($this->input->post('invoice'));
        $karyawan_id = htmlspecialchars($this->input->post('karyawan_id'));

        $cek = $this->db->get_where('qr_record', ['no_faktur' => $invoice])->num_rows();
        
        if($cek > 0){
            return 0;
        }

        $insert=[];
        for ($i=0; $i<count($barang_jual_id); $i++) { 
            $data = [
                'barang_jual_id' => htmlspecialchars($barang_jual_id[$i]),
                'quantity' => htmlspecialchars($quantity[$i]),
                'no_faktur' => $invoice,
                'karyawan_id' => $karyawan_id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id,
            ];

            array_push($insert, $data);
        }
        
        $this->db->insert_batch('qr_record', $insert);
        return 1;
    }
    
}