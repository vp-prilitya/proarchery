<div class="card">
   <div class="card-body">
      <div class="row my-3">
         <div class="col-12 table-responsive">
         <table id="example3" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
            <thead>
            <tr>
               <th>No</th>
               <th>Kuota</th>
               <th>Total Tagihan</th>
               <th>Tanggal Pembelian</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($data as $db) :?>
               <tr>
                  <td><?=$i++?></td>
                  <td><?=$db['qty']?></td>
                  <td>IDR <?=number_format($db['total_tagihan'],0,'','.')?></td>
                  <td><?=$db['tgl_bayar']?></td>
               </tr>
            <?php endforeach?>
            </tbody>
            </table>
         </div>
         <!-- /.col -->
      </div>

      <h5>Harap Segera Melalukan Tranfer sesuai dengan total tagihan anda ke rekeninh berikut : 12356789</h5>
   </div>
</div>

<script>
$(document).ready(function() {
      $('#example3').DataTable();
});
</script>