<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row mb-3">
         <div class="col-sm-12">
            <div class="white shadow r-15">
               <div class="card-title gradient p-3 r-15" ><h5 class="text-white "><strong>Pilih Periode</strong></h5></div>
               <div class="card-body">
                  <form action="" method="">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="dari">Dari Tanggal</label>
                           <input type="text" class="date-time-picker form-control" value="<?=$dari?>" data-options='{"timepicker":false, "format":"Y-m-d"}' name="dari" id="dari"/>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="sampai">Sampai Tanggal</label>
                           <input type="text" class="date-time-picker form-control" value="<?=$sampai?>" data-options='{"timepicker":false, "format":"Y-m-d"}' name="sampai" id="sampai"/>
                        </div>
                     </div>
                     <div class="col-sm-3 pt-4">
                        <div class="form-group">
                           <label for="no_faktur"></label>
                           <button type="submit" class="btn btn-success">Tampilkan</button>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
        </div>

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong><?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

         <div class="white shadow r-15">
            <!-- <div class="card-header white"> -->
            <div class="row">
               <div class="col-sm-10">
                  <!-- <h6 class=""><?=$judul?> </h6> -->
               </div>
            </div>
            <!-- </div> -->
            <div class="card-body">
               
               <div id="buttons2" style="padding: 10px; margin-bottom: 10px;width: 25%;">
                     <p>Download :</p>
               </div>
               <div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-hover ">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Rincian Transaksi</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $grandKredit = 0; $grandDebit = 0;?>
                     <?php if(isset($data)):?>
                        <tr class="bg-info">
                           <td></td>
                           <td></td>
                           <td><strong>&mdash; PENDAPATAN &mdash;</strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                     <?php endif?>

                     <?php foreach($pendapatan as $key => $db):?>
                        <?php $akun = explode('|', $key)?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong><?=$akun[0]?> - <?=$akun[1]?></strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        
                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; $saldo2=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                              $grandDebit += $db2['debit'];
                              $grandKredit += $db2['kredit'];
                              $saldo = $saldo + $db2['debit'] - $db2['kredit'];
                              $saldo2 = $saldo>0?number_format($saldo, 0, '', ','):"(".str_replace("-", "", number_format($saldo,0,'',',')).")";
                        ?>
                           <tr>
                              <td><?=$i++?></td>
                              <td><?=$db2['created']?></td>
                              <td><?=$db2['rincian']?></td>
                              <td><?=number_format($db2['debit'], 0, '', ',')?></td>
                              <td><?=number_format($db2['kredit'], 0, '', ',')?></td>
                              <td><?=$saldo2?></td>
                           </tr>
                        <?php endforeach?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong>Total</strong></td>
                           <td><strong><?=number_format($debit, 0, '', ',')?></strong></td>
                           <td><strong><?=number_format($kredit, 0, '', ',')?></strong></td>
                           <td><strong><?=$saldo2?></strong></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>

                     <?php endforeach?>

                     <?php if(isset($data)):?>
                        <tr class="bg-info">
                           <td></td>
                           <td></td>
                           <td><strong>&mdash; BEBAN &mdash;</strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                     <?php endif?>

                     <?php foreach($beban as $key => $db):?>
                        <?php $akun = explode('|', $key)?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong><?=$akun[0]?> - <?=$akun[1]?></strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        
                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; $saldo2=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                              $grandDebit += $db2['debit'];
                              $grandKredit += $db2['kredit'];
                              $saldo = $saldo + $db2['debit'] - $db2['kredit'];
                              $saldo2 = $saldo>0?number_format($saldo, 0, '', ','):"(".str_replace("-", "", number_format($saldo,0,'',',')).")";
                        ?>
                           <tr>
                              <td><?=$i++?></td>
                              <td><?=$db2['created']?></td>
                              <td><?=$db2['rincian']?></td>
                              <td><?=number_format($db2['debit'], 0, '', ',')?></td>
                              <td><?=number_format($db2['kredit'], 0, '', ',')?></td>
                              <td><?=$saldo2?></td>
                           </tr>
                        <?php endforeach?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong>Total</strong></td>
                           <td><strong><?=number_format($debit, 0, '', ',')?></strong></td>
                           <td><strong><?=number_format($kredit, 0, '', ',')?></strong></td>
                           <td><strong><?=$saldo2?></strong></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>

                     <?php endforeach?>

                     <?php if(isset($data)):?>
                        <tr class="bg-info">
                           <td></td>
                           <td></td>
                           <td><strong>&mdash; BEBAN UMUM &mdash;</strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                     <?php endif?>

                     <?php foreach($beban_umum as $key => $db):?>
                        <?php $akun = explode('|', $key)?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong><?=$akun[0]?> - <?=$akun[1]?></strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        
                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; $saldo2=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                              $grandDebit += $db2['debit'];
                              $grandKredit += $db2['kredit'];
                              $saldo = $saldo + $db2['debit'] - $db2['kredit'];
                              $saldo2 = $saldo>0?number_format($saldo, 0, '', ','):"(".str_replace("-", "", number_format($saldo,0,'',',')).")";
                        ?>
                           <tr>
                              <td><?=$i++?></td>
                              <td><?=$db2['created']?></td>
                              <td><?=$db2['rincian']?></td>
                              <td><?=number_format($db2['debit'], 0, '', ',')?></td>
                              <td><?=number_format($db2['kredit'], 0, '', ',')?></td>
                              <td><?=$saldo2?></td>
                           </tr>
                        <?php endforeach?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong>Total</strong></td>
                           <td><strong><?=number_format($debit, 0, '', ',')?></strong></td>
                           <td><strong><?=number_format($kredit, 0, '', ',')?></strong></td>
                           <td><strong><?=$saldo2?></strong></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>

                     <?php endforeach?>

                     <?php if(isset($data)):?>
                        <tr class="bg-info">
                           <td></td>
                           <td></td>
                           <td><strong>&mdash; PENDAPATAN LAIN-LAIN &mdash;</strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                     <?php endif?>

                     <?php foreach($pendapatan_lain as $key => $db):?>
                        <?php $akun = explode('|', $key)?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong><?=$akun[0]?> - <?=$akun[1]?></strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        
                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; $saldo2=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                              $grandDebit += $db2['debit'];
                              $grandKredit += $db2['kredit'];
                              $saldo = $saldo + $db2['debit'] - $db2['kredit'];
                              $saldo2 = $saldo>0?number_format($saldo, 0, '', ','):"(".str_replace("-", "", number_format($saldo,0,'',',')).")";
                        ?>
                           <tr>
                              <td><?=$i++?></td>
                              <td><?=$db2['created']?></td>
                              <td><?=$db2['rincian']?></td>
                              <td><?=number_format($db2['debit'], 0, '', ',')?></td>
                              <td><?=number_format($db2['kredit'], 0, '', ',')?></td>
                              <td><?=$saldo2?></td>
                           </tr>
                        <?php endforeach?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong>Total</strong></td>
                           <td><strong><?=number_format($debit, 0, '', ',')?></strong></td>
                           <td><strong><?=number_format($kredit, 0, '', ',')?></strong></td>
                           <td><strong><?=$saldo2?></strong></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>

                     <?php endforeach?>
                     <?php if(isset($data)):?>
                        <tr class="bg-info">
                           <td></td>
                           <td></td>
                           <td><strong>&mdash; BEBAN LAIN-LAIN &mdash;</strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                     <?php endif?>

                     <?php foreach($beban_lain as $key => $db):?>
                        <?php $akun = explode('|', $key)?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong><?=$akun[0]?> - <?=$akun[1]?></strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        
                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                              $grandDebit += $db2['debit'];
                              $grandKredit += $db2['kredit'];
                              $saldo = $saldo + $db2['debit'] - $db2['kredit'];
                              $saldo2 = $saldo>0?number_format($saldo, 0, '', ','):"(".str_replace("-", "", number_format($saldo,0,'',',')).")";
                        ?>
                           <tr>
                              <td><?=$i++?></td>
                              <td><?=$db2['created']?></td>
                              <td><?=$db2['rincian']?></td>
                              <td><?=number_format($db2['debit'], 0, '', ',')?></td>
                              <td><?=number_format($db2['kredit'], 0, '', ',')?></td>
                              <td><?=$saldo2?></td>
                           </tr>
                        <?php endforeach?>
                        <tr>
                           <td></td>
                           <td></td>
                           <td><strong>Total</strong></td>
                           <td><strong><?=number_format($debit, 0, '', ',')?></strong></td>
                           <td><strong><?=number_format($kredit, 0, '', ',')?></strong></td>
                           <td><strong><?=$saldo2?></strong></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>

                     <?php endforeach?>

                     <tr>
                        <td></td>
                        <td></td>
                        <td><strong>&mdash; TOTAL KESELURUHAN &mdash;</strong></td>
                        <td><?=number_format($grandDebit, 0, '', ',')?></td>
                        <td><?=number_format($grandKredit, 0, '', ',')?></td>
                        <td><?= number_format(abs($grandDebit - $grandKredit), 0, '', ',')?></td>
                     </tr>
                  </tbody>
               </table>
               </div>
            </div>
         </div>

        </div>
    </div>















    
</div>

<script>
   var dari = <?=json_encode($dari)?>;
   var sampai = <?=json_encode($sampai)?>;
    $(document).ready(function() {
        var table2 = $('#example2').DataTable({ "paging": false, "ordering":false});
        var buttons2 = new $.fn.dataTable.Buttons(table2, {
            buttons: [{
                extend: 'excelHtml5',
                title: 'Laba Rugi ' + dari + ' s.d ' + sampai,
                text: '<i class="fas fa-file-excel"></i>&nbsp; EXCEL',
                className: 'btn btn-success btn-sm btn-corner',
                titleAttr: 'Download as Excel'
            },{
                extend: 'pdfHtml5',
                title: 'Laba Rugi ' + dari + ' s.d ' + sampai,
                orientation: 'potrait',
                pageSize: 'A4',
                className: 'btn btn-danger btn-sm btn-corner',
                text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF',
                titleAttr: 'Download as PDF',
            }, ],
        }).container().appendTo($('#buttons2'));
    });
</script>