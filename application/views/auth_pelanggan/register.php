
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Pro - Archery</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/app.css">
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
</head>
<body class="light">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
<main>
    <div id="primary" class="p-t-b-100 height-full">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mx-md-auto paper-card">
                    <div class="text-center">
                        <img src="<?=base_url()?>assets/img/basic/logo.png" alt="">
                        <h3 class="mt-2"><strong>Pro-Archery</strong></h3>
                        <p class="p-t-b-20">Please register to access the application</p>
                    </div>
                    <form action="<?=base_url('auth_pelanggan/save')?>" method="post">
                        <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                            <input type="text" class="form-control form-control-lg" placeholder="Name" required name="nama" id="nama" >
                        </div>
                        <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                            <input type="text" class="form-control form-control-lg" placeholder="Telp Number" required name="telp" id="telp">
                        </div>
                        <div class="form-group has-icon"><i class="icon-user-secret"></i>
                            <input type="text" class="form-control form-control-lg" placeholder="Address" required name="alamat" id="alamat">
                        </div>
                        <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                            <input type="email" class="form-control form-control-lg" placeholder="Email Address" required name="email" id="email">
                        </div>
                        <div class="form-group has-icon"><i class="icon-user-secret"></i>
                            <input type="password" class="form-control form-control-lg" placeholder="Password" required name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #primary -->
</main>
<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<div class="info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="gagal" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>
<div class="sukses" data-flashdata="<?= $this->session->flashdata('sukses'); ?>"></div>
<div class="warning" data-flashdata="<?= $this->session->flashdata('warning'); ?>"></div>
<!--/#app -->
<script src="<?=base_url()?>assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    const gagal = $('.gagal').data('flashdata');
    if (gagal) {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Gagal',
        text: gagal,
        showConfirmButton: false,
        timer: 2500
      })
    }

    const sukses = $('.sukses').data('flashdata');
    if (sukses) {
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Berhasil',
        text: sukses,
        showConfirmButton: false,
        timer: 2500
      })
    }

    const warning = $('.warning').data('flashdata');
    if (warning) {
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Peringatan',
        text: warning,
        showConfirmButton: false,
        timer: 2500
      })
    }

    const info = $('.info').data('flashdata');
    if (info) {
      Swal.fire({
        position: 'center',
        icon: 'info',
        title: 'Informasi',
        text: info,
        showConfirmButton: false,
        timer: 2500
      })
    }
  </script>


<!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->
<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
</body>
</html>