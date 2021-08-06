<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Tambah <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

         <form action="<?=base_url('transaksi_kas/saveTransfer')?>" method="post">
            <div class="row">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">

                        <div class="form-group">
                           <label for="rincian">Deskripsi</label>
                           <input type="text" class="form-control" placeholder="Masukan Deskripsi" id="rincian" name="rincian" required>
                        </div>

                        <div class="form-group">
                           <label for="created">Tanggal</label>
                           <input type="text" class="date-time-picker form-control" value="<?=date('Y-m-d')?>" data-options='{"timepicker":false, "format":"Y-m-d"}' name="created" id="created"/>
                        </div>

                        <hr>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="table-responsive">
                                 <table class="table table-striped" width="100%">
                                 <col style="width:30%">
                                 <col style="width:30%">
                                 <col style="width:40%">
                                    <thead>
                                       <tr>
                                          <th>DARI AKUN</th>
                                          <th>KE AKUN</th>
                                          <th>JUMLAH</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tbody">
                                       <tr id="row1">
                                          <td>
                                             <div class="form-group">
                                                <select class="custom-select select2 abc" required name="akun_id_from" id="akun_id_from">
                                                   <option value="" disabled selected>Pilih Akun </option>
                                                   <?php $i=1; foreach($data as $db):?>
                                                   <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                                   <?php endforeach?>
                                                </select>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <select class="custom-select select2 abc" required name="akun_id" id="akun_id">
                                                   <option value="" disabled selected>Pilih Akun </option>
                                                   <?php $i=1; foreach($data as $db):?>
                                                   <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                                   <?php endforeach?>
                                                </select>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="show-kredit1" name="show-kredit1" required onkeyup="totalKredit(1, this.value)" value=0>
                                                <input type="hidden" class="form-control" id="kredit1" name="kredit" required  value=0>
                                             </div>
                                          </td>

                                       </tr>
                                    </tbody>
                                 </table>
                                 <hr>
                              </div>
                           </div>

                           <div class="col-sm-12">
                              <button type="submit" class="btn btn-primary float-right">Simpan</button>
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
var data = <?=json_encode($data)?>;
var i = 2;

function rupiah(params) {
   var bilangan = params;
   
   var reverse = bilangan.toString().split('').reverse().join(''),
         ribuan 	= reverse.match(/\d{1,3}/g);
         ribuan	= ribuan.join('.').split('').reverse().join('');

   return ribuan;
}

function totalKredit(id, value){
   var value = value.replace(/\./g,'');
   console.log(value);
   var total = 0;

   $('#show-kredit'+id).val(rupiah(value));
   $('#kredit'+id).val(value);

   $('input[name="kredit[]"]').each(function() {
      total += parseInt(this.value);
      console.log('masuk');
   });
   $('#total_kredit').val(rupiah(total));
}
</script>