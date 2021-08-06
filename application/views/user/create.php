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

                     <form action="<?=base_url('user/save')?>" method="post">
                        <div class="form-group">
                           <label for="karyawan">Karyawan</label>
                           <select class="custom-select select2" required name="karyawan" id="karyawan">
                              <option value="" disabled selected>Pilih Karyawan</option>
                              <?php $i=1; foreach($data as $db):?>
                                <option value="<?=$db['id']?>|<?=$db['nama']?>|<?=$db['email']?>|<?=$db['perusahaan_id']?>"><?=$db['nama']?> | <?=$db['divisi']?></option>
                              <?php endforeach?>
                            </select>
                        </div>

                        <div class="form-group">
                           <label for="nama">Nama</label>
                           <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required readonly>
                           <input type="hidden" class="form-control" placeholder="Masukan Nama" id="karyawan_id" name="karyawan_id" required readonly>
                           <input type="hidden" class="form-control" placeholder="Masukan Nama" id="perusahaan_id" name="perusahaan_id" required readonly>
                        </div>

                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" class="form-control" placeholder="Masukan Email" id="email" name="email" required readonly>
                        </div>

                        <div class="form-group">
                           <label for="password">Password</label>
                           <input type="password" class="form-control" placeholder="Masukan Password" id="password" name="password" required>
                        </div>

                        <a href="<?=base_url('user')?>" class="btn btn-danger mr-2">Batal</a>
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
   $( "#karyawan" ).change(function() {
      var data = $('#karyawan').val().split('|');

      $("#karyawan_id").val(data[0]);
      $("#nama").val(data[1]);
      $("#email").val(data[2]);
      $("#perusahaan_id").val(data[3]);
   });
});
</script>