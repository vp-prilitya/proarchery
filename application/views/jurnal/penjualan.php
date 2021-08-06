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
                     <h5 class="text-white text-bold"><strong>Daftar <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

         <div class="white shadow r-15">
            <!-- <div class="card-header white"> -->
            <div class="row">
               <div class="col-sm-10">
                  <!-- <h6 class=""> Daftar <?=$judul?> </h6> -->
               </div>
               <div class="col">
                  <!-- <a href="<?=base_url('jurnal/create')?>" class="btn btn-primary btn-xs float-right mt-5 mr-5"><i class="icon-plus"></i> Tambah</a> -->
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
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; $tgl = ''; $desc=''; foreach($data as $db):?>
                        <?php if($tgl !== $db['created'] OR $desc !== $db['rincian']):?>
                        <tr>
                           <td><?=$db['created']?></td>
                           <td><?=$db['rincian']?></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <?php endif?>
                        <tr>
                           <td></td>
                           <td><?=$db['kode']?> - <?=$db['nama']?></td>
                           <td><?=$db['debit']==0?'':number_format($db['debit'],2,'.',',')?></td>
                           <td><?=$db['kredit']==0?'':number_format($db['kredit'],2,'.',',')?></td>
                        </tr>
                        <!-- <?php if($i !== 1 AND $tgl !== $db['created']):?>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                        <?php endif?> -->
                     <?php $desc=$db['rincian']; $tgl=$db['created']; $i++; endforeach?>
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
                title: 'Jurnal Penjualan ' + dari + ' s.d ' + sampai,
                text: 'EXCEL',
                className: 'btn btn-success btn-sm btn-corner',
                titleAttr: 'Download as Excel'
            },{
                extend: 'pdfHtml5',
                title: 'Jurnal Penjualan ' + dari + ' s.d ' + sampai,
                orientation: 'potrait',
                pageSize: 'A4',
                className: 'btn btn-danger btn-sm btn-corner',
                text: 'PDF',
                titleAttr: 'Download as PDF',
            }, ],
        }).container().appendTo($('#buttons2'));
    });
</script>