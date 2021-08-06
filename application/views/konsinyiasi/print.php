
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>#<?=$data[0]['no_transaksi']?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/app.css">
</head>
<body class="light">
<div class="card" id="print">
               <div class="card-body">
                  <div class="row">
                     <div class="col-12">
                           <img class="w-80px mb-4" src="<?=base_url()?>assets/img/dummy/bootstrap-social-logo.png" alt="">

                           <div class="float-right">
                              <h4><strong>Invoice #<?=$data[0]['no_transaksi']?></strong></h4><br>
                              <table>
                                 <tr>
                                    <td class="font-weight-normal">Date:</td>
                                    <td><?= date('d/m/Y', strtotime($data[0]['created']))?></td>
                                 </tr>
                                 <tr>
                                    <td class="font-weight-normal">Order ID:</td>
                                    <td><?=$data[0]['no_transaksi']?></td>
                                 </tr>
                              </table>
                           </div>
                     
                     </div>
                  </div>

                  <!-- info row -->
                  <div class="row my-3 ">
                    <div class="col-sm-4">
                      To
                      <address>
                        <strong><?=$data[0]['nama']?></strong><br>
                        <?=$data[0]['alamat']?> <br>
                        Phone: <?=$data[0]['telp']?><br>
                        Email: <?=$data[0]['email']?>
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      From
                      <address>
                        <strong><?=$data[0]['perusahaan']?></strong><br>
                        <?=$data[0]['alamat_perusahaan']?> <br>
                        Phone: <?=$data[0]['telp']?><br>
                        Email: <?=$data[0]['email_perusahaan']?>
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
                            <th>No Transaksi</th>
                            <th>No Penerimaan Barang</th>
                            <th>Hutang</th>
                            <th>Jumlah Bayar</th>
                            <th>Tanggal</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($data as $db):?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$db['no_transaksi']?></td>
                                <td><?=$db['no_sj']?></td>
                                <td><?=number_format($db['hutang'],0,'','.')?></td>
                                <td><?=number_format($db['bayar'],0,'','.')?></td>
                                <td><?=$db['created']?></td>
                            </tr>
                          <?php endforeach?>
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
                            <tbody>
                            <!-- <tr>
                                <th>TOTAL TAGIHAN (IDR) : </th>
                                <td><?//=number_format($data[0]['total_tagihan'],0,'','.')?></td>
                            </tr> -->
                            <tr>
                                <th>HUTANG (IDR) : </th>
                                <td><?=number_format($data[0]['hutang'],0,'','.')?></td>
                            </tr>
                            <tr>
                                <th>TOTAL BAYAR (IDR) : </th>
                                <td><?=number_format($data[0]['bayar'],0,'','.')?></td>
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
   
   <script>
      window.print();
   </script>
</body>
</html>