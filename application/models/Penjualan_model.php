<?php

class Penjualan_model extends CI_model
{
    public function getPenjualan($dari, $sampai)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.id, 
                                    a.no_faktur, 
                                    a.total_tagihan, 
                                    a.total_bayar, 
                                    a.status,
                                    a.created, 
                                    COUNT(b.penjualan_id) as item, 
                                    c.nama, 
                                    c.contact 
                                FROM 
                                    penjualan a 
                                    JOIN penjualan_detail b ON a.id = b.penjualan_id 
                                    AND a.no_faktur = b.no_faktur 
                                    JOIN pelanggan c ON a.pelanggan_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.created BETWEEN '$dari' 
                                    AND '$sampai' 
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function getPenjualanByNoFaktur($no_faktur)
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT 
                                    a.id, 
                                    a.no_faktur, 
                                    a.total_tagihan, 
                                    a.total_bayar, 
                                    a.status,
                                    a.created, 
                                    COUNT(b.penjualan_id) as item, 
                                    c.nama, 
                                    c.contact 
                                FROM 
                                    penjualan a 
                                    JOIN penjualan_detail b ON a.id = b.penjualan_id 
                                    AND a.no_faktur = b.no_faktur 
                                    JOIN pelanggan c ON a.pelanggan_id = c.id 
                                WHERE 
                                    a.perusahaan_id = $perusahaan_id AND
                                    a.no_faktur = '$no_faktur'
                                GROUP BY 
                                    a.id, 
                                    a.no_faktur
                                ")->result_array();
    }

    public function getBarangPopulerToko()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, SUM(b.quantity) as jml FROM barang_jual a LEFT JOIN penjualan_detail b ON a.id = b.barang_jual_id WHERE a.jenis_barang = 'toko' AND a.perusahaan_id = '$perusahaan_id' GROUP BY a.id ORDER BY jml DESC LIMIT 20")->result_array();
    }

    public function getBarangPopulerJasa()
    {
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        return $this->db->query("SELECT a.*, SUM(b.quantity) as jml FROM barang_jual a LEFT JOIN penjualan_detail b ON a.id = b.barang_jual_id WHERE a.jenis_barang = 'jasa' AND a.perusahaan_id = '$perusahaan_id' GROUP BY a.id ORDER BY jml DESC LIMIT 20")->result_array();
    }

    public function getBarang()
    {
        $cari = $this->input->post('cari');
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $jenis_barang = $this->input->post('jenis_barang');
        return $this->db->query("SELECT * FROM barang_jual WHERE nama LIKE '%$cari%' AND jenis_barang = '$jenis_barang' AND perusahaan_id = '$perusahaan_id'")->result_array();
    }

    public function getBarangDetail()
    {
        $id = $this->input->post('id');
        return $this->db->query("SELECT 
                                    a.quantity,
                                    a.barang_id,
                                    c.nama as paket,
                                    c.satuan as p_satuan,
                                    c.need_raw
                                FROM 
                                    barang_jual_detail a 
                                    JOIN barang_jual b ON a.barang_jual_id = b.id 
                                    JOIN barang_jual c ON a.barang_id = c.id 
                                WHERE 
                                    a.barang_jual_id = $id")->result_array();
    }

    public function getCust()
    {
        $cari = $this->input->post('cari');
        return $this->db->query("SELECT * FROM pelanggan WHERE nama LIKE '%$cari%'")->result_array();
    }

    public function cekBarang()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        
        $cek = $this->db->get_where('barang_jual', ['id' => $id])->row_array();

        if($cek['need_raw'] == 0 AND $cek['is_paket'] == 0){
            if($cek['stok'] < $qty) { return true;}
        }

        if($cek['need_raw'] == 0 AND $cek['is_paket'] == 1){
            $item = $this->getItem($cek['id'], $qty);
                                            
            foreach ($item as $key => $it) {
                if($it['need_raw'] == 0 AND $it['is_paket'] == 0){
                    if($it['quantity'] > $it['barang_jual_stok']) { return true; break;}
                }

                if($it['need_raw'] == 1 AND $it['is_paket'] == 0){
                    $item_mentah = $this->getItem($it['barang_id'], $qty);

                    foreach ($item_mentah as $key => $it2) {
                        if(is_null($it2['need_raw']) AND is_null($it2['is_paket'])){
                            if($it2['quantity'] > $it2['barang_mentah_stok']) { return true; break;}
                        }
                    }
                }
            }
        }

        if($cek['need_raw'] == 1 AND $cek['is_paket'] == 0){
            $item = $this->getItem($cek['id'], $qty);
                                            
            foreach ($item as $key => $it) {
                if(is_null($it['need_raw']) AND is_null($it['is_paket'])){
                    if($it['quantity'] > $it['barang_mentah_stok']) { return true; break;}
                }
            }
        }

        return false;
    }

    public function getItem($id, $qty)
    {
        return $this->db->query("SELECT (a.quantity * $qty) AS quantity,
                                        a.barang_id,
                                        b.nama,
                                        b.is_paket,
                                        b.need_raw,
                                        b.stok as barang_jual_stok,
                                        c.nama,
                                        c.stok as barang_mentah_stok
                                    FROM barang_jual_detail a
                                        LEFT JOIN barang_jual b ON a.barang_id = b.id AND a.type = 1
                                        LEFT JOIN barang_mentah c ON a.barang_id = c.id AND a.type = 0
                                    WHERE 
                                        a.barang_jual_id = $id")->result_array();
    }

    public function save()
    {
        $total_gross = str_replace('.', '', htmlspecialchars($this->input->post('total_gross')));
        $subtotal = str_replace('.', '', htmlspecialchars($this->input->post('total_tagihan')));
        $ppn = str_replace(',','.', str_replace('.','',htmlspecialchars($this->input->post('ppn'))));
        $total_tagihan = str_replace('.', '', htmlspecialchars($this->input->post('total_tagihan2')));
        $total_bayar = str_replace('.', '', htmlspecialchars($this->input->post('total_bayar')));
        $jenis_pembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));
        $pelanggan_id = htmlspecialchars($this->input->post('pelanggan_id'));
        $diskon_idr = htmlspecialchars($this->input->post('diskon_idr'))!=''?htmlspecialchars($this->input->post('diskon_idr')):0;
        $perusahaan_id = $this->session->userdata('perusahaan_id');
        $created = date('Y-m-d');
        $user_created = $this->session->userdata('id');
        $nodaktur = nofaktur();

        $data = [
            'no_faktur' => $nodaktur,
            'pelanggan_id' => $pelanggan_id,
            'total_gross' => $total_gross,
            'diskon' => htmlspecialchars($this->input->post('diskon'))!=''?htmlspecialchars($this->input->post('diskon')):0,
            'diskon_idr' => $diskon_idr,
            'subtotal' => $subtotal,
            'ppn' => $ppn,
            'total_tagihan' => $total_tagihan,
            'total_bayar' => $total_bayar,
            'biaya_lain' => 0,
            'status' => $total_bayar >= $total_tagihan ? 1 : 0,
            'is_valid' => 0,
            'is_bank' => $jenis_pembayaran == 'cash' ? 0 : 1,
            'sales_id' => htmlspecialchars($this->input->post('sales_id')),
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('penjualan', $data);
        $penjualan_id = $this->db->insert_id();

        $barang_id = $this->input->post('id')??[];
        $quantity = $this->input->post('quantity');
        $diskon = $this->input->post('disc');
        $insert = [];
        
        for ($i=0; $i < count($barang_id); $i++) { 
            $barang_jual_id = htmlspecialchars($barang_id[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $disc = htmlspecialchars($diskon[$i]);

            $dataInsert = [
                'penjualan_id' => $penjualan_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $barang_jual_id,
                'quantity' => $qty,
                'diskon' => $disc,
            ];

            array_push($insert, $dataInsert);
            $update = "UPDATE barang_jual SET stok = stok - $qty WHERE id = $barang_jual_id AND is_paket = 0 AND need_raw = 0 AND jenis_barang = 'toko'";
            $this->db->query($update);
        }

        // JIKA PAKETAN (UPDATE STOK)
        // $brg_id = $this->input->post('barangJualId');
        // $quantityBarangJualId = $this->input->post('quantityBarangJualId');
        // for ($i=0; $i < count($brg_id); $i++) { 
        //     $qty = htmlspecialchars($quantityBarangJualId[$i]);
        //     $id = htmlspecialchars($brg_id[$i]);

        //     $update = "UPDATE barang_jual SET stok = stok - $qty WHERE id = $id AND is_paket = 0";
        //     $this->db->query($update);
        // }

        $paket = $this->input->post('idPaket')??[];
        for ($i=0; $i < count($paket); $i++) {
            $idPaket = htmlspecialchars($paket[$i]);

            $brg_id = $this->input->post("barangJualId$idPaket");
            $quantityBarangJualId = $this->input->post("quantityBarangJualId$idPaket");
            $qtyPaket = $this->input->post("quantityPaket$idPaket");

            for ($i=0; $i < count($brg_id); $i++) { 
                $qty = htmlspecialchars($quantityBarangJualId[$i]);
                $id = htmlspecialchars($brg_id[$i]);

                // JIKA DALAM PAKET ADA BARANG MENTAH
                if(htmlspecialchars($this->input->post("need_raw$id")) == 1){
                    $this->updateBarangMentah($id, $qtyPaket);
                } 
                // AKHIR
                else {
                    $update = "UPDATE barang_jual SET stok = stok - ($qty * $qtyPaket) WHERE id = $id AND is_paket = 0 AND need_raw=0 AND jenis_barang = 'toko'";;
                    $this->db->query($update);
                }
            }
        }
        // AKHIR

        // JIKA BARANG MENTAH (UPDATE STOK)
        $barang_mentah = $this->input->post('idRaw')??[];
        $quantity = $this->input->post('quantityRaw');
        $diskon = $this->input->post('discRaw');
        for ($i=0; $i < count($barang_mentah); $i++) { 
            $id = htmlspecialchars($barang_mentah[$i]);
            $qty = htmlspecialchars($quantity[$i]);
            $disc = htmlspecialchars($diskon[$i]);

            $this->updateBarangMentah($id, $qty);

            // PENJUALAN DETAIL BARANG MENTAH
            $dataInsert = [
                'penjualan_id' => $penjualan_id,
                'no_faktur' => $nodaktur,
                'barang_jual_id' => $id,
                'quantity' => $qty,
                'diskon' => $disc
            ];
            array_push($insert, $dataInsert);
        }
        // AKHIR

        // JIKA PIUTANG
        // if($total_bayar < $total_tagihan){
        //     $this->piutang($penjualan_id, htmlspecialchars($this->input->post('pelanggan_id')), $total_tagihan, $total_bayar, $created, $user_created, $perusahaan_id);
        // }
        // AKHIR

        // INSERT TRANSAKSI
        // $this->transaksi($penjualan_id, $total_tagihan, $total_bayar, $created, $user_created, $perusahaan_id);
        // AKHIR

        // INSERT TRANSAKSI BANK
        if($jenis_pembayaran != 'cash'){
            $bank_id = htmlspecialchars($this->input->post('bank_id'));
            $this->transaksiBank($bank_id, $total_bayar, $jenis_pembayaran, $penjualan_id, $created, $user_created, $perusahaan_id);
        }
        // AKHIR

        count($insert)>0? $this->db->insert_batch('penjualan_detail', $insert) : null;

        foreach($insert as $dt){
            $this->db->select('*');
            $this->db->where('id', $dt['barang_jual_id']);
            $query = $this->db->get('barang_jual')->row();
            if($query->jenis_barang == 'jasa'){
                for($i=0; $i<$dt['quantity']; $i++){
                    $json = [
                        'qr_code' => $nodaktur,
                        'uniq_code'=> $i,
                        'id_barang'=> $dt['barang_jual_id']
                    ];
                    qr_code2($json);
                }
            }
        }

        // JIKA MEMBER
        if($pelanggan_id != 0){
            $this->kirimInvoice($penjualan_id, 'member');
        } else {
            $this->kirimInvoice($penjualan_id, 'non_member');
        }
        // AKHIR

        // QRCODE
        if(htmlspecialchars($this->input->post('is_jasa'))=='jasa'){
            $json = [
                'qr_code' => $nodaktur,
            ];
            qr_code($json);
        }
        // AKHIR

        return $penjualan_id;
    }

    public function updateBarangMentah($id, $qty)
    {
        $item = $this->db->query("SELECT 
                                        a.quantity,
                                        a.barang_id
                                    FROM 
                                        barang_jual_detail a 
                                        JOIN barang_jual b ON a.barang_jual_id = b.id 
                                        JOIN barang_mentah c ON a.barang_id = c.id 
                                    WHERE 
                                        a.barang_jual_id = $id")->result_array();
        
        foreach ($item as $key => $db) {
            $update = "UPDATE barang_mentah SET stok = stok - ($db[quantity] * $qty) WHERE id = $db[barang_id]";
            $this->db->query($update);
        }
    }

    public function piutang($penjualan_id, $pelanggan_id, $total_tagihan, $total_bayar, $created, $user_created, $perusahaan_id)
    {
        $data = [
            'penjualan_id' => $penjualan_id,
            'pelanggan_id' => $pelanggan_id,
            'piutang' => $total_tagihan - $total_bayar,
            'perusahaan_id' => $perusahaan_id,
            'created' => $created,
            'user_created' => $user_created,
        ];

        $this->db->insert('piutang', $data);
    }

    public function transaksi($penjualan_id, $total_tagihan, $total_bayar, $created, $user_created, $perusahaan_id)
    {
        if($total_bayar >= $total_tagihan){
            $rule = $this->db->get_where('pengaturan', ['variable'=>'penjualan', 'jenis'=>'tunai', 'perusahaan_id'=>$perusahaan_id])->result_array();
        } else {
            $rule = $this->db->get_where('pengaturan', ['variable'=>'penjualan', 'jenis'=>'kredit', 'perusahaan_id'=>$perusahaan_id])->result_array();
        }

        $insert = [];
        foreach ($rule as $key => $db) {
            $data = [
                'akun_id' => $db['akun_id'],
                'debit' => $db['is_debit'] == 1 ? $total_bayar : 0,
                'kredit' => $db['is_debit'] == 0 ? $total_bayar : 0,
                'rincian' => 'Transaksi dilakukan dari POS penjualan',
                'url' => 'penjualan',
                'foreign_id' => $penjualan_id,
                'created' => $created,
                'user_created' => $user_created,
                'perusahaan_id' => $perusahaan_id
            ];

            array_push($insert, $data);
        }

        $this->db->insert_batch('transaksi', $insert);
    }

    public function transaksiBank($bank_id, $total_bayar, $jenis_pembayaran, $penjualan_id, $created, $user_created, $perusahaan_id)
    {
        $data = [
            'bank_id' => $bank_id,
            'jumlah' => $total_bayar,
            'jenis' => $jenis_pembayaran,
            'rincian' => 'Transaksi dilakukan dari POS penjualan / Kasir',
            'url' => 'penjualan',
            'foreign_id' => $penjualan_id,
            'created' => $created,
            'user_created' => $user_created,
            'perusahaan_id' => $perusahaan_id
        ];

        $this->db->insert('transaksi_bank', $data);
    }

    public function kirimInvoice($id, $jenis)
    {
        $item = $this->getPenjualanById($id);

        if($jenis == 'member'){
            $data = [
                'email' => $item[0]['email'],
                'subjek' => 'Invoice Transaksi',
                'nama' => $item[0]['pelanggan'],
                'link' => base_url("cetak/penjualan/") . $item[0]['id'],
                'template' => 'penjualan/email',
            ];
        } else {
            $data = [
                'email' => 'robyngwie@gmail.com',
                'subjek' => 'Invoice Transaksi',
                'nama' => 'NON MEMBER',
                'link' => base_url("cetak/penjualan/") . $item[0]['id'],
                'template' => 'penjualan/email',
            ];
        }
        send_mail($data);
    }

    public function getPenjualanById($id)
    {
        
        return $this->db->query("SELECT 
                                    a.*, 
                                    b.barang_jual_id, 
                                    b.quantity,
                                    b.diskon as disc, 
                                    c.nama as pelanggan, 
                                    c.alamat, 
                                    c.contact, 
                                    c.email, 
                                    d.nama as item, d.harga_jual, d.satuan, d.id, d.jenis_barang,
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
                                    LEFT JOIN barang_jual_detail e ON e.barang_jual_id = b.barang_jual_id 
                                    LEFT JOIN barang_jual g ON g.id = e.barang_id AND d.is_paket = 1
                                    JOIN perusahaan f ON a.perusahaan_id = f.id 
                                WHERE 
                                    a.id = $id 
                                GROUP BY 
                                    b.barang_jual_id
                                ")->result_array();
    }

    public function delete($id)
    {
        $penjualan = $this->db->query("SELECT a.*, b.*, c.is_paket, c.need_raw FROM penjualan a JOIN penjualan_detail b ON a.id = b.penjualan_id AND a.no_faktur = b.no_faktur JOIN barang_jual c ON b.barang_jual_id = c.id WHERE a.id = $id")->result_array();

        foreach ($penjualan as $key => $db) {

            // JIKA BUKAN PAKET
            if($db['need_raw'] == 0 AND $db['is_paket'] == 0){
                $update = "UPDATE barang_jual SET stok = stok + ($db[quantity] * $db[quantity]) WHERE id = $db[barang_jual_id] AND is_paket = 0";
                $this->db->query($update);
            }
            // AKHIR

            // JIKA PAKET
            if($db['need_raw'] == 0 AND $db['is_paket'] == 1){
                $item = $this->db->query("SELECT a.*, b.*, c.nama, c.need_raw as is_raw FROM barang_jual a JOIN barang_jual_detail b ON a.id = b.barang_jual_id LEFT JOIN barang_jual c on b.barang_id = c.id WHERE a.id = $db[barang_jual_id]")->result_array();

                foreach ($item as $key => $dt) {

                    if($dt['is_raw'] == 1){
                        $this->updateBarangMentahPlus($dt['barang_id'], $db['quantity']);
                    } else {
                        $update = "UPDATE barang_jual SET stok = stok + ($dt[quantity] * $db[quantity]) WHERE id = $dt[barang_id] AND is_paket = 0";
                        $this->db->query($update);
                    }
                }
            }
            // AKHIR

            // JIKA BARANG MENTAH
            if($db['need_raw'] == 1 AND $db['is_paket'] == 0){
                $item = $this->db->query("SELECT a.*, b.* FROM barang_jual a JOIN barang_jual_detail b ON a.id = b.barang_jual_id WHERE a.id = $db[barang_jual_id]")->result_array();

                foreach ($item as $key => $dt2) {
                    $update = "UPDATE barang_mentah SET stok = stok + ($dt2[quantity] * $db[quantity]) WHERE id = $dt2[barang_id]";
                    $this->db->query($update);
                }
            }
            // AKHIR
        }

        $this->db->delete('penjualan',['id'=>$id]);
        $this->db->delete('penjualan_detail',['penjualan_id'=>$id]);

        // HAPUS PIUTANG
        $this->deletePiutang($id);
        // AKHIR

        // HAPUS TRANSAKSI
        $this->deleteTransaksi($id);
        // AKHIR
    }

    public function deletePiutang($id)
    {
        $data = $this->db->get_where('piutang', ['penjualan_id' => $id])->row_array();
        $this->db->delete('pembayaran_piutang', ['piutang_id'=>$data['id']]);
        $this->db->delete('piutang',['penjualan_id'=>$id]);
    }

    public function deleteTransaksi($penjualan_id)
    {
        $this->db->delete('transaksi',['foreign_id'=>$penjualan_id, 'url'=>'penjualan']);
    }

    public function updateBarangMentahPlus($id, $qty)
    {
        $item = $this->db->query("SELECT 
                                        a.quantity,
                                        a.barang_id
                                    FROM 
                                        barang_jual_detail a 
                                        JOIN barang_jual b ON a.barang_jual_id = b.id 
                                        JOIN barang_mentah c ON a.barang_id = c.id 
                                    WHERE 
                                        a.barang_jual_id = $id")->result_array();
        
        foreach ($item as $key => $db) {
            $update = "UPDATE barang_mentah SET stok = stok + ($db[quantity] * $qty) WHERE id = $db[barang_id]";
            $this->db->query($update);
        }
    }

    public function update()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'perusahaan_id' => $this->session->userdata('perusahaan_id'),
            'created' => date('Y-m-d'),
            'user_created' => $this->session->userdata('id'),
        ];

        $this->db->update('penjualan', $data, ['id'=>$this->input->post('id')]);
    }

}