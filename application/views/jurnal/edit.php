<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Edit Input <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

            <div class="row">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">

                     <form action="<?=base_url('jurnal/update')?>" method="post">
                     <input type="hidden" name="time" id="time" value="<?=$jurnal[0]['time']?>">
                        <div class="form-group">
                           <label for="rincian">Rincian</label>
                           <input type="text" class="form-control" placeholder="Masukan Rincian" id="rincian" name="rincian" required value="<?=$jurnal[0]['rincian']?>">
                        </div>

                        <div class="form-group">
                           <label for="created">Tanggal</label>
                           <input type="text" class="date-time-picker form-control" value="<?=$jurnal[0]['created']?>" data-options='{"timepicker":false, "format":"Y-m-d"}' name="created" id="created"/>
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
                                       <?php $i=1; $totalDebit = 0; $totalKredit = 0; foreach ($jurnal as $db) :?>
                                       <?php $totalDebit+=$db['debit']; $totalKredit+=$db['kredit']?>
                                       <tr>
                                          <td>
                                             <div class="form-group">
                                                <select class="custom-select select2 abc" required name="akun_id<?=$i?>" id="akun_id<?=$i?>">
                                                   <option value="" disabled selected>Pilih Akun </option>
                                                   <?php foreach($data as $akun):?>
                                                   <option value="<?=$akun['id']?>" <?=$db['akun_id'] == $akun['id']?'selected':''?>><?=$akun['kode']?> - <?=$akun['nama']?></option>
                                                   <?php endforeach?>
                                                </select>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="show-debit<?=$i?>" name="show-debit<?=$i?>" required onkeyup="totalDebit(<?=$i?>, this.value)" value=<?=number_format($db['debit'],0,'','.')?>>
                                                <input type="hidden" class="form-control" id="debit<?=$i?>" name="debit<?=$i?>" required value=<?=$db['debit']?>>
                                             </div>
                                          </td>

                                          <td>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="show-kredit<?=$i?>" name="show-kredit<?=$i?>" required onkeyup="totalKredit(<?=$i?>, this.value)" value=<?=number_format($db['kredit'],0,'','.')?>>
                                                <input type="hidden" class="form-control" id="kredit<?=$i?>" name="kredit<?=$i?>" required  value=<?=$db['kredit']?>>
                                             </div>
                                          </td>
                                       </tr>
                                       <?php $i++; endforeach?>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <th><strong>Total</strong></th>
                                          <th>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="total_debit" name="total_debit" required readonly value=<?=number_format($totalDebit,0,'','.')?>>
                                             </div>
                                          </th>
                                          <th>
                                             <div class="form-group">
                                                <input type="text" class="form-control" id="total_kredit" name="total_kredit" required readonly value=<?=number_format($totalKredit,0,'','.')?>>
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
                        
                        <input type="hidden" name="jml" id="jml" required value=<?=$i-1?>>

                        <div class="text-right">
                           <button type="submit" class="btn btn-primary simpan">Simpan</button>
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
var i = parseInt(document.getElementById("jml").value) + 1;

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
   console.log(total);
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