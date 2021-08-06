<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Tambah <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

            <form action="<?=base_url('barang_jual/save')?>" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">


                        <div class="row">

                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="nama">Nama</label>
                                 <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" required>
                              </div>

                              <!-- <div class="form-group">
                                 <label for="harga_pokok">Harga Pokok</label>
                                 <input type="text" class="form-control" placeholder="Masukan Harga Pokok" id="harga_pokok2" name="harga_pokok2" required onkeyup="toRibuan('harga_pokok', this.value)">
                                 <input type="hidden" class="form-control" placeholder="Masukan Harga Pokok" id="harga_pokok" name="harga_pokok" required>
                              </div> -->

                              <div class="form-group">
                                 <label for="jenis_harga_pokok">Jenis Harga Pokok</label>
                                 <select class="custom-select select2" required name="jenis_harga_pokok" id="jenis_harga_pokok">
                                 <option value="" disabled selected>Pilih Harga Pokok</option>
                                    <option value="FIFO">FIFO</option>
                                    <option value="LIFO">LIFO</option>
                                    <option value="AVERAGE">AVERAGE</option>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label for="harga_jual">Harga Jual</label>
                                 <input type="text" class="form-control" placeholder="Masukan Harga Jual" id="harga_jual2" name="harga_jual2" required onkeyup="toRibuan('harga_jual', this.value)">
                                 <input type="hidden" class="form-control" placeholder="Masukan Harga Jual" id="harga_jual" name="harga_jual" required>
                              </div>

                              <div class="form-group">
                                 <label for="no_part">Nomor Part</label>
                                 <input type="text" class="form-control" placeholder="Masukan Nomor Part" id="no_part" name="no_part" required>
                              </div>

                              <div class="form-group">
                                 <label for="satuan">Satuan</label>
                                 <select class="custom-select select2" required name="satuan" id="satuan">
                                 <option value="" disabled selected>Pilih Satuan</option>
                                    <?php $i=1; foreach($satuan as $db):?>
                                       <option value="<?=$db['nama']?>"><?=$db['nama']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label for="jenis_barang">Jenis</label>
                                 <select class="custom-select select2" required name="jenis_barang" id="jenis_barang">
                                    <option value="" disabled selected>Pilih Jenis</option>
                                    <option value="toko">Toko</option>
                                    <option value="jasa">Jasa</option>
                                 </select>
                              </div>
                           </div>

                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="stok">Stok Awal</label>
                                 <input type="number" class="form-control" placeholder="Masukan Stok Awal" id="stok" name="stok">
                              </div>

                              <div class="form-group">
                                 <label for="min_stok">Minimal Stok</label>
                                 <input type="number" class="form-control" placeholder="Masukan Minimal Stok" id="min_stok" name="min_stok">
                              </div>

                              <div class="form-group">
                                 <label for="kategori_id">Kategori</label>
                                 <select class="custom-select select2" required name="kategori_id" id="kategori_id">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <?php $i=1; foreach($data as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label for="gudang_id">Gudang</label>
                                 <select class="custom-select select2" required name="gudang_id" id="gudang_id">
                                 <option value="" disabled selected>Pilih Gudang</option>
                                    <?php $i=1; foreach($gudang as $db):?>
                                    <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                                    <?php endforeach?>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label for="poto">Poto</label>
                                 <input type="file" class="form-control" placeholder="Pilih File" id="poto" name="poto">
                              </div>

                              <div class="form-group">
                                 <label for="Sifat">Sifat</label>
                                 <br>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="simpan" value="simpan" name="sifat[]">
                                    <label class="form-check-label" for="simpan">Disimpan</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="beli" value="beli" name="sifat[]">
                                    <label class="form-check-label" for="beli">Dibeli</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="jual" value="jual" name="sifat[]">
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
                              </tbody>
                           </table>
                           <div class="text-center">
                              <!-- <button type="button" class="btn btn-success" id="tambah">Tambah Baris</button> -->
                              <input type="hidden" name="jml" id="jml" required value=1>
                           </div>
                           <hr>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body text-right">
                        <a href="<?=base_url('barang_jual')?>" class="btn btn-danger mr-2">Batal</a>
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
var data = <?=json_encode($akun)?>;
var i = 2;

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

function hapusTable(id){
   $(id).empty();
}
</script>

<script>
    $(document).ready(function() {
      var table = $('#example').DataTable();
      var table2 = $('#example2').DataTable();
      
      // $('.delete-row').click(function(){
      //    // alert("AMSUK");
      //    table
      //          .row( $(this).parents('tr') )
      //          .remove()
      //          .draw();
      // });

      $('#example tbody').on( 'click', 'button.delete-row', function () {
            table
               .row( $(this).parents('tr') )
               .remove()
               .draw();
      } );

      $('#example2 tbody').on( 'click', 'button.delete-row2', function () {
            table2
               .row( $(this).parents('tr') )
               .remove()
               .draw();
      } );

      // $('.delete-row2').click(function(){
      //    table2
      //          .row( $(this).parents('tr') )
      //          .remove()
      //          .draw();
      // });

      $( "#barang_mentah_id" ).change(function() {
         var id = $('#barang_mentah_id').val();
         $.ajax({
                url:"<?= base_url('barang_jual/getBarangMentah')?>",
                type:"POST",
                dataType: 'json',
                data:{id:id},
                success:function(data){
                     var quantity = `<input type="text" class="form-control" id="quantityBarangMentah`+data.id+`" name="quantityBarangMentah[]" required>
                                    <input type="hidden" class="form-control" id="idBarangMentah`+data.id+`" name="idBarangMentah[]" required value="`+data.id+`">`;

                     var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row"><i class="icon-delete_forever"></i></button>`;

                     table.row.add([
                        data.nama,
                        data.satuan,
                        quantity,
                        aksi
                     ]);
                     table.draw();
                }
         });
      });

      $( "#barang_jual_id" ).change(function() {
         var id = $('#barang_jual_id').val();
         $.ajax({
                url:"<?= base_url('barang_jual/getBarangJual')?>",
                type:"POST",
                dataType: 'json',
                data:{id:id},
                success:function(data){
                     var quantity = `<input type="text" class="form-control" id="quantityBarangJualid`+data.id+`" name="quantityBarangJual[]" required>
                                    <input type="hidden" class="form-control" id="idBarangJualid`+data.id+`" name="idBarangJual[]" required value="`+data.id+`">`;

                     var aksi = `<button type="button" class="btn btn-danger btn-xs delete-row2"><i class="icon-delete_forever"></i></button>`;

                     table2.row.add([
                        data.nama,
                        data.satuan,
                        quantity,
                        aksi
                     ]);
                     table2.draw();
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