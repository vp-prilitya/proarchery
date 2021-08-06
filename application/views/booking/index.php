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
                  <a href="<?=base_url('booking/create')?>" class="btn btn-primary btn-xs float-right mt-5 mr-5"><i class="icon-plus"></i> Booking</a>
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
                        <th>No Booking</th>
                        <th>Arena</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; foreach($data as $db):?>
                        <tr>
                           <td><?=$i++?></td>
                           <td><?=$db['no_booking']?></td>
                           <td><?=$db['nama']?></td>
                           <td><?=$db['tanggal']?></td>
                           <td><?=$db['jam']?></td>
                           <td>
                                 <?php date_default_timezone_set('Asia/Jakarta'); $book = $db['tanggal'] . ' ' . $db['jam'];?>
                                 <?php if(date('Y-m-d H:i', strtotime($book)) < date('Y-m-d H:i') AND $db['status'] == 0) : $status = 0;?>
                                    <span class="badge badge-pill badge-danger">Expire</span>
                                 <?php elseif(date('Y-m-d H:i', strtotime($book)) > date('Y-m-d H:i') AND $db['status'] == 0) : $status = 1;?>
                                    <span class="badge badge-pill badge-warning">Available</span>
                                 <?php elseif($db['status'] == 1) : $status = 2;?>
                                    <span class="badge badge-pill badge-success">Used</span>
                                 <?php endif?>
                           </td>
                           <td>
                              <?php if($status == 1):?>
                                 <a href="<?=base_url('booking/valid/')?><?=$db['id']?>" class="btn btn-warning btn-xs my-1 valid" ><i class="icon-edit"></i> Aktifkan</a>

                                 <a href="<?=base_url('booking/delete/')?><?=$db['id']?>" class="btn btn-danger btn-xs my-1 tombol-hapus" ><i class="icon-delete_forever"></i> Hapus</a>
                              <?php endif?>
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

<script>
    $(document).ready(function() {
       
      $('.valid').on('click', function (e) {
         e.preventDefault();
         const href = $(this).attr('href');
         Swal.fire({
            title: 'Pastikan Hanya Staff Pro-Archery Yang Memvalidasi',
            text: "Data ini Sudah Divalidasi..?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin!',
            cancelButtonText: 'Batal'
            }).then((result) => {
            if (result.value) {
               document.location.href = href;
            }
         })
      });
    });
</script>