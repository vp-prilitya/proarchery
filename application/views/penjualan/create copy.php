<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

            <div class="row">
               <div class="col-sm-6">
                  <div class="white mb-3">
                     <div class="card-body">
                        <div class="form-group">
                           <input type="text" name="search" id="search" placeholder="Cari Item Produk" class="form-control" />
                           <ul class="list-group" id="result"></ul>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <?php foreach($data as $db):?>
                     <div class="col-sm-3">
                        <div class="white text-center p-4 mb-3">
                           <i class="icon-data_usage s-48"></i>
                           <h6 class="mt-3"><?=$db['nama']?></h6>
                           <button type="button" data-id='<?=$db['id']?>' data-raw='<?=$db['need_raw']?>' data-paket='<?=$db['is_paket']?>' class="btn btn-outline-success btn-xs r-30 mt-1"><i class="icon-plus"></i></button>
                        </div>
                     </div>
                     <?php endforeach?>
                  </div>

               </div>

               <div class="col-sm-6">
               <form action="<?=base_url('penjualan/save')?>" method="post" target="_blank">
                  <div class="white mb-3">
                     <div class="card-body">
                        <div class="form-group">
                           <input type="text" name="search_cust" id="search_cust" placeholder="Cari Nama Pelanggan" class="form-control" required/>
                           <input type="hidden" name="pelanggan_id" id="pelanggan_id" placeholder="Cari Nama Pelanggan" class="form-control" required/>
                           <ul class="list-group" id="result_cust"></ul>
                        </div>
                     </div>
                  </div>

                  <div class="white mb-3">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="example" class="table table-bordered table-striped table-hover">
                              <thead>
                                 <tr>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Aksi</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <!-- <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>
                                       <input type="text" class="form-control" id="quantityid" name="quantity[]" required>
                                       <input type="hidden" class="form-control" id="idid" name="id[]" required>
                                    </td>
                                    <td>
                                       <button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>
                                    </td>
                                 </tr> -->
                              </tbody>
                           </table>
                        </div>   
                     </div>
                  </div>

                  <div class="white mb-3">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table">
                              <tbody><tr>
                                 <th style="width:50%">TOTAL GROSS (IDR) :</th>
                                 <td><input type="text" name="total_gross" id="total_gross" class="form-control" readonly value=0 /></td>
                              </tr>
                              <tr>
                                 <th>DISKON (%) : </th>
                                 <td><input type="text" name="diskon" id="diskon" class="form-control" onkeyup="mydiskon(this.value)" value=0 /></td>
                              </tr>
                              <tr>
                                 <th>TOTAL TAGIHAN (IDR) : </th>
                                 <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value=0 /></td>
                              </tr>
                              <tr>
                                 <th>TOTAL BAYAR (IDR) : </th>
                                 <td><input type="text" name="total_bayar" id="total_bayar" class="form-control" required onkeyup="totalBayar(this.value)"/></td>
                              </tr>
                              <tr>
                                 <th>KEMBALIAN (IDR) :  </th>
                                 <td><input type="text" name="kembalian" id="kembalian" class="form-control" readonly /></td>
                              </tr>
                              </tbody>
                           </table>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        <a href="<?=base_url('penjualan/create')?>" class="btn btn-success mr-2 float-right">Buat Baru</a>
                        <a href="<?=base_url('penjualan')?>" class="btn btn-danger mr-2 float-right">Batal</a>
                        <p class="text-white">Lorem ipsum dolor sit amet .</p>
                     </div>
                  </div>
                  </form>
               </div>


            </div>

            <!-- <div class="row">
               <div class="col-sm-12">
                  <div class="white">
                     <div class="card-header white">
                        <h6>Tambah <?=$judul?></h6>
                     </div>
                     <div class="card-body">

                     <form action="<?=base_url('penjualan/save')?>" method="post" target="_blank">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="item">CARI ITEM</label>
                              <input type="text" name="search" id="search" placeholder="Cari Item Produk" class="form-control" />
                              <ul class="list-group" id="result"></ul>
                           </div>

                           <div class="table-responsive">
                                 <table id="example" class="table table-bordered table-striped table-hover">
                                    <thead>
                                       <tr>
                                          <th>Nama</th>
                                          <th>Satuan</th>
                                          <th>Harga</th>
                                          <th>Quantity</th>
                                          <th>Aksi</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>1</td>
                                          <td>1</td>
                                          <td>1</td>
                                          <td>
                                             <input type="text" class="form-control" id="quantityid" name="quantity[]" required>
                                             <input type="hidden" class="form-control" id="idid" name="id[]" required>
                                          </td>
                                          <td>
                                             <button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                        </div>

                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="search_cust">PELANGGAN</label>
                              <input type="text" name="search_cust" id="search_cust" placeholder="Cari Nama Pelanggan" class="form-control" required/>
                              <input type="hidden" name="pelanggan_id" id="pelanggan_id" placeholder="Cari Nama Pelanggan" class="form-control" required/>
                              <ul class="list-group" id="result_cust"></ul>
                           </div>

                           <div class="table-responsive">
                              <table class="table">
                                 <tbody><tr>
                                    <th style="width:50%">TOTAL GROSS (IDR) :</th>
                                    <td><input type="text" name="total_gross" id="total_gross" class="form-control" readonly value=0 /></td>
                                 </tr>
                                 <tr>
                                    <th>DISKON (%) : </th>
                                    <td><input type="text" name="diskon" id="diskon" class="form-control" onkeyup="mydiskon(this.value)" value=0 /></td>
                                 </tr>
                                 <tr>
                                    <th>TOTAL TAGIHAN (IDR) : </th>
                                    <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value=0 /></td>
                                 </tr>
                                 <tr>
                                    <th>TOTAL BAYAR (IDR) : </th>
                                    <td><input type="text" name="total_bayar" id="total_bayar" class="form-control" required onkeyup="totalBayar(this.value)"/></td>
                                 </tr>
                                 <tr>
                                    <th>KEMBALIAN (IDR) :  </th>
                                    <td><input type="text" name="kembalian" id="kembalian" class="form-control" readonly /></td>
                                 </tr>
                                 </tbody>
                              </table>
                           </div>

                           <button type="submit" class="btn btn-primary float-right">Simpan</button>
                           <a href="<?=base_url('penjualan/create')?>" class="btn btn-success mr-2 float-right">Buat Baru</a>
                           <a href="<?=base_url('penjualan')?>" class="btn btn-danger mr-2 float-right">Batal</a>
                           </form>
                        </div>
                     </div>

                     </div>
                  </div>
               </div>
            </div> -->

        </div>
    </div>















    
</div>

<script>

function rupiah(params) {
   var bilangan = params;
   
   var reverse = bilangan.toString().split('').reverse().join(''),
         ribuan 	= reverse.match(/\d{1,3}/g);
         ribuan	= ribuan.join('.').split('').reverse().join('');

   return ribuan;
}

function _subtotal() {
   var total = 0;
   $('input[name="subtotal[]"]').each(function() {
      total += parseInt(this.value);
   });
   $('#total_gross').val(rupiah(total));
   $('#total_tagihan').val(rupiah(total));
}

function quantity(id) {
   var hrg = $('#harga'+id).val().replace(/\./g,'') == '' ? 0 : $('#harga'+id).val().replace(/\./g,'');
   var qty = $('#quantity'+id).val();
   var total = (parseInt(qty) * parseInt(hrg));
   $('#subtotal'+id).val(total);
   _subtotal();
   
   var paket = $('#quantity'+id).data('paket');
   paket ? $('#quantityPaket'+id).val(qty) : null;
}

function mydiskon(value) {
   var disc = value / 100;
   var total_gross = $('#total_gross').val().replace(/\./g,'');
   var total = rupiah(total_gross - (total_gross*disc));
   $('#total_tagihan').val(total);
}

function totalBayar(value) {
   var total_tagihan = $('#total_tagihan').val().replace(/\./g,'');
   var total = rupiah(value - total_tagihan);
   value < total_tagihan ? total = '- ' + total : total;
   $('#kembalian').val(total);
}

$(document).ready(function(){
 $('#search').keyup(function(){
   $('#result').html('');
   var html = ``;
   var cari = $('#search').val();

   if(cari != ''){
      $.ajax({
         url:"<?= base_url('penjualan/getBarang')?>",
         type:"POST",
         dataType: 'json',
         data:{cari:cari},
         success:function(data){
            $.each(data, function (i, key) {
               var rupiah1 = rupiah(data[i].harga_jual);
               html += `<a href="javascript: void(0);"><li data-id='`+data[i].id+`' data-raw='`+data[i].need_raw+`' data-paket='`+data[i].is_paket+`' class="list-group-item link-class"><span class="text-muted">`+data[i].nama+` | `+data[i].satuan+` | Stok `+data[i].stok+` | Harga `+rupiah1+`</span></li></a>`;
            });

            $('#result').append(html);
         }
      });
   }
 });
 
 $('#result').on('click', 'li', function() {
   var item = $(this).text().split('|');
   var nama = item[0];
   var id = $(this).data('id');
   var paket = $(this).data('paket');
   var raw = $(this).data('raw');

   showTable(id, nama, raw, paket, item);

   
   // var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>`;

   // if(raw == 1 && paket == 0){
   //    var quantity = `<input type="number" class="form-control" id="quantityRaw`+id+`" name="quantityRaw[]" required onkeyup="quantity('Raw`+id+`')" />
   //                <input type="hidden" class="form-control" id="idRaw`+id+`" name="idRaw[]" required value="`+id+`"/>
   //                <input type="hidden" class="form-control" id="hargaRaw`+id+`" name="hargaRaw[]" required value="`+item[3].replace(" Harga ", "")+`"/>
   //                <input type="hidden" class="form-control" id="subtotalRaw`+id+`" name="subtotal[]" required value=0 />`;
   // } 
   
   // if(raw == 0 && paket == 0){
   //    var quantity = `<input type="number" class="form-control" id="quantity`+id+`" name="quantity[]" required onkeyup="quantity(`+id+`)"/>
   //                <input type="hidden" class="form-control" id="id`+id+`" name="id[]" required value="`+id+`"/>
   //                <input type="hidden" class="form-control" id="harga`+id+`" name="harga[]" required value="`+item[3].replace(" Harga ", "")+`"/>
   //                <input type="hidden" class="form-control" id="subtotal`+id+`" name="subtotal[]" required value=0 />`;
   // }
   
   // if(raw == 0 && paket == 1){
   //    var quantity = `<input type="number" class="form-control" id="quantity`+id+`" data-paket=1 name="quantity[]" required onkeyup="quantity(`+id+`)"/>
   //                <input type="hidden" class="form-control" id="id`+id+`" name="id[]" required value="`+id+`"/>
   //                <input type="hidden" class="form-control" id="harga`+id+`" name="harga[]" required value="`+item[3].replace(" Harga ", "")+`"/>
   //                <input type="hidden" class="form-control" id="subtotal`+id+`" name="subtotal[]" required value=0 />
   //                <input type="hidden" class="form-control" id="quantityPaket`+id+`" name="quantityPaket`+id+`" required />`;
   // }

   // if(paket == 1){
   //       $.ajax({
   //          url:"<?= base_url('penjualan/getBarangDetail')?>",
   //          type:"POST",
   //          dataType: 'json',
   //          data:{id:id},
   //          success:function(data){
   //             nama += `( `;
   //             nama += `<input type="hidden" class="form-control" id="idPaket`+id+`" name="idPaket[]" required value="`+id+`" />`;
   //             $.each(data, function (i, key) {
   //                nama += data[i].paket + ` @ `+ data[i].quantity +` `+ data[i].p_satuan +` || `;
   //                // nama += `<input type="hidden" class="form-control" id="barangJualId`+id+`" name="barangJualId[]" required value="`+data[i].barang_id+`">`;
   //                // nama += `<input type="hidden" class="form-control" id="quantityBarangJualId`+id+`" name="quantityBarangJualId[]" required value="`+data[i].quantity+`">`;
   //                nama += `<input type="hidden" class="form-control" id="barangJualId`+id+`" name="barangJualId`+id+`[]" required value="`+data[i].barang_id+`"/>`;
   //                nama += `<input type="hidden" class="form-control" id="quantityBarangJualId`+id+`" name="quantityBarangJualId`+id+`[]" required value="`+data[i].quantity+`" />`;
   //                nama += `<input type="hidden" class="form-control" id="need_raw`+data[i].barang_id+`" name="need_raw`+data[i].barang_id+`" required value="`+data[i].need_raw+`" />`;
   //             });
   //             nama += ' )';

   //             table.row.add([
   //                nama,
   //                item[1],
   //                item[3].replace("Harga", ""),
   //                quantity,
   //                aksi
   //             ]);
   //             table.draw();
   //          }
   //       });

   // } else {
   //    table.row.add([
   //       nama,
   //       item[1],
   //       item[3].replace("Harga", ""),
   //       quantity,
   //       aksi
   //    ]);
   //    table.draw();
   // }

   // $('#search').val('');
   // $("#result").html('');
 });

 function showTable(id, nama, raw, paket, item) {
   var item = item;
   var nama = nama;
   var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>`;

   if(raw == 1 && paket == 0){
      var quantity = `<input type="number" class="form-control" id="quantityRaw`+id+`" name="quantityRaw[]" required onkeyup="quantity('Raw`+id+`')" />
                  <input type="hidden" class="form-control" id="idRaw`+id+`" name="idRaw[]" required value="`+id+`"/>
                  <input type="hidden" class="form-control" id="hargaRaw`+id+`" name="hargaRaw[]" required value="`+item[3].replace(" Harga ", "")+`"/>
                  <input type="hidden" class="form-control" id="subtotalRaw`+id+`" name="subtotal[]" required value=0 />`;
   } 

   if(raw == 0 && paket == 0){
      var quantity = `<input type="number" class="form-control" id="quantity`+id+`" name="quantity[]" required onkeyup="quantity(`+id+`)"/>
                  <input type="hidden" class="form-control" id="id`+id+`" name="id[]" required value="`+id+`"/>
                  <input type="hidden" class="form-control" id="harga`+id+`" name="harga[]" required value="`+item[3].replace(" Harga ", "")+`"/>
                  <input type="hidden" class="form-control" id="subtotal`+id+`" name="subtotal[]" required value=0 />`;
   }

   if(raw == 0 && paket == 1){
      var quantity = `<input type="number" class="form-control" id="quantity`+id+`" data-paket=1 name="quantity[]" required onkeyup="quantity(`+id+`)"/>
                  <input type="hidden" class="form-control" id="id`+id+`" name="id[]" required value="`+id+`"/>
                  <input type="hidden" class="form-control" id="harga`+id+`" name="harga[]" required value="`+item[3].replace(" Harga ", "")+`"/>
                  <input type="hidden" class="form-control" id="subtotal`+id+`" name="subtotal[]" required value=0 />
                  <input type="hidden" class="form-control" id="quantityPaket`+id+`" name="quantityPaket`+id+`" required />`;
   }

   if(paket == 1){
         $.ajax({
            url:"<?= base_url('penjualan/getBarangDetail')?>",
            type:"POST",
            dataType: 'json',
            data:{id:id},
            success:function(data){
               nama += `( `;
               nama += `<input type="hidden" class="form-control" id="idPaket`+id+`" name="idPaket[]" required value="`+id+`" />`;
               $.each(data, function (i, key) {
                  nama += data[i].paket + ` @ `+ data[i].quantity +` `+ data[i].p_satuan +` || `;
                  // nama += `<input type="hidden" class="form-control" id="barangJualId`+id+`" name="barangJualId[]" required value="`+data[i].barang_id+`">`;
                  // nama += `<input type="hidden" class="form-control" id="quantityBarangJualId`+id+`" name="quantityBarangJualId[]" required value="`+data[i].quantity+`">`;
                  nama += `<input type="hidden" class="form-control" id="barangJualId`+id+`" name="barangJualId`+id+`[]" required value="`+data[i].barang_id+`"/>`;
                  nama += `<input type="hidden" class="form-control" id="quantityBarangJualId`+id+`" name="quantityBarangJualId`+id+`[]" required value="`+data[i].quantity+`" />`;
                  nama += `<input type="hidden" class="form-control" id="need_raw`+data[i].barang_id+`" name="need_raw`+data[i].barang_id+`" required value="`+data[i].need_raw+`" />`;
               });
               nama += ' )';

               table.row.add([
                  nama,
                  item[1],
                  item[3].replace("Harga", ""),
                  quantity,
                  aksi
               ]);
               table.draw();
            }
         });

   } else {
      table.row.add([
         nama,
         item[1],
         item[3].replace("Harga", ""),
         quantity,
         aksi
      ]);
      table.draw();
   }

   $('#search').val('');
   $("#result").html('');
 }

   var table = $('#example').DataTable({
                  "searching" : false,
                  "paging":false,
                  'ordering':false
               });

   $('#example tbody').on( 'click', 'button.delete-row', function () {
         table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
         
         _subtotal();
   } );

   $('#search_cust').keyup(function(){
      $('#result_cust').html('');
      var html = ``;
      var cari = $('#search_cust').val();

      if(cari != ''){
         $.ajax({
            url:"<?= base_url('penjualan/getCust')?>",
            type:"POST",
            dataType: 'json',
            data:{cari:cari},
            success:function(data){
               $.each(data, function (i, key) {
                  html += `<a href="javascript: void(0);"><li data-id='`+data[i].id+`' class="list-group-item link-class"><span class="text-muted">`+data[i].nama+` | `+data[i].contact+` </span></li></a>`;
               });

               $('#result_cust').append(html);
            }
         });
      }
   });

   $('#result_cust').on('click', 'li', function() {
      var item = $(this).text().split('|');
      var id = $(this).data('id');

      $('#search_cust').val(item);
      $('#pelanggan_id').val(id);
      $("#result_cust").html('');
   });
});
</script>