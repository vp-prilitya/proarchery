<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Edit <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

            <form action="<?=base_url('barang_jual/updateFnb')?>" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">

                        <input type="hidden" name="id" id="id" value="<?=$data[0]['id']?>">
                        <div class="row">

                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="nama">Nama</label>
                                 <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required value="<?=$data[0]['nama']?>">
                              </div>

                              <div class="form-group">
                                 <label for="harga_pokok">Harga Pokok</label>
                                 <input type="text" class="form-control" placeholder="Masukan Harga Pokok" id="harga_pokok2" name="harga_pokok2" required value="<?=number_format($data[0]['harga_pokok'],0,'','.')?>" onkeyup="toRibuan('harga_pokok', this.value)" readonly>
                                 <input type="hidden" class="form-control" placeholder="Masukan Harga Pokok" id="harga_pokok" name="harga_pokok" required value="<?=$data[0]['harga_pokok']?>">
                              </div>

                              <div class="form-group">
                                 <label for="harga_jual">Harga Jual</label>
                                 <input type="text" class="form-control" placeholder="Masukan Harga Jual" id="harga_jual2" name="harga_jual2" required value="<?=number_format($data[0]['harga_jual'],0,'','.')?>" onkeyup="toRibuan('harga_jual', this.value)">
                                 <input type="hidden" class="form-control" placeholder="Masukan Harga Jual" id="harga_jual" name="harga_jual" required value="<?=$data[0]['harga_jual']?>">
                              </div>

                              <div class="form-group">
                                 <label for="no_part">Nomor Part</label>
                                 <input type="text" class="form-control" placeholder="Masukan Nomor Part" id="no_part" name="no_part" required value="<?=$data[0]['no_part']?>">
                              </div>

                              <div class="form-group">
                                 <label for="satuan">Satuan</label>
                                 <select class="custom-select select2" required name="satuan" id="satuan">
                                 <option value="" disabled selected>Pilih Satuan</option>
                                    <?php $i=1; foreach($satuan as $db):?>
                                       <option value="<?=$db['nama']?>" <?=$data[0]['satuan'] == $db['nama'] ? 'selected':''?>><?=$db['nama']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>
                           </div>

                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="stok">Stok Awal</label>
                                 <input type="number" class="form-control" placeholder="Masukan Stok Awal" id="stok" name="stok"  value="<?=$data[0]['stok']?>">
                              </div>

                              <div class="form-group">
                                 <label for="min_stok">Minimal Stok</label>
                                 <input type="number" class="form-control" placeholder="Masukan Minimal Stok" id="min_stok" name="min_stok"  value="<?=$data[0]['min_stok']?>">
                              </div>

                              <div class="form-group">
                                 <label for="kategori_id">Kategori</label>
                                 <select class="custom-select select2" required name="kategori_id" id="kategori_id">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <?php $i=1; foreach($kat as $db):?>
                                    <option value="<?=$db['id']?>" <?=$data[0]['kategori_id'] == $db['id'] ? 'selected':''?>><?=$db['nama']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label for="poto">Poto</label>
                                 <input type="file" class="form-control" placeholder="Pilih File" id="poto" name="poto">
                              </div>

                              <?php $sifat= explode(',',$data[0]['sifat'])?>
                              <div class="form-group">
                                 <label for="Sifat">Sifat</label>
                                 <br>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="simpan" value="simpan" name="sifat[]" <?=in_array('simpan', $sifat)?'checked':''?>>
                                    <label class="form-check-label" for="simpan">Disimpan</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="beli" value="beli" name="sifat[]" <?=in_array('beli', $sifat)?'checked':''?>>
                                    <label class="form-check-label" for="beli">Dibeli</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="jual" value="jual" name="sifat[]" <?=in_array('jual', $sifat)?'checked':''?>>
                                    <label class="form-check-label" for="jual">Dijual</label>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>

            <div class="row mb-3">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-striped" width="100%">
                              <col style="width:25%">
                              <col style="width:50%">
                              <col style="width:25%">
                              <thead>
                                 <tr>
                                    <th>KETERANGAN</th>
                                    <th>AKUN</th>
                                    <th>JENIS</th>
                                    <!-- <th>#</th> -->
                                 </tr>
                              </thead>
                              <tbody id="tbody">
                                 <?//php $no=1; foreach($data_akun as $db2): $no++;?>
                                 <?php if(array_key_exists('Harga Pokok', $data_akun)):?>
                                 <tr id="row1" class="">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan1" name="keterangan1"  placholder="Masukan Keterangan" readonly value="Harga Pokok">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id1" id="akun_id1">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>" <?=$db['id']==$data_akun['Harga Pokok']['akun_id']?'selected':''?>><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis1" id="jenis1">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" <?='kredit'==$data_akun['Harga Pokok']['jenis']?'selected':''?>>Kredit</option>
                                                <option value="debit" <?='debit'==$data_akun['Harga Pokok']['jenis']?'selected':''?>>Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php else :?>
                                    <tr id="row1" class="hilang">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan1" name="keterangan1"  placholder="Masukan Keterangan" readonly value="Harga Pokok">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id1" id="akun_id1">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis1" id="jenis1">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" selected>Kredit</option>
                                                <option value="debit">Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php endif?>
                                 <?//php endforeach?>

                                 <?php if(array_key_exists('Penjualan', $data_akun)):?>
                                 <tr class="" id="row2">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan2" name="keterangan2"  placholder="Masukan Keterangan" readonly value="Penjualan">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id2" id="akun_id2">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>" <?=$db['id']==$data_akun['Penjualan']['akun_id']?'selected':''?>><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis2" id="jenis2">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" <?='kredit'==$data_akun['Penjualan']['jenis']?'selected':''?>>Kredit</option>
                                                <option value="debit" <?='debit'==$data_akun['Penjualan']['jenis']?'selected':''?>>Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php else :?>
                                    <tr class="hilang" id="row2">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan2" name="keterangan2"  placholder="Masukan Keterangan" readonly value="Penjualan">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id2" id="akun_id2">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis2" id="jenis2">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" selected>Kredit</option>
                                                <option value="debit">Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php endif?>

                                 <?php if(array_key_exists('Persediaan', $data_akun)):?>
                                 <tr class="" id="row3">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan3" name="keterangan3"  placholder="Masukan Keterangan" readonly value="Persediaan">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id3" id="akun_id3">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>" <?=$db['id']==$data_akun['Persediaan']['akun_id']?'selected':''?>><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis3" id="jenis3">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" <?='kredit'==$data_akun['Persediaan']['jenis']?'selected':''?>>Kredit</option>
                                                <option value="debit" <?='debit'==$data_akun['Persediaan']['jenis']?'selected':''?>>Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php else :?>
                                    <tr class="hilang" id="row3">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan3" name="keterangan3"  placholder="Masukan Keterangan" readonly value="Persediaan">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id3" id="akun_id3">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis3" id="jenis3">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" selected>Kredit</option>
                                                <option value="debit">Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php endif?>

                                 <?php if(array_key_exists('Pengiriman Beli', $data_akun)):?>
                                 <tr class="" id="row4">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan4" name="keterangan4"  placholder="Masukan Keterangan" readonly value="Pengiriman Beli">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id4" id="akun_id4">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>" <?=$db['id']==$data_akun['Pengiriman Beli']['akun_id']?'selected':''?>><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis4" id="jenis4">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" <?='kredit'==$data_akun['Pengiriman Beli']['jenis']?'selected':''?>>Kredit</option>
                                                <option value="debit" <?='debit'==$data_akun['Pengiriman Beli']['jenis']?'selected':''?>>Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php else :?>
                                    <tr class="hilang" id="row4">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan4" name="keterangan4"  placholder="Masukan Keterangan" readonly value="Pengiriman Beli">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id4" id="akun_id4">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis4" id="jenis4">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" selected>Kredit</option>
                                                <option value="debit">Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php endif?>

                                 <?php if(array_key_exists('Pengiriman Jual', $data_akun)):?>
                                 <tr class="" id="row5">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan5" name="keterangan5"  placholder="Masukan Keterangan" readonly value="Pengiriman Jual">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id5" id="akun_id5">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>" <?=$db['id']==$data_akun['Pengiriman Jual']['akun_id']?'selected':''?>><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis5" id="jenis5">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" <?='kredit'==$data_akun['Pengiriman Jual']['jenis']?'selected':''?>>Kredit</option>
                                                <option value="debit" <?='debit'==$data_akun['Pengiriman Jual']['jenis']?'selected':''?>>Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php else :?>
                                    <tr class="hilang" id="row5">
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan5" name="keterangan5"  placholder="Masukan Keterangan" readonly value="Pengiriman Jual">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc" name="akun_id5" id="akun_id5">
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>"><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis5" id="jenis5">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" selected>Kredit</option>
                                                <option value="debit">Debit</option>
                                             </select>
                                       </div>
                                    </td>

                                    <td>
                                       <!-- <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row1')"><i class="icon-delete_forever"></i></button> -->
                                    </td>
                                 </tr>
                                 <?php endif?>

                              </tbody>
                           </table>
                           <div class="text-center">
                              <!-- <button type="button" class="btn btn-success" id="tambah">Tambah Baris</button> -->
                              <!-- <input type="hidden" name="jml" id="jml" required value=<?=$no?>> -->
                           </div>
                           <hr>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row mb-3">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-title gradient p-3 r-15" ><h5 class="text-white text-bold"><strong>Tambah Ingredient</strong></h5></div>
                     <div class="card-body">
                        <div class="form-group">
                           <label for="barang_mentah_id">Barang Mentah</label>
                           <select class="custom-select select2" name="barang_mentah_id" id="barang_mentah_id">
                              <option value="" disabled selected>Pilih Barang Mentah</option>
                              <?php $i=1; foreach($barang_mentah as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                              <?php endforeach?>
                           </select>
                        </div>

                        <div class="table-responsive">
                           <table id="example" class="table table-bordered table-striped table-hover data-tables" data-options='{"paging":false}'>
                              <thead>
                                 <tr>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Aksi</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php if($data[0]['need_raw']==1 AND $data[0]['is_paket']==0):?>
                                    <?php foreach($data as $db) : ?>
                                    <tr>
                                       <td><?=$db['paket']?></td>
                                       <td><?=$db['p_satuan']?></td>
                                       <td>
                                          <input type="text" class="form-control" id="hargaBarangMentahSatuan<?=$db['barang_id']?>" name="hargaBarangMentahSatuan[]" required value="<?=number_format($db['harga_pokok'],0,'','.')?>" readonly>
                                          <input type="hidden" class="form-control" id="hargaBarangMentah<?=$db['barang_id']?>" name="hargaBarangMentah[]" required value="<?=$db['harga_pokok'] * $db['quantity']?>">
                                       </td>
                                       <td>
                                          <input type="text" class="form-control" id="quantityBarangMentah<?=$db['barang_id']?>" name="quantityBarangMentah[]" required value="<?=$db['quantity']?>" onkeyup="qty(<?=$db['barang_id']?>, this.value)">
                                          <input type="hidden" class="form-control" id="idBarangMentah<?=$db['barang_id']?>" name="idBarangMentah[]" required value="<?=$db['barang_id']?>">
                                       </td>
                                       <td>
                                          <button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>
                                       </td>
                                    </tr>
                                    <?php endforeach?>
                                 <?php endif?>
                              </tbody>
                           </table>
                        </div>

                        <div class="text-right">
                           <h3 class="text-dark"><strong>Total : <span id="total_table"><?=number_format($data[0]['harga_pokok'],0,'','.')?></span></strong></h3>
                           <h3 class="text-danger hilang kurang"><strong>Harga Jual : <span id="kurang"></span></strong></h3>
                        </div>

                     </div>
                  </div>
               </div>

            </div>

            <div class="row">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body text-right">
                        <a href="<?=base_url('barang_jual/fnb')?>" class="btn btn-danger mr-2 mt-5">Batal</a>
                        <button type="submit" class="btn btn-primary mt-5">Ubah</button>
                     </form>
                     </div>
                  </div>
               </div>
            </div>

        </div>
    </div>















    
</div>
<script>
var data = <?=json_encode($akun)?>;
var i = parseInt(document.getElementById("jml").value) + 1;

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

function _harga_pokok() {
   var harga_jual = $('#harga_jual').val();
   var total = 0;
   $('input[name="hargaBarangMentah[]"]').each(function() {
      total += parseInt(this.value.replace(/\./g,''));
   });

   $('#harga_pokok2').val(rupiah(total));
   $('#harga_pokok').val(total);

   $('#total_table').text(rupiah(total));
   if(parseInt(total) > parseInt(harga_jual)){
      $('.kurang').show();
      $('#kurang').text('- ' + rupiah(total - harga_jual));
   } else {
      $('.kurang').hide();
   }
}

function qty(id, value) {
   var hrg = $('#hargaBarangMentahSatuan'+id).val().replace(/\./g,'') * value;
   $('#hargaBarangMentah'+id).val(hrg);
   _harga_pokok();
}

function hapusTable(id){
   $(id).empty();
}
</script>
<script>

    $(document).ready(function() {
      var table = $('#example').DataTable();
      var table2 = $('#example2').DataTable();
      // play();
      
      $('#example tbody').on( 'click', 'button.delete-row', function () {
            table
               .row( $(this).parents('tr') )
               .remove()
               .draw();

               _harga_pokok();
      } );

      $( "#barang_mentah_id" ).change(function() {
         var id = $('#barang_mentah_id').val();
         $.ajax({
                url:"<?= base_url('barang_jual/getBarangMentah')?>",
                type:"POST",
                dataType: 'json',
                data:{id:id},
                success:function(data){
                     var quantity = `<input type="text" class="form-control" id="quantityBarangMentah`+data.id+`" name="quantityBarangMentah[]" required onkeyup="qty(`+data.id+`, this.value)">
                                    <input type="hidden" class="form-control" id="idBarangMentah`+data.id+`" name="idBarangMentah[]" required value="`+data.id+`">`;

                     var harga = `<input type="text" class="form-control" id="hargaBarangMentahSatuan`+data.id+`" name="hargaBarangMentahSatuan[]" required value="`+rupiah(data.harga_pokok)+`" readonly>
                                 <input type="hidden" class="form-control" id="hargaBarangMentah`+data.id+`" name="hargaBarangMentah[]" required value="`+data.harga_pokok+`">`;

                     var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>`;

                     table.row.add([
                        data.nama,
                        data.satuan,
                        harga,
                        quantity,
                        aksi
                     ]);
                     table.draw();

                     _harga_pokok();
                }
              });
      });

      $('#tambah').click(function(){
            var id = i++;
            var html = `<tr id="row`+id+`">
                           <td>
                              <div class="form-group">
                                 <select class="custom-select select2 abc" required name="akun_id[]" id="akun_id`+id+`">
                                    <option value="" disabled selected>Pilih Akun </option>
                                 </select>
                              </div>
                           </td>

                           <td>
                              <div class="form-group">
                                 <select class="custom-select select2" required name="jenis[]" id="jenis`+id+`">
                                       <option value="" disabled selected>Pilih Jenis</option>
                                    </select>
                              </div>
                           </td>

                           <td>
                              <div class="form-group">
                                 <input type="text" class="form-control" id="keterangan`+id+`" name="keterangan[]" required  placholder="Masukan Keterangan">
                              </div>
                           </td>
                           <td>
                              <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row`+id+`')"><i class="icon-delete_forever"></i></button>
                           </td>
                        </tr>`;
            
            $('#tbody').append(html);
            $('#akun_id'+id).select2();

            $.each(data, function (i, key) {
               var newOption = new Option(data[i].kode+'-'+data[i].nama, data[i].id, false, false);
               $('#akun_id'+id).append(newOption).trigger('change');
            });

            $('#jenis'+id).select2();
            var newOption1 = new Option('Kredit', 'kredit', false, false);
            $('#jenis'+id).append(newOption1).trigger('change');
            var newOption = new Option('Debit', 'debit', false, false);
            $('#jenis'+id).append(newOption).trigger('change');

            $('#jml').val(id);
         });

         $("#simpan").click(function(){
            if($(this).prop('checked') == true){
               $('#row3').show();
               $('#row5').show();
            } else {
               $('#row3').hide();
               $('#row5').hide();
            }
         });

         $("#beli").click(function(){
            if($(this).prop('checked') == true){
               $('#row1').show();
               $('#row4').show();
            } else {
               $('#row1').hide();
               $('#row4').hide();
            }
         });

         $("#jual").click(function(){
            if($(this).prop('checked') == true){
               $('#row2').show();
            } else {
               $('#row2').hide();
            }
         });
    });
</script>