<style>
.kurang{
    color: #d92550 !important;
    font-weight: bold !important;
}
</style>

<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

            <div class="row">
               <div class="col-sm-6">
                  <div class="white shadow r-15 mb-3 r-15 no-b shadow">
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
                        <div class="white shadow r-15 text-center p-4 mb-3 card__hover shadow">
                           <!-- <i class="icon-data_usage s-48"></i> -->
                           <?php if($db['poto'] == null) :?>
                           <img src="<?=base_url()?>assets/img/icon/barang_jual.png" style="width:58px;">
                           <?php else :?>
                           <img src="<?=base_url("assets/")?><?=$db['poto']?>" style="width:58px;">
                           <?php endif?>
                           <h6 class="mt-3"><?=$db['nama']?></h6>
                           <button type="button" data-id='<?=$db['id']?>' data-raw='<?=$db['need_raw']?>' data-paket='<?=$db['is_paket']?>'  data-item='<?=$db['nama']?> | <?=$db['satuan']?> | Stok <?=$db['stok']?> | Harga <?=$db['harga_jual']?>' class="btn btn-success btn-sm r-10 mt-2 tombol-add"><i class="icon-plus"></i> Add</button>
                        </div>
                     </div>
                     <?php endforeach?>
                  </div>

               </div>

               <div class="col-sm-6">
               <form action="<?=base_url('penjualan/save')?>" method="post" target="_blank">
                  <div class="white shadow r-15 mb-3">
                     <div class="card-body">
                        <!-- <div class="form-group">
                           <input type="text" name="search_cust" id="search_cust" placeholder="Cari Nama Pelanggan" class="form-control" required/>
                           <input type="hidden" name="pelanggan_id" id="pelanggan_id" placeholder="Cari Nama Pelanggan" class="form-control" required/>
                           <ul class="list-group" id="result_cust"></ul>
                        </div> -->
                        <select class="custom-select select2" name="pelanggan_id" id="pelanggan_id" required>
                           <option value="" disabled selected>Pilih Pelanggan</option>
                              <option value="0">NON MEMBER</option>
                           <?php foreach($data1 as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['nama']?> || <?=$db['contact']?></option>
                           <?php endforeach?>
                        </select>
                     </div>
                  </div>

                  <div class="white shadow r-15 mb-3">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                           <col style="width:40%">
                           <col style="width:15%">
                           <col style="width:20%">
                           <col style="width:20%">
                           <col style="width:5%">
                              <thead>
                                 <tr>
                                    <th>Nama</th>
                                    <!-- <th>Satuan</th> -->
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Disc</th>
                                    <th>#</th>
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

                  <div class="white shadow r-15 mb-3">
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
                                 <th>DISKON (IDR) : </th>
                                 <td>
                                    <input type="text" name="diskon_idr2" id="diskon_idr2" class="form-control" onkeyup="mydiskonIDR(this.value)" value=0 />
                                    <input type="hidden" name="diskon_idr" id="diskon_idr" class="form-control" value=0 />
                                 </td>
                              </tr>
                              <tr>
                                 <th>SUB TOTAL (IDR) : </th>
                                 <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value=0 /></td>
                              </tr>
                              <tr>
                                 <th>PPN 10% (IDR) : </th>
                                 <td><input type="text" name="ppn" id="ppn" class="form-control" readonly value=0 /></td>
                              </tr>
                              <tr>
                                 <th>TOTAL PEMBELANJAAN (IDR) : </th>
                                 <td><input type="text" name="total_tagihan2" id="total_tagihan2" class="form-control" readonly value=0 /></td>
                              </tr>
                              <tr>
                                 <th>TOTAL BAYAR (IDR) : </th>
                                 <td>
                                    <input type="text" name="total_bayar2" id="total_bayar2" class="form-control" required onkeyup="totalBayar(this.value)"/>
                                    <input type="hidden" name="total_bayar" id="total_bayar" class="form-control" required />
                                 </td>
                              </tr>
                              <tr>
                                 <th>KEMBALIAN (IDR) :  </th>
                                 <td><input type="text" name="kembalian" id="kembalian" class="form-control" readonly /></td>
                              </tr>
                              </tbody>
                           </table>
                        </div>

                     </div>
                  </div>

                  <div class="white shadow r-15 mb-3">
                     <div class="card-body">
                        <div class="form-group">
                           <select class="custom-select select2" name="sales_id" id="sales_id" required>
                              <option value="" disabled selected>Pilih Sales</option>
                              <option value="0">NON SALES</option>
                              <?php foreach($sales as $db):?>
                                 <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>
                        <div class="form-group">
                           <select class="custom-select select2" name="jenis_pembayaran" id="jenis_pembayaran" required>
                              <option value="" disabled selected>Pilih Jenis Pembayaran</option>
                              <option value="cash">Cash</option>
                              <option value="debit">Debit</option>
                              <option value="kredit">Kartu Kredit</option>
                              <option value="transfer">Tranfer</option>
                           </select>
                        </div>

                        <div class="form-group hilang bank_id">
                           <select class="custom-select select2 mt-3" name="bank_id" id="bank_id" required>
                              <option value="0" disabled selected>Pilih Bank</option>
                              <?php foreach($bank as $db):?>
                                 <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>

                        <div class="text-right ">
                           <a href="<?=base_url('penjualan')?>" class="btn btn-danger mr-2">Batal</a>
                           <a href="<?=base_url('penjualan/create')?>" class="btn btn-success mr-2">Buat Baru</a>
                           <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                        </div>
                     </div>
                  </div>

                  </form>
               </div>


            </div>

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
   // console.log(total);
   $('#total_gross').val(rupiah(total));
   $('#total_tagihan').val(rupiah(total));

   _ppn();
}

function _ppn() {
   var subtotal = $('#total_tagihan').val().replace(/\./g,'');
   var ppn = (10/100)*subtotal;
   var total = parseInt(ppn) + parseInt(subtotal);
   // console.log(total);
   $('#ppn').val(rupiah(ppn));
   $('#total_tagihan2').val(rupiah(total));
}

function quantity(id) {
   var hrg = $('#harga'+id).val().replace(/\./g,'') == '' ? 0 : $('#harga'+id).val().replace(/\./g,'');
   var qty = $('#quantity'+id).val();
   var total = (parseInt(qty) * parseInt(hrg));
   $('#subtotal'+id).val(total);
   diskonItem(id);
   
   var paket = $('#quantity'+id).data('paket');
   paket ? $('#quantityPaket'+id).val(qty) : null;
}

function quantityChange(id, raw=0) {
   var qty = raw==1 ? $('#quantityRaw'+id).val() : $('#quantity'+id).val();
   $.ajax({
         url:"<?= base_url('penjualan/cekBarang')?>",
         type:"POST",
         dataType: 'json',
         data:{id:id, qty:qty},
         success:function(data){
            if(data){
               Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Gagal',
                  text: 'Stok Tidak Mencukupi',
                  showConfirmButton: false,
                  timer: 2500
               });

               raw==1 ? $('#quantityRaw'+id).val(1) : $('#quantity'+id).val(1);
               raw==1 ? quantity('Raw'+id) : quantity(id);
            }
         }
      });
}

function diskonItem(id) {
   var hrg = $('#harga'+id).val().replace(/\./g,'') == '' ? 0 : $('#harga'+id).val().replace(/\./g,'');
   var qty = $('#quantity'+id).val();
   var disc = $('#disc'+id).val();
   var total = (parseInt(qty) * parseInt(hrg));
   total = total - (total * (parseInt(disc)/100));
   $('#subtotal'+id).val(total);
   _subtotal();
}

function mydiskon(value) {
   var disc = value / 100;
   var disc_idr = $('#diskon_idr2').val().replace(/\./g,'');
   var total_gross = $('#total_gross').val().replace(/\./g,'');
   var total = rupiah((total_gross - (total_gross*disc)) - disc_idr);
   $('#total_tagihan').val(total);
   _ppn();
}

function mydiskonIDR(value) {
   var value = value.replace(/\./g,'');
   // console.log(value);
   var disc = $('#diskon').val().replace(/\./g,'');;
   var total_gross = $('#total_gross').val().replace(/\./g,'');
   var total = rupiah((total_gross - (total_gross*disc/100)) - value);
   console.log(total);
   $('#total_tagihan').val(total);
   $('#diskon_idr2').val(rupiah(value));
   $('#diskon_idr').val(value);
   _ppn();
}

function totalBayar(value) {
   var value = value.replace(/\./g,'');
   var total_tagihan = $('#total_tagihan').val().replace(/\./g,'');
   var total = rupiah(value - total_tagihan);
   // console.log(parseInt(value)<parseInt(total_tagihan));
   // console.log(parseInt(total_tagihan));
   parseInt(value) < parseInt(total_tagihan) ? total = '- ' + rupiah(total) : rupiah(total);
   parseInt(value) < parseInt(total_tagihan) ? $('#kembalian').addClass('kurang') : $('#kembalian').removeClass('kurang');
   parseInt(value) < parseInt(total_tagihan) && parseInt(total_tagihan)!=0 ? $('.btn-simpan').hide() : $('.btn-simpan').show();
   $('#kembalian').val(total);
   $('#total_bayar2').val(rupiah(value));
   $('#total_bayar').val(value);
}

$(document).ready(function(){
 $('.btn-simpan').hide();

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
 });

 $('.tombol-add').click(function(){
   var item = $(this).data('item').split('|');
   var nama = item[0];
   var id = $(this).data('id');
   var paket = $(this).data('paket');
   var raw = $(this).data('raw');

   showTable(id, nama, raw, paket, item);
 });

 function showTable(id, nama, raw, paket, item) {
   var item = item;
   var nama = nama;
   var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>`;

   if(raw == 1 && paket == 0){
      var quantity = `<input type="number" class="form-control" id="quantityRaw`+id+`" name="quantityRaw[]" required onkeyup="quantity('Raw`+id+`')" value=1 onchange="quantityChange(`+id+`, 1)" />
                  <input type="hidden" class="form-control" id="idRaw`+id+`" name="idRaw[]" required value="`+id+`"/>
                  <input type="hidden" class="form-control" id="hargaRaw`+id+`" name="hargaRaw[]" required value="`+item[3].replace(" Harga ", "")+`"/>
                  <input type="hidden" class="form-control" id="subtotalRaw`+id+`" name="subtotal[]" required value=`+item[3].replace(" Harga ", "")+` />`;
      
      var disc = `<input type="number" max=100 class="form-control" id="discRaw`+id+`" name="discRaw[]" required onkeyup="diskonItem('Raw`+id+`')" value=0 >`;
   } 

   if(raw == 0 && paket == 0){
      var quantity = `<input type="number" class="form-control" id="quantity`+id+`" name="quantity[]" required onkeyup="quantity(`+id+`)" value=1 onchange="quantityChange(`+id+`)" />
                  <input type="hidden" class="form-control" id="id`+id+`" name="id[]" required value="`+id+`"/>
                  <input type="hidden" class="form-control" id="harga`+id+`" name="harga[]" required value="`+item[3].replace(" Harga ", "")+`"/>
                  <input type="hidden" class="form-control" id="subtotal`+id+`" name="subtotal[]" required value=`+item[3].replace(" Harga ", "")+` />`;
      
      var disc = `<input type="number" max=100 class="form-control" id="disc`+id+`" name="disc[]" required onkeyup="diskonItem(`+id+`)" value=0 >`;
   }

   if(raw == 0 && paket == 1){
      var quantity = `<input type="number" class="form-control" id="quantity`+id+`" data-paket=1 name="quantity[]" required onkeyup="quantity(`+id+`)" value=1 onchange="quantityChange(`+id+`)" />
                  <input type="hidden" class="form-control" id="id`+id+`" name="id[]" required value="`+id+`"/>
                  <input type="hidden" class="form-control" id="harga`+id+`" name="harga[]" required value="`+item[3].replace(" Harga ", "")+`"/>
                  <input type="hidden" class="form-control" id="subtotal`+id+`" name="subtotal[]" required value=`+item[3].replace(" Harga ", "")+` />
                  <input type="hidden" class="form-control" id="quantityPaket`+id+`" name="quantityPaket`+id+`" required value=1 />`;
      
      var disc = `<input type="number" max=100 class="form-control" id="disc`+id+`" name="disc[]" required onkeyup="diskonItem(`+id+`)" value=0 >`;
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
                  nama += `<input type="hidden" class="form-control" id="barangJualId`+id+`" name="barangJualId`+id+`[]" required value="`+data[i].barang_id+`"/>`;
                  nama += `<input type="hidden" class="form-control" id="quantityBarangJualId`+id+`" name="quantityBarangJualId`+id+`[]" required value="`+data[i].quantity+`" />`;
                  nama += `<input type="hidden" class="form-control" id="need_raw`+data[i].barang_id+`" name="need_raw`+data[i].barang_id+`" required value="`+data[i].need_raw+`" />`;
               });
               nama += ' )';

               table.row.add([
                  nama,
                  // item[1],
                  rupiah(item[3].replace("Harga", "")),
                  quantity,
                  disc,
                  aksi
               ]);
               table.draw();
               _subtotal();
            }
         });

   } else {
      table.row.add([
         nama,
         // item[1],
         rupiah(item[3].replace("Harga", "")),
         quantity,
         disc,
         aksi
      ]);
      table.draw();
      _subtotal();
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

   $('#jenis_pembayaran').change(function(){
      var jenis = $(this).val();

      jenis == 'cash' ? $('.bank_id').hide() : $('.bank_id').show();
   });
});
</script>