<div class="card">
   <div class="card-body">
      <div class="row my-3">
         <div class="col-12 table-responsive">
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
                  <td><?=$db['item']?> <?=$db['paket']?':<br>'.$db['paket']:''?></td>
                  <td>IDR <?=number_format($db['harga_jual'],0,'','.')?></td>
                  <td><?=$db['quantity']?> <?=$db['satuan']?></td>
                  <td>IDR <?=number_format($db['harga_jual']*$db['quantity'],0,'','.')?></td>
               </tr>
            <?php endforeach?>
            </tbody>
            </table>
         </div>
         <!-- /.col -->
      </div>
   </div>
</div>