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

                     <form action="<?=base_url('uang_muka_pembelian/save')?>" method="post">
                        <div class="form-group">
                           <label for="vendor_id">Pilih Vendor</label>
                           <select class="custom-select select2" name="vendor_id" id="vendor_id" required>
                              <option value="" disabled selected>Pilih Vendor</option>
                              <?php foreach($pelanggan as $db):?>
                                 <option value="<?=$db['id']?>"><?=$db['nama']?> || <?=$db['telp']?></option>
                              <?php endforeach?>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="jumlah2">Jumlah</label>
                           <input type="text" class="form-control" placeholder="Masukan Jumlah" id="jumlah2" name="jumlah2" required onkeyup="jumlahBayar(this.value)">
                        </div>

                        <div class="form-group">
                           <label for="jenis_ppn">Pilih Jenis Pajak</label>
                           <select class="custom-select select2" name="jenis_ppn" id="jenis_ppn" required>
                              <option value="" disabled selected>Pilih Jenis PPN</option>
                              <option value="exclude">Exclude PPN</option>
                              <option value="include">Include PPN</option>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="ppn">Pajak</label>
                           <input type="text" class="form-control" placeholder="Masukan ppn" id="ppn" name="ppn" required value=0 readonly>
                        </div>

                        <div class="form-group">
                           <input type="hidden" class="form-control"id="jumlah" name="jumlah" required readonly>
                        </div>

                        <div class="form-group">
                           <label for="akun_id">Pilih Akun</label>
                           <select class="custom-select select2" name="akun_id" id="akun_id" required>
                              <option value="" disabled selected>Pilih Akun</option>
                              <?php foreach($akun as $db):?>
                                 <option value="<?=$db['id']?>"><?=$db['kode']?>-<?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="catatan">Memo</label>
                           <textarea class="form-control" placeholder="Masukan Memo" id="catatan" name="catatan" required></textarea>
                        </div>
                        
                        <a href="<?=base_url('uang_muka_pembelian')?>" class="btn btn-danger mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                     </form>

                     </div>
                  </div>
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

function jumlahBayar(value) {
   var value = value.replace(/\./g,'');
   $('#jumlah2').val(rupiah(value));
   $('#jumlah').val(value);

   var jenis = $('#jenis_ppn').val();
   ppn(jenis);
}

function ppn(jenis) {

   if(jenis == 'exclude'){
      var total = $("#jumlah2").val().replace(/\./g,'');
      var ppn = parseInt(total)*0.1;
      $("#ppn").val(rupiah(ppn));
      $("#jumlah_total").val(rupiah(parseInt(total)+parseInt(ppn)));
      $('#jumlah').val(parseInt(total)+parseInt(ppn));
   }

   if(jenis == 'include'){
      var jumlah = $("#jumlah2").val().replace(/\./g,'');
      var total = jumlah/1.1;
      var ppn = parseInt(total.toFixed(1))*0.1;
      $("#ppn").val(addCommas(ppn));
      $('#jumlah').val(jumlah);
   }
}

$(document).ready(function(){
   $('#jenis_ppn').change(function(){
      var jenis = $(this).val();

      ppn(jenis);
   });
});
</script>