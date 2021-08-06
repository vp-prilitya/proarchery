<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

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
               <div class="col-sm-6">
                  <!-- <h6 class=""> Daftar <?=$judul?> </h6> -->
               </div>
               <div class="col">
                  <a href="<?=base_url('arena/createPanahan')?>" class="btn btn-primary btn-xs float-right mt-5 mr-5"><i class="icon-plus"></i> Tambah</a>
                  <!-- <a href="<?//=base_url('arena/set_rule')?>" class="btn btn-warning btn-xs float-right mt-5 mr-2"><i class="icon-plus"></i> Pengaturan Umum</a> -->
               </div>
            <!-- </div> -->
            </div>
            <div class="card-body">
               <!-- <div id="buttons2" style="padding: 10px; margin-bottom: 10px;width: 25%;">
                     <p>Download :</p>
               </div> -->
               <div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Bantalan</th>
                        <th>Kapasitas/Bantalan</th>
                        <th>Kapasitas Maks</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; foreach($data as $db):?>
                        <tr>
                           <td><?=$i++?></td>
                           <td><?=$db['nama']?></td>
                           <td><?=$db['jumlah']?></td>
                           <td><?=$db['kapasitas']?></td>
                           <td><?=$db['kapasitas_maks']?></td>
                           <td>
                              <a href="<?=base_url('arena/settingPanahan/')?><?=$db['id']?>" class="btn btn-warning btn-xs"><i class="icon-edit"></i> Atur Jadwal</a>
                              <a href="<?=base_url('arena/editPanahan/')?><?=$db['id']?>" class="btn btn-warning btn-xs"><i class="icon-edit"></i> Ubah</a>
                              <a href="<?=base_url('arena/deletePanahan/')?><?=$db['id']?>" class="btn btn-danger btn-xs tombol-hapus" ><i class="icon-delete_forever"></i> Hapus</a>
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
   //  $(document).ready(function() {
   //      // $('#example').DataTable({
   //      //     dom: 'Bfrtip',
   //      //     buttons: [
   //      //         'excel', 'pdf'
   //      //     ]
   //      // });
   //      var table2 = $('#example2').DataTable();
   //      var buttons2 = new $.fn.dataTable.Buttons(table2, {
   //          buttons: [{
   //              extend: 'excelHtml5',
   //              title: 'Daftar Siswa',
   //              text: '<i class="fas fa-file-excel"></i>&nbsp; EXCEL',
   //              className: 'btn btn-success btn-sm btn-corner',
   //              titleAttr: 'Download as Excel'
   //          },{
   //              extend: 'pdfHtml5',
   //              title: 'Daftar Siswa',
   //              orientation: 'potrait',
   //              pageSize: 'A4',
   //              className: 'btn btn-danger btn-sm btn-corner',
   //              text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF',
   //              titleAttr: 'Download as PDF',
   //          }, ],
   //      }).container().appendTo($('#buttons2'));
   //  });
</script>