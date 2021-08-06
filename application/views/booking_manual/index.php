<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

         <div class="row mb-3">
         <div class="col-sm-12">
            <div class="white shadow r-15">
               <div class="card-title gradient p-3 r-15" ><h5 class="text-white "><strong>Pilih Periode <?=$judul?></strong></h5></div>
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
                     <div class="col-sm-3 pt-4 text-right">
                        <div class="form-group">
                           <label for="no_faktur"></label>
                           <!-- <button type="submit" class="btn btn-success">Tampilkan</button> -->
                           <a href="<?=base_url('booking/createManual')?>" class="btn btn-primary"><i class="icon-plus"></i> Booking</a>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
        </div>

         <div class="white shadow r-15">
            <!-- <div class="card-header white"> -->
            <div class="row">
               <div class="col-sm-10">
                  <!-- <h6 class=""> Daftar <?=$judul?> </h6> -->
                  <div class="card-title gradient pt-5 pl-4 r-15" ><h5 class="text-white "><strong>Jadwal Berkuda</strong></h5></div>
               </div>
               <div class="col">
                  <!-- <a href="<?=base_url('booking/createManual')?>" class="btn btn-primary btn-xs float-right mt-5 mr-5"><i class="icon-plus"></i> Booking</a> -->
               </div>
            <!-- </div> -->
            </div>
            <div class="card-body">
               <div id="buttons2" style="padding: 10px; margin-bottom: 10px;width: 25%;">
                     <p>Download :</p>
               </div>
               <div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>No Booking</th>
                        <th>Nama Pelanggan</th>
                        <th>Arena</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Nama Kuda</th>
                        <th>Nama Pelatih</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; foreach($data1 as $db):?>
                        <tr>
                           <td><?=$i++?></td>
                           <td><?=$db['no_booking']?></td>
                           <td><?=$db['nama']?></td>
                           <td><?=$db['arena']?></td>
                           <td><?=$db['tanggal']?></td>
                           <td><?=$db['jam']?></td>
                           <td><?=$db['kuda']?></td>
                           <td><?=$db['pelatih']?></td>
                           <td>
                                 <a href="<?=base_url('booking/deleteManual/')?><?=$db['id']?>" class="btn btn-danger btn-xs my-1 tombol-hapus" ><i class="icon-delete_forever"></i> Hapus</a>
                           </td>
                        </tr>
                     <?php endforeach?>
                  </tbody>
               </table>
               </div>
            </div>
         </div>

         <div class="white shadow r-15 mt-3">
            <!-- <div class="card-header white"> -->
            <div class="row">
               <div class="col-sm-10">
                  <!-- <h6 class=""> Daftar <?=$judul?> </h6> -->
                  <div class="card-title gradient pt-5 pl-4 r-15" ><h5 class="text-white "><strong>Jadwal Panahan</strong></h5></div>
               </div>
               <div class="col">
               </div>
            <!-- </div> -->
            </div>
            <div class="card-body">
               <div id="buttons3" style="padding: 10px; margin-bottom: 10px;width: 25%;">
                     <p>Download :</p>
               </div>
               <div class="table-responsive">
               <table id="example3" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>No Booking</th>
                        <th>Nama Pelanggan</th>
                        <th>Arena</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Nama Pelatih</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; foreach($data2 as $db):?>
                        <tr>
                           <td><?=$i++?></td>
                           <td><?=$db['no_booking']?></td>
                           <td><?=$db['nama']?></td>
                           <td><?=$db['arena']?></td>
                           <td><?=$db['tanggal']?></td>
                           <td><?=$db['jam']?></td>
                           <td><?=$db['pelatih']?></td>
                           <td>
                                 <a href="<?=base_url('booking/deleteManual/')?><?=$db['id']?>" class="btn btn-danger btn-xs my-1 tombol-hapus" ><i class="icon-delete_forever"></i> Hapus</a>
                           </td>
                        </tr>
                     <?php endforeach?>
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
        var table2 = $('#example2').DataTable();
        var buttons2 = new $.fn.dataTable.Buttons(table2, {
            buttons: [{
                extend: 'excelHtml5',
                title: 'Jadwal Latihan Berkuda ' + dari + ' s.d ' + sampai,
                text: 'EXCEL',
                className: 'btn btn-success btn-sm btn-corner',
                titleAttr: 'Download as Excel'
            },{
                extend: 'pdfHtml5',
                title: 'Jadwal Latihan Berkuda ' + dari + ' s.d ' + sampai,
                orientation: 'potrait',
                pageSize: 'A4',
                className: 'btn btn-danger btn-sm btn-corner',
                text: 'PDF',
                titleAttr: 'Download as PDF',
            }, ],
        }).container().appendTo($('#buttons2'));

        var table3 = $('#example3').DataTable();
        var buttons3 = new $.fn.dataTable.Buttons(table3, {
            buttons: [{
                extend: 'excelHtml5',
                title: 'Jadwal Latihan Panahan ' + dari + ' s.d ' + sampai,
                text: 'EXCEL',
                className: 'btn btn-success btn-sm btn-corner',
                titleAttr: 'Download as Excel'
            },{
                extend: 'pdfHtml5',
                title: 'Jadwal Latihan Panahan ' + dari + ' s.d ' + sampai,
                orientation: 'potrait',
                pageSize: 'A4',
                className: 'btn btn-danger btn-sm btn-corner',
                text: 'PDF',
                titleAttr: 'Download as PDF',
            }, ],
        }).container().appendTo($('#buttons3'));

    });
</script>