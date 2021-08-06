<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Pengaturan Umum</strong></h5>
                  </div>
               </div>
         </div>

            <div class="row">
               <div class="col-sm-8">
                  <div class="white shadow r-15">
                     <!-- <div class="row">
                        <div class="col-sm-12">
                           <button type="button" data-toggle="modal" data-target="#exampleModalTanggal" class="btn btn-primary btn-xs float-right mt-4 mr-4"><i class="icon-plus"></i> Tambah Tanggal</button>
                        </div>
                     </div> -->
                     <div class="card-body">

                     <div class="table-responsive">
                     <table id="example2" class="table table-bordered table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Value</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>Durasi</td>
                              <td><?=$durasi?></td>
                              <td>
                                 <button data-id=2 type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-xs" >Set</button>
                              </td>
                           </tr>
                           <tr>
                              <td>2</td>
                              <td>Quantity Maksimal</td>
                              <td><?=$qty_maks?></td>
                              <td>
                                 <button data-id=3 type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-xs" >Set</button>
                              </td>
                           </tr>
                           <tr>
                              <td>3</td>
                              <td>Expire</td>
                              <td><?=$expire?></td>
                              <td>
                                 <button data-id=4 type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-xs" >Set</button>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     </div>

                     </div>
                  </div>
               </div>
            </div>

        </div>
    </div>



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Value</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('arena/saveSetting')?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
         <div class="form-group">
            <label for="value">Value</label>
            <input type="number" class="form-control" value="0" name="value" id="value" />
         </div>
         <input type="hidden" name="id" id="id" required value="">
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

<script>
$(document).ready(function() {
   $('#exampleModal').on('show.bs.modal', function(e){
         var button = $(e.relatedTarget);
         var modal = $(this);
         modal.find('#id').val(button.data('id'));

   });
});
</script>