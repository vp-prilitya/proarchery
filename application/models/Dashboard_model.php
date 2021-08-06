<?php

class Dashboard_model extends CI_model
{
    public function getSaldo()
    {
        $month = date('m');
        $year = date('Y');
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.debit) as debit, 
                                    SUM(a.kredit) as kredit 
                                FROM 
                                    transaksi a 
                                    JOIN akun b ON a.akun_id = b.id 
                                    LEFT JOIN kelompok c ON b.kelompok_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    c.id = 1 AND
                                    MONTH(a.created) = $month AND 
                                    YEAR(a.created) = $year
                                ")->row_array();
    }

    public function getHutang()
    {
        $month = date('m');
        $year = date('Y');
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.hutang) as hutang
                                FROM 
                                    hutang a 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    MONTH(a.created) = $month AND 
                                    YEAR(a.created) = $year
                                ")->row_array();
    }

    public function getPiutang()
    {
        $month = date('m');
        $year = date('Y');
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.piutang) as piutang
                                FROM 
                                    piutang a 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    MONTH(a.created) = $month AND 
                                    YEAR(a.created) = $year
                                ")->row_array();
    }

    public function getStok()
    {
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.stok) as stok 
                                FROM 
                                    barang_jual a 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    a.need_raw = 0 AND 
                                    a.is_paket = 0
                                ")->row_array();
    }

    
    public function getPenjualanHariPOS()
    {
        $date = date('Y-m-d');
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.total_tagihan) as total_tagihan
                                FROM 
                                    penjualan a 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    a.created = '$date' 
                                ")->row_array();
    }
    
    public function getPenjualanBulanPOS()
    {
        $month = date('m');
        $year = date('Y');
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.total_tagihan) as total_tagihan
                                FROM 
                                    penjualan a 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    MONTH(a.created) = $month AND 
                                    YEAR(a.created) = $year
                                ")->row_array();
    }
    
    public function getPenjualanHari()
    {
        $date = date('Y-m-d');
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.total_tagihan) as total_tagihan
                                FROM 
                                    pengiriman_penjualan a 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    a.created = '$date' 
                                ")->row_array();
    }
    
    public function getPenjualanBulan()
    {
        $month = date('m');
        $year = date('Y');
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.total_tagihan) as total_tagihan
                                FROM 
                                    pengiriman_penjualan a 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    MONTH(a.created) = $month AND 
                                    YEAR(a.created) = $year
                                ")->row_array();
    }
    
    public function getPembelianHari()
    {
        $date = date('Y-m-d');
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.total_tagihan) as total_tagihan
                                FROM 
                                    penerimaan_pembelian a 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    a.created = '$date' 
                                ")->row_array();
    }
    
    public function getPembelianBulan()
    {
        $month = date('m');
        $year = date('Y');
        $id = $this->session->userdata('perusahaan_id');

        return $this->db->query("SELECT 
                                    SUM(a.total_tagihan) as total_tagihan
                                FROM 
                                    penerimaan_pembelian a 
                                WHERE 
                                    a.perusahaan_id = $id AND
                                    MONTH(a.created) = $month AND 
                                    YEAR(a.created) = $year
                                ")->row_array();
    }

}