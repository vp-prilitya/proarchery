
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
    

<!-- TEST PRINTER0 -->
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                              
                                  <th><H1><STRONG><p text-align: center, style="font-size:80px">THE HUB CIBUBUR</STRONG></H1></th>
                              
                        <tr>
                            
                            <th><H1><p style="font-size:60px">Tgl</H1></th>
                            <td><H1><p style="font-size:60px"><?= date('d/m/Y', strtotime($data[0]['created']))?></H1></td>
                          </tr>  
                              
                        <tr>
                            <th><H1><p style="font-size:60px">No Invoice </H1></th>
                            <td><H1><p style="font-size:60px"><?=$data[0]['no_faktur']?></H1></td>
                          </tr>  
                         tr
                          
                             
                        </tbody>
                        </table>
                        
                      </div>
                    </div>




<div class="card" id="print">
               <!-- <div class="card-body">
                  <div class="row">
                     <div class="col-6">
                     THE HUB
                           <img class="w-80000px mb-4" src="<?=base_url()?>assets/img/dummy/bootstrap-social-logo.png" alt=""> -->

                        <!-- <div class="float-right">
                              <h4><strong>Invoice #<?=$data[0]['no_faktur']?></strong></h4><br>
                              <table>
                                 <tr>
                                    <td class="font-weight-normal">Date:</td>
                                    <td><?= date('d/m/Y', strtotime($data[0]['created']))?></td>
                                 </tr>
                                 <tr>
                                    <td class="font-weight-normal">Order ID:</td>
                                    <td><?=$data[0]['no_faktur']?></td>
                                 </tr>
                              </table>
                           </div> -->
                     
                     </div>
                  </div> 

                  <!-- info row -->
                  
                  <!-- <div class="row my-3 ">
                    <div class="col-sm-4">
                      To
                      <address>
                        <strong><?=$data[0]['pelanggan']??'NON MEMBER'?></strong><br>
                        <?=$data[0]['alamat']?> <br>
                        Phone: <?=$data[0]['contact']?><br>
                        Email: <?=$data[0]['email']?>
                      </address>
                    </div>  -->
                    
                    <!-- /.col -->
                    
                    <!--<div class="col-sm-4">
                      From
                      <address>
                        <strong><?=$data[0]['perusahaan']?></strong><br>
                        <?=$data[0]['alamat_perusahaan']?> <br>
                        Phone: <?=$data[0]['telp']?><br>
                        Email: <?=$data[0]['email_perusahaan']?>
                      </address>
                    </div> --> 
                    
                    <!-- /.col -->
                    
                    <!-- <div class="col-sm-4">
                     
                    </div> -->
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <!-- Table row -->
                 
                  <div class="row my-3">
                    <div class="col-12 table-responsive">
                      <table class="table table-striped">
                        <thead>
                        <tr>
                            
                          <!-- <th><H1>No</H1></th> 
                          <th><H1>Product</H1></th>
                          <th><H1>Harga</H1></th>
                          <th><H1>Quantity</H1></th> -->
                         <!-- <th>Diskon</th>
                          <th>Subtotal</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($data as $db) :?>
                          <tr>
                              
                            <!-- <td><H1><?=$i++?></H1></td> -->
                            
                            
                            <td><H1><p style="font-size:60px"><?=$db['item']?> <?=$db['paket']?':<br>'.$db['paket']:''?></H1></td>
                            <td><H1><p style="font-size:60px">IDR <?=number_format($db['harga_jual'],0,'','.')?> x <?=$db['quantity']?></H1></td>
                            <td><H1><p style="font-size:60px">IDR <?=number_format($db['harga_jual']*$db['quantity'],0,'','.')?></H1></td>
                            
                           
                            <!--<td><H1><?=$db['quantity']?> <?=$db['satuan']?></H1></td> -->
                            <!-- <td><?=$db['disc']?></td>
                            <?php $subtotal = $db['harga_jual'] - ($db['harga_jual']*$db['disc']/100);?>
                            <td>IDR <?=number_format($subtotal*$db['quantity'],0,'','.')?></td>
                          </tr> -->
                        <?php endforeach?>
                        </tbody>
                      </table>
                    </div> 
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <div class="row">
                    <!-- accepted payments column -->
                    <!-- <div class="col-6 text-center">
                        <img src="<?=base_url('assets/qr_code/')?><?=$data[0]['no_faktur']?>.png" alt="" width=150 class="">
                    </div> -->
                    
                    
                    
                    <!-- /.col -->
                    
                    <!-- TEST PRINTER 1 -->
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                              
                        <!-- <tr>
                            <th><H1>Tgl</H1></th>
                            <td><H1><?= date('d/m/Y', strtotime($data[0]['created']))?></H1></td>
                          </tr>  
                              
                        <tr>
                            <th><H1>No Invoice</STRONG</STRONG</H1></th>
                            <td><H1><?=$data[0]['no_faktur']?></H1></td>
                          </tr> --> 
                              
                          <!--  <tr>
                            <th><H1>No.  </H1></th> </H4>
                            <td><H1><?=$i++?></H1></td>
                          </tr>
                          
                          <tr>
                            <th><H1>Product</H1></th>
                            <td><H1><?=$db['item']?> <?=$db['paket']?':<br>'.$db['paket']:''?></H1></td>
                          </tr>  
                          
                          
                          <tr>
                            <th><H1>Qty</H1></th>
                            <td><H1><?=$db['quantity']?> <?=$db['satuan']?></H1></td>
                          </tr>  
                          
                           <tr>
                            <th><H1>Harga</H1></th>
                            <td><H1>IDR <?=number_format($db['harga_jual'],0,'','.')?></H1></td>
                          </tr>  -->
                              
                            <!-- <tr>
                            <th style="width:50%">TOTAL GROSS (IDR) :</th>
                            <td><?=number_format($data[0]['total_gross'],0,'','.')?></td>
                          </tr> -->
                          
                          
                         <!-- <tr>
                            <th><H1>DISKON (%) : </H1></th>
                            <td><H1><?=$data[0]['diskon']?></H1></td>
                          </tr>
                          <tr>
                            <th><H1>DISKON (IDR) : </H1></th>
                            <td><H1><?=number_format($data[0]['diskon_idr'],0,'','.')??0?></H1></td>
                          </tr>
                          <tr>
                            <th><H1>SUB TOTAL (IDR) : </H1></th>
                            <td><H1><?=number_format($data[0]['subtotal'],0,'','.')??0?></H1></td>
                          </tr> -->
                          
                          
                          <!-- <tr>
                            <th>PPN 10% (IDR) : </H1></th>
                            <td><?//=number_format($data[0]['ppn'],0,'','.')??0?></H1></td>
                          </tr> -->
                         <!-- <tr>
                            <th><H1>TOTAL TAGIHAN (IDR) : </H1></th>
                            <td><H1><?=number_format($data[0]['total_tagihan'],0,'','.')?></H1></td>
                          </tr>
                          <tr>
                            <th><H1>TOTAL BAYAR (IDR) : </H1></th>
                            <td><H1><?=number_format($data[0]['total_bayar'],0,'','.')?></H1></td>
                          </tr>
                          <tr>
                            <th><H1>KEMBALIAN (IDR) : </H1></th>
                            <td><H1><?=number_format(($data[0]['total_bayar']-$data[0]['total_tagihan']),0,'','.')??0?></H1></td>
                          </tr> -->
                          
                          <tr>
                            <!-- <th><H1>QR Code</th> 
                            <td><img src="<?=base_url('assets/qr_code/')?><?=$data[0]['no_faktur']?>.png" alt="" width=500 class=""></td>
                          </tr> -->
                          
                        </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  
                  
                  <!-- TEST PRINTER2 -->
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                              
                        <tr>
                            <th><H1><p style="font-size:60px">Total Tagihan</H1></th>
                            <td><H1><p style="font-size:60px">IDR <?=number_format($data[0]['total_gross'],0,'','.')?></H1></td>
                          </tr>
                          <tr>
                            <th><H1><p style="font-size:60px">Total Bayar</H1></th>
                            <td><H1><p style="font-size:60px">IDR <?=number_format($data[0]['total_bayar'],0,'','.')?></H1></td>
                          </tr>
                          <tr>
                            <th><H1><p style="font-size:60px">Kembalian</H1></th>
                            <td><H1><p style="font-size:60px">IDR <?=number_format(($data[0]['total_bayar']-$data[0]['total_gross']),0,'','.')??0?></H1></td>
                          </tr>
                         
                          
                          </tbody>
                        </table>
                      </div>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                    </div>
                    
                    <div class="row justify-content-center">
                    <?php $i=1; foreach($data as $dd) :?>
                      <?php if($dd['jenis_barang'] == 'jasa') { ?>
                        <?php for($i=0; $i<$dd['quantity']; $i++) { ?>
                        <div class="col-sm-12 ">
                          <h1 class="text-center"><?= $dd['item'] ?> </h1>  
                          <h2 class="text-center">QR <?= $i + 1 ?></h2> 
                          <div class="row justify-content-center">
                            <img src="<?=base_url('assets/qr_code/')?><?=$data[0]['no_faktur']?>-<?=$dd['id']?>-<?= $i ?>.png" alt="" width=500 class="">
                          </div> 
                        </div> 
                        <br>
                        <br>
                    ______________________________________________________________________________________________________________________________________________________________________________
                          <br>
                          <br>
                          <br>
                        <?php } ?>
                      <?php } ?>  
                    <?php endforeach ?>          
                    </div>
                              
                              
                  <!-- /.row -->
            
                  <!-- this row will not appear when printing -->
            </div>
   
    <!-- <script src="https://cdn.jsdelivr.net/npm/recta/dist/recta.js"></script>
   <script type="text/javascript">
   var data = <?//=json_encode($data)?>;
   console.log(data);
     var printer = new Recta('010203040506070809', '1811')
   
     function onClick () {
       printer.open().then(function () {
         printer.align('center')
           .text('Pro-Archery').bold(true)
           .text('------------------------')

           for(var i =0; i<data.length; i++){
              printer.align('left').text(``+data[i].item+`' '`+data[i].paket??'')
              .align('left').text(``+data[i].harga_jual+`' x '`+data[i].quantity+`' Disc.'`+data[i].disc)
           }
            printer.text('------------------------')
           .align('right')
           .text('Total Tagihan : '+data[0].total_tagihan)
           .text('Total Bayar : '+data[0].total_bayar)
           .cut()
           .print()
       })
     }

     function name() {
       alert("MASUK");
     }
   </script> -->

    <script>
      window.print();
      // onClick();
      // name();
   </script>
</body>
</html>