<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <form action="<?=base_url('piutang/savePembayaran')?>" method="post">

        <div class="row">
         <div class="col-sm-6">
            <div class="white shadow r-15 mb-3">
               <div class="card-body">
                  <div class="form-group">
                     <select class="custom-select select2" name="search_select" id="search_select">
                        <option value="" disabled selected>Pilih Nomor Penjualan (SO)</option>
                        <option value="cari_input">Cari Nomor Penjualan (SO)</option>
                        <?php foreach($so as $db):?>
                           <option value="<?=$db['no_faktur']?>"><?=$db['no_faktur']?></option>
                        <?php endforeach?>
                     </select>
                     <input type="text" name="search" id="search" placeholder="Cari Nomor Pesanan Penjualan (SO)" class="form-control hilang mt-2" required />
                     <input type="hidden" name="piutang_id" id="piutang_id" class="form-control" required/>
                     <input type="hidden" name="pelanggan_id" id="pelanggan_id" class="form-control" required/>
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
                     <col style="width:25%">
                     <col style="width:20%">
                     <col style="width:25%">
                     <col style="width:25%">
                     <col style="width:5%">
                        <thead>
                           <tr>
                              <th>Nomor Surat Jalan</th>
                              <th>Total Tagihan</th>
                              <th>Diskon (IDR)</th>
                              <th>Pembayaran</th>
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
                              <tbody>
                              <tr>
                                 <th>TOTAL TAGIHAN (IDR) : </th>
                                 <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value=0 /></td>
                              </tr>
                              <!-- <tr>
                                 <th>DISKON (%) : </th>
                                 <td><input type="text" name="diskon" id="diskon" class="form-control" onkeyup="mydiskon(this.value)" value=0 /></td>
                              </tr> -->
                              <tr>
                                 <th>TOTAL DISKON (IDR) : </th>
                                 <td>
                                    <input type="text" name="total_diskon_idr2" id="total_diskon_idr2" class="form-control" onkeyup="mydiskonIDR(this.value)" value=0 readonly />
                                    <input type="hidden" name="total_diskon_idr" id="total_diskon_idr" class="form-control" value=0 />
                                 </td>
                              </tr>
                              <tr>
                                 <th>TOTAL BAYAR (IDR) : </th>
                                 <td>
                                    <input type="text" name="total_bayar2" id="total_bayar2" class="form-control" required onkeyup="totalBayar(this.value)" readonly value=0 />
                                    <input type="hidden" name="total_bayar" id="total_bayar" class="form-control" required />
                                 </td>
                              </tr>
                              <tr>
                                 <th>SISA (IDR) :  </th>
                                 <td><input type="text" name="kembalian" id="kembalian" class="form-control" readonly value=0 /></td>
                              </tr>
                              <tr>
                                 <th>JENIS PEMBAYARAN :  </th>
                                 <td>
                                    <!-- <div class="form-group"> -->
                                       <select class="custom-select select2" name="jenis_pembayaran" id="jenis_pembayaran" required>
                                          <option value="" disabled selected>Pilih Jenis Pembayaran</option>
                                          <option value="cash">Cash</option>
                                          <option value="uang muka">Uang Muka</option>
                                          <option value="transfer">Tranfer</option>
                                       </select>

                                    <!-- </div> -->
                                 </td>
                              </tr>
                              <tr class="hilang bank_id">
                                 <th>PILIH BANK :  </th>
                                 <td>
                                    <!-- <div class="form-group"> -->
                                       <select class="custom-select select2 mt-3" name="bank_id" id="bank_id" required>
                                          <option value="0" disabled selected>Pilih Bank</option>
                                          <?php foreach($bank as $db):?>
                                             <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                          <?php endforeach?>
                                       </select>
                                    <!-- </div> -->
                                 </td>
                              </tr>
                              </tbody>
                           </table>
                        </div>
                        
                        <div class="text-right">
                           <a href="<?=base_url('piutang')?>"Pembayaran class="btn btn-danger mr-2">Batal</a>
                           <!-- <a href="<?=base_url('piutang/creaPembate')?>" class="btn btn-success mr-2">Buat Baru</a> -->
                           <button type="submit" class="btn btn-primary">Simpan</button>
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
      total += parseInt(this.value.replace(/\./g,''));
   });
   $('#total_tagihan').val(rupiah(total));
}

function _subtotalBayar() {
   var total = 0;
   var disc = 0;

   $('input[name="bayar[]"]').each(function() {
      total += parseInt(this.value.replace(/\./g,''));
   });

   $('input[name="diskon_idr[]"]').each(function() {
      disc += parseInt(this.value.replace(/\./g,''));
   });

   // console.log(total);
   $('#total_bayar2').val(rupiah(total));
   $('#total_diskon_idr2').val(rupiah(disc));
   $('#kembalian').val(rupiah((total + disc) - $('#total_tagihan').val().replace(/\./g,'')));
}

function bayar(id) {
   var bayar = $('#bayar2'+id).val().replace(/\./g,'');

   $('#bayar'+id).val(bayar);
   _subtotalBayar();
   
   $('#bayar2'+id).val(rupiah(bayar))
}

function mydiskonIDR(id) {
   var diskon_idr = $('#diskon_idr2'+id).val().replace(/\./g,'');

   $('#diskon_idr'+id).val(diskon_idr);
   $('#diskon_idr2'+id).val(rupiah(diskon_idr))
   _subtotalBayar();
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
         url:"<?= base_url('piutang/getSO')?>",
         type:"POST",
         dataType: 'json',
         data:{po:po},
         success:function(data){
            var gagal = data.length;

            if(gagal == 0){
               Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Gagal',
                  text: 'Data Tidak Ditemukan',
                  showConfirmButton: false,
                  timer: 2500
               })
            } else {
               $('#piutang_id').val(data[0].id)
               $('#pelanggan_id').val(data[0].pelanggan_id)
               table.clear();
               $.each(data, function (i, key) {
                  showTable(data[i].id, data[i].no_faktur, data[i].piutang)
               });
            }

         }
      });
   }
 });

 function showTable(id, nama, piutang) {
   var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>`;

   var disc = `<input type="text" name="diskon_idr2[]" id="diskon_idr2`+id+`" class="form-control" onkeyup="mydiskonIDR(`+id+`)" value=0 />
               <input type="hidden" name="diskon_idr[]" id="diskon_idr`+id+`" class="form-control" value=0 />`;

   var bayar = `<input type="text" class="form-control" id="bayar2`+id+`" name="bayar2[]" required onkeyup="bayar(`+id+`)" value=0>
               <input type="hidden" class="form-control" id="bayar`+id+`" name="bayar[]" required value=0>
               <input type="hidden" class="form-control" id="id`+id+`" name="id[]" required value="`+id+`"/>
               <input type="hidden" class="form-control" id="subtotal`+id+`" name="subtotal[]" required value="`+piutang+`"/>`;


   table.row.add([
      nama,
      rupiah(piutang),
      disc,
      bayar,
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

   $('#jenis_pembayaran').change(function(){
      var jenis = $(this).val();

      jenis == 'transfer' ? $('.bank_id').show() : $('.bank_id').hide();
   });

});
</script>