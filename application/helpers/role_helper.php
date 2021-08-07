<?php

function is_login()
{
   $ci = get_instance();
   if($ci->session->userdata('id')){
      $url = $ci->uri->segment(1);

      // if($url == 'laporan'){
            $url = $url . "/" . $ci->uri->segment(2)??'';
      // }

      $menu = $ci->session->userdata('menu');

      if(!in_array($url, $menu)){
            $ci->session->set_flashdata('gagal', 'Akses Ditolak');
            redirect($_SERVER['HTTP_REFERER']);
      }
   } else {
      $ci->session->set_flashdata('info', 'Session Anda Telah Berakhir. SIlahkan Login Kembali');
      redirect('auth');
   }
}

function _kode($num)
{
   $kode = '';
   $num = intval($num) + 1;
   if($num >= 1 AND $num <= 9){
      $kode = '00000' . $num;
   }

   if($num >= 10 AND $num <= 99){
      $kode = '0000' . $num;
   }

   if($num >= 100 AND $num <= 999){
      $kode = '000' . $num;
   }

   if($num >= 1000 AND $num <= 9999){
      $kode = '00' . $num;
   }

   if($num >= 10000 AND $num <= 99999){
      $kode = '0' . $num;
   }

   if($num >= 100000){
      $kode = $num;
   }

   return $kode;
}

function kodeMentah()
{
   $ci = get_instance();
   $jml = $ci->db->query("SELECT RIGHT(kode_barang,6) as kode_barang FROM barang_mentah ORDER BY id DESC")->row_array();
   return $jml?'BRM'._kode($jml['kode_barang']):'BRM000001';
}

function kodeJual()
{
   $ci = get_instance();
   $jml = $ci->db->query("SELECT RIGHT(kode_barang,6) as kode_barang FROM barang_jual ORDER BY id DESC")->row_array();
   return $jml?['BRJ'._kode($jml['kode_barang']), _kode($jml['kode_barang'])]:['BRJ000001', 1];
}

function penawaran()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM penawaran_penjualan WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'SQ'. date('Ymd') ._kode($jml['no_faktur']) : 'SQ'. date('Ymd') .'000001';
}

function pesanan()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM pesanan_penjualan WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'SO'. date('Ymd') ._kode($jml['no_faktur']) : 'SO'. date('Ymd') .'000001';
}

function pengiriman()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM pengiriman_penjualan WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'SJ'. date('Ymd') ._kode($jml['no_faktur']) : 'SJ'. date('Ymd') .'000001';
}

function returPenjualan()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM pengiriman_penjualan WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'SRT'. date('Ymd') ._kode($jml['no_faktur']) : 'SRT'. date('Ymd') .'000001';
}

function notransaksiPiutang()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_transaksi,6) as no_faktur FROM pembayaran_piutang WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'CR'. date('Ymd') ._kode($jml['no_faktur']) : 'CR'. date('Ymd') .'000001';
}

function penawaranPembelian()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM penawaran_pembelian WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'RQ'. date('Ymd') ._kode($jml['no_faktur']) : 'RQ'. date('Ymd') .'000001';
}

function pesananPembelian()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM pesanan_pembelian WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'PO'. date('Ymd') ._kode($jml['no_faktur']) : 'PO'. date('Ymd') .'000001';
}

function penerimaanPembelian()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM penerimaan_pembelian WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'PJ'. date('Ymd') ._kode($jml['no_faktur']) : 'PJ'. date('Ymd') .'000001';
}

function returPembelian()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM retur_pembelian WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'PRT'. date('Ymd') ._kode($jml['no_faktur']) : 'PRT'. date('Ymd') .'000001';
}

function notransaksiHutang()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_transaksi,6) as no_faktur FROM pembayaran_hutang WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'CD'. date('Ymd') ._kode($jml['no_faktur']) : 'CD'. date('Ymd') .'000001';
}

function pesananKonsinyiasi()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM pesanan_konsinyiasi WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'PK'. date('Ymd') ._kode($jml['no_faktur']) : 'PK'. date('Ymd') .'000001';
}

function notransaksiKonsinyiasi()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_transaksi,6) as no_faktur FROM pembayaran_konsinyiasi WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'CK'. date('Ymd') ._kode($jml['no_faktur']) : 'CK'. date('Ymd') .'000001';
}

function pesananKuota()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM kuota WHERE tgl_bayar = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'OK'. date('Ymd') ._kode($jml['no_faktur']) : 'OK'. date('Ymd') .'000001';
}

function noBooking()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_booking,6) as no_faktur FROM booking WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'BK'. date('Ymd') ._kode($jml['no_faktur']) : 'BK'. date('Ymd') .'000001';
}

function noUMS()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_transaksi,6) as no_faktur FROM uang_muka_penjualan WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'UMS'. date('Ymd') ._kode($jml['no_faktur']) : 'UMS'. date('Ymd') .'000001';
}

function noUMP()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_transaksi,6) as no_faktur FROM uang_muka_pembelian WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'UMP'. date('Ymd') ._kode($jml['no_faktur']) : 'UMP'. date('Ymd') .'000001';
}

function pengeluaran()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_transaksi,6) as no_faktur FROM transaksi_kas WHERE created = '$tgl' AND url = 'pengeluaran' ORDER BY id DESC")->row_array();
   return $jml?'CD'. date('Ymd') ._kode($jml['no_faktur']) : 'CD'. date('Ymd') .'000001';
}

function penerimaan()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_transaksi,6) as no_faktur FROM transaksi_kas WHERE created = '$tgl' AND url = 'penerimaan' ORDER BY id DESC")->row_array();
   return $jml?'CR'. date('Ymd') ._kode($jml['no_faktur']) : 'CR'. date('Ymd') .'000001';
}

function transfer()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_transaksi,6) as no_faktur FROM transaksi_kas WHERE created = '$tgl' AND url = 'transfer' ORDER BY id DESC")->row_array();
   return $jml?'FT'. date('Ymd') ._kode($jml['no_faktur']) : 'FT'. date('Ymd') .'000001';
}

function nofaktur()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM penjualan WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'FTR'. date('Ymd') ._kode($jml['no_faktur']) : 'FTR'. date('Ymd') .'000001';
}

function nofakturPembelian()
{
   $ci = get_instance();
   $tgl = date('Y-m-d');
   $jml = $ci->db->query("SELECT RIGHT(no_faktur,6) as no_faktur FROM pembelian WHERE created = '$tgl' ORDER BY id DESC")->row_array();
   return $jml?'FTR'. date('Ymd') ._kode($jml['no_faktur']) : 'FTR'. date('Ymd') .'000001';
}

function qr_code($json)
{  
   $ci = get_instance();
   $ci->load->library('ciqrcode'); //pemanggilan library QR CODE
 
   $config['cacheable']    = true; //boolean, the default is true
   $config['cachedir']     = './assets/'; //string, the default is application/cache/
   $config['errorlog']     = './assets/'; //string, the default is application/logs/
   $config['imagedir']     = './assets/qr_code/'; //direktori penyimpanan qr code
   $config['quality']      = true; //boolean, the default is true
   $config['size']         = '1024'; //interger, the default is 1024
   $config['black']        = array(224,255,255); // array, default is array(255,255,255)
   $config['white']        = array(70,130,180); // array, default is array(0,0,0)
   $ci->ciqrcode->initialize($config);

   $image_name=$json['qr_code'].'.png'; //buat name dari qr code sesuai dengan nim

   $params['data'] = json_encode($json); //data yang akan di jadikan QR CODE
   $params['level'] = 'H'; //H=High
   $params['size'] = 10;
   $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
   $ci->ciqrcode->generate($params); // fungsi untuk generate QR CODE
}

function qr_code2($json)
{  
   $ci = get_instance();
   $ci->load->library('ciqrcode'); //pemanggilan library QR CODE
 
   $config['cacheable']    = true; //boolean, the default is true
   $config['cachedir']     = './assets/'; //string, the default is application/cache/
   $config['errorlog']     = './assets/'; //string, the default is application/logs/
   $config['imagedir']     = './assets/qr_code/'; //direktori penyimpanan qr code
   $config['quality']      = true; //boolean, the default is true
   $config['size']         = '1024'; //interger, the default is 1024
   $config['black']        = array(224,255,255); // array, default is array(255,255,255)
   $config['white']        = array(70,130,180); // array, default is array(0,0,0)
   $ci->ciqrcode->initialize($config);

   $image_name=$json['qr_code'].'-'.$json['id_barang'].'-'.$json['uniq_code'].'.png'; //buat name dari qr code sesuai dengan nim

   $params['data'] = json_encode($json); //data yang akan di jadikan QR CODE
   $params['level'] = 'H'; //H=High
   $params['size'] = 10;
   $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
   $ci->ciqrcode->generate($params); // fungsi untuk generate QR CODE
}

function send_mail($data)
{
   $ci = get_instance();

   $config = [
         'protocol' => 'smtp',
         'smtp_host' => 'ssl://mail.mywayout.my.id',
         'smtp_user' => 'ggalmair@mywayout.my.id',
         'smtp_pass' => 'G1i2a3n4',
         'smtp_port' => 465,
         'mailtype' => 'html',
         'charset' => 'utf-8',
         'newline' => "\r\n"
   ];

   $ci->email->initialize($config);
   $ci->load->library('email', $config);

   $ci->email->from('ggalmair@mywayout.my.id', 'Pro-Archery');
   $ci->email->to($data['email']);
   $subject = $data['subjek'];
   $ci->email->subject($subject);

   $body = $ci->load->view($data['template'],$data,TRUE);
   $ci->email->message($body);
   $ci->email->send();
}

?>