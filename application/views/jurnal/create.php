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

                     <form action="<?=base_url('jurnal/save')?>" method="post">
                        <div class="form-group">
                           <label for="rincian">Rincian</label>
                           <input type="text" class="form-control" placeholder="Masukan Rincian" id="rincian" name="rincian" required>
                        </div>

                        <div class="form-group">
                           <label for="created">Tanggal</label>
                           <input type="text" class="date-time-picker form-control" value="<?=date('Y-m-d')?>" data-options='{"timepicker":false, "format":"Y-m-d"}' name="created" id="created"/>
                        </div>

                        <hr>
                        <div class="row">
                           <div class="col-sm-2"></div>
                           <div class="col-sm-8">
                              <div class="table-responsive">
                                 <table class="table table-striped" width="100%">
                                 <col style="width:50%">
                                 <col style="width:25%">
                                 <col style="width:25%">
                                    <thead>
                                       <tr>
                                          <th>AKUN</th>
                                          <th>DEBIT</th>
                                          <th>KREDIT</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tbody">
                                       <tr>
                                          <td>
                                             <div class="form-group">
                                                <select class="custom-select select2 abc" required name="akun_id1" id="akun_id1">
                                                   <option value="" disabled selected>Pilih Akun </option>
                                                   <?php $i=1; foreach($data as $db):?>
                                                   <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                                                   <?php endforeach?>
                                                </select>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="show-debit1" name="show-debit1" required onkeyup="totalDebit(1, this.value)" value=0>
                                                <input type="hidden" class="form-control" id="debit1" name="debit1" required value=0>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="show-kredit1" name="show-kredit1" required onkeyup="totalKredit(1, this.value)" value=0>
                                                <input type="hidden" class="form-control" id="kredit1" name="kredit1" required  value=0>
                                             </div>
                                          </td>
                                       </tr>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <th><strong>Total</strong></th>
                                          <th>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="total_debit" name="total_debit" required readonly>
                                             </div>
                                          </th>
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
                        </div>
                        
                        <input type="hidden" name="jml" id="jml" required value=1>

                        <div class="text-right">
                           <button type="submit" class="btn btn-primary simpan hilang">Simpan</button>
                        </div>
                     </form>

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

function _cek() {
   if($('#total_debit').val().replace(/\./g,'') == $('#total_kredit').val().replace(/\./g,'')){
      $('.simpan').show();
   } else {
      $('.simpan').hide();
   }
}

function totalDebit(id, value){
   var value = value.replace(/\./g,'');
   var jml = $('#jml').val();
   var total = 0;

   $('#show-debit'+id).val(rupiah(value));
   $('#debit'+id).val(value);

   for (let i = 1; i <= jml; i++) {
      total += parseInt($('#debit'+i).val());
   }

   $('#total_debit').val(rupiah(total));
   _cek();
}

function totalKredit(id, value){
   var value = value.replace(/\./g,'');

   var jml = $('#jml').val();
   var total = 0;

   $('#show-kredit'+id).val(rupiah(value));
   $('#kredit'+id).val(value);

   for (let i = 1; i <= jml; i++) {
      total += parseInt($('#kredit'+i).val());
   }

   $('#total_kredit').val(rupiah(total));
   _cek();
}

$(document).ready(function(){
   $('.select2').select2();

   $('#Tambah').click(function(){
      var id = i++;
      var html = `<tr>
                     <td>
                        <div class="form-group">
                           <select class="custom-select select2" required name="akun_id`+id+`" id="akun_id`+id+`">
                              <option value="" disabled selected>Pilih Akun </option>
                           </select>
                        </div>
                     </td>

                     <td>
                        <div class="form-group">
                           <input type="text" class="form-control" id="show-debit`+id+`" name="show-debit`+id+`" required onkeyup="totalDebit(`+id+`, this.value)" value=0>
                           <input type="hidden" class="form-control" id="debit`+id+`" name="debit`+id+`" required value=0>
                        </div>
                     </td>

                     <td>
                        <div class="form-group">
                           <input type="text" class="form-control" id="show-kredit`+id+`" name="show-kredit`+id+`" required onkeyup="totalKredit(`+id+`, this.value)" value=0>
                           <input type="hidden" class="form-control" id="kredit`+id+`" name="kredit`+id+`" required value=0>
                        </div>
                     </td>
                  </tr>`;
      
      $('#tbody').append(html);
      $('#akun_id'+id).select2();

      $.each(data, function (i, key) {
         var newOption = new Option(data[i].kode+ ' - ' + data[i].nama, data[i].id, false, false);
         $('#akun_id'+id).append(newOption).trigger('change');
      });

      $('#jml').val(id);
   });
});
</script>