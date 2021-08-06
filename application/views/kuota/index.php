<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Daftar <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

         <div class="white shadow r-15">
            <!-- <div class="card-header white"> -->
            <div class="row">
               <div class="col-sm-10">
                  <!-- <h6 class=""> Daftar <?=$judul?> </h6> -->
               </div>
               <div class="col">
                  <a href="<?=base_url('kuota/create')?>" class="btn btn-primary btn-xs float-right mt-5 mr-5"><i class="icon-plus"></i> Tambah</a>
               </div>
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
                        <th>No Faktur</th>
                        <th>Kuota</th>
                        <th>Kuota Terpakai</th>
                        <th>Kuota Sisa</th>
                        <th>Tanggal Pembelian</th>
                        <th>Batas Waktu</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; foreach($data as $db):?>
                        <tr>
                           <td><?=$i++?></td>
                           <td><?=$db['no_faktur']?></td>
                           <td><?=$db['qty']?></td>
                           <td><?=$db['qty'] - $db['qty_sisa']?></td>
                           <td><?=$db['qty_sisa']?></td>
                           <td><?=$db['tgl_bayar']?></td>
                           <td><?=$db['tgl_jatuh_tempo']?></td>
                           <td>
                              <?php if($db['bukti'] == null) :?>
                              <button type="button" data-id="<?=$db['id']?>" class="btn btn-warning btn-xs my-1" data-toggle="modal" data-target="#exampleModalUpload"><i class="icon-edit"></i> Upload Bukti</button>
                              <?php endif?>
                              <button  type="button" data-remote="<?=base_url('kuota/detail/')?><?=$db['id']?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="icon-edit"></i> Detail</button>
                              <a href="<?=base_url('kuota/delete/')?><?=$db['id']?>" class="btn btn-danger btn-xs my-1 tombol-hapus" ><i class="icon-delete_forever"></i> Hapus</a>
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


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detai Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="text-center">
         <i class="fa fa-spinner fa-spin"></i>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal UPLOAD-->
<div class="modal fade bd-example-modal-lg" id="exampleModalUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('kuota/upload')?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
         <div class="form-group">
            <label for="upload">Upload</label>
            <input type="file" class="form-control" placeholder="Pilih File" id="file_bukti" name="file_bukti" required>
         </div>
         <input type="hidden" name="id" id="id" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Upload</button>
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
            modal.find('.modal-body').load(button.data('remote'));

      });
      $('#exampleModalUpload').on('show.bs.modal', function(e){
            var button = $(e.relatedTarget);
            var modal = $(this);
            modal.find('#id').val(button.data('id'));

      });
    });
</script>