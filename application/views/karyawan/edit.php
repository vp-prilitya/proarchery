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
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">

                     <div class="row">
                        <div class="col-sm-6">
                        <form action="<?=base_url('karyawan/update')?>" method="post">
                        <input type="hidden" name="id" id="id" value="<?=$data['id']?>">
                           <!-- <div class="form-group">
                              <label for="nip">NIP</label>
                              <input type="text" class="form-control" placeholder="Masukan NIP" id="nip" name="nip" required>
                           </div> -->

                           <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required value="<?=$data['nama']?>">
                           </div>

                           <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <textarea type="text" class="form-control" placeholder="Masukan Alamat" id="alamat" name="alamat" required><?=$data['alamat']?></textarea>
                           </div>

                           <div class="form-group">
                              <label for="contact">Contact</label>
                              <input type="text" class="form-control" placeholder="Masukan Contact" id="contact" name="contact" required value="<?=$data['contact']?>">
                           </div>

                           <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" placeholder="Masukan Email" id="email" name="email" required value="<?=$data['email']?>">
                           </div>

                           <div class="form-group">
                                 <label for="jabatan">Jabatan</label>
                                 <select class="custom-select select2" required name="jabatan" id="jabatan">
                                    <option value="" disabled selected>Pilih Jabatan</option>
                                    <option value="1|Tetap" <?=$data['jabatan']=='Tetap' ? 'selected' : ''?>>Tetap</option>
                                    <option value="2|Kontrak" <?=$data['jabatan']=='Kontrak' ? 'selected' : ''?>>Kontrak</option>
                                    <option value="3|Freelance" <?=$data['jabatan']=='Freelance' ? 'selected' : ''?>>Freelance</option>
                                 </select>
                              </div>

                           <div class="form-group">
                                 <label for="divisi_id">Divisi</label>
                                 <select class="custom-select select2" required name="divisi_id" id="divisi_id">
                                    <option value="" disabled selected>Pilih Divisi</option>
                                    <?php $i=1; foreach($div as $db):?>
                                    <option value="<?=$db['id']?>" <?=$data['divisi_id']==$db['id'] ? 'selected' : ''?>><?=$db['nama']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>

                        </div>

                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="gaji">Gaji Pokok</label>
                              <input type="text" class="form-control" placeholder="Masukan Gaji Pokok" id="gaji" name="gaji" required onkeyup="rupiah(this.value, 'gaji')" value="<?=number_format($data['gaji'],0,'','.')?>">
                           </div>

                           <div class="form-group">
                              <label for="telkom">Tunjangan Telekomunikasi</label>
                              <input type="text" class="form-control" placeholder="Masukan Tunjangan Telekomunikasi" id="telkom" name="telkom" required value="<?=number_format($data['telkom'],0,'','.')?>" onkeyup="rupiah(this.value, 'telkom')" >
                           </div>

                           <div class="form-group">
                              <label for="transport">Tunjangan Transport</label>
                              <input type="text" class="form-control" placeholder="Masukan Tunjangan Transport" id="transport" name="transport" required value="<?=number_format($data['transport'],0,'','.')?>" onkeyup="rupiah(this.value, 'transport')">
                           </div>

                           <div class="form-group">
                              <label for="makan">Tunjangan Makan</label>
                              <input type="text" class="form-control" placeholder="Masukan Tunjangan Makan" id="makan" name="makan" required value="<?=number_format($data['makan'],0,'','.')?>" onkeyup="rupiah(this.value, 'makan')">
                           </div>

                           <div class="form-group">
                              <label for="lainnya">Tunjangan Laninnya</label>
                              <input type="text" class="form-control" placeholder="Masukan Tunjangan Laninnya" id="lainnya" name="lainnya" required value="<?=number_format($data['lainnya'],0,'','.')?>" onkeyup="rupiah(this.value, 'lainnya')">
                           </div>

                           <div class="form-group">
                                 <label for="perusahaan_id">Perusahaan</label>
                                 <select class="custom-select select2" required name="perusahaan_id" id="perusahaan_id">
                                    <option value="" disabled selected>Pilih Perusahaan</option>
                                    <?php $i=1; foreach($perusahaan as $db):?>
                                    <option value="<?=$db['id']?>" <?=$data['perusahaan_id']==$db['id'] ? 'selected' : ''?>><?=$db['nama']?></option>
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
