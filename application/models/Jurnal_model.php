<?php

class Jurnal_model extends CI_model
{
    public function getJurnal($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT *, SUM(debit) as totalDebit, SUM(kredit) as totalKredit FROM transaksi WHERE url = 'jurnal' AND created BETWEEN '$dari' AND '$sampai' AND perusahaan_id = $perusahaan_id GROUP BY time")->result_array();
    }
    public function save()
    {
        $created = htmlspecialchars($this->input->post('created')??date('Y-m-d'));
        $rincian = htmlspecialchars($this->input->post('rincian'));
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $user_created = $this->session->userdata('id');
        $jml = htmlspecialchars($this->input->post('jml'));
        $time = date('Ymdhis');

        $insert=[];
        for ($i=1; $i<=$jml; $i++) { 
            $data = [
                'akun_id' => htmlspecialchars($this->input->post("akun_id$i")),
                'debit' => htmlspecialchars($this->input->post("debit$i")),
                'kredit' => htmlspecialchars($this->input->post("kredit$i")),
                'rincian' => $rincian,
                'url' => 'jurnal',
                'created' => $created,
                'time' => $time,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id,
            ];

            array_push($insert, $data);
        }
        

        $this->db->insert_batch('transaksi', $insert);
    }
    
    public function getJurnalByTime($time)
    {
        return $this->db->get_where('transaksi', ['time'=>$time])->result_array();
    }
    
    public function update()
    {
        $this->db->delete('transaksi', ['time' => htmlspecialchars($this->input->post('time'))]);
        $this->save();
    }
    
    public function delete($time)
    {
        $this->db->delete('transaksi', ['time' => $time]);
    }

    public function getJurnalPenjualan($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama, b.kode FROM transaksi a LEFT JOIN akun b ON a.akun_id = b.id WHERE a.url = 'pesanan_penjualan' AND a.created BETWEEN '$dari' AND '$sampai' AND a.perusahaan_id = $perusahaan_id")->result_array();
    }

    public function getJurnalPembelian($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama, b.kode FROM transaksi a LEFT JOIN akun b ON a.akun_id = b.id WHERE a.url = 'pesanan_pembelian' AND a.created BETWEEN '$dari' AND '$sampai' AND a.perusahaan_id = $perusahaan_id")->result_array();
    }

    public function getJurnalUmum($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, b.nama, b.kode FROM transaksi a LEFT JOIN akun b ON a.akun_id = b.id WHERE (a.url = 'jurnal' OR a.url = 'transaksi_kas/createPenerimaan' OR a.url = 'transaksi_kas/createPengeluaran') AND a.created BETWEEN '$dari' AND '$sampai' AND a.perusahaan_id = $perusahaan_id")->result_array();
    }
}