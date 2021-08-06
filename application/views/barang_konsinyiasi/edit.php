<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Ubah <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

         <div class="row">
            <div class="col-sm-12">
               <div class="white shadow r-15">
                  <div class="card-body">

                  <form action="<?=base_url('barang_konsinyiasi/update')?>" method="post">

                  <input type="hidden" name="id" id="id" value="<?=$data['id']?>">

                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="nama">Nama</label>
                           <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required value="<?=$data['nama']?>">
                        </div>

                        <!-- <div class="form-group">
                           <label for="harga_pokok">Harga Pokok</label>
                           <input type="text" class="form-control" placeholder="Masukan Harga Pokok" id="harga_pokok2" name="harga_pokok2" required value="<?=number_format($data['harga_pokok'],0,'','.')?>" onkeyup="toRibuan('harga_pokok', this.value)">
                           <input type="hidden" class="form-control" placeholder="Masukan Harga Pokok" id="harga_pokok" name="harga_pokok" required value="<?=$data['harga_pokok']?>">
                        </div> -->

                        <div class="form-group">
                           <label for="no_part">Nomor Part</label>
                           <input type="text" class="form-control" placeholder="Masukan Nomor Part" id="no_part" name="no_part" required value="<?=$data['no_part']?>">
                        </div>

                        <div class="form-group">
                           <label for="jenis_harga_pokok">Jenis Harga Pokok</label>
                           <select class="custom-select select2" required name="jenis_harga_pokok" id="jenis_harga_pokok">
                           <option value="" disabled selected>Pilih Harga Pokok</option>
                              <option value="FIFO" <?=$data['jenis_harga_pokok'] == 'FIFO' ? 'selected':''?>>FIFO</option>
                              <option value="LIFO" <?=$data['jenis_harga_pokok'] == 'LIFO' ? 'selected':''?>>LIFO</option>
                              <option value="AVERAGE" <?=$data['jenis_harga_pokok'] == 'AVERAGE' ? 'selected':''?>>AVERAGE</option>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="harga_jual">Harga Jual</label>
                           <input type="text" class="form-control" placeholder="Masukan Harga Jual" id="harga_jual2" name="harga_jual2" required value="<?=number_format($data['harga_jual'],0,'','.')?>" onkeyup="toRibuan('harga_jual', this.value)">
                           <input type="hidden" class="form-control" placeholder="Masukan Harga Jual" id="harga_jual" name="harga_jual" required value="<?=$data['harga_jual']?>">
                        </div>

                        <div class="form-group">
                           <label for="satuan">Satuan</label>
                           <select class="custom-select select2" required name="satuan" id="satuan">
                           <option value="" disabled selected>Pilih Satuan</option>
                              <?php $i=1; foreach($satuan as $db):?>
                              <option value="<?=$db['nama']?>" <?=$data['satuan'] == $db['nama'] ? 'selected':''?>><?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>
                     </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="stok">Stok</label>
                           <input type="number" class="form-control" placeholder="Masukan Stok" id="stok" name="stok" required value="<?=$data['stok']?>">
                        </div>

                        <div class="form-group">
                           <label for="min_stok">Minimal Stok</label>
                           <input type="number" class="form-control" placeholder="Masukan Minimal Stok" id="min_stok" name="min_stok" required value="<?=$data['min_stok']?>">
                        </div>

                        <div class="form-group">
                           <label for="kategori_id">Kategori</label>
                           <select class="custom-select select2" required name="kategori_id" id="kategori_id">
                              <option value="" disabled selected>Pilih Kategori</option>
                              <?php $i=1; foreach($kat as $db):?>
                              <option value="<?=$db['id']?>" <?=$data['kategori_id'] == $db['id'] ? 'selected':''?>><?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="gudang_id">Gudang</label>
                           <select class="custom-select select2" required name="gudang_id" id="gudang_id">
                           <option value="" disabled selected>Pilih Gudang</option>
                              <?php $i=1; foreach($gudang as $db):?>
                              <option value="<?=$db['id']?>" <?=$data['gudang_id'] == $db['id'] ? 'selected':''?>><?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="vendor_id">Vendor</label>
                           <select class="custom-select select2" required name="vendor_id" id="vendor_id">
                           <option value="" disabled selected>Pilih Vendor</option>
                              <?php $i=1; foreach($vendor as $db):?>
                              <option value="<?=$db['id']?>" <?=$data['vendor_id'] == $db['id'] ? 'selected':''?>><?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>
                        
                     </div>
                  </div>
                     

                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-sm-12">
               <div class="white shadow r-15">
                  <div class="card-body">
                     <div class="text-right">
                              <a href="<?=base_url('barang_konsinyiasi')?>" class="btn btn-danger mr-2">Batal</a>
                              <button type="submit" class="btn btn-primary">Ubah</button>
                           </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

        </div>
    </div>















    
</div>

<script>
function rupiah(params) {
   var bilangan = params;
   
   var reverse = bilangan.toString().split('').reverse().join(''),
         ribuan 	= reverse.match(/\d{1,3}/g);
         ribuan	= ribuan.join('.').split('').reverse().join('');

   return ribuan;
}

function toRibuan(id, value) {
   var value = value.replace(/\./g,'');
   $('#'+id+'2').val(rupiah(value));
   $('#'+id).val(value);
}
</script>