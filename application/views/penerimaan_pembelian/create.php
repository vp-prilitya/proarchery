<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <form action="<?=base_url('penerimaan_pembelian/save')?>" method="post">

        <div class="row">
         <div class="col-sm-6">
            <div class="white shadow r-15 mb-3">
               <div class="card-body">
                  <div class="form-group">
                     <select class="custom-select select2" name="search_select" id="search_select">
                        <option value="" disabled selected>Pilih Pesanan Pembelian (PO)</option>
                        <option value="cari_input">Cari Nomor Pesanan Pembelian (PO)</option>
                        <?php foreach($po as $db):?>
                           <option value="<?=$db['no_faktur']?>"><?=$db['no_faktur']?></option>
                        <?php endforeach?>
                     </select>
                     <input type="text" name="search" id="search" placeholder="Cari Nomor Pesanan Pembelian" class="form-control mt-3 hilang" required />
                     <input type="hidden" name="pesanan_pembelian_id" id="pesanan_pembelian_id" class="form-control" required/>
                     <input type="hidden" name="vendor_id" id="vendor_id" class="form-control" required/>
                     <button type="button" class="btn btn-success mt-2 cari">Cari</button>
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
                     <col style="width:50%">
                     <col style="width:8%">
                     <col style="width:8%">
                     <col style="width:15%">
                     <col style="width:14%">
                     <col style="width:5%">
                        <thead>
                           <tr>
                              <th>Nama</th>
                              <th>Qty PO</th>
                              <th>Qty Kirim</th>
                              <th>Harga</th>
                              <th>Qty</th>
                              <th>#</th>
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
                                 <th>TOTAL TAGIHAN (IDR) : </th>
                                 <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value=0 /></td>
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
                        <!-- <a href="<?=base_url('penerimaan_pembelian/create')?>" class="btn btn-success mr-2 float-right">Buat Baru</a> -->
                        <a href="<?=base_url('penerimaan_pembelian')?>" class="btn btn-danger mr-2 float-right">Batal</a>
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
   
   var paket = $('#quantity'+id).data('paket');
   paket ? $('#quantityPaket'+id).val(qty) : null;
}

function quantity(id) {
   var hrg = $('#harga'+id).val().replace(/\./g,'') == '' ? 0 : $('#harga'+id).val().replace(/\./g,'');
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

$(document).ready(function(){
   $('#search_select').change(function(){
      var val = $(this).val();

      if (val === 'cari_input'){
         $('#search').show();
         $('#search').val('');
      } else {
         $('#search').hide();
         $('#search').val(val);
      }
   });

 $('.cari').click(function(){
   var po = $('#search_select').val();

    if (po === 'cari_input'){
       po = $('#search').val();
    }

   if(po != ''){
      $.ajax({
         url:"<?= base_url('penerimaan_pembelian/getPO')?>",
         type:"POST",
         dataType: 'json',
         data:{po:po},
         success:function(data){
            $('#pesanan_pembelian_id').val(data[0].pesanan_pembelian_id)
            $('#vendor_id').val(data[0].vendor_id)
            table.clear();
            var gagal = 0;
            $.each(data, function (i, key) {
               if(data[i].quantity != data[i].qty){
                  gagal++;
                  showTable(data[i].barang_jual_id, data[i].nama, data[i].need_raw, data[i].is_paket, data[i].harga, data[i].quantity, data[i].qty)
               }
            });

            if(gagal == 0){
               Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Gagal',
                  text: 'Semua Barang Telah DIkirimkan Sesuai Pesanan Pembelian',
                  showConfirmButton: false,
                  timer: 2500
               })
            }
         }
      });
   }
 });

 function showTable(id, nama, raw, paket, harga, qty_po, qty_kirim) {
   var qty = qty_po - qty_kirim;
   var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>`;
   
   if(raw==1){
      var quantity = `<input type="number" class="form-control" id="quantityRaw`+id+`" name="quantityRaw[]" required onkeyup="quantity('Raw`+id+`')" value=1 min=1 max=`+qty+` data-raw=1 />
               <input type="hidden" class="form-control" id="idRaw`+id+`" name="idRaw[]" required value="`+id+`"/>
               <input type="hidden" class="form-control" id="hargaRaw`+id+`" name="hargaRaw[]" required value="`+harga+`"/>
               <input type="hidden" class="form-control" id="subtotalRaw`+id+`" name="subtotalRaw[]" required value=`+(harga.replace(/\./g,''))+` />`;
   } else {
      var quantity = `<input type="number" class="form-control" id="quantity`+id+`" name="quantity[]" required onkeyup="quantity(`+id+`)" value=1 min=1 max=`+qty+` data-paket=`+paket+` />
               <input type="hidden" class="form-control" id="id`+id+`" name="id[]" required value="`+id+`"/>
               <input type="hidden" class="form-control" id="harga`+id+`" name="harga[]" required value="`+harga+`"/>
               <input type="hidden" class="form-control" id="subtotal`+id+`" name="subtotal[]" required value=`+(harga.replace(/\./g,''))+` />`;
   }

   table.row.add([
      nama,
      qty_po,
      qty_kirim??0,
      harga,
      quantity,
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

});
</script>