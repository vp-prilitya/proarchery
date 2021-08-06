<?php
    function cekuri($url, $parameter)
    {
        return $url == $parameter ? 'active-1' : false; 
    }

    function cekuri2($url, $parameter)
    {
        return $url == $parameter ? 'active-1' : false; 
    }

    function cekMain($url, $parameter)
    {
        return $url == $parameter ? 'active-1' : ''; 
    }

    $url_tmp = '';
    $url = $this->uri->segment(1);
    $url2 = $this->uri->segment(2);

    $dashboard = cekuri($url, 'dashboard');

    $menuMaster = ['satuan', 'kategori', 'gudang', 'barang_mentah', 'barang_jual', 'pelanggan', 'vendor', 'perusahaan', 'divisi', 'karyawan', 'menu', 'user'];
    $master = cekMain($url2, 'master');
    if(in_array($url, $menuMaster)){
        $master = 'active-1';
    }

    $kasir = cekuri($url, 'penjualan');

    $menuPenjualan = ['penawaran_penjualan', 'pesanan_penjualan', 'pengiriman_penjualan', 'retur_penjualan', 'piutang'];
    $penjualan = cekMain($url2, 'penjualan');
    if($url == 'laporan'){
        $penjualan = '';
    }
    if(in_array($url, $menuPenjualan)){
        $penjualan = 'active-1';
    }

    $menuPembelian = ['penawaran_pembelian', 'pesanan_pembelian', 'penerimaan_pembelian', 'retur_pembelian', 'hutang'];
    $pembelian = cekMain($url2, 'pembelian');
    if($url == 'laporan'){
        $pembelian = '';
    }
    if(in_array($url, $menuPembelian)){
        $pembelian = 'active-1';
    }

    $menubarang = ['stock_opname'];
    $barang = cekMain($url2, 'barang');
    if(in_array($url, $menubarang)){
        $barang = 'active-1';
    }

    $menulaporan = ['laporan'];
    $laporan = cekMain($url2, 'laporan');
    if(in_array($url, $menulaporan)){
        $laporan = 'active-1';
    }

    $menustatement = ['akun', 'pengaturan', 'jurnal', 'saldo', 'beban', 'buku_besar', 'neraca', 'laba_rugi'];
    $statement = cekMain($url2, 'statement');
    if(in_array($url, $menustatement)){
        $statement = 'active-1';
    }

?>
<div id="app">
<aside class="main-sidebar fixed offcanvas shadow bg-primary text-white no-b">
    <section class="sidebar">
        <div class="w-100px mt-3 mb-3" style="margin-left:70px;">
            <img src="<?=base_url()?>assets/img/basic/logo.png" alt="">
        </div>
        <ul class="sidebar-menu hover-dark">
            <li class="header"><strong>MAIN NAVIGATION</strong></li>

            <li class="<?=$dashboard??''?>"><a href="<?=base_url('dashboard')?>"><img src="<?=base_url()?>assets/img/icon/dashboardw.png" class="img-icon">Dashboard</a></li>

            <li class="<?=$master??''?>"><a href="<?=base_url('main/master')?>"><img src="<?=base_url()?>assets/img/icon/masterw.png" class="img-icon">Master</a></li>

            <li class="<?=$kasir??''?>"><a href="<?=base_url('penjualan/create')?>"><img src="<?=base_url()?>assets/img/icon/kasirw.png" class="img-icon">Kasir</a></li>

            <li class=""><a href="<?=base_url('scan/create')?>"><img src="<?=base_url()?>assets/img/icon/kasirw.png" class="img-icon">Scan QR</a></li>

            <li class="<?=$penjualan??''?>"><a href="<?=base_url('main/penjualan')?>"><img src="<?=base_url()?>assets/img/icon/penjualanw.png" class="img-icon">Penjualan</a></li>

            <li class="<?=$pembelian??''?>"><a href="<?=base_url('main/pembelian')?>"><img src="<?=base_url()?>assets/img/icon/pembelianw.png" class="img-icon">Pembelian</a></li>

            <li class=""><a href="<?=base_url('main/konsinyiasi')?>"><img src="<?=base_url()?>assets/img/icon/pembelianw.png" class="img-icon">Konsinyiasi</a></li>

            <li class=""><a href="<?=base_url('main/jadwal')?>"><img src="<?=base_url()?>assets/img/icon/laporanw1.png" class="img-icon">Jadwal</a></li>

            <li class=""><a href="<?=base_url('main/bank')?>"><img src="<?=base_url()?>assets/img/icon/laporanw1.png" class="img-icon">Kas & Bank</a></li>

            <li class="<?=$barang??''?>"><a href="<?=base_url('main/barang')?>"><img src="<?=base_url()?>assets/img/icon/barang.png" class="img-icon">Persediaan Barang</a></li>

            <li class="<?=$laporan??''?>"><a href="<?=base_url('main/laporan')?>"><img src="<?=base_url()?>assets/img/icon/laporanw1.png" class="img-icon">Laporan</a></li>

            <li class="<?=$statement??''?>"><a href="<?=base_url('main/statement')?>"><img src="<?=base_url()?>assets/img/icon/akuntasiw.png" class="img-icon">Statement</a></li>

    </section>
</aside>
<!--Sidebar End-->
<div class="has-sidebar-left">
    <div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
            <div class="search-bar">
                <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50" type="text"
                       placeholder="start typing...">
            </div>
            <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="false"
               aria-label="Toggle navigation" class="paper-nav-toggle paper-nav-white active "><i></i></a>
        </div>
    </div>
</div>
<div class="sticky">
   <div class="navbar navbar-expand d-flex justify-content-between bd-navbar white shadow">
      <div class="relative">
            <div class="d-flex">
               <div>
                  <a href="#"  data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                        <i></i>
                  </a>
               </div>
               <div class="d-none d-md-block">
                  <h1 class="nav-title text-dark"><strong><?=str_replace('_', ' ', strtoupper($this->uri->segment(1)));?></strong></h1>
               </div>
            </div>
      </div>
            <!--Top Menu Start -->
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li class="dropdown custom-dropdown notifications-menu user user-menu ">
            <a href="#" class="nav-link" data-toggle="dropdown">
                <img src="<?=base_url()?>assets/img/dummy/u1.png" class="user-image" alt="User Image">
                <i class="icon-more_vert "></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-right r-15">
                <li class="header">User Profile</li>
                <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                        <li>
                            <a href="javascript:void(0)">
                                <img src="<?=base_url()?>assets/img/icon/nama.png" class="img-icon"><strong> <?=$this->session->userdata('nama')?></strong>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                            <img src="<?=base_url()?>assets/img/icon/email.png" class="img-icon"><?=$this->session->userdata('email')?>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                            <img src="<?=base_url()?>assets/img/icon/divisi.png" class="img-icon"><?=$this->session->userdata('divisi')?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="footer p-2 text-center bg-danger text-white" style="border-radius: 0px 0px 15px 15px;"><a href="<?=base_url('auth/logout')?>"><i class="icon icon-sign-out"></i>Log Out</a></li>
            </ul>
        </li>
    </ul>
</div>
        </div>
    </div>