<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <form action="<?=base_url('pesanan_pembelian/save')?>" method="post">

        <div class="row">
         <div class="col-sm-6">
            <div class="white shadow r-15 mb-3">
               <div class="card-body">
                  <div class="form-group">
                     <label for="">Pilih Barang</label>
                     <select class="custom-select select2" name="barang_jual_id" id="barang_jual_id">
                     <option value="" disabled selected>Pilih Barang</option>
                     <?php foreach($produk as $db):?>
                        <option value="<?=$db['id']?>" data-raw=0 data-paket=1><?=$db['nama']?> - <?=$db['no_part']?> | <?=$db['satuan']?> | Stok <?=$db['stok']?> | Harga <?=number_format($db['harga_pokok']==''?0:$db['harga_pokok'],0,'','.')?></option>
                     <?php endforeach?>
                     <?php foreach($paket as $db):?>
                        <option value="<?=$db['id']?>" data-raw=1 data-paket=0><?=$db['nama']?> - <?=$db['no_part']?> | <?=$db['satuan']?> | Stok <?=$db['stok']?> | Harga <?=number_format($db['harga_pokok']==''?0:$db['harga_pokok'],0,'','.')?></option>
                     <?php endforeach?>
                  </select>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-sm-6">
            <div class="white shadow r-15 mb-3">
               <div class="card-body">
                  <div class="form-group">
                     <div class="form-group">
                        <label for="">Pilih Vendor</label>
                        <select class="custom-select select2" name="vendor_id" id="vendor_id" required>
                           <option value="" disabled selected>Pilih Vendor</option>
                           <?php foreach($vendor as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['nama']?> || <?=$db['telp']?></option>
                           <?php endforeach?>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        </div>

        <div class="row">
         <div class="col-sm-12">
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
                              <th>Harga</th>
                              <th>Qty</th>
                              <th>Disc</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <!-- <tr>
                              <td>
                                 <div class="form-group">
                                    <select class="custom-select select2 produk" required name="produk1" id="produk1">
                                       <option value="" disabled selected>Pilih Akun </option>
                                       <?php $i=1; foreach($data as $db):?>
                                       <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                       <?php endforeach?>
                                    </select>
                                 </div>
                              </td>
                              <td>
                                 <input type="text" class="form-control" id="harga1" name="harga[]" required>
                                 <input type="hidden" class="form-control" id="id1" name="id[]" required>
                              </td>
                              <td>
                                 <input type="text" class="form-control" id="quantity1" name="quantity[]" required>
                                 <input type="hidden" class="form-control" id="id1" name="id[]" required>
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
         </div>
        </div>

            <div class="row">
               <div class="col-sm-6">
               </div>

               <div class="col-sm-6">
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
                                 <th>JENIS PPN : </th>
                                 <td>
                                    <select class="custom-select select2" name="jenis_ppn" id="jenis_ppn" required>
                                       <option value="" disabled selected>Pilih Jenis PPN</option>
                                       <option value="exclude">Exclude PPN</option>
                                       <option value="include">Include PPN</option>
                                       <option value="non">NON PPN</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <th>PPN (IDR) : </th>
                                 <td><input type="text" name="ppn" id="ppn" class="form-control" readonly value=0 /></td>
                              </tr>
                              <tr>
                                 <th>TOTAL TAGIHAN (IDR) : </th>
                                 <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value=0 /></td>
                              </tr>
                              <tr>
                                 <th>TANGGAL JATUH TEMPO : </th>
                                 <td>
                                    <input type="text" class="date-time-picker form-control" value="<?=date('Y-m-d')?>" data-options='{"timepicker":false, "format":"Y-m-d"}' name="tgl_jatuh_tempo" id="tgl_jatuh_tempo"/>
                                 </td>
                              </tr>
                              <!-- <tr>
                                 <th>TOTAL BAYAR (IDR) : </th>
                                 <td>
                                    <input type="text" name="total_bayar2" id="total_bayar2" class="form-control" required onkeyup="totalBayar(this.value)"/>
                                    <input type="hidden" name="total_bayar" id="total_bayar" class="form-control" required />
                                 </td>
                              </tr>
                              <tr>
                                 <th>KEMBALIAN (IDR) :  </th>
                                 <td><input type="text" name="kembalian" id="kembalian" class="form-control" readonly /></td>
                              </tr> -->
                              </tbody>
                           </table>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        <!-- <a href="<?=base_url('pembelian/create')?>" class="btn btn-success mr-2 float-right">Buat Baru</a> -->
                        <a href="<?=base_url('pembelian')?>" class="btn btn-danger mr-2 float-right">Batal</a>
                        <p class="text-white shadow r-15">Lorem ipsum dolor sit amet .</p>
                     </div>
                  </div>
                  </form>
               </div>


            </div>

        </div>
    </div>















    
</div>

<script>
function addCommas(nStr){
   nStr += '';
   var x = nStr.split('.');
   var x1 = x[0];
   var x2 = x.length > 1 ? ',' + x[1] : '';
   var rgx = /(\d+)(\d{3})/;
   while (rgx.test(x1)) {
   x1 = x1.replace(rgx, '$1' + '.' + '$2');
   }
   return x1 + x2;
}

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
      total += parseInt(this.value.replace(/\./g,''));
   });
   $('input[name="subtotalRaw[]"]').each(function() {
      total += parseInt(this.value.replace(/\./g,''));
   });
   $('#total_gross').val(rupiah(total));
   $('#total_tagihan').val(rupiah(total));
}

function harga(id) {
   var hrg = $('#harga'+id).val().replace(/\./g,'') == '' ? 0 : $('#harga'+id).val().replace(/\./g,'');
   var qty = $('#quantity'+id).val();
   var total = (parseInt(qty) * parseInt(hrg));
   $('#subtotal'+id).val(total);
   _subtotal();
   
   $('#harga'+id).val(rupiah(hrg));
   var paket = $('#quantity'+id).data('paket');
   paket ? $('#quantityPaket'+id).val(qty) : null;
}

function quantity(id) {
   var hrg = $('#harga'+id).val().replace(/\./g,'') == '' ? 0 : $('#harga'+id).val().replace(/\./g,'');
   var qty = $('#quantity'+id).val();
   var total = (parseInt(qty) * parseInt(hrg));
   $('#subtotal'+id).val(total);
   diskonItem(id);
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
   var total_gross = $('#total_gross').val().replace(/\./g,'');
   var total = rupiah(total_gross - (total_gross*disc));
   $('#total_tagihan').val(total);
   var jenis = $('#jenis_ppn').val();
   ppn(jenis);
}

function totalAfterDisc() {
   var disc = $('#diskon').val().replace(/\./g,'')??0;
   var total_gross = $('#total_gross').val().replace(/\./g,'');
   var total = rupiah(total_gross - (total_gross*(disc/100)));
   $('#total_tagihan').val(total);
}

function ppn(jenis) {
   totalAfterDisc();

   if(jenis == 'exclude'){
      var total = $("#total_tagihan").val().replace(/\./g,'');
      var ppn = parseInt(total)*0.1;
      $("#ppn").val(rupiah(ppn));
      $("#total_tagihan").val(rupiah(parseInt(total)+parseInt(ppn)));
   }

   if(jenis == 'include'){
      var total = $("#total_tagihan").val().replace(/\./g,'')/1.1;
      var ppn = parseInt(total.toFixed(1))*0.1;
      console.log(ppn.toString().replace(".", ","));
      $("#ppn").val(addCommas(ppn));
   }

   if(jenis == 'non'){
      var ppn = 0;
      $("#ppn").val(rupiah(ppn));
   }
}

$(document).ready(function(){

$( "#barang_jual_id" ).change(function() {
   var id = $('#barang_jual_id').val();
   var raw = $(this).find(':selected').data('raw');
   var paket = $(this).find(':selected').data('paket');
   var item = $(this).find(':selected').text().split('|');
   var nama = item[0];

   showTable(id, nama, raw, paket, item);
});

function showTable(id, nama, raw, paket, item) {
   var item = item;
   var nama = nama;
   var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>`;

   if(raw == 1){
      var harga = `<input type="text" class="form-control" id="hargaRaw`+id+`" name="hargaRaw[]" required value="`+rupiah(item[3].replace("Harga", ""))+`" onkeyup="harga('Raw`+id+`')" />`;
      var quantity = `<input type="number" class="form-control" id="quantityRaw`+id+`" name="quantityRaw[]" required onkeyup="quantity('Raw`+id+`')" value=1 />
               <input type="hidden" class="form-control" id="idRaw`+id+`" name="idRaw[]" required value="`+id+`"/>
               <input type="hidden" class="form-control" id="subtotalRaw`+id+`" name="subtotalRaw[]" required value=`+item[3].replace(" Harga ", "")+` />`;
      var disc = `<input type="number" max=100 class="form-control" id="discRaw`+id+`" name="discRaw[]" required onkeyup="diskonItem('Raw`+id+`')" value=0 >`;
   } else {
      var harga = `<input type="text" class="form-control" id="harga`+id+`" name="harga[]" required value="`+rupiah(item[3].replace("Harga", ""))+`" onkeyup="harga(`+id+`)" />`;
      var quantity = `<input type="number" class="form-control" id="quantity`+id+`" name="quantity[]" required onkeyup="quantity(`+id+`)" value=1 />
               <input type="hidden" class="form-control" id="id`+id+`" name="id[]" required value="`+id+`"/>
               <input type="hidden" class="form-control" id="subtotal`+id+`" name="subtotal[]" required value=`+item[3].replace(" Harga ", "")+` />`;
      var disc = `<input type="number" max=100 class="form-control" id="disc`+id+`" name="disc[]" required onkeyup="diskonItem(`+id+`)" value=0 >`;
   }

   table.row.add([
      nama,
      harga,
      quantity,
      disc,
      aksi
   ]);
   table.draw();
   _subtotal();
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

   $('#jenis_ppn').change(function(){
      var jenis = $(this).val();

      ppn(jenis);
   });


});
</script>