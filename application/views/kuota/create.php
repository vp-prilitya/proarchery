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
               <div class="col-sm-6">
                  <div class="white shadow r-15">
                     <div class="card-body">

                     <form action="<?=base_url('kuota/save')?>" method="post">
                     <div class="form-group">
                        <label for="barang_jual_id">Produk</label>
                        <select class="custom-select select2" required name="barang_jual_id" id="barang_jual_id">
                              <option value="" disabled selected>Pilih Produk</option>
                              <?php foreach($data as $db):?>
                              <option value="<?=$db['id']?>" data-harga="<?=$db['harga_jual']?>"><?=$db['nama']?> ( <?=$db['detail']?> )</option>
                              <?php endforeach?>
                        </select>
                     </div>

                     <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" placeholder="Masukan Quantity" id="qty" name="qty" required value=1 onkeyup="getqty(this.value)">
                     </div>

                     <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" placeholder="0" id="harga" name="harga" required readonly value="0">
                     </div>

                     <div class="form-group">
                        <label for="total_tagihan">Total Tagihan</label>
                        <input type="text" class="form-control" placeholder="0" id="total_tagihan" name="total_tagihan" required readonly>
                     </div>
                        
                        <a href="<?=base_url('kuota')?>" class="btn btn-danger mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                     </form>

                     </div>
                  </div>
               </div>

               <div class="col-sm-5">
                  <div class="white r-15 shadow">
                     <div class="card-body">
                        Harap Melakukan Tranfer ke Rekening :
                        12345678

                        Sesuai dengan total tagihan anda. Terima KAsih.
                     </div>
                  </div>
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

function getqty(value) {
   var harga = $('#harga').val().replace(/\./g,'');
   $("#total_tagihan").val(rupiah(value*harga));
}

$(document).ready(function(){
   $("#barang_jual_id").change(function(){
      var qty = $('#qty').val();
      var hrg = $(this).find(':selected').data('harga');

      $('#harga').val(rupiah(hrg));
      $('#total_tagihan').val(rupiah(hrg * qty));

   });
});
</script>