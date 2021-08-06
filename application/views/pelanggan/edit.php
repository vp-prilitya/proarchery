<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Edit <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

            <div class="row">
               <div class="col-sm-6">
                  <div class="white shadow r-15">
                     <div class="card-body">

                     <form action="<?=base_url('pelanggan/update')?>" method="post">
                     <input type="hidden" name="id" id="id" value="<?=$data['id']?>">
                        <div class="form-group">
                           <label for="nama">Nama</label>
                           <input type="text" class="form-control " placeholder="Masukan Nama" id="nama" name="nama" required value="<?=$data['nama']?>">
                        </div>

                        <div class="form-group">
                           <label for="alamat">Alamat</label>
                           <textarea type="text" class="form-control " placeholder="Masukan Alamat" id="alamat" name="alamat" required><?=$data['alamat']?></textarea>
                        </div>

                        <div class="form-group">
                           <label for="contact">Contact</label>
                           <input type="text" class="form-control " placeholder="Masukan Contact" id="contact" name="contact" required value="<?=$data['contact']?>">
                        </div>

                        <div class="form-group">
                           <label for="telp_darurat">Telp Darurat</label>
                           <input type="text" class="form-control" placeholder="Masukan Telp Darurat" id="telp_darurat" name="telp_darurat" required value="<?=$data['telp_darurat']?>">
                        </div>

                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" class="form-control " placeholder="Masukan Email" id="email" name="email" required value="<?=$data['email']?>">
                        </div>

                        <a href="<?=base_url('pelanggan')?>" class="btn btn-danger  mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary ">Ubah</button>
                     </form>

                     </div>
                  </div>
               </div>
            </div>

        </div>
    </div>















    
</div>
