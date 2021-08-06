
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Paper</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/app.css">
    <!-- <style>
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
    </style> -->
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
    <!-- <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script> -->
</head>
<body class="light">
<!-- Pre loader -->
<!-- <div id="loader" class="loader">
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
</div> -->
<!-- <div id="app"> -->
<!-- <aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
    <section class="sidebar">
        <div class="w-80px mt-3 mb-3 ml-3">
            <img src="assets/img/basic/logo.png" alt="">
        </div>
        <div class="relative">
            <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
               aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                <i class="icon icon-cogs"></i>
            </a>
            <div class="user-panel p-3 light mb-2">
                <div>
                    <div class="float-left image">
                        <img class="user_avatar" src="assets/img/dummy/u2.png" alt="User Image">
                    </div>
                    <div class="float-left info">
                        <h6 class="font-weight-light mt-2 mb-1">Alexander Pierce</h6>
                        <a href="#"><i class="icon-circle text-primary blink"></i> Online</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="collapse multi-collapse" id="userSettingsCollapse">
                    <div class="list-group mt-3 shadow">
                        <a href="index.html" class="list-group-item list-group-item-action ">
                            <i class="mr-2 icon-umbrella text-blue"></i>Profile
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="mr-2 icon-cogs text-yellow"></i>Settings</a>
                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="mr-2 icon-security text-purple"></i>Change Password</a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header"><strong>MAIN NAVIGATION</strong></li>
            <li class="treeview"><a href="#">
                <i class="icon icon-sailing-boat-water purple-text s-18"></i> <span>Dashboard</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i>
            </a>
                <ul class="treeview-menu">
                    <li><a href="index.html"><i class="icon icon-folder5"></i>Panel Dashboard 1</a>
                    </li>
                    <li><a href="panel-page-dashboard1-rtl.html"><i class="icon icon-folder5"></i>Panel Dashboard 1 - RTL</a>
                    </li>
                    <li><a href="panel-page-dashboard2.html"><i class="icon icon-folder5"></i>Panel Dashboard 2</a>
                    </li>
                    <li><a href="panel-page-dashboard3.html"><i class="icon icon-folder5"></i>Panel Dashboard 3</a>
                    </li>
                    <li><a href="panel-page-dashboard4.html"><i class="icon icon-folder5"></i>Panel Dashboard 4</a>
                    </li>
                    <li><a href="panel-page-dashboard5.html"><i class="icon icon-folder5"></i>Panel Dashboard 5</a>
                    </li>
                    <li><a href="panel-page-dashboard6.html"><i class="icon icon-folder5"></i>Panel Dashboard 6</a>
                    </li>
                    <li><a href="panel-page-dashboard7.html"><i class="icon icon-folder5"></i>Panel Dashboard 7</a></li>
                    <li><a href="panel-page-dashboard9.html"><i class="icon icon-folder5"></i>Panel Dashboard 9</a></li>
                    <li><a href="panel-page-dashboard10.html"><i class="icon icon-folder5"></i>Panel Dashboard 10</a></li>
                    <li><a href="panel-page-dashboard11.html"><i class="icon icon-folder5"></i>Panel Dashboard 11</a></li>
                </ul>
            </li>
            <li class="treeview"><a href="#">
                <i class="icon icon icon-package blue-text s-18"></i>
                <span>Products</span>
                <span class="badge r-3 badge-primary pull-right">4</span>
            </a>
                <ul class="treeview-menu">
                    <li><a href="panel-page-products.html"><i class="icon icon-circle-o"></i>All Products</a>
                    </li>
                    <li><a href="panel-page-products-create.html"><i class="icon icon-add"></i>Add
                        New </a>
                    </li>
                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Users<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="panel-page-users.html"><i class="icon icon-circle-o"></i>All Users</a>
                    </li>
                    <li><a href="panel-page-users-create.html"><i class="icon icon-add"></i>Add User</a>
                    </li>
                    <li><a href="panel-page-profile.html"><i class="icon icon-user"></i>User Profile </a>
                    </li>
                </ul>
            </li>
            <li class="treeview no-b"><a href="#">
                <i class="icon icon-package light-green-text s-18"></i>
                <span>Inbox</span>
                <span class="badge r-3 badge-success pull-right">20</span>
            </a>
                <ul class="treeview-menu">
                    <li><a href="panel-page-inbox.html"><i class="icon icon-circle-o"></i>All Messages</a>
                    </li>
                    <li><a href="panel7-inbox.html"><i class="icon icon-circle-o"></i>Panel7 - Inbox</a>
                    </li>
                    <li><a href="panel8-inbox.html"><i class="icon icon-circle-o"></i>Panel8 - Inbox</a>
                    </li>
                    <li><a href="panel-page-inbox-create.html"><i class="icon icon-add"></i>Compose</a>
                    </li>
                </ul>
            </li>
            <li class="header light mt-3"><strong>UI COMPONENTS</strong></li>
            <li class="treeview ">
                <a href="#">
                    <i class="icon icon-package text-lime s-18"></i> <span>Apps</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="panel-page-chat.html"><i class="icon icon-circle-o"></i>Chat</a>
                    </li>
                    <li><a href="panel7-tasks.html"><i class="icon icon-circle-o"></i>Tasks / Todo</a>
                    </li>
                    <li><a href="panel-page-calendar.html"><i class="icon icon-date_range"></i>Calender</a>
                    </li>
                    <li><a href="panel-page-calendar2.html"><i class="icon icon-date_range"></i>Calender 2</a>
                    </li>
                    <li><a href="panel-page-contacts.html"><i class="icon icon-circle-o"></i>Contacts</a>
                    </li>
                    <li><a href="panel1-projects.html"><i class="icon icon-circle-o"></i>Panel1 - Projects</a>
                    </li>
                    <li><a href="panel7-projects-list.html"><i class="icon icon-circle-o"></i>Panel7 - Projects List</a>
                    </li>
                    <li><a href="panel7-invoices.html"><i class="icon icon-circle-o"></i>Invoices</a>
                    <li><a href="panel7-meetings.html"><i class="icon icon-circle-o"></i>Meetings</a>
                    <li><a href="panel7-payments.html"><i class="icon icon-circle-o"></i>Payments</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="icon icon-documents3 text-blue s-18"></i> <span>Pages</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="icon icon-documents3"></i>Blank Pages<i
                            class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="panel-page-blank.html"><i class="icon icon-document"></i>Simple Blank</a>
                            </li>
                            <li><a href="panel-page-blank-tabs.html"><i class="icon icon-document"></i>Tabs Blank <i
                                    class="icon icon-angle-left s-18 pull-right"></i></a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="icon icon-fingerprint text-green"></i>Auth Pages<i
                            class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="login.html"><i class="icon icon-document"></i>Login Page 1</a>
                            </li>
                            <li><a href="login-2.html"><i class="icon icon-document"></i>Login Page 2</a>
                            </li>
                            <li><a href="login-3.html"><i class="icon icon-document"></i>Login Page 3</a>
                            </li>
                            <li><a href="login-4.html"><i class="icon icon-document"></i>Login Page 4</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="icon icon-bug text-red"></i>Error Pages<i
                            class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="panel-page-404.html"><i class="icon icon-document"></i>404 Page</a>
                            </li>
                            <li><a href="panel-page-500.html"><i class="icon icon-document"></i>500 Page<i
                                    class="icon icon-angle-left s-18 pull-right"></i></a>
                            </li>
                            <li><a href="panel-page-error.html"><i class="icon icon-document"></i>420 Page<i
                                    class="icon icon-angle-left s-18 pull-right"></i></a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="icon icon-documents3"></i>Other Pages<i
                            class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="panel-page-invoice.html"><i class="icon icon-document"></i>Invoice Page</a>
                            </li>
                            <li><a href="panel-page-no-posts.html"><i class="icon icon-document"></i>No Post Page</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="icon icon-goals-1 amber-text s-18"></i> <span>Elements</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="panel-element-widgets.html">
                        <i class="icon icon-widgets amber-text s-14"></i> <span>Widgets</span>
                    </a>
                    </li>
                    <li><a href="panel-element-counters.html">
                        <i class="icon icon-filter_9_plus amber-text s-14"></i> <span>Counters</span>
                    </a>
                    <li><a href="panel-element-buttons.html">
                        <i class="icon icon-touch_app amber-text s-14"></i> <span>Buttons</span>
                    </a>
                    </li>
                    <li>
                        <a href="panel-element-typography.html">
                            <i class="icon icon-text-width amber-text s-14"></i> <span>Typography</span>
                        </a>
                    </li>
                    <li><a href="panel-element-tabels.html">
                        <i class="icon icon-table amber-text s-14"></i> <span>Tables</span>
                    </a>
                    </li>
                    <li><a href="panel-element-alerts.html">
                        <i class="icon icon-exclamation-circle amber-text s-14"></i> <span>Alerts</span>
                    </a>
                    </li>
                    <li><a href="panel-element-slider.html"><i class="icon icon-view_carousel amber-text s-14"></i>
                        <span>Slider</span></a></li>
                    <li><a href="panel-element-tabs.html"><i class="icon icon-folders2 amber-text s-14"></i>
                        <span>Tabs</span></a></li>
                    <li><a href="panel-element-progress-bars.html"><i class="icon icon-folders2 amber-text s-14"></i>
                        <span>Progress Bars</span></a></li>
                    <li><a href="panel-element-badges.html"><i class="icon icon-flag7 amber-text s-14"></i>
                        <span>Badges</span></a></li>
                    <li><a href="panel-element-preloaders.html"><i class="icon icon-data_usage amber-text s-14"></i>
                        <span>Preloaders</span></a></li>
                </ul>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i class="icon icon-wpforms light-green-text s-18 "></i> <span>Forms & Plugins</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="panel-element-forms.html"><i class="icon icon-wpforms light-green-text"></i>Bootstrap
                        Inputs</a>
                    </li>
                    <li><a href="form-jquery-validations.html"><i class="icon icon-note-important light-green-text"></i>
                        Form Validation (Jquery)</a>
                    </li>
                    <li><a href="form-bootstrap-validations.html"><i class="icon icon-note-important light-green-text"></i>
                        Form Validation (Bootstrap)</a>
                    </li>
                    <li><a href="panel-element-editor.html"><i class="icon icon-pen2 light-green-text"></i>Editor</a>
                    </li>
                    <li><a href="panel-element-toast.html"><i
                            class="icon icon-notifications_active light-green-text"></i>Toasts</a>
                    </li>
                    <li><a href="panel-element-stepper.html"><i class="icon icon-burst_mode light-green-text"></i>Stepper</a>
                    </li>
                    <li><a href="panel-element-date-time-picker.html"><i
                            class="icon icon-date_range light-green-text"></i>Date Time Picker</a>
                    </li>
                    <li><a href="panel-element-color-picker.html"><i class="icon icon-adjust light-green-text"></i>Color
                        Picker</a>
                    </li>
                    <li><a href="panel-element-range-slider.html"><i class="icon icon-space_bar light-green-text"></i>Range
                        Slider</a>
                    </li>
                    <li><a href="panel-element-select2.html"><i
                            class="icon  icon-one-finger-click light-green-text"></i>Select 2</a>
                    </li>
                    <li><a href="panel-element-tags.html"><i class="icon  icon-tags3 light-green-text"></i>Tags</a>
                    </li>
                    <li><a href="panel-element-data-tables.html"><i class="icon icon-table light-green-text"></i>Data
                        Tables</a>
                    </li>
                </ul>
            </li>
            <li class="treeview"><a href="#">
                <i class="icon icon-bar-chart2 pink-text s-18"></i>
                <span>Charts</span>
                <i class="icon icon-angle-left s-18 pull-right"></i>
            </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="panel-element-charts-js.html"><i class="icon icon-area-chart pink-text s-14"></i><span>Charts.Js</span></a>
                    </li>
                    <li>
                        <a href="panel-element-morris.html"><i class="icon icon-bubble_chart pink-text s-14"></i>Morris
                            Charts</a>
                    </li>
                    <li>
                        <a href="panel-element-echarts.html">
                            <i class="icon icon-bar-chart-o pink-text s-14"></i>Echarts</a>
                    </li>
                    <li>
                        <a href="panel-element-easy-pie-charts.html">
                            <i class="icon icon-area-chart pink-text s-14"></i>Easy Pie Charts</a>
                    </li>
                    <li>
                        <a href="panel-element-jqvmap.html">
                            <i class="icon icon-map pink-text s-14"></i>Jqvmap</a>
                    </li>
                    <li>
                        <a href="panel-element-sparklines.html">
                            <i class="icon icon-line-chart2 pink-text s-14"></i>Sparklines</a>
                    </li>
                    <li>
                        <a href="panel-element-float.html">
                            <i class="icon icon-pie-chart pink-text s-14"></i>Float Charts</a>
                    </li>
                </ul>
            </li>
            <li class="treeview"><a href="#">
                <i class="icon icon-dialpad blue-text  s-18"></i>
                <span>Extra</span>
                <i class="icon icon-angle-left s-18 pull-right"></i>
            </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="panel-element-letters.html">
                            <i class="icon icon-brightness_auto light-blue-text s-14"></i>
                            <span>Avatar Placeholders</span>
                        </a>
                    </li>
                    <li>
                        <a href="panel-element-icons.html">
                            <i class="icon icon-camera2 light-blue-text s-14"></i> <span>Icons</span>
                        </a>
                    </li>
                    <li><a href="panel-element-colors.html">
                        <i class="icon icon-palette light-blue-text s-14"></i> <span>Colors</span>
                    </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside> -->
<!--Sidebar End-->
<!-- <div class="has-sidebar-left">
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
</div> -->
    <!-- <div class="sticky">
        <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
            <div class="relative">
                <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                    <i></i>
                </a>
            </div> -->
            <!--Top Menu Start -->
<!-- <div class="navbar-custom-menu">
    
</div> -->
        <!-- </div>
    </div>
</div> -->
<!-- <div class="page has-sidebar-left">
    <header class="my-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="s-24">
                        <i class="icon-pages"></i>
                        Blank <span class="s-14">Get Started</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid my-3">
        <p>You are the boss make something great.</p>
    </div>
</div> -->
<div class="card" id="print">
               <div class="card-body">
                  <div class="row">
                     <div class="col-12">
                           <img class="w-80px mb-4" src="<?=base_url()?>assets/img/dummy/bootstrap-social-logo.png" alt="">

                           <div class="float-right">
                              <h4>Invoice #007612</h4><br>
                              <table>
                                 <tr>
                                    <td class="font-weight-normal">Date:</td>
                                    <td>2/10/2014</td>
                                 </tr>
                                 <tr>
                                    <td class="font-weight-normal">Order ID:</td>
                                    <td>4F3S8J</td>
                                 </tr>
                              </table>
                           </div>
                     
                     </div>
                  </div>

                  <!-- info row -->
                  <div class="row my-3 ">
                    <div class="col-sm-4">
                      From
                      <address>
                        <strong>Admin, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (804) 123-5432<br>
                        Email: info@almasaeedstudio.com
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      To
                      <address>
                        <strong>John Doe</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (555) 539-1037<br>
                        Email: john.doe@example.com
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                     
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <!-- Table row -->
                  <div class="row my-3">
                    <div class="col-12 table-responsive">
                      <table class="table table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Product</th>
                          <th>Harga</th>
                          <th>Quantity</th>
                          <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>1</td>
                          <td>Call of Duty</td>
                          <td>IDR 50000</td>
                          <td><input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control" /></td>
                          <td>$64.50</td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody><tr>
                            <th style="width:50%">TOTAL GROSS (IDR) :</th>
                            <td>3000</td>
                          </tr>
                          <tr>
                            <th>DISKON (%) : </th>
                            <td>3000</td>
                          </tr>
                          <tr>
                            <th>TOTAL TAGIHAN (IDR) : </th>
                            <td>3000</td>
                          </tr>
                          <tr>
                            <th>TOTAL BAYAR (IDR) : </th>
                            <td>3000</td>
                          </tr>
                        </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <!-- this row will not appear when printing -->
            </div>
<!-- Right Sidebar -->
<!-- <aside class="control-sidebar fixed white ">
    <div class="slimScroll">
        <div class="sidebar-header">
            <h4>Activity List</h4>
            <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
        </div>
        <div class="p-3">
            <div>
                <div class="my-3">
                    <small>25% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>45% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 45%;" aria-valuenow="45"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>60% Complete</small>
                    `
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="60"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>75% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>100% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 bg-primary text-white">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="font-weight-normal s-14">Sodium</h5>
                    <span class="font-weight-lighter text-primary">Spark Bar</span>
                    <div> Oxygen
                        <span class="text-primary">
                                                    <i class="icon icon-arrow_downward"></i> 67%</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <canvas width="100" height="70" data-chart="spark" data-chart-type="bar"
                            data-dataset="[[28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100]]"
                            data-labels="['a','b','c','d','e','f','g','h','i','j','k','l','m','n','a','b','c','d','e','f','g','h','i','j','k','l','m','n']">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                <tbody>
                <tr>
                    <td>
                        <a href="#">INV-281281</a>
                    </td>
                    <td>
                        <span class="badge badge-success">Paid</span>
                    </td>
                    <td>$ 1228.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-01112</a>
                    </td>
                    <td>
                        <span class="badge badge-warning">Overdue</span>
                    </td>
                    <td>$ 5685.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-281012</a>
                    </td>
                    <td>
                        <span class="badge badge-success">Paid</span>
                    </td>
                    <td>$ 152.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-01112</a>
                    </td>
                    <td>
                        <span class="badge badge-warning">Overdue</span>
                    </td>
                    <td>$ 5685.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-281012</a>
                    </td>
                    <td>
                        <span class="badge badge-success">Paid</span>
                    </td>
                    <td>$ 152.28</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="sidebar-header">
            <h4>Activity</h4>
            <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
        </div>
        <div class="p-4">
            <div class="activity-item activity-primary">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 5 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit amet conse ctetur which ascing elit users.</p>
                </div>
            </div>
            <div class="activity-item activity-danger">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 8 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit ametcon the sectetur that ascing elit users.</p>
                </div>
            </div>
            <div class="activity-item activity-success">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 10 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit amet cons the ecte tur and adip ascing elit users.</p>
                </div>
            </div>
            <div class="activity-item activity-warning">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 12 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit amet consec tetur adip ascing elit users.</p>
                </div>
            </div>
        </div>
    </div>
</aside> -->
<!-- /.right-sidebar -->
<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
<!-- <div class="control-sidebar-bg shadow white fixed"></div>
</div> -->
<!--/#app -->
<!-- <script src="<?=base_url()?>assets/js/app.js"></script> -->




<!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->
<!-- <script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script> -->
</body>
</html>