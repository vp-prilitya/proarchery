<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <form action="" method="">
        <div class="row mb-3">
         <div class="col-sm-12">
            <div class="white shadow r-15">
               <div class="card-title gradient p-3 r-15" ><h5 class="text-white "><strong>Pilih Periode</strong></h5></div>
               <div class="card-body">
                  
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
               <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" name="checkAll" id="checkAll" checked>
                  <label for="">Pilih Semua</label>
               </div>
               <table id="example2" class="table table-condensed table-bordered table-striped ">
                  <thead>
                     <tr>
                        <th>Aksi</th>
                        <th>Kode</th>
                        <th>Akun</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Mutasi</th>
                        <th>Saldo Akhir Debit</th>
                        <th>Saldo Akhir Kredit</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $totalDebit = 0; $totalKredit = 0; $totalDebitAkhir = 0; $totalKreditAkhir = 0; $collapse = '';?>

                     <?php 
                        // $no=1; $dataHarta = []; $keybefore=''; foreach($harta as $key => $db):
                        // $dataHarta[$key] = $db;
                        // $akun = explode('|', $key);

                        // if($akun[2] !== ''){
                        //    foreach ($db as $dt) {
                        //       array_push($dataHarta[$keybefore], $dt);
                        //    }
                        // } else {
                        //    $keybefore=$key;
                        // }
                     ?>
                     <?//php endforeach; var_dump($dataHarta); die;?>

                     <?php $no=1; foreach($harta as $key => $db):?>
                        <?php $akun=explode('|',$key);?>

                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                        ?>
                        <?php endforeach?>

                        <?php $mutasi = $debit-$kredit;?>
                        <?php if($akun[2] !== '') : ?>
                           <tr class="collapse" id="harta<?=$collapse?>">
                              <td></td>
                              <td><?=$akun[0]?></td>
                              <td><strong><?=$akun[1]?></strong></td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php else :?>
                           <?php 
                              $totalDebit += $debit; $totalKredit += $kredit;
                              $mutasi > 0 ? $totalDebitAkhir += $mutasi : null;   
                              $mutasi < 0 ? $totalKreditAkhir += abs($mutasi) : null;
                           ?>
                           <?php $collapse = $no++;?>
                           <tr>
                              <td>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$akun[0]?>" name="akun_id[]" id="akun<?=$akun[0]?>" checked>
                                 </div>
                              </td>
                              <td><?=$akun[0]?></td>
                              <td data-toggle="collapse" data-target="#harta<?=$collapse?>">
                                    <strong><?=$akun[1]?></strong>
                              </td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php endif?>

                     <?php endforeach?>

                     <?php $no=1; foreach($utang as $key => $db):?>
                        <?php $akun=explode('|',$key);?>

                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                        ?>
                        <?php endforeach?>

                        <?php $mutasi = $debit-$kredit;?>
                        <?php if($akun[2] !== '') : ?>
                           <tr class="collapse" id="utang<?=$collapse?>">
                              <td></td>
                              <td><?=$akun[0]?></td>
                              <td><strong><?=$akun[1]?></strong></td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php else :?>
                           <?php 
                              $totalDebit += $debit; $totalKredit += $kredit;
                              $mutasi > 0 ? $totalDebitAkhir += $mutasi : null;   
                              $mutasi < 0 ? $totalKreditAkhir += abs($mutasi) : null;
                           ?>
                           <?php $collapse = $no++;?>
                           <tr>
                              <td>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$akun[0]?>" name="akun_id[]" id="akun<?=$akun[0]?>" checked>
                                 </div>
                              </td>
                              <td><?=$akun[0]?></td>
                              <td data-toggle="collapse" data-target="#utang<?=$collapse?>">
                                    <strong><?=$akun[1]?></strong>
                              </td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php endif?>

                     <?php endforeach?>

                     <?php $no=1; foreach($modal as $key => $db):?>
                        <?php $akun=explode('|',$key);?>

                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                        ?>
                        <?php endforeach?>

                        <?php $mutasi = $debit-$kredit;?>
                        <?php if($akun[2] !== '') : ?>
                           <tr class="collapse" id="modal<?=$collapse?>">
                              <td></td>
                              <td><?=$akun[0]?></td>
                              <td><strong><?=$akun[1]?></strong></td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php else :?>
                           <?php 
                              $totalDebit += $debit; $totalKredit += $kredit;
                              $mutasi > 0 ? $totalDebitAkhir += $mutasi : null;   
                              $mutasi < 0 ? $totalKreditAkhir += abs($mutasi) : null;
                           ?>
                           <?php $collapse = $no++;?>
                           <tr >
                              <td>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$akun[0]?>" name="akun_id[]" id="akun<?=$akun[0]?>" checked>
                                 </div>
                              </td>
                              <td><?=$akun[0]?></td>
                              <td data-toggle="collapse" data-target="#modal<?=$collapse?>">
                                    <strong><?=$akun[1]?></strong>
                              </td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php endif?>

                     <?php endforeach?>

                     <?php $no=1; foreach($pendapatan as $key => $db):?>
                        <?php $akun=explode('|',$key);?>

                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                        ?>
                        <?php endforeach?>

                        <?php $mutasi = $debit-$kredit;?>
                        <?php if($akun[2] !== '') : ?>
                           <tr class="collapse" id="pendapatan<?=$collapse?>">
                              <td></td>
                              <td><?=$akun[0]?></td>
                              <td><strong><?=$akun[1]?></strong></td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php else :?>
                           <?php 
                              $totalDebit += $debit; $totalKredit += $kredit;
                              $mutasi > 0 ? $totalDebitAkhir += $mutasi : null;   
                              $mutasi < 0 ? $totalKreditAkhir += abs($mutasi) : null;
                           ?>
                           <?php $collapse = $no++;?>
                           <tr >
                              <td>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$akun[0]?>" name="akun_id[]" id="akun<?=$akun[0]?>" checked>
                                 </div>
                              </td>
                              <td><?=$akun[0]?></td>
                              <td data-toggle="collapse" data-target="#pendapatan<?=$collapse?>">
                                    <strong><?=$akun[1]?></strong>
                              </td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php endif?>

                     <?php endforeach?>

                     <?php $no=1; foreach($beban as $key => $db):?>
                        <?php $akun=explode('|',$key);?>

                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                        ?>
                        <?php endforeach?>

                        <?php $mutasi = $debit-$kredit;?>
                        <?php if($akun[2] !== '') : ?>
                           <tr class="collapse" id="beban<?=$collapse?>">
                              <td></td>
                              <td><?=$akun[0]?></td>
                              <td><strong><?=$akun[1]?></strong></td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php else :?>
                           <?php 
                              $totalDebit += $debit; $totalKredit += $kredit;
                              $mutasi > 0 ? $totalDebitAkhir += $mutasi : null;   
                              $mutasi < 0 ? $totalKreditAkhir += abs($mutasi) : null;
                           ?>
                           <?php $collapse = $no++;?>
                           <tr >
                              <td>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$akun[0]?>" name="akun_id[]" id="akun<?=$akun[0]?>" checked>
                                 </div>
                              </td>
                              <td><?=$akun[0]?></td>
                              <td data-toggle="collapse" data-target="#beban<?=$collapse?>">
                                    <strong><?=$akun[1]?></strong>
                              </td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php endif?>

                     <?php endforeach?>

                     <?php $no=1; foreach($beban_umum as $key => $db):?>
                        <?php $akun=explode('|',$key);?>

                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                        ?>
                        <?php endforeach?>

                        <?php $mutasi = $debit-$kredit; ?>
                        <?php if($akun[2] !== '') : ?>
                           <tr class="collapse" id="beban_umum<?=$collapse?>">
                              <td></td>
                              <td><?=$akun[0]?></td>
                              <td><strong><?=$akun[1]?></strong></td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php else :?>
                           <?php 
                              $totalDebit += $debit; $totalKredit += $kredit;
                              $mutasi > 0 ? $totalDebitAkhir += $mutasi : null;   
                              $mutasi < 0 ? $totalKreditAkhir += abs($mutasi) : null;
                           ?>
                           <?php $collapse = $no++;?>
                           <tr >
                              <td>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$akun[0]?>" name="akun_id[]" id="akun<?=$akun[0]?>" checked>
                                 </div>
                              </td>
                              <td><?=$akun[0]?></td>
                              <td data-toggle="collapse" data-target="#beban_umum<?=$collapse?>">
                                    <strong><?=$akun[1]?></strong>
                              </td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php endif?>

                     <?php endforeach?>

                     <?php $no=1; foreach($pendapatan_lain as $key => $db):?>
                        <?php $akun=explode('|',$key);?>

                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                        ?>
                        <?php endforeach?>

                        <?php $mutasi = $debit-$kredit;?>
                        <?php if($akun[2] !== '') : ?>
                           <tr class="collapse" id="pendapatan_lain<?=$collapse?>">
                              <td></td>
                              <td><?=$akun[0]?></td>
                              <td><strong><?=$akun[1]?></strong></td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php else :?>
                           <?php 
                              $totalDebit += $debit; $totalKredit += $kredit;
                              $mutasi > 0 ? $totalDebitAkhir += $mutasi : null;   
                              $mutasi < 0 ? $totalKreditAkhir += abs($mutasi) : null;
                           ?>
                           <?php $collapse = $no++;?>
                           <tr >
                              <td>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$akun[0]?>" name="akun_id[]" id="akun<?=$akun[0]?>" checked>
                                 </div>
                              </td>
                              <td><?=$akun[0]?></td>
                              <td data-toggle="collapse" data-target="#pendapatan_lain<?=$collapse?>">
                                    <strong><?=$akun[1]?></strong>
                              </td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php endif?>

                     <?php endforeach?>

                     <?php $no=1; foreach($beban_lain as $key => $db):?>
                        <?php $akun=explode('|',$key);?>

                        <?php $i=1; $saldo=0; $debit=0; $kredit=0; foreach($db as $db2):
                              $debit += $db2['debit'];
                              $kredit += $db2['kredit'];
                        ?>
                        <?php endforeach?>

                        <?php $mutasi = $debit-$kredit;?>
                        <?php if($akun[2] !== '') : ?>
                           <tr class="collapse" id="beban_lain<?=$collapse?>">
                              <td></td>
                              <td><?=$akun[0]?></td>
                              <td><strong><?=$akun[1]?></strong></td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php else :?>
                           <?php 
                              $totalDebit += $debit; $totalKredit += $kredit;
                              $mutasi > 0 ? $totalDebitAkhir += $mutasi : null;   
                              $mutasi < 0 ? $totalKreditAkhir += abs($mutasi) : null;
                           ?>
                           <?php $collapse = $no++;?>
                           <tr >
                              <td>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$akun[0]?>" name="akun_id[]" id="akun<?=$akun[0]?>" checked>
                                 </div>
                              </td>
                              <td><?=$akun[0]?></td>
                              <td data-toggle="collapse" data-target="#beban_lain<?=$collapse?>">
                                    <strong><?=$akun[1]?></strong>
                              </td>
                              <td><?=number_format($debit, 0, '', ',')?></td>
                              <td><?=number_format($kredit, 0, '', ',')?></td>
                              <td><?=number_format($mutasi, 0, '', ',')?></td>
                              <td><?= $mutasi > 0 ? number_format($mutasi, 0, '', ',') : 0?></td>
                              <td><?= $mutasi < 0 ? number_format(abs($mutasi), 0, '', ',') : 0?></td>
                           </tr>
                        <?php endif?>

                     <?php endforeach?>

                     <tr>
                        <td></td>
                        <td></td>
                        <td><strong>&mdash; TOTAL &mdash;</strong></td>
                        <td><?=number_format($totalDebit, 0, '', ',')?></td>
                        <td><?=number_format($totalKredit, 0, '', ',')?></td>
                        <td><?=number_format(0, 0, '', ',')?></td>
                        <td><?=  number_format($totalDebitAkhir, 0, '', ',')?></td>
                        <td><?= number_format(abs($totalKreditAkhir), 0, '', ',')?></td>
                     </tr>
                  </tbody>
               </table>
               </div>
            </div>
         </div>
         </form>
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
                title: 'Neraca ' + dari + ' s.d ' + sampai,
                text: 'EXCEL',
                className: 'btn btn-success btn-sm btn-corner',
                titleAttr: 'Download as Excel'
            },{
                extend: 'pdfHtml5',
                title: 'Neraca ' + dari + ' s.d ' + sampai,
                orientation: 'potrait',
                pageSize: 'A4',
                className: 'btn btn-danger btn-sm btn-corner',
                text: 'PDF',
                titleAttr: 'Download as PDF',
            }, ],
        }).container().appendTo($('#buttons2'));

        $("#checkAll").click(function(){
         $('input:checkbox').not(this).prop('checked', this.checked);
      });
    });
</script>