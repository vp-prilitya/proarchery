<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Tambah <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

         <div class="row">
         <form action="<?=base_url('pembelian/save')?>" method="post" target="_blank">
            <div class="col-sm-8">
               <div class="white shadow r-15">
                  <div class="card-body">
                     <div class="form-group ">
                        <label for="item">CARI ITEM</label>
                        <select class="custom-select select2" name="barang_jual_id" id="barang_jual_id">
                           <option value="" disabled selected>Pilih Barang Jual</option>
                           <?php foreach($barang_jual as $db):?>
                              <?php if($db['need_raw']==0):?>
                              <option value="<?=$db['id']?>" data-raw=0><?=$db['nama']?></option>
                              <?php endif?>
                           <?php endforeach?>
                           <?php foreach($barang_mentah as $db):?>
                              <option value="<?=$db['id']?>" data-raw=1><?=$db['nama']?></option>
                           <?php endforeach?>
                        </select>
                     </div>

                     <div class="table-responsive">
                           <table id="example" class="table table-bordered table-striped table-hover">
                              <thead>
                                 <tr>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
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
            </div>

            <div class="col-sm-4">
               <div class="white shadow r-15">
                  <div class="card-body">
                     <div class="form-group">
                        <label for="search_cust">VENDOR</label>
                        <select class="custom-select select2" name="vendor_id" id="vendor_id" required>
                           <option value="" disabled selected>Pilih Vendor</option>
                           <?php foreach($vendor as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['nama']?> || <?=$db['telp']?></option>
                           <?php endforeach?>
                        </select>
                        <ul class="list-group" id="result_cust"></ul>
                     </div>

                     <div class="table-responsive">
                        <table class="table">
                           <tbody><tr>
                              <th style="width:50%">TOTAL GROS (IDR):</th>
                              <td><input type="text" name="total_gross" id="total_gross" class="form-control" readonly value=0 /></td>
                           </tr>
                           <tr>
                              <th>DISKON (%) :</th>
                              <td><input type="text" name="diskon" id="diskon" class="form-control" onkeyup="mydiskon(this.value)" value=0 /></td>
                           </tr>
                           <tr>
                              <th>TOTAL TAGIHAN (IDR) :</th>
                              <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value=0 /></td>
                           </tr>
                           <tr>
                              <th>TOTAL BAYAR (IDR):</th>
                              <td><input type="text" name="total_bayar" id="total_bayar" class="form-control" required onkeyup="totalBayar(this.value)"/></td>
                           </tr>
                           <tr>
                              <th>KEMBALIAN (IDR) :</th>
                              <td><input type="text" name="kembalian" id="kembalian" class="form-control" readonly /></td>
                           </tr>
                           </tbody>
                        </table>
                     </div>

                     <button type="submit" class="btn btn-primary float-right">Simpan</button>
                     <a href="<?=base_url('pembelian/create')?>" class="btn btn-success mr-2 float-right">Buat Baru</a>
                     <a href="<?=base_url('pembelian')?>" class="btn btn-danger mr-2 float-right">Batal</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>

            <div class="row">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <!-- <div class="card-header white">
                        <h6>Tambah <?=$judul?></h6>
                     </div> -->
                     <div class="card-body">

                     <form action="<?=base_url('pembelian/save')?>" method="post" target="_blank">
                     <div class="row">
                        <div class="col-sm-8">
                           <div class="form-group row col-sm-6">
                              <label for="item">CARI ITEM</label>
                              <select class="custom-select select2" name="barang_jual_id" id="barang_jual_id">
                                 <option value="" disabled selected>Pilih Barang Jual</option>
                                 <?php foreach($barang_jual as $db):?>
                                    <?php if($db['need_raw']==0):?>
                                    <option value="<?=$db['id']?>" data-raw=0><?=$db['nama']?></option>
                                    <?php endif?>
                                 <?php endforeach?>
                                 <?php foreach($barang_mentah as $db):?>
                                    <option value="<?=$db['id']?>" data-raw=1><?=$db['nama']?></option>
                                 <?php endforeach?>
                              </select>
                           </div>

                           <div class="table-responsive">
                                 <table id="example" class="table table-bordered table-striped table-hover">
                                    <thead>
                                       <tr>
                                          <th>Nama</th>
                                          <th>Satuan</th>
                                          <th>Harga</th>
                                          <th>Qty</th>
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

                        <div class="col-sm-4">
                           <div class="form-group">
                              <label for="search_cust">VENDOR</label>
                              <select class="custom-select select2" name="vendor_id" id="vendor_id" required>
                                 <option value="" disabled selected>Pilih Vendor</option>
                                 <?php foreach($vendor as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?> || <?=$db['telp']?></option>
                                 <?php endforeach?>
                              </select>
                              <ul class="list-group" id="result_cust"></ul>
                           </div>

                           <div class="table-responsive">
                              <table class="table">
                                 <tbody><tr>
                                    <th style="width:50%">TOTAL GROS (IDR):</th>
                                    <td><input type="text" name="total_gross" id="total_gross" class="form-control" readonly value=0 /></td>
                                 </tr>
                                 <tr>
                                    <th>DISKON (%) :</th>
                                    <td><input type="text" name="diskon" id="diskon" class="form-control" onkeyup="mydiskon(this.value)" value=0 /></td>
                                 </tr>
                                 <tr>
                                    <th>TOTAL TAGIHAN (IDR) :</th>
                                    <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value=0 /></td>
                                 </tr>
                                 <tr>
                                    <th>TOTAL BAYAR (IDR):</th>
                                    <td><input type="text" name="total_bayar" id="total_bayar" class="form-control" required onkeyup="totalBayar(this.value)"/></td>
                                 </tr>
                                 <tr>
                                    <th>KEMBALIAN (IDR) :</th>
                                    <td><input type="text" name="kembalian" id="kembalian" class="form-control" readonly /></td>
                                 </tr>
                                 </tbody>
                              </table>
                           </div>

                           <button type="submit" class="btn btn-primary float-right">Simpan</button>
                           <a href="<?=base_url('pembelian/create')?>" class="btn btn-success mr-2 float-right">Buat Baru</a>
                           <a href="<?=base_url('pembelian')?>" class="btn btn-danger mr-2 float-right">Batal</a>
                           </form>
                        </div>
                     </div>

                     </div>
                  </div>
               </div>
            </div>

        </div>
    </div>















    
</div>

<script>

var subtotal = [];

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

function harga(id) {
   var hrg = $('#harga'+id).val();
   var qty = $('#quantity'+id).val()== ''? 0 : $('#quantity'+id).val();
   var total_gross = $('#total_gross').val().replace(/\./g,'');
   var total = (parseInt(qty) * parseInt(hrg));
   $('#subtotal'+id).val(total);
   _subtotal();
}

function quantity(id) {
   var hrg = $('#harga'+id).val().replace(/\./g,'') == '' ? 0 : $('#harga'+id).val().replace(/\./g,'');
   var total_gross = $('#total_gross').val().replace(/\./g,'');
   var qty = $('#quantity'+id).val();
   var total = (parseInt(qty) * parseInt(hrg));
   $('#subtotal'+id).val(total);
   _subtotal();
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
   $( "#barang_jual_id" ).change(function() {
         var id = $('#barang_jual_id').val();
         var raw = $(this).find(':selected').data('raw')
         var base_url = (raw == 0) ? "<?= base_url('barang_jual/getBarangJual')?>" : "<?= base_url('barang_jual/getBarangMentah')?>";

         $.ajax({
               url: base_url,
               type:"POST",
               dataType: 'json',
               data:{id:id},
               success:function(data){
                  var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>`;

                  if(raw == 0){
                     var qty = `<input type="hidden" class="form-control" id="id`+data.id+`" name="id[]" required value="`+data.id+`">
                     <input type="hidden" class="form-control" id="subtotal`+data.id+`" name="subtotal[]" required />`;
                     qty += `<input type="text" class="form-control" id="quantity`+data.id+`" name="quantity[]" required onkeyup="quantity('`+data.id+`')">`;

                     var harga = `<input type="text" class="form-control" id="harga`+data.id+`" name="harga[]" required onkeyup="harga('`+data.id+`')">`;
                  } else {
                     var qty = `<input type="hidden" class="form-control" id="id`+data.id+`" name="idRaw[]" required value="`+data.id+`">
                     <input type="hidden" class="form-control" id="subtotalRaw`+data.id+`" name="subtotal[]" required />`;
                     qty += `<input type="text" class="form-control" id="quantityRaw`+data.id+`" name="quantityRaw[]" required onkeyup="quantity('Raw`+data.id+`')">`;

                     var harga = `<input type="text" class="form-control" id="hargaRaw`+data.id+`" name="hargaRaw[]" required onkeyup="harga('Raw`+data.id+`')">`;
                  }

                  table.row.add([
                     data.nama,
                     data.satuan,
                     harga,
                     qty,
                     aksi
                  ]);
                  table.draw();
               }
         });
         
      });

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
});
</script>