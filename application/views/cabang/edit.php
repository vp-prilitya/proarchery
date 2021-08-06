<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Edit <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

            <form action="<?=base_url('cabang/update')?>" method="post">
            <div class="row">
               <div class="col-sm-6">
                  <div class="white shadow r-15">
                     <div class="card-body">

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
                           <label for="telp">Telpon</label>
                           <input type="text" class="form-control " placeholder="Masukan Telpon" id="telp" name="telp" required value="<?=$data['telp']?>">
                        </div>

                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" class="form-control " placeholder="Masukan Email" id="email" name="email" required value="<?=$data['email']?>">
                        </div>

                        <div class="form-group">
                           <label for="website">Website</label>
                           <input type="text" class="form-control " placeholder="Masukan Website" id="website" name="website" required value="<?=$data['website']?>">
                        </div>

                     </div>
                  </div>
               </div>

               <div class="col-sm-6">
                  <div class="white shadow r-15">
                     <div class="card-body">

                        <div class="form-group">
                           <label for="nama_pic">Nama PIC</label>
                           <input type="text" class="form-control" placeholder="Masukan Nama PIC" id="nama_pic" name="nama_pic" required value="<?=$data['nama_pic']?>">
                        </div>

                        <div class="form-group">
                           <label for="bagian_pic">Bagian PIC</label>
                           <input type="text" class="form-control" placeholder="Masukan Bagian PIC" id="bagian_pic" name="bagian_pic" required value="<?=$data['bagian_pic']?>">
                        </div>

                        <div class="form-group">
                           <label for="telp_pic">Telpon PIC</label>
                           <input type="text" class="form-control" placeholder="Masukan Telpon PIC" id="telp_pic" name="telp_pic" required value="<?=$data['telp_pic']?>">
                        </div>
                        
                        <a href="<?=base_url('cabang')?>" class="btn btn-danger mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                     </form>

                     </div>
                  </div>
               </div>
            </div>

        </div>
    </div>















    
</div>
