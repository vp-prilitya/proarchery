<div class="card">
   <div class="card-body">
      <div class="row my-3">
         <div class="col-12 table-responsive">
         <table id="example3" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
            <thead>
            <tr>
               <th>No</th>
               <th>No Pesanan Penjualan</th>
               <th>No Pengiriman Penjualan</th>
               <th>Total Tagihan</th>
               <th>Jatuh Tempo</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($data as $db) :?>
            <?php if($db['tgl_jatuh_tempo'] <= date('Y-m-d')) {
                        $style = 'background-color:#d92550; color:white';
                     } else {
                        $diff = strtotime(date('Y-m-d')) - strtotime($db['tgl_jatuh_tempo']);
                        if(floor($diff / (60 * 60 * 24)) >= -7){
                           $style = 'background-color:#faf800; color:black';
                        } else {
                           $style = 'background-color:none';
                        }
                     }
               ?>
               <tr style="<?=$style?>">
                  <td><?=$i++?></td>
                  <td><?=$db['so']?></td>
                  <td><?=$db['sj']?></td>
                  <td>IDR <?=number_format($db['total_tagihan'],0,'','.')?></td>
                  <td><?=$db['tgl_jatuh_tempo']?></td>
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