<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=base_url()?>assets/img/basic/favicon.ico" type="image/x-icon">
    <title>POS - Accounting</title>
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
/* 
        * {
            scrollbar-width: thin;
            scrollbar-color: #7952b3 #8e2de2;
        }
        *::-webkit-scrollbar {
            width: 5px;
        }
        *::-webkit-scrollbar-track {
            background: rgba(128, 128, 128, 0.1);
        }
        *::-webkit-scrollbar-thumb {
            background-color: #d31027;
            border-radius: 2px;
        } */

        .hilang{
            display:none;
        }

        .img-icon {
            width:22px;
            margin-left:10px;
            margin-right:10px;
            margin-top:-5px;
        }

        .active-1{
            /* background: linear-gradient(135deg,#d31027 0,#ea384d 100%); */
            background-color: #3b76db;
            /* border-radius: 20px; */
            /* width : 90%; */
            /* margin-left:5px !important; */
        }

        .active-1 a {
            font-size: 15px !important;
            font-weight: bold !important;
            /* color:black !important; */
        }

        /* .offcanvas .sidebar-menu>li.active:after{
            background: #F00000 !important;
        } */

        .gradient{
            /* background: #F00000 !important;  fallback for old browsers */
            /* background: -webkit-linear-gradient(to left top, #ea384d, #e53044, #df273a, #d91d31, #d31027) !important;  Chrome 10-25, Safari 5.1-6 */
            /* background: linear-gradient(to left top, #ea384d, #e53044, #df273a, #d91d31, #d31027) !important;  */
            background: linear-gradient(to left top, #ffffff, #ffffff); 
        }

        .gradient .card-body h5 strong {
            color:black !important;
        }

        .gradient h5 strong {
            color:black !important;
        }

        /* .paper-nav-toggle i{
            background: #F00000 !important;
        }

        .paper-nav-toggle i::after, .paper-nav-toggle i::before{
            background: #F00000 !important;
        } */

        .card__hover {
            transition: transform .5s;
        }

        .card__hover::after {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: opacity 2s cubic-bezier(.165, .84, .44, 1);
            box-shadow: 0 8px 17px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .15);
            content: '';
            opacity: 0;
            z-index: -1;
        }

        .card__hover:hover,
        .card__hover:focus {
            transform: scale3d(1.036, 1.036, 1);
            -webkit-box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);
            -moz-box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);
            box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);
        }

        .gradient-yellow{
            background-image: linear-gradient(to left top, #FFDD00, #FBB034);
        }

        .gradient-red{
            background-image: linear-gradient(to left top, #ff416c, #ff4b2b);
        }

        .gradient-green{
            background-image: linear-gradient(to left top, #0BAB64, #3BB78F);
        }

        .gradient-blue{
            background-image: linear-gradient(to left top, #37D5D6, #36096D);
        }

        .gradient-sky{
            background-image: linear-gradient(to left top, #4884EE, #06BCFB);
        }

        .gradient-blue-2{
            background-image: linear-gradient(to left top, #89D4CF, #734AE8);
        }

        .gradient-purple-lighten{
            background-image: linear-gradient(to left top, #B621FE, #1FD1F9);
        }

        .gradient-purple{
            background-image: linear-gradient(to left top, #647DEE, #7F53AC);
        }

        .gradient-pink{
            background-image: linear-gradient(to left top, #F67062, #FC5296);
        }

        .gradient-brown{
            background-image: linear-gradient(to left top, #F2A65A, #772F1A);
        }

        .gradient-orange{
            background-image: linear-gradient(to left top, #EC9F05, #FF4E00);
        }

        .p-20{
            padding-top : 25px !important;
            padding-bottom : 25px !important;
        }

        .p-20 .text-dark{
            color : #FFFFFF !important;
            font-size : 16px !important;
            font-weight : 400 !important;
            margin-top: 5px !important;
        }

        .p-20 .img-icon{
            width : 60px;
        }

        .box{
            padding-top : 50px ;
            padding-bottom : 50px ;
            position : relative;
        }

        .box .nomor{
            width : 40px;
            left : 10px;
            top : 10px;
            position : absolute;
        }

        .box .img-icon{
            width : 90px;
        }

        .box .text-dark{
            color : #FFFFFF !important;
            font-size : 18px !important;
            font-weight : 400 !important;
            margin-top: 15px !important;
        }

        .btn-primary, .btn-primary:hover{
            background-color: #9c27b0;
        }

        .btn-warning, .btn-warning:hover{
            background-color: #304ffe;
        }

        .btn-danger, .btn-danger:hover{
            background-color: #e3f2fd;
        }

        .btn-success, .btn-success:hover{
            background-color: #039be5;
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
        <div class="preloader-wrapper  active">

            <div class="spinner-layer spinner-red">
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