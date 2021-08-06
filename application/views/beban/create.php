<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Input <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

            <div class="row">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">

                     <form action="<?=base_url('beban/save')?>" method="post">
                        
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="akun_id">Pilih Akun Beban</label>
                                 <select class="custom-select select2 abc" required name="akun_id" id="akun_id">
                                    <option value="" disabled selected>Pilih Akun Beban</option>
                                    <?php $i=1; foreach($akun as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="foreign_id">Pilih Penerima</label>
                                 <select class="custom-select select2 abc" required name="foreign_id" id="foreign_id">
                                    <option value="" disabled selected>Pilih Penerima</option>
                                    <?php foreach($karyawan as $db):?>
                                       <option value="<?=$db['id']?>" data-id=1>[KARYAWAN] <?=$db['nama']?> | <?=$db['contact']?></option>
                                    <?php endforeach?>
                                    <?php foreach($pelanggan as $db):?>
                                       <option value="<?=$db['id']?>" data-id=2>[PELANGGAN] <?=$db['nama']?> | <?=$db['contact']?></option>
                                    <?php endforeach?>
                                    <?php foreach($vendor as $db):?>
                                       <option value="<?=$db['id']?>" data-id=3>[VENDOR] <?=$db['nama']?> | <?=$db['telp']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>
                              <input type="hidden" name="type_id" id="type_id" required>
                              <div class="form-group">
                                 <label for="created">Tanggal</label>
                                 <input type="text" class="date-time-picker form-control" value="<?=date('Y-m-d')?>" data-options='{"timepicker":false, "format":"Y-m-d"}' name="created" id="created"/>
                              </div>
                           </div>

                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="total_tagihan">Total Tagihan</label>
                                 <input type="text" class="form-control" placeholder="Masukan Total Tagihan" id="total_tagihan2" name="total_tagihan2" required onkeyup="toRibuan('total_tagihan', this.value)">
                                 <input type="hidden" class="form-control" placeholder="Masukan Total Tagihan" id="total_tagihan" name="total_tagihan" required>
                              </div>
                              <div class="form-group">
                                 <label for="total_bayar">Total Bayar</label>
                                 <input type="text" class="form-control" placeholder="Masukan Total Bayar" id="total_bayar2" name="total_bayar2" required onkeyup="toRibuan('total_bayar', this.value)">
                                 <input type="hidden" class="form-control" placeholder="Masukan Total Bayar" id="total_bayar" name="total_bayar" required>
                              </div>
                              <div class="form-group">
                                 <label for="rincian">Rincian</label>
                                 <input type="text" class="form-control" placeholder="Masukan Rincian" id="rincian" name="rincian" required>
                              </div>
                           </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        <a href="<?=base_url('beban')?>" class="btn btn-danger mr-2 float-right">Batal</a>
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

$(document).ready(function(){
   $('#foreign_id').change(function(){
      var id = $(this).find(':selected').data('id');
      $('#type_id').val(id);
   })
})
</script>