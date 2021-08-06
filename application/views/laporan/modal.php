<div class="card">
   <div class="card-body">
      <div class="row my-3">
         <div class="col-12 table-responsive">
         <table id="example3" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
            <thead>
            <tr>
               <th>No</th>
               <th>Nama Produk</th>
               <th>Item Terjual</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($data as $db) :?>
               <tr>
                  <td><?=$i++?></td>
                  <td><?=$db['nama']?></td>
                  <td><?=$db['qty']?> <?=$db['satuan']?></td>
               </tr>
            <?php endforeach?>
            </tbody>
            </table>
         </div>
         <!-- /.col -->
      </div>
   </div>
</div>

<script>
$(document).ready(function() {
      $('#example3').DataTable();
});
</script>