<?php
    function cekuri($url, $parameter)
    {
        return $url == $parameter ? 'active-1' : false; 
    }

    function cekuri2($url, $parameter)
    {
        return $url == $parameter ? 'active-1' : false; 
    }

    $url = $this->uri->segment(1);
    $url2 = $this->uri->segment(2);

    $dashboard = cekuri($url, 'dashboard');
    $satuan = cekuri($url, 'satuan');
    $kategori = cekuri($url, 'kategori');
    $barang_mentah = cekuri($url, 'barang_mentah');
    $barang_jual = cekuri($url, 'barang_jual');
    $pelanggan = cekuri($url, 'pelanggan');
    $vendor = cekuri($url, 'vendor');
    $penjualan = cekuri($url, 'penjualan');
    $pembelian = cekuri($url, 'pembelian');
    $piutang = cekuri($url, 'piutang');
    $hutang = cekuri($url, 'hutang');
    $lap_penjualan = cekuri2($url2, 'penjualan');
    $lap_pembelian = cekuri2($url2, 'pembelian');
    $lap_piutang = cekuri2($url2, 'piutang');
    $lap_hutang = cekuri2($url2, 'hutang');
    $lap_stok = cekuri2($url2, 'stok');
    $akun = cekuri($url, 'akun');
    $pengaturan = cekuri($url, 'pengaturan');
    $jurnal = cekuri($url, 'jurnal');
    $saldo = cekuri($url, 'saldo');
    $beban = cekuri($url, 'beban');
    $buku_besar = cekuri($url, 'buku_besar');
    $neraca = cekuri($url, 'neraca');
    $laba_rugi = cekuri($url, 'laba_rugi');
    $perusahaan = cekuri($url, 'perusahaan');
    $divisi = cekuri($url, 'divisi');
    $karyawan = cekuri($url, 'karyawan');
    $menu = cekuri($url, 'menu');
    $user = cekuri($url, 'user');
?>
<div id="app">
<aside class="main-sidebar fixed offcanvas  shadow ">
    <section class="sidebar">
        <div class="w-100px mt-3 mb-3" style="margin-left:70px;">
            <img src="<?=base_url()?>assets/img/basic/logo.png" alt="">
        </div>
        <ul class="sidebar-menu hover-dark">
            <li class="header"><strong>MAIN NAVIGATION</strong></li>

            <li class="<?=$dashboard??''?>"><a href="<?=base_url('dashboard')?>"><img src="<?=base_url()?>assets/img/icon/dashboard.png" class="img-icon">Dashboard</a></li>

            <li class="<?=$main??''?>"><a href="<?=base_url('main/master')?>"><img src="<?=base_url()?>assets/img/icon/dashboard.png" class="img-icon">Master</a></li>

            <li class="<?=$main??''?>"><a href="<?=base_url('main/laporan')?>"><img src="<?=base_url()?>assets/img/icon/dashboard.png" class="img-icon">Laporan</a></li>

            <li class="<?=$main??''?>"><a href="<?=base_url('main/statement')?>"><img src="<?=base_url()?>assets/img/icon/dashboard.png" class="img-icon">Statement</a></li>
            
            <!-- <li class="treeview <?=$satuan?'active':''?> <?=$kategori?'active':''?> <?=$barang_mentah?'active':''?> <?=$barang_jual?'active':''?>"><a href="#">
                <img src="<?=base_url()?>assets/img/icon/inventory.png" class="img-icon"><span>Inventori</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu ml-2 <?=$satuan?'menu-open':''?> <?=$kategori?'menu-open':''?> <?=$barang_mentah?'menu-open':''?> <?=$barang_jual?'menu-open':''?>">
                    <li class="<?=$satuan??''?>"><a href="<?=base_url('satuan')?>"><img src="<?=base_url()?>assets/img/icon/satuan.png" class="img-icon"></i>Satuan</a></li>
                    <li class="<?=$kategori??''?>"><a href="<?=base_url('kategori')?>"><img src="<?=base_url()?>assets/img/icon/kategori.png" class="img-icon">Kategori</a></li>
                    <li class="<?=$barang_mentah??''?>"><a href="<?=base_url('barang_mentah')?>"><img src="<?=base_url()?>assets/img/icon/barang_mentah.png" class="img-icon">Barang Mentah</a></li>
                    <li class="<?=$barang_jual??''?>"><a href="<?=base_url('barang_jual')?>"><img src="<?=base_url()?>assets/img/icon/barang_jual.png" class="img-icon">Barang Jual</a></li>
                </ul>
            </li>

            <li class="treeview <?=$pelanggan?'active':''?> <?=$vendor?'active':''?>"><a href="#">
            <img src="<?=base_url()?>assets/img/icon/stakeholder.png" class="img-icon"><span>Stakeholder</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu ml-2 <?=$pelanggan?'menu-open':''?> <?=$vendor?'menu-open':''?>">
                <li class="<?=$pelanggan??''?>"><a href="<?=base_url('pelanggan')?>"><img src="<?=base_url()?>assets/img/icon/pelanggan.png" class="img-icon">Pelanggan</a></li>
                <li class="<?=$vendor??''?>"><a href="<?=base_url('vendor')?>"><img src="<?=base_url()?>assets/img/icon/vendor.png" class="img-icon">Vendor</a></li>
                </ul>
            </li> -->

            <li class="treeview <?=$penjualan?'active':''?> <?=$pembelian?'active':''?>"><a href="#">
            <img src="<?=base_url()?>assets/img/icon/pos.png" class="img-icon"><span>Point Of Sale</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu ml-2 <?=$penjualan?'menu-open':''?> <?=$pembelian?'menu-open':''?>">
                    <li class="<?=$penjualan??''?>"><a href="<?=base_url('penjualan')?>"><img src="<?=base_url()?>assets/img/icon/penjualan2.png" class="img-icon">Penjualan</a></li>
                    <li class="<?=$pembelian??''?>"><a href="<?=base_url('pembelian')?>"><img src="<?=base_url()?>assets/img/icon/pembelian2.png" class="img-icon">Pembelian</a></li>
                </ul>
            </li>

            <li class="treeview <?=$piutang?'active':''?> <?=$hutang?'active':''?>"><a href="#">
                <img src="<?=base_url()?>assets/img/icon/pembayaran.png" class="img-icon"><span>Pembayaran</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu ml-2 <?=$piutang?'menu-open':''?> <?=$hutang?'menu-open':''?>">
                    <li class="<?=$piutang??''?>"><a href="<?=base_url('piutang')?>"><img src="<?=base_url()?>assets/img/icon/piutang.png" class="img-icon">Piutang</a></li>
                    <li class="<?=$hutang??''?>"><a href="<?=base_url('hutang')?>"><img src="<?=base_url()?>assets/img/icon/deposit.png" class="img-icon">Hutang</a></li>
                </ul>
            </li>

            <!-- <li class="treeview <?=$lap_hutang?'active':''?> <?=$lap_pembelian?'active':''?> <?=$lap_penjualan?'active':''?> <?=$lap_piutang?'active':''?> <?=$lap_stok?'active':''?>"><a href="#">
                <img src="<?=base_url()?>assets/img/icon/laporan.png" class="img-icon"><span>Laporan</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu ml-2 <?=$lap_hutang?'menu-open':''?> <?=$lap_pembelian?'menu-open':''?> <?=$lap_penjualan?'menu-open':''?> <?=$lap_piutang?'menu-open':''?> <?=$lap_stok?'menu-open':''?>">
                    <li class="<?=$lap_penjualan??''?>"><a href="<?=base_url('laporan/penjualan')?>"><img src="<?=base_url()?>assets/img/icon/laporan2.png" class="img-icon">Penjualan</a></li>
                    <li class="<?=$lap_pembelian??''?>"><a href="<?=base_url('laporan/pembelian')?>"><img src="<?=base_url()?>assets/img/icon/laporan4.png" class="img-icon">Pembelian</a></li>
                    <li class="<?=$lap_piutang??''?>"><a href="<?=base_url('laporan/piutang')?>"><img src="<?=base_url()?>assets/img/icon/laporan5.png" class="img-icon">Piutang</a></li>
                    <li class="<?=$lap_hutang??''?>"><a href="<?=base_url('laporan/hutang')?>"><img src="<?=base_url()?>assets/img/icon/laporan3.png" class="img-icon">Hutang</a></li>
                    <li class="<?=$lap_stok??''?>"><a href="<?=base_url('laporan/stok')?>"><img src="<?=base_url()?>assets/img/icon/stock.png" class="img-icon">Stok</a></li>
                </ul>
            </li>

            <li class="treeview <?=$akun?'active':''?> <?=$pengaturan?'active':''?> <?=$jurnal?'active':''?> <?=$beban?'active':''?> <?=$saldo?'active':''?> <?=$buku_besar?'active':''?> <?=$neraca?'active':''?> <?=$laba_rugi?'active':''?>"><a href="#">
                <img src="<?=base_url()?>assets/img/icon/akuntansi.png" class="img-icon"><span>Akuntansi</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu ml-2 <?=$akun?'menu-open':''?> <?=$pengaturan?'menu-open':''?> <?=$beban?'menu-open':''?> <?=$saldo?'menu-open':''?> <?=$buku_besar?'menu-open':''?> <?=$neraca?'menu-open':''?> <?=$laba_rugi?'menu-open':''?>">
                    <li class="<?=$akun??''?>"><a href="<?=base_url('akun')?>"><img src="<?=base_url()?>assets/img/icon/barcode.png" class="img-icon">Bagan Akun</a></li>
                    <li class="<?=$pengaturan??''?>"><a href="<?=base_url('pengaturan')?>"><img src="<?=base_url()?>assets/img/icon/pengaturan.png" class="img-icon">Pengaturan Umum</a></li>
                    <li class="<?=$jurnal??''?>"><a href="<?=base_url('jurnal/create')?>"><img src="<?=base_url()?>assets/img/icon/jurnal2.png" class="img-icon">Input Jurnal</a></li>
                    <li class="<?=$saldo??''?>"><a href="<?=base_url('saldo/create')?>"><img src="<?=base_url()?>assets/img/icon/saldo.png" class="img-icon">Pembukaan Saldo</a></li>
                    <li class="<?=$beban??''?>"><a href="<?=base_url('beban')?>"><img src="<?=base_url()?>assets/img/icon/beban.png" class="img-icon">Beban Pengeluaran</a></li>
                    <li class="<?=$buku_besar??''?>"><a href="<?=base_url('buku_besar')?>"><img src="<?=base_url()?>assets/img/icon/buku_besar.png" class="img-icon">Buku Besar</a></li>
                    <li class="<?=$neraca??''?>"><a href="<?=base_url('neraca')?>"><img src="<?=base_url()?>assets/img/icon/jurnal.png" class="img-icon">Neraca</a></li>
                    <li class="<?=$laba_rugi??''?>"><a href="<?=base_url('laba_rugi')?>"><img src="<?=base_url()?>assets/img/icon/laba_rugi.png" class="img-icon">Laba Rugi</a></li>
                </ul>
            </li>

            <li class="treeview <?=$perusahaan?'active':''?> <?=$divisi?'active':''?> <?=$karyawan?'active':''?>"><a href="#">
            <img src="<?=base_url()?>assets/img/icon/perusahaan.png" class="img-icon"><span>Perusahaan</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu ml-2 <?=$perusahaan?'menu-open':''?> <?=$divisi?'menu-open':''?> <?=$karyawan?'menu-open':''?>">
                    <li class="<?=$perusahaan??''?>"><a href="<?=base_url('perusahaan')?>"><img src="<?=base_url()?>assets/img/icon/perusahaan2.png" class="img-icon">Perusahaan</a></li>
                    <li class="<?=$divisi??''?>"><a href="<?=base_url('divisi')?>"><img src="<?=base_url()?>assets/img/icon/divisi.png" class="img-icon">Divisi</a></li>
                    <li class="<?=$karyawan??''?>"><a href="<?=base_url('karyawan')?>"><img src="<?=base_url()?>assets/img/icon/karyawan.png" class="img-icon">Karyawan</a></li>
                </ul>
            </li>

            <li class="treeview"><a href="#">
            <img src="<?=base_url()?>assets/img/icon/menu.png" class="img-icon"><span>Menu Management</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu ml-2">
                    <li class="<?=$menu??''?>"><a href="<?=base_url('menu')?>"><img src="<?=base_url()?>assets/img/icon/role_akses.png" class="img-icon">Role Access</a></li>
                    <li class="<?=$user??''?>"><a href="<?=base_url('user')?>"><img src="<?=base_url()?>assets/img/icon/user.png" class="img-icon">User</a></li>
                </ul>
            </li> -->
            
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