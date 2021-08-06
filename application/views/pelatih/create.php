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

                     <form action="<?=base_url('pelatih/save')?>" method="post">
                        <!--<div class="form-group">-->
                        <!--   <label for="nama">Nama</label>-->
                        <!--   <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required>-->
                        <!--</div>-->
                        
                        <div class="form-group">
                     <label for="">Pilih Pelatih</label>
                     <select class="custom-select select2" name="nama" id="nama">
                     <option value="" disabled selected>Pilih Pelatih</option>
                     <?php foreach($pelatih as $db):?>
                        <option value="<?=$db['nama']?>"><?=$db['nip']?> - <?=$db['nama']?></option>
                     <?php endforeach?>
                  </select>
                  </div>
                        
                        <a href="<?=base_url('pelatih')?>" class="btn btn-danger mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                     </form>

                     </div>
                  </div>
               </div>
            </div>

        </div>
    </div>















    
</div>
