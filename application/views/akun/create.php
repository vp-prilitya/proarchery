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

                     <form action="<?=base_url('akun/save')?>" method="post">
                        <div class="form-group">
                           <label for="akun_id">Akun</label>
                           <select class="custom-select select2" required name="akun_id" id="akun_id">
                              <option value="" disabled selected>Pilih Akun</option>
                              <?php $i=1; foreach($data as $db):?>
                                <option value="<?=$db['id']?>|<?=$db['kode']?>|<?=$db['kelompok_id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                              <?php endforeach?>
                            </select>
                        </div>

                        <div class="form-group">
                           <label for="kode">Kode</label>
                           <input type="text" class="form-control" placeholder="Masukan Kode" id="kode" name="kode" required readonly>
                           <input type="hidden" class="form-control" placeholder="Masukan Kode" id="kelompok_id" name="kelompok_id" required readonly>
                           <input type="hidden" class="form-control" placeholder="Masukan Kode" id="parent" name="parent" readonly>
                        </div>

                        <div class="form-group">
                           <label for="nama">Nama</label>
                           <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required>
                        </div>

                        <!-- <div class="form-group">
                           <label for="kelompok_id">Kelompok</label>
                           <select class="custom-select select2" required name="kelompok_id" id="kelompok_id">
                              <option value="" disabled selected>Pilih Kelompok</option>
                              <?php $i=1; foreach($data as $db):?>
                                <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                              <?php endforeach?>
                            </select>
                        </div> -->

                        <div class="form-group">
                           <label for="tipe">Tipe</label>
                           <select class="custom-select select2" required name="tipe" id="tipe">
                              <option value="" disabled selected>Pilih Tipe</option>
                              <option value="Lancar">Lancar</option>
                              <option value="Tetap">Tetap</option>
                            </select>
                        </div>
                        
                        <a href="<?=base_url('akun')?>" class="btn btn-danger mr-2">Batal</a>
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
      $('#akun_id').change(function(){
         var akun_id = $(this).val().split("|");

         $.ajax({
            url:"<?= base_url('akun/getKode')?>",
            type:"POST",
            dataType: 'json',
            data:{akun_id:akun_id},
            success:function(data){
               // console.log(data);
               $('#kode').val(data);
               $('#kelompok_id').val(akun_id[2]);
               $('#parent').val(akun_id[0]);
            }
         });
      });
   });
</script>