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

                     <div class="d-flex justify-content-between">
                        <div class="align-self-center">
                           <ul class="nav nav-pills mb-3" role="tablist">
                              <li class="nav-item">
                                    <a class="nav-link active show r-20" id="w3--tab1" data-toggle="tab" href="#w3-tab1" role="tab" aria-controls="tab1" aria-expanded="true" aria-selected="true">Kuda</a>
                              </li>
                              <li class="nav-item">
                                    <a class="nav-link r-20" id="w3--tab2" data-toggle="tab" href="#w3-tab2" role="tab" aria-controls="tab2" aria-selected="false">Panah</a>
                              </li>
                           </ul>
                        </div>
                     </div>

                     <div class="tab-content">
                        <div class="tab-pane fade show active" id="w3-tab1" role="tabpanel" aria-labelledby="w3-tab1">

                           <form action="<?=base_url('booking/saveManual')?>"  method="post">
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

                           <div class="form-group">
                              <label for="jam">Jam</label>
                              <select class="custom-select select2" required name="jam" id="jam">
                                 <option value="" disabled selected>Pilih Jam</option>
                              </select>
                           </div>

                           <div class="form-group">
                              <label for="kuda">Kuda</label>
                              <select class="custom-select select2" required name="kuda" id="kuda">
                                 <option value="" disabled selected>Pilih Kuda</option>
                                 <!-- <option value="1" >Pilih Kuda</option> -->
                              </select>
                           </div>

                           <div class="form-group">
                              <label for="pelatih">Pelatih</label>
                              <select class="custom-select select2" required name="pelatih" id="pelatih">
                                 <option value="" disabled selected>Pilih Pelatih</option>
                                 <?php foreach($pelatih as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                 <?php endforeach?>
                              </select>
                           </div>

                           <div class="form-group">
                              <label for="pelanggan_id">Pelanggan</label>
                              <select class="custom-select select2" required name="pelanggan_id" id="pelanggan_id">
                                 <option value="" disabled selected>Pilih Pelanggan</option>
                                 <?php foreach($pelanggan as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                 <?php endforeach?>
                              </select>
                           </div>
                              
                              <a href="<?=base_url('booking/manual')?>" class="btn btn-danger mr-2">Batal</a>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                           </form>
                        </div>

                        <div class="tab-pane fade" id="w3-tab2" role="tabpanel" aria-labelledby="w3-tab2">

                           <form onsubmit="return validationPanah()" method="post">
                           <div class="form-group">
                              <label for="arena_idPanahan">Arena</label>
                              <select class="custom-select select2" required name="arena_idPanahan" id="arena_idPanahan">
                                    <option value="" disabled selected>Pilih Arena</option>
                                    <?php foreach($data2 as $db):?>
                                       <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                    <?php endforeach?>
                              </select>
                           </div>

                           <div class="form-group">
                              <label for="tanggalPanahan">Tanggal</label>
                              <input type="date" class="form-control" min="<?=date('Y-m-d')?>" name="tanggalPanahan" id="tanggalPanahan" />
                           </div>

                           <div class="form-group">
                              <label for="jamPanahan">Jam</label>
                              <select class="custom-select select2" required name="jamPanahan" id="jamPanahan">
                                 <option value="" disabled selected>Pilih Jam</option>
                              </select>
                           </div>

                           <!-- <div class="form-group">
                              <label for="pelatihPanahan">Pelatih</label>
                              <select class="custom-select select2" required name="pelatihPanahan" id="pelatihPanahan">
                                 <option value="" disabled selected>Pilih Pelatih</option>
                                 <?php foreach($pelatih as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                 <?php endforeach?>
                              </select>
                           </div> -->

                           <div class="form-group">
                              <label for="tanggalPanahan">Jumlah Booking Orang</label>
                              <input type="number" class="form-control" name="jumlah" id="jumlah" />
                           </div>

                           <div class="form-group">
                              <label for="pelanggan_id">Pelanggan</label>
                              <select class="custom-select select2" required name="pelanggan_idPanah" id="pelanggan_idPanah">
                                 <option value="" disabled selected>Pilih Pelanggan</option>
                                 <?php foreach($pelanggan as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                 <?php endforeach?>
                              </select>
                           </div>
                              
                              <a href="<?=base_url('booking/manual')?>" class="btn btn-danger mr-2">Batal</a>
                              <button type="submit" class="btn btn-primary" id="btn-panah">Simpan</button>
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

$(document).ready(function(){
   $("#tanggal").change(function(){
      var tanggal = $(this).val();
      var arena_id = $("#arena_id").val();
      if(arena_id != null){
         getJam(tanggal, arena_id);
      }
   });

   $("#arena_id").change(function(){
      var arena_id = $(this).val();
      var tanggal = $("#tanggal").val();
      if(tanggal != null && tanggal != ''){
         getJam(tanggal, arena_id);
      }
   });

   function getJam(tanggal,arena_id){
      $.ajax({
         url:"<?= base_url('booking/getTanggalAndJam')?>",
         type:"POST",
         dataType: 'json',
         data:{tanggal:tanggal, arena_id:arena_id},
         success:function(data){
            if(data.jam.length == 0){
               Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Gagal',
                  text: 'Data Tanggal / Jam Tidak Ditemukan. Silahkan Pilih Tanggal Kembali',
                  showConfirmButton: false,
                  timer: 2500
               });
            } else {
               $('#jam').val(null).trigger('change');
               $.each(data.jam, function (i, key) {
                  var mydata = {
                     id: data.jam[i].jam,
                     text: data.jam[i].jam
                  };

                  if ($('#jam').find("option[value='" + mydata.id + "']").length) {
                     // $('#jam').val(mydata.id).trigger('change');
                  } else { 
                     var newOption = new Option(mydata.text, mydata.id, false, false);
                     $('#jam').append(newOption).trigger('change');
                  } 

               });
            }
         }
      });
   }

   $("#jam").change(function(){
      var jam = $(this).val();
      var tanggal = $("#tanggal").val();
      if(jam !== null){
         $.ajax({
            url:"<?= base_url('booking/getKuda')?>",
            type:"POST",
            dataType: 'json',
            data:{tanggal:tanggal, jam:jam},
            success:function(data){
               console.log(data);
               if(data.length == 0){
                  Swal.fire({
                     position: 'center',
                     icon: 'error',
                     title: 'Gagal',
                     text: 'Data Kuda Tidak Ditemukan. Silahkan Pilih Jam Kembali',
                     showConfirmButton: false,
                     timer: 2500
                  });
               } else {
                  // $('#kuda').val('').trigger('change');
                  // $('#kuda').val(null).trigger('change');
                  $('#kuda').html('').select2({data: [{id: '', text: 'Pilih Kuda'}]});
                  $.each(data, function (i, key) {
                     var mydata = {
                        id: data[i].id,
                        text: data[i].nama
                     };

                     if ($('#kuda').find("option[value='" + mydata.id + "']").length) {
                        $('#kuda').val(mydata.id).trigger('change');
                     } else { 
                        var newOption = new Option(mydata.text, mydata.id, true, true);
                        $('#kuda').append(newOption).trigger('change');
                     } 

                  });
               }
            }
         });
      }
   });

   $("#tanggalPanahan").change(function(){
      var tanggal = $(this).val();
      var arena_id = $("#arena_idPanahan").val();
      if(arena_id != null){
         getJamPanahan(tanggal, arena_id);
      }
   });

   $("#arena_idPanahan").change(function(){
      var arena_id = $(this).val();
      var tanggal = $("#tanggalPanahan").val();
      if(tanggal != null && tanggal != ''){
         getJamPanahan(tanggal, arena_id);
      }
   });
   
   function getJamPanahan(tanggal,arena_id){
      $.ajax({
         url:"<?= base_url('booking/getTanggalAndJamPanahan')?>",
         type:"POST",
         dataType: 'json',
         data:{tanggal:tanggal, arena_id:arena_id},
         success:function(data){
            $('#jamPanahan').val(null).trigger('change');

            if(data.jam.length == 0){
               Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Gagal',
                  text: 'Data Tanggal / Jam Tidak Ditemukan. Silahkan Pilih Tanggal Kembali',
                  showConfirmButton: false,
                  timer: 2500
               });
            } else {
               $('#jamPanahan').val(null).trigger('change');
               $.each(data.jam, function (i, key) {
                  var mydata = {
                     id: data.jam[i].jam,
                     text: data.jam[i].jam
                  };

                  if ($('#jamPanahan').find("option[value='" + mydata.id + "']").length) {
                     // $('#jamPanahan').val(mydata.id).trigger('change');
                  } else { 
                     var newOption = new Option(mydata.text, mydata.id, false, false);
                     $('#jamPanahan').append(newOption).trigger('change');
                  } 

               });
            }
         }
      });
   }

   $("#jamPanahan").change(function(){
      var jamPanahan = $(this).val();
      var tanggalPanahan = $("#tanggalPanahan").val();
      var arena_idPanahan = $("#arena_idPanahan").val();

      if(jam !== null){
         $.ajax({
            url:"<?= base_url('booking/getPanahan')?>",
            type:"POST",
            dataType: 'json',
            data:{tanggalPanahan:tanggalPanahan, jamPanahan:jamPanahan, arena_idPanahan:arena_idPanahan},
            success:function(data){
               console.log(data);
               console.log(data.length);
               if(data.length == 0){
                  Swal.fire({
                     position: 'center',
                     icon: 'error',
                     title: 'Gagal',
                     text: 'Arena Sudah Penuh. Silahkan Pilih Jam Kembali',
                     showConfirmButton: false,
                     timer: 2500
                  });
               }
            }
         });
      }
   });

   $("#btn-panah").click(function(e){
        e.preventDefault();
        var arena_idPanahan = $('#arena_idPanahan').val(); 
        var tanggalPanahan = $('#tanggalPanahan').val(); 
        var jamPanahan = $('#jamPanahan').val(); 
        var jumlah = $('#jumlah').val();
        var idpel = $('#pelanggan_idPanah').val(); 

        if(arena_idPanahan == null){
            Swal.fire({
               position: 'center',
               icon: 'error',
               title: 'Gagal',
               text: 'Arena harus di isi',
               showConfirmButton: false,
               timer: 2500
            });

         return false;
        }

        if(tanggalPanahan == null){
            Swal.fire({
               position: 'center',
               icon: 'error',
               title: 'Gagal',
               text: 'Tanggal harus di isi',
               showConfirmButton: false,
               timer: 2500
            });
         return false;
        }

         if(jamPanahan == null){
            Swal.fire({
               position: 'center',
               icon: 'error',
               title: 'Gagal',
               text: 'Jam harus di isi',
               showConfirmButton: false,
               timer: 2500
         });
         return false;
        }

         if(jumlah == 0){
            Swal.fire({
               position: 'center',
               icon: 'error',
               title: 'Gagal',
               text: 'Jumlah Booking harus di isi',
               showConfirmButton: false,
               timer: 2500
            });

         return false;
        }

        if(idpel == null){
            Swal.fire({
               position: 'center',
               icon: 'error',
               title: 'Gagal',
               text: 'Pelanggan harus di isi',
               showConfirmButton: false,
               timer: 2500
            });

         return false;
        }

         

        $.ajax({
            url:"<?= base_url('booking/saveManualPanahan')?>",
            type:"POST",
            dataType: 'json',
            data:{arena_idPanahan:arena_idPanahan, tanggalPanahan:tanggalPanahan, jamPanahan:jamPanahan,jumlah : jumlah, pelanggan_idPanah : idpel},
            success:function(data){
               if(data == 1){
                  window.location.href = "<?= base_url('booking/manual')?>";
               }else{
                  Swal.fire({
                     position: 'center',
                     icon: 'error',
                     title: 'Gagal',
                     text: 'Jumlah Booking anda sudah melebihi kapasitas maximun untuk jam ' + jamPanahan,
                     showConfirmButton: false,
                     timer: 2500
                  });
               }
            }
         });
   })
   
});
</script>