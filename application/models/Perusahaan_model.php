<?php

class Perusahaan_model extends CI_model
{
    public function getPerusahaan()
    {
        return $this->db->get('perusahaan')->result_array();
    }

    public function save()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telp' => htmlspecialchars($this->input->post('telp')),
            'email' => htmlspecialchars($this->input->post('email')),
            'website' => htmlspecialchars($this->input->post('website')),
            'nama_pic' => htmlspecialchars($this->input->post('nama_pic')),
            'bagian_pic' => htmlspecialchars($this->input->post('bagian_pic')),
            'telp_pic' => htmlspecialchars($this->input->post('telp_pic')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->insert('perusahaan', $data);
        $perusahaan_id = $this->db->insert_id();
        $this->saveAkun($perusahaan_id,  $this->session->userdata('id'), date('Y-m-d'));
    }

    public function saveAkun($perusahaan_id, $user_created, $created)
    {
        $kelompok1 = [
            'Kas',
            'Bank',
            'Piutang Usaha',
            'Piutang Lain',
            'Piutang Giro',
            'Piutang Karyawan',
            'Piutang Lain',
            'Cadangan Kerugian Piutang',
            'Persediaan Barang',
            'Persediaan',
            'Persediaan Lain',
            'Persediaan Diterima Belum Ditagihkan',
            'Uang Muka Dibayar',
            'Uang Muka Pembelian',
            'Uang Muka Pembelian Harta Tetap',
            'Pajak Dibayar Dimuka',
            'Biaya Dibayar Dimuka',
            'Sewa Dibayar di Muka',
            'Asuransi Dibayar di Muka',
            'Biaya Dibayar di Muka Lain',
            'Biaya Belum Ditagihkan',
            'Investasi',
            'Investasi Saham',
            'Harta Tetap Berwujud',
            'Harta Tetap',
            'Tanah',
            'Gedung',
            'Mesin & Peralatan',
            'Kendaraan',
            'Harta Lainnya',
            'Akumulasi Penyusutan Harta Tetap',
            'Accumulated Depreciation Gedung',
            'Accumulated Depreciation Mesin & Peralatan',
            'Accumulated Depreciation Kendaraan',
            'Accumulated Depreciation Harta Lainnya',
            'Harta Tetap Tidak Berwujud',
            'Hak Merek',
            'Hak Cipta',
            'Good Will'
        ];

        $kelompok2 = ['Utang Usaha',
        'Utang Lain',
        'Persediaan Dikirim Belum Ditagihkan',
        'Utang Konsinyasi',
        'Utang Giro',
        'Utang Gaji & Upah',
        'Utang Komisi Penjualan',
        'Uang Muka Diterima',
        'Uang Muka Penjualan',
        'Pendapatan Belum Ditagihkan',
        'Utang Pajak',
        'Utang Jangka Panjang',
        'Utang Bank',
        'Utang Pembiayaan'];

        $kelompok3 = ['Modal',
        'Modal Disetor',
        'Saham Biasa',
        'Laba',
        'Laba ditahan',
        'Laba Tahun Berjalan',
        'Historical Balancing'];

        $kelompok4 = ['Pendapatan Usaha',
        'Penjualan Produk',
        'Penjualan Jasa',
        'Potongan Penjualan',
        'Pendapatan Lain',
        'Pendapatan General',
        'Beban General'];

        $kelompok5 = ['Beban atas Pendapatan',
        'Harga Pokok Penjualan',
        'Beban Pembelian',
        'Beban Pengiriman',
        'Potongan Pembelian',
        'Penyesuaian Persediaan'];

        $kelompok6 = ['Beban Pemasaran Dan Penjualan',
        'Beban Iklan & Promosi',
        'Beban Komisi Penjualan',
        'Beban Piutang Tak Tertagih',
        'Beban Administrasi Dan Umum',
        'Beban Gaji & Upah',
        'Beban Staff Ahli & Perizinan',
        'Beban Sewa Kantor',
        'Beban Listrik',
        'Beban Air',
        'Beban Telepon',
        'Beban Internet',
        'Beban Perlengkapan',
        'Beban Operasional Lain',
        'Beban Lain'];

        $kelompok8 = ['Pendapatan Luar Usaha',
        'Laba (Rugi) Selisih Kurs - Unrealize',
        'Laba (Rugi) Selisih Kurs - Realize',
        'Laba (Rugi) Penjualan Harta Tetap'];

        $kelompok9 = ['Beban Luar Usaha',
        'Beban Bunga Bank',
        'Beban Jasa Bank',
        'Beban Pajak',
        'Beban Pajak Penghasilan'];

        $allData = ['1' => $kelompok1, '2' => $kelompok2, '3' => $kelompok3, '4' => $kelompok4, '5' => $kelompok5, '6' => $kelompok6, '8' => $kelompok8, '9' => $kelompok9];
        $kode = ['1' => 100, '2' => 200, '3' => 300, '4' => 400, '5' => 500, '6' => 600, '8' => 800, '9' => 900];

        $insert = [];
        foreach ($allData as $key => $value) {
            for ($i=0; $i < count($value); $i++) { 
                $data = [
                    'kode' => intval($kode[$key]) + $i,
                    'nama' => $value[$i],
                    'tipe' => 'Lancar',
                    'kelompok_id' => $key,
                    'saldo' => 0,
                    'created' => $created,
                    'user_created' => $user_created,
                    'perusahaan_id' => $perusahaan_id,
                ];
                array_push($insert, $data);
            }
        }
        $this->db->insert_batch('akun', $insert);
    }

    public function getPerusahaanById($id)
    {
        return $this->db->get_where('perusahaan', ['id'=>$id])->row_array();
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telp' => htmlspecialchars($this->input->post('telp')),
            'email' => htmlspecialchars($this->input->post('email')),
            'website' => htmlspecialchars($this->input->post('website')),
            'nama_pic' => htmlspecialchars($this->input->post('nama_pic')),
            'bagian_pic' => htmlspecialchars($this->input->post('bagian_pic')),
            'telp_pic' => htmlspecialchars($this->input->post('telp_pic')),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('perusahaan', $data, ['id'=>$this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('perusahaan',['id'=>$id]);
        $this->db->delete('akun',['perusahaan_id'=>$id]);
    }
}