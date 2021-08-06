<div class="container-fluid animatedParent animateOnce my-3">
      <div class="animated fadeInUpShort">
         <form action="<?=base_url('stock_opname/saveGudang')?>" method="post">

         <div class="row ml-1">
                  <div class="r-15 mb-3 gradient shadow">
                     <div class="card-body" >
                        <h5 class="text-white text-bold"><strong><?=$judul?> </strong></h5>
                     </div>
                  </div>
            </div>
         
            <div class="row">
               <div class="col-sm-6">
                  <div class="white shadow r-15 mb-3">
                     <div class="card-body">
                        <select class="custom-select select2" name="gudang_awal" id="gudang_awal">
                           <option value="" disabled selected>Pilih Gudang Awal</option>
                           <?php foreach($data as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                           <?php endforeach?>
                        </select>
                     </div>
                  </div>
               </div>

               <div class="col-sm-6">
                  <div class="white shadow r-15 mb-3">
                     <div class="card-body">
                        <select class="custom-select select2" name="gudang_tujuan" id="gudang_tujuan">
                           <option value="" disabled selected>Pilih Gudang Tujuan</option>
                           <?php foreach($data as $db):?>
                              <option value="<?=$db['id']?>"><?=$db['nama']?></option>
                           <?php endforeach?>
                        </select>
                     </div>
                  </div>
               </div>

            </div>

            <div class="white shadow r-15">
               <!-- <div class="card-header white"> -->
               <div class="row">
                  <div class="col-sm-10">
                     <!-- <h6 class=""> Daftar <?=$judul?> </h6> -->
                  </div>
                  <!-- <div class="col">
                     <a href="<?=base_url('divisi/create')?>" class="btn btn-primary btn-xs float-right mt-5 mr-5"><i class="icon-plus"></i> Tambah</a>
                  </div> -->
               <!-- </div> -->
               </div>
               <div class="card-body">
                  <!-- <div id="buttons2" style="padding: 10px; margin-bottom: 10px;width: 25%;">
                        <p>Download :</p>
                  </div> -->
                  <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Nama</th>
                           <th>Satuan</th>
                           <th>Stok</th>
                           <th>Gudang</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
                  </div>
               </div>
            </div>

         </div>

         <div class="row mt-3">
            <div class="col-sm-12">
               <div class="white shadow r-15">
                  <div class="card-body">
                     <div class="text-right">
                              <a href="<?=base_url('stock_opname/pindah_gudang')?>" class="btn btn-danger">Batal</a>
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
$(document).ready(function() {
   var table = $('#example2').DataTable();

   $( "#gudang_awal" ).change(function() {
      var id = $('#gudang_awal').val();
      var gudang = $(this).find(':selected').text();

      $.ajax({
         url:"<?= base_url('stock_opname/getBarang')?>",
         type:"POST",
         dataType: 'json',
         data:{id:id},
         success:function(data){
            console.log(data);
            table.clear();
            var j = 1;
            $.each(data.jual, function (i, key) {
               var aksi = `<div class="material-switch">
                                    <input id="id`+data.jual[i].id+`" name="id[]" type="checkbox" value=`+data.jual[i].id+` />
                                    <label for="id`+data.jual[i].id+`" class="bg-primary"></label>
                              </div>`;
               table.row.add([
                  j++,
                  data.jual[i].nama,
                  data.jual[i].satuan,
                  data.jual[i].stok,
                  gudang,
                  aksi
               ]);
            });

            $.each(data.mentah, function (i, key) {
               var aksi = `<div class="material-switch">
                                    <input id="idRaw`+data.mentah[i].id+`" name="idRaw[]" type="checkbox" value=`+data.mentah[i].id+` />
                                    <label for="idRaw`+data.mentah[i].id+`" class="bg-primary"></label>
                              </div>`;
               table.row.add([
                  j++,
                  data.mentah[i].nama,
                  data.mentah[i].satuan,
                  data.mentah[i].stok,
                  gudang,
                  aksi
               ]);
            });

            table.draw();
         }
      });
   });
});
</script>