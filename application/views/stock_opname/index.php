<div class="container-fluid animatedParent animateOnce my-3">
      <div class="animated fadeInUpShort">
         <form action="<?=base_url('stock_opname/save')?>" method="post">
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
                  <!-- <div class="col">
                     <a href="<?=base_url('divisi/create')?>" class="btn btn-primary btn-xs float-right mt-5 mr-5"><i class="icon-plus"></i> Tambah</a>
                  </div> -->
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
                           <th>Satuan</th>
                           <th>Stok</th>
                           <th>Actual</th>
                           <th>Gudang</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $i=1; foreach($data as $db):?>
                           <tr>
                              <td><?=$i++?></td>
                              <td><?=$db['nama']?></td>
                              <td><?=$db['satuan']?></td>
                              <td><?=$db['stok']?></td>
                              <td>
                                 <input type="text" name="qty<?=$db['id']?>" id="qty<?=$db['id']?>" class="form-control">
                                 <input type="hidden" name="id[]" id="id" class="form-control" value="<?=$db['id']?>">
                              </td>
                              <td><?=$db['gudang']?></td>
                           </tr>
                        <?php endforeach?>
                        <?php foreach($barang_mentah as $db):?>
                           <tr>
                              <td><?=$i++?></td>
                              <td><?=$db['nama']?></td>
                              <td><?=$db['satuan']?></td>
                              <td><?=$db['stok']?></td>
                              <td>
                                 <input type="text" name="qtyRaw<?=$db['id']?>" id="qtyRaw<?=$db['id']?>" class="form-control">
                                 <input type="hidden" name="idRaw[]" id="idRaw" class="form-control" value="<?=$db['id']?>">
                              </td>
                              <td><?=$db['gudang']?></td>
                           </tr>
                        <?php endforeach?>
                     </tbody>
                  </table>
                  </div>
               </div>
            </div>

         </div>

         <div class="row mt-3">
            <div class="col-sm-12">
               <div class="white shadow r-15">
                  <div class="card-body">
                     <div class="text-right">
                              <a href="<?=base_url('stock_opname')?>" class="btn btn-danger">Batal</a>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                           </form>
                     </div>
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