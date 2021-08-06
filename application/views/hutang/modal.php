<div class="card">
   <div class="card-body">
      <div class="row my-3">
         <div class="col-12 table-responsive">
            <div class="table-responsive">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Product</th>
                     <th>Harga</th>
                     <th>Quantity</th>
                     <th>Subtotal</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i=1; foreach($data as $db) :?>
                     <tr>
                        <td><?=$i++?></td>
                        <td><?=$db['is_barang_jual'] == 1 ? $db['barang_jual'] : $db['barang_mentah']?></td>
                        <td>IDR <?=number_format($db['harga_beli'],0,'','.')?></td>
                        <td><?=$db['quantity']?> <?=$db['is_barang_jual'] == 1 ? $db['satuan_jual'] : $db['satuan_mentah']?></td>
                        <td>IDR <?=number_format($db['harga_beli']*$db['quantity'],0,'','.')?></td>
                     </tr>
                  <?php endforeach?>
               </tbody>
            </table>
            </div>
         </div>
         <!-- /.col -->
      </div>
   </div>
</div>