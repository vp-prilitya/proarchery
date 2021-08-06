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
                     <!-- <div class="card-header white">
                        <h6>Tambah <?=$judul?></h6>
                     </div> -->
                     <div class="card-body">

                     <form action="<?=base_url('pelanggan/save')?>" method="post">
                        <div class="form-group">
                           <label for="nama">Nama</label>
                           <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required>
                        </div>

                        <div class="form-group">
                           <label for="alamat">Alamat</label>
                           <textarea type="text" class="form-control" placeholder="Masukan Alamat" id="alamat" name="alamat" required></textarea>
                        </div>

                        <div class="form-group">
                           <label for="contact">Contact</label>
                           <input type="text" class="form-control" placeholder="Masukan Contact" id="contact" name="contact" required>
                        </div>

                        <div class="form-group">
                           <label for="telp_darurat">Telp Darurat</label>
                           <input type="text" class="form-control" placeholder="Masukan Telp Darurat" id="telp_darurat" name="telp_darurat" required>
                        </div>

                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" class="form-control" placeholder="Masukan Email" id="email" name="email" required>
                        </div>
                        
                        <a href="<?=base_url('pelanggan')?>" class="btn btn-danger mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                     </form>

                     </div>
                  </div>
               </div>
            </div>

        </div>
    </div>















    
</div>
