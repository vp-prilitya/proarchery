
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>#<?=$data[0]['no_faktur']?></title>
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
                              <h4><strong>No Penjualan #<?=$data[0]['no_faktur']?></strong></h4><br>
                              <table>
                                 <tr>
                                    <td class="font-weight-normal">Date:</td>
                                    <td><?= date('d/m/Y', strtotime($data[0]['created']))?></td>
                                 </tr>
                                 <tr>
                                    <td class="font-weight-normal">No Penjualan:</td>
                                    <td><?=$data[0]['no_faktur']?></td>
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
                        <strong><?=$data[0]['pelanggan']?></strong><br>
                        <?=$data[0]['alamat']?> <br>
                        Phone: <?=$data[0]['contact']?><br>
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
                          <th>Product</th>
                          <th>Harga</th>
                          <th>Quantity</th>
                          <th>Diskon</th>
                          <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($data as $db) :?>
                          <tr>
                            <td><?=$i++?></td>
                            <td><?=$db['item']?> <?=$db['paket']?':<br>'.$db['paket']:''?></td>
                            <td>IDR <?=number_format($db['harga'],0,'','.')?></td>
                            <td><?=$db['quantity']?> <?=$db['satuan']?></td>
                            <td><?=$db['disc']?></td>
                            <?php $subtotal = $db['harga'] - ($db['harga']*$db['disc']/100);?>
                            <td>IDR <?=number_format($subtotal*$db['quantity'],0,'','.')?></td>
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
                    <div class="col-6" style="padding:60px;">
                      <table class="table">
                        <tr>
                          <p>Anda dapat melakukan pembayaran invoice ke :</p>
                          <p>Nama Bank : <strong><?=$data[0]['bank']?></strong></p>
                          <p>No. Rekening : <strong><?=$data[0]['no_rek']?></strong></p>
                          <p>Nama Pemilik : <strong><?=$data[0]['nama_pemilik']?></strong></p>
                        </tr>
                      </table>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody><tr>
                            <th style="width:50%">TOTAL GROSS (IDR) :</th>
                            <td><?=number_format($data[0]['total_gross'],0,'','.')?></td>
                          </tr>
                          <tr>
                            <th>DISKON (%) : </th>
                            <td><?=$data[0]['diskon']?></td>
                          </tr>
                          <tr>
                            <th>JENIS PPN : </th>
                            <td><?=ucwords($data[0]['jenis_ppn'])?> PPN</td>
                          </tr>
                          <tr>
                            <th>PPN (IDR) : </th>
                            <td><?=number_format($data[0]['ppn'],0,'','.')?></td>
                          </tr>
                          <tr>
                            <th>TOTAL TAGIHAN (IDR) : </th>
                            <td><?=number_format($data[0]['total_tagihan'],0,'','.')?></td>
                          </tr>
                          <!-- <tr>
                            <th>TOTAL BAYAR (IDR) : </th>
                            <td><?//=number_format($data[0]['total_bayar'],0,'','.')?></td>
                          </tr> -->
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