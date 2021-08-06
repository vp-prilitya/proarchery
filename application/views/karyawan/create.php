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
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">

                     <div class="row">
                        <div class="col-sm-6">
                        <form action="<?=base_url('karyawan/save')?>" method="post">
                           <!-- <div class="form-group">
                              <label for="nip">NIP</label>
                              <input type="text" class="form-control" placeholder="Masukan NIP" id="nip" name="nip" required>
                           </div> -->

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
                              <label for="email">Email</label>
                              <input type="email" class="form-control" placeholder="Masukan Email" id="email" name="email" required>
                           </div>

                           <div class="form-group">
                                 <label for="jabatan">Status Kepegawaian</label>
                                 <select class="custom-select select2" required name="jabatan" id="jabatan">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="1|Tetap">Tetap</option>
                                    <option value="2|Kontrak">Kontrak</option>
                                    <option value="3|Freelance">Freelance</option>
                                 </select>
                              </div>

                           <div class="form-group">
                                 <label for="divisi_id">Divisi</label>
                                 <select class="custom-select select2" required name="divisi_id" id="divisi_id">
                                    <option value="" disabled selected>Pilih Divisi</option>
                                    <?php $i=1; foreach($div as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>

                        </div>

                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="gaji">Gaji Pokok</label>
                              <input type="text" class="form-control" placeholder="Masukan Gaji Pokok" id="gaji" name="gaji" required onkeyup="rupiah(this.value, 'gaji')">
                           </div>

                           <div class="form-group">
                              <label for="telkom">Tunjangan Telekomunikasi</label>
                              <input type="text" class="form-control" placeholder="Masukan Tunjangan Telekomunikasi" id="telkom" name="telkom" required onkeyup="rupiah(this.value, 'telkom')" >
                           </div>

                           <div class="form-group">
                              <label for="transport">Tunjangan Transport</label>
                              <input type="text" class="form-control" placeholder="Masukan Tunjangan Transport" id="transport" name="transport" required onkeyup="rupiah(this.value, 'transport')">
                           </div>

                           <div class="form-group">
                              <label for="makan">Tunjangan Makan</label>
                              <input type="text" class="form-control" placeholder="Masukan Tunjangan Makan" id="makan" name="makan" required onkeyup="rupiah(this.value, 'makan')">
                           </div>

                           <div class="form-group">
                              <label for="lainnya">Tunjangan Laninnya</label>
                              <input type="text" class="form-control" placeholder="Masukan Tunjangan Laninnya" id="lainnya" name="lainnya" required onkeyup="rupiah(this.value, 'lainnya')">
                           </div>

                           <div class="form-group">
                                 <label for="perusahaan_id">Perusahaan</label>
                                 <select class="custom-select select2" required name="perusahaan_id" id="perusahaan_id">
                                    <option value="" disabled selected>Pilih Perusahaan</option>
                                    <?php $i=1; foreach($perusahaan as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>

                              <a href="<?=base_url('karyawan')?>" class="btn btn-danger mr-2">Batal</a>
                              <button type="submit" class="btn btn-primary">Simpan</button>
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
   function rupiah1(params) {
      var bilangan = params;
      
      var reverse = bilangan.toString().split('').reverse().join(''),
            ribuan 	= reverse.match(/\d{1,3}/g);
            ribuan	= ribuan.join('.').split('').reverse().join('');

      return ribuan;
      // $('#'+id).val(rupiah);
   }

   function rupiah(params, id) {
      $('#'+id).val(rupiah1(params.replace(/\./g,'')));
   }
</script>