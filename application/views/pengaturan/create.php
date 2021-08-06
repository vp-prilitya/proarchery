<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Tambah Rule <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

            <div class="row">
               <div class="col-sm-6">
                  <div class="white shadow r-15">
                     <div class="card-body">

                     <form action="<?=base_url('pengaturan/save')?>" method="post">
                        <div class="form-group">
                           <label for="variable">Pilih Variable</label>
                           <select class="custom-select select2" required name="variable" id="variable">
                              <option value="" disabled selected>Pilih Variable</option>
                              <option value="penjualan">Penjualan</option>
                              <option value="pembelian">Pembelian</option>
                              <option value="pajak keluaran">Pajak Keluaran</option>
                              <option value="pajak masukan">Pajak Masukan</option>
                              <option value="piutang">Pembayaran Piutang</option>
                              <option value="hutang">Pembayaran Hutang</option>
                           </select>
                        </div>

                        <div class="form-group" id="hide">
                           <label for="jenis">Pilih Jenis</label>
                           <select class="custom-select select2" required name="jenis" id="jenis">
                              <option value="tunai">Tunai</option>
                              <option value="kredit">Kredit</option>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="akun_id">Pilih Akun</label>
                           <select class="custom-select select2" required name="akun_id" id="akun_id">
                              <option value="" disabled selected>Pilih Akun</option>
                              <?php $i=1; foreach($data as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="is_debit">Add To</label>
                           <select class="custom-select select2" required name="is_debit" id="is_debit">
                              <option value=1>Debit</option>
                              <option value=0>Kredit</option>
                           </select>
                        </div>
                        
                        <a href="<?=base_url('pengaturan')?>" class="btn btn-danger mr-2">Batal</a>
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
$(document).ready(function(){
   $('#hide').hide();
   
   $('#variable').change(function(){
      var variable = $('#variable').val();
      
      if(variable == 'piutang' || variable == 'hutang'){
         $('#hide').hide();
      } else {
         $('#hide').show();
      }

   });
});
</script>