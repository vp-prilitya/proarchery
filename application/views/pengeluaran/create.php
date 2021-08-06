<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Tambah <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

         <form action="<?=base_url('transaksi_kas/savePengeluaran')?>" method="post">
         <div class="row mb-3">
            <div class="col-sm-6">
               <div class="white shadow r-15">
                  <div class="card-body">
                     <div class="form-group">
                        <label for="">Pelanggan</label>
                        <select class="custom-select select2" name="user_id" id="user_id" required>
                           <option value="" disabled selected>Pilih Pelanggan</option>
                           <?php foreach($pelanggan as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['nama']?> || <?=$db['contact']?></option>
                           <?php endforeach?>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="white shadow r-15">
                  <div class="card-body">
                     <div class="form-group">
                        <label for="">Akun</label>
                        <select class="custom-select select2" name="akun_id_from" id="akun_id_from" required>
                           <option value="" disabled selected>Dari Akun</option>
                           <?php foreach($akun_from as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                           <?php endforeach?>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
         </div>

            <div class="row">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">

                        <div class="form-group">
                           <label for="rincian">Deskripsi</label>
                           <input type="text" class="form-control" placeholder="Masukan Deskripsi" id="rincian" name="rincian" required>
                        </div>

                        <!-- <div class="form-group">
                           <label for="created">Tanggal</label>
                           <input type="text" class="date-time-picker form-control" value="<?=date('Y-m-d')?>" data-options='{"timepicker":false, "format":"Y-m-d"}' name="created" id="created"/>
                        </div> -->

                        <hr>
                        <div class="row">
                           <div class="col-sm-2"></div>
                           <div class="col-sm-8">
                              <div class="table-responsive">
                                 <table class="table table-striped" width="100%">
                                 <col style="width:50%">
                                 <col style="width:40%">
                                 <col style="width:10%">
                                    <thead>
                                       <tr>
                                          <th>AKUN</th>
                                          <th>JUMLAH</th>
                                          <th>#</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tbody">
                                       <tr id="row1">
                                          <td>
                                             <div class="form-group">
                                                <select class="custom-select select2 abc" required name="akun_id[]" id="akun_id1">
                                                   <option value="" disabled selected>Pilih Akun </option>
                                                   <?php $i=1; foreach($data as $db):?>
                                                   <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                                                   <?php endforeach?>
                                                </select>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="show-kredit1" name="show-kredit1" required onkeyup="totalKredit(1, this.value)" value=0>
                                                <input type="hidden" class="form-control" id="kredit1" name="kredit[]" required  value=0>
                                             </div>
                                          </td>

                                          <td>
                                             <button type="button" class="btn btn-danger btn-xs" onclick="deleteRow('row1')"><i class="icon-delete_forever"></i></button>
                                          </td>
                                       </tr>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <th><strong>Total</strong></th>
                                          <th>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="total_kredit" name="total_kredit" required readonly>
                                             </div>
                                          </th>
                                       </tr>
                                    </tfoot>
                                 </table>
                                 <div class="text-center">
                                    <button type="button" class="btn btn-success" id="Tambah">Tambah Baris</button>
                                 </div>
                                 <hr>
                              </div>
                           </div>

                           <div class="col-sm-12">
                              <input type="hidden" name="jml" id="jml" required value=1>
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

function deleteRow(params) {
   $('#'+params).remove();
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
   console.log('total '+total)
   $('#total_kredit').val(rupiah(total));
}

$(document).ready(function(){
   $('.select2').select2();

   $('#Tambah').click(function(){
      var id = i++;
      var html = `<tr id="row`+id+`">
                     <td>
                        <div class="form-group">
                           <select class="custom-select select2" required name="akun_id[]" id="akun_id`+id+`">
                              <option value="" disabled selected>Pilih Akun </option>
                           </select>
                        </div>
                     </td>

                     <td>
                        <div class="form-group">
                           <input type="text" class="form-control" id="show-kredit`+id+`" name="show-kredit`+id+`" required onkeyup="totalKredit(`+id+`, this.value)" value=0>
                           <input type="hidden" class="form-control" id="kredit`+id+`" name="kredit[]" required value=0>
                        </div>
                     </td>

                     <td>
                        <button type="button" class="btn btn-danger btn-xs" onclick="deleteRow('row`+id+`')"><i class="icon-delete_forever"></i></button>
                     </td>
                  </tr>`;
      
      $('#tbody').append(html);
      $('#akun_id'+id).select2();

      $.each(data, function (i, key) {
         var newOption = new Option(data[i].kode+' - '+data[i].nama, data[i].id, false, false);
         $('#akun_id'+id).append(newOption).trigger('change');
      });

   });
});
</script>