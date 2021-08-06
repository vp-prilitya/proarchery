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

                     <form action="<?=base_url('bank/update')?>" method="post">
                     <input type="hidden" name="id" id="id" value="<?=$data['id']?>">
                        <div class="form-group">
                           <label for="nama">Nama</label>
                           <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required value="<?=$data['nama']?>">
                        </div>

                        <div class="form-group">
                           <label for="no_rek">Nomor Rekening</label>
                           <input type="text" class="form-control" placeholder="Masukan Nomor Rekening" id="no_rek" name="no_rek" required value="<?=$data['no_rek']?>">
                        </div>

                        <div class="form-group">
                           <label for="nama_pemilik">Nama Pemilik</label>
                           <input type="text" class="form-control" placeholder="Masukan Nama Pemilik" id="nama_pemilik" name="nama_pemilik" required value="<?=$data['nama_pemilik']?>">
                        </div>
                        
                        <a href="<?=base_url('bank')?>" class="btn btn-danger mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                     </form>

                     </div>
                  </div>
               </div>
            </div>

        </div>
    </div>















    
</div>
