<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong><?=$judul?> : <?=$data['nama']?></strong></h5>
                  </div>
               </div>
         </div>

            <div class="row">
               <div class="col-sm-6">
                  <div class="white shadow r-15">
                     <div class="row">
                        <div class="col-sm-12">
                           <button type="button" data-toggle="modal" data-target="#exampleModalTanggal" class="btn btn-primary btn-xs float-right mt-4 mr-4"><i class="icon-plus"></i> Tambah Tanggal Libur</button>
                        </div>
                     </div>
                     <div class="card-body">

                     <div class="table-responsive">
                     <table id="example2" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Tanggal Libur</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=1; foreach($tanggal as $db):?>
                              <tr>
                                 <td><?=$i++?></td>
                                 <td><?=$db['tanggal']?></td>
                                 <td>
                                    <a href="<?=base_url('arena/deleteTanggal/')?><?=$db['id']?>/<?=$data['id']?>" class="btn btn-danger btn-xs tombol-hapus" ><i class="icon-delete_forever"></i> Hapus</a>
                                 </td>
                              </tr>
                           <?php endforeach?>
                        </tbody>
                     </table>
                     </div>

                     </div>
                  </div>
               </div>

               <div class="col-sm-6">
                  <div class="white shadow r-15">
                     <div class="row">
                        <div class="col-sm-12">
                           <button type="button" data-toggle="modal" data-target="#exampleModalJam" class="btn btn-primary btn-xs float-right mt-4 mr-4"><i class="icon-plus"></i> Tambah Jam</button>
                        </div>
                     </div>
                     <div class="card-body">

                     <div class="table-responsive">
                     <table id="example2" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Tanggal</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=1; foreach($jam as $db):?>
                              <tr>
                                 <td><?=$i++?></td>
                                 <td><?=$db['jam']?></td>
                                 <td>
                                    <a href="<?=base_url('arena/deleteJam/')?><?=$db['id']?>/<?=$data['id']?>" class="btn btn-danger btn-xs tombol-hapus" ><i class="icon-delete_forever"></i> Hapus</a>
                                 </td>
                              </tr>
                           <?php endforeach?>
                        </tbody>
                     </table>
                     </div>

                     </div>
                  </div>
               </div>
            </div>

        </div>
    </div>



<!-- Modal TANGGAL-->
<div class="modal fade bd-example-modal-lg" id="exampleModalTanggal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Tanggal Libur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('arena/saveTanggal')?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
         <div class="form-group">
            <label for="tanggal">Pilih Tanggal Libur</label>
            <input type="text" class="date-time-picker form-control" data-options='{"timepicker":false, "format":"Y-m-d"}' value="<?=date('Y-m-d')?>" name="tanggal" id="tanggal" />
         </div>
         <input type="hidden" name="arena_id" id="arena_id" required value="<?=$data['id']?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Jam-->
<div class="modal fade bd-example-modal-lg" id="exampleModalJam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Jam Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('arena/saveJam')?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
         <div class="form-group">
            <label for="jam">Pilih Jam</label>
            <input type="text" class="date-time-picker form-control" data-options='{"datepicker":false, "format":"H:i"}' value="<?=date('H:i')?>" name="jam" id="jam" />
         </div>
         <input type="hidden" name="arena_id" id="arena_id" required value="<?=$data['id']?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>











    
</div>
