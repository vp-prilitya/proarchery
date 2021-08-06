<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <form action="<?=base_url('konsinyiasi/savePembayaran')?>" method="post">

        <div class="row">
         <div class="col-sm-6">
            <div class="white shadow r-15 mb-3">
               <div class="card-body">
                  <div class="form-group">
                     <input type="text" name="search" id="search" placeholder="Cari Nomor Penerimaan Konsinyiasi" class="form-control" required />
                     <input type="hidden" name="konsinyiasi_id" id="konsinyiasi_id" class="form-control" required/>
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
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Harga</th>
                              <th>Qty</th>
                              <th>Disc</th>
                           </tr>
                        </thead>
                        <tbody>
                           
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
                                 <th>TOTAL SISA TAGIHAN (IDR) : </th>
                                 <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value=0 /></td>
                              </tr>
                              <!-- <tr>
                                 <th>DISKON (%) : </th>
                                 <td><input type="text" name="diskon" id="diskon" class="form-control" onkeyup="mydiskon(this.value)" value=0 /></td>
                              </tr> -->
                              <tr>
                                 <th>TOTAL BAYAR (IDR) : </th>
                                 <td>
                                    <input type="text" name="total_bayar2" id="total_bayar2" class="form-control" required onkeyup="totalBayar(this.value)" value=0 />
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

                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        <!-- <a href="<?=base_url('hutang/creaPembate')?>" class="btn btn-success mr-2 float-right">Buat Baru</a> -->
                        <a href="<?=base_url('konsinyiasi')?>"Pembayaran class="btn btn-danger mr-2 float-right">Batal</a>
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

function totalBayar(value) {
   var value = value.replace(/\./g,'');
   var total_tagihan = $('#total_tagihan').val().replace(/\./g,'');
   var total = rupiah(value - total_tagihan);
   $('#kembalian').val(total);
   $('#total_bayar2').val(rupiah(value));
   $('#total_bayar').val(value);
}


$(document).ready(function(){

 $('.cari').click(function(){
   var po = $('#search').val();

   if(po != ''){
      $.ajax({
         url:"<?= base_url('konsinyiasi/getKO')?>",
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
               $('#konsinyiasi_id').val(data[0].id);
               $('#pelanggan_id').val(data[0].pelanggan_id);

               $('#total_tagihan').val(rupiah(data[0].sisa));
               table.clear();
               var num = 1;
               $.each(data, function (i, key) {
                  showTable(num++, data[i].nama, data[i].no_part, data[i].harga, data[i].quantity, data[i].diskon)
               });
            }

         }
      });
   }
 });

 function showTable(no, nama, no_part, harga, quantity, diskon) {
   table.row.add([
      no,
      ``+nama+` - `+no_part,
      rupiah(harga),
      quantity,
      diskon
   ]);
   table.draw();
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