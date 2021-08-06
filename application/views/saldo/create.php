<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Pembukaan <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

            <div class="row">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">

                     <form action="<?=base_url('saldo/save')?>" method="post">
                        <div class="form-group">
                           <label for="akun_id">Pilih Akun</label>
                           <select class="custom-select select2 abc" required name="akun_id" id="akun_id">
                              <option value="" disabled selected>Pilih Akun</option>
                              <?php $i=1; foreach($data as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="jenis">Pilih Jenis Transaksi</label>
                           <select class="custom-select select2 abc" required name="jenis" id="jenis">
                              <option value="" disabled selected>Pilih Jenis Transaksi</option>
                              <option value=1>Debit</option>
                              <option value=2>Kredit</option>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="jumlah">Jumlah</label>
                           <input type="text" class="form-control" placeholder="Masukan Jumlah" id="jumlah2" name="jumlah2" required onkeyup="toRibuan('jumlah', this.value)">
                           <input type="hidden" class="form-control" placeholder="Masukan Jumlah" id="jumlah" name="jumlah" required>
                        </div>

                        <div class="form-group">
                           <label for="created">Tanggal</label>
                           <input type="text" class="date-time-picker form-control" value="<?=date('Y-m-d')?>" data-options='{"timepicker":false, "format":"Y-m-d"}' name="created" id="created"/>
                        </div>

                        <div class="form-group">
                           <label for="rincian">Keterangan</label>
                           <input type="text" class="form-control" placeholder="Masukan Rincian" id="rincian" name="rincian" required>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                     </form>

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

function toRibuan(id, value) {
   var value = value.replace(/\./g,'');
   $('#'+id+'2').val(rupiah(value));
   $('#'+id).val(value);
}
</script>