<?php

class Laporan_model extends CI_model
{

    public function getQtyPOS($dari, $sampai, $id)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    SUM(b.quantity) as qty
                                FROM 
                                    penjualan a 
                                    JOIN penjualan_detail b ON b.penjualan_id = a.id 
                                    LEFT JOIN barang_jual c ON b.barang_jual_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' AND
                                    b.barang_jual_id = $id
                                GROUP BY 
                                    b.barang_jual_id
                                ")->row_array();
    }

    public function getQty($dari, $sampai, $id)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    SUM(b.quantity) as qty
                                FROM 
                                    pengiriman_penjualan a 
                                    JOIN pengiriman_penjualan_detail b ON b.pengiriman_penjualan_id = a.id 
                                    LEFT JOIN barang_jual c ON b.barang_jual_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' AND
                                    b.barang_jual_id = $id
                                GROUP BY 
                                    b.barang_jual_id
                                ")->row_array();
    }

    public function getPenjualanPOS($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    SUM(b.quantity) as qty, 
                                    c.nama, 
                                    c.harga_pokok, 
                                    c.harga_jual,
                                    c.satuan 
                                FROM 
                                    penjualan a 
                                    JOIN penjualan_detail b ON b.penjualan_id = a.id 
                                    LEFT JOIN barang_jual c ON b.barang_jual_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' 
                                GROUP BY 
                                    b.barang_jual_id
                                ")->result_array();
    }

    public function getPenjualanSales($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.sales_id, 
                                    b.nama, 
                                    SUM(c.quantity) as qty
                                FROM 
                                    penjualan a 
                                    LEFT JOIN karyawan b ON a.sales_id = b.id
                                    JOIN penjualan_detail c ON a.id = c.penjualan_id
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created BETWEEN '$dari' AND '$sampai' AND
                                    a.is_valid = 1 
                                GROUP BY 
                                    a.sales_id
                                ")->result_array();
    }

    public function getPenjualanSalesDetail($sales_id, $dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    SUM(b.quantity) as qty, 
                                    c.nama, 
                                    c.harga_pokok, 
                                    c.harga_jual,
                                    c.satuan 
                                FROM 
                                    penjualan a 
                                    JOIN penjualan_detail b ON b.penjualan_id = a.id 
                                    LEFT JOIN barang_jual c ON b.barang_jual_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created BETWEEN '$dari' AND '$sampai' AND
                                    a.sales_id = $sales_id AND
                                    a.is_valid = 1
                                GROUP BY 
                                    b.barang_jual_id
                                ")->result_array();
    }

    public function getPembelian($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    SUM(b.quantity) as qty, 
                                    b.harga as harga_beli, 
                                    c.nama, 
                                    c.satuan, 
                                    d.nama as mentah, 
                                    d.satuan as satuan_mentah 
                                FROM 
                                    penerimaan_pembelian a 
                                    JOIN penerimaan_pembelian_detail b ON b.penerimaan_pembelian_id = a.id 
                                    LEFT JOIN barang_jual c ON b.barang_jual_id = c.id 
                                    AND b.type = 1 
                                    LEFT JOIN barang_mentah d ON b.barang_jual_id = d.id 
                                    AND b.type = 0 
                                WHERE
                                    a.perusahaan_id = $perusahaan_id AND 
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' 
                                GROUP BY 
                                    b.barang_jual_id, b.harga")->result_array();
    }

    public function getPiutang($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    SUM(a.piutang) as piutang, 
                                    b.nama, 
                                    b.contact 
                                FROM 
                                    piutang a 
                                    JOIN pelanggan b ON a.pelanggan_id = b.id 
                                    JOIN penjualan c ON c.id = a.penjualan_id 
                                    AND c.status = 0 
                                WHERE
                                    a.perusahaan_id = $perusahaan_id AND  
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' 
                                GROUP BY 
                                    a.pelanggan_id
                                ")->result_array();
    }

    public function getHutang($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    SUM(a.hutang) as hutang, 
                                    b.nama, 
                                    b.telp 
                                FROM 
                                    hutang a 
                                    JOIN vendor b ON a.vendor_id = b.id 
                                    JOIN pembelian c ON c.id = a.pembelian_id 
                                    AND c.status = 0 
                                WHERE
                                    a.perusahaan_id = $perusahaan_id AND  
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' 
                                GROUP BY 
                                    a.vendor_id
                                ")->result_array();
    }

}