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

                     <form action="<?=base_url('arena/updatePanahan')?>" method="post">
                     <input type="hidden" name="id" id="id" value="<?=$data['id']?>">
                        <div class="form-group">
                           <label for="nama">Nama</label>
                           <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required value="<?=$data['nama']?>">
                        </div>

                        <div class="form-group">
                           <label for="jumlah">Jumlah Bantalan</label>
                           <input type="number" class="form-control" placeholder="Masukan Jumlah Bantalan" id="jumlah" name="jumlah" required value="<?=$data['jumlah']?>">
                        </div>

                        <div class="form-group">
                           <label for="kapasitas">Kapasitas / Bantalan</label>
                           <input type="number" class="form-control" placeholder="Masukan Kapasitas / Bantalan" id="kapasitas" name="kapasitas" required value="<?=$data['kapasitas']?>">
                        </div>

                        <div class="form-group">
                           <label for="kapasitas_maks">Kapasitas Maks</label>
                           <input type="number" class="form-control" placeholder="Masukan Kapasitas Maks" id="kapasitas_maks" name="kapasitas_maks" required readonly value="<?=$data['kapasitas_maks']?>">
                        </div>
                        
                        <a href="<?=base_url('arena/panahan')?>" class="btn btn-danger mr-2">Batal</a>
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
   $('#jumlah').change(function(){
      var jumlah = $('#jumlah').val();
      var kapasitas = $('#kapasitas').val();

      if(jumlah != 0 && kapasitas != 0){
         $('#kapasitas_maks').val(jumlah*kapasitas);
      }
   });

   $('#kapasitas').change(function(){
      var jumlah = $('#jumlah').val();
      var kapasitas = $('#kapasitas').val();

      if(jumlah != 0 && kapasitas != 0){
         $('#kapasitas_maks').val(jumlah*kapasitas);
      }
   });
});
</script>