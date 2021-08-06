<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Laporan <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

         <div class="white shadow r-15">
            <!-- <div class="card-header white"> -->
            <div class="row">
               <div class="col-sm-10">
                  <!-- <h6 class=""> LAPORAN <?=$judul?> </h6> -->
               </div>
            </div>
            <!-- </div> -->
            <div class="card-body">

               <div id="buttons2" style="padding: 10px; margin-bottom: 10px;width: 25%;">
                     <p>Download :</p>
               </div>
               <div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Jenis Barang</th>
                        <th>Gudang</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; foreach($barang_jual as $db): ?>
                        <tr>
                           <td><?=$i++?></td>
                           <td><?=$db['nama']?></td>
                           <td><?=$db['stok']?></td>
                           <td><?=$db['satuan']?></td>
                           <td>Jual</td>
                           <td><?=$db['gudang']?></td>
                        </tr>
                     <?php endforeach?>
                     <?php foreach($barang_mentah as $db): ?>
                        <tr>
                           <td><?=$i++?></td>
                           <td><?=$db['nama']?></td>
                           <td><?=$db['stok']?></td>
                           <td><?=$db['satuan']?></td>
                           <td>Mentah</td>
                           <td><?=$db['gudang']?></td>
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
    $(document).ready(function() {
        var table2 = $('#example2').DataTable();
        var buttons2 = new $.fn.dataTable.Buttons(table2, {
            buttons: [{
                extend: 'excelHtml5',
                title: 'Laporan Stok',
                text: '<i class="fas fa-file-excel"></i>&nbsp; EXCEL',
                className: 'btn btn-success btn-sm btn-corner',
                titleAttr: 'Download as Excel'
            },{
                extend: 'pdfHtml5',
                title: 'Laporan Stok',
                orientation: 'potrait',
                pageSize: 'A4',
                className: 'btn btn-danger btn-sm btn-corner',
                text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF',
                titleAttr: 'Download as PDF',
            }, ],
        }).container().appendTo($('#buttons2'));
    });
</script>
