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

                     <form action="<?=base_url('booking/save')?>" method="post">
                     <div class="form-group">
                        <label for="arena_id">Arena</label>
                        <select class="custom-select select2" required name="arena_id" id="arena_id">
                              <option value="" disabled selected>Pilih Arena</option>
                              <?php foreach($data as $db):?>
                                 <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                              <?php endforeach?>
                        </select>
                     </div>

                     <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" min="<?=date('Y-m-d')?>" name="tanggal" id="tanggal" />
                     </div>

                     <div class="form-group hilang jam">
                        <label for="jam">Jam</label>
                        <select class="custom-select select2" required name="jam" id="jam">
                           <option value="" disabled selected>Pilih Jam</option>
                        </select>
                     </div>
                        
                        <a href="<?=base_url('booking')?>" class="btn btn-danger mr-2">Batal</a>
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
function rupiah(params) {
   var bilangan = params;
   
   var reverse = bilangan.toString().split('').reverse().join(''),
         ribuan 	= reverse.match(/\d{1,3}/g);
         ribuan	= ribuan.join('.').split('').reverse().join('');

   return ribuan;
}

function custom(value) {
   $("#total_tagihan").val(rupiah(value*50000));
}

$(document).ready(function(){
   $("#tanggal").change(function(){
      var tanggal = $(this).val();
      var arena_id = $("#arena_id").val();

      $.ajax({
         url:"<?= base_url('booking/getJadwal')?>",
         type:"POST",
         dataType: 'json',
         data:{tanggal:tanggal, arena_id:arena_id},
         success:function(data){
            // console.log(data);
            if(data.length == 0 || data == false){
               $('.jam').hide();
               Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Gagal',
                  text: 'Data Tanggal / Jam Tidak Ditemukan. Silahkan Pilih Tanggal Kembali',
                  showConfirmButton: false,
                  timer: 2500
               });
            } else {
               $('.jam').show();
               $('#jam').val(null).trigger('change');
               $.each(data, function (i, key) {
                  var mydata = {
                     id: data[i].jam,
                     text: data[i].jam
                  };

                  if ($('#jam').find("option[value='" + mydata.id + "']").length) {
                     $('#jam').val(mydata.id).trigger('change');
                  } else { 
                     var newOption = new Option(mydata.text, mydata.id, true, true);
                     $('#jam').append(newOption).trigger('change');
                  } 

               });
            }
         }
      });
   });

});
</script>