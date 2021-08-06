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
               <!-- <div class="col">
                  <a href="<?=base_url('piutang/create')?>" class="btn btn-primary btn-xs float-right"><i class="icon-plus"></i> Tambah</a>
               </div> -->
            </div>
            <!-- </div> -->
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
                        <th>Total Piutang</th>
                        <th>Total Bayar</th>
                        <th>Sisa</th>
                        <th>Detail</th>
                     </tr>
                  </thead>
                  <tbody>
                     
                     <?php $i=1; foreach($data as $db): ?>
                        <?php if($db['tgl_jatuh_tempo'] <= date('Y-m-d')) {
                                 $style = 'background-color:#d92550; color:white';
                              } else {
                                 $diff = strtotime(date('Y-m-d')) - strtotime($db['tgl_jatuh_tempo']);
                                 if(floor($diff / (60 * 60 * 24)) >= -7){
                                    $style = 'background-color:#faf800; color:black';
                                 } else {
                                    $style = 'background-color:none';
                                 }
                              }
                        ?>
                        <tr style="<?=$style?>">
                           <td><?=$i++?></td>
                           <td><?=$db['nama']?></td>
                           <td><?=number_format($db['total']??$db['mytotal'],0,'',',')?></td>
                           <td><?=number_format($db['bayar']??0,0,'',',')?></td>
                           <td><?=number_format(($db['total']??$db['mytotal']) - $db['bayar']??0,0,'',',')?></td>
                           <!-- <td><button type="button" data-remote="<?=base_url('piutang/detailPiutang/')?><?=$db['pelanggan_id']?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="icon-plus"></i> Detail</button></td> -->
                           <td><button type="button" data-remote="<?=base_url('piutang/detailPiutang2/')?><?=$db['pelanggan_id']?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="icon-plus"></i> Detail</button></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Detail Piutang</h5>
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












    
</div>

<script>
    $(document).ready(function() {
      $('#exampleModal').on('show.bs.modal', function(e){
            var button = $(e.relatedTarget);
            var modal = $(this);
            modal.find('.modal-body').load(button.data('remote'));

      });
      //   var table2 = $('#example2').DataTable();
      //   var buttons2 = new $.fn.dataTable.Buttons(table2, {
      //       buttons: [{
      //           extend: 'excelHtml5',
      //           title: 'Daftar Siswa',
      //           text: '<i class="fas fa-file-excel"></i>&nbsp; EXCEL',
      //           className: 'btn btn-success btn-sm btn-corner',
      //           titleAttr: 'Download as Excel'
      //       },{
      //           extend: 'pdfHtml5',
      //           title: 'Daftar Siswa',
      //           orientation: 'potrait',
      //           pageSize: 'A4',
      //           className: 'btn btn-danger btn-sm btn-corner',
      //           text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF',
      //           titleAttr: 'Download as PDF',
      //       }, ],
      //   }).container().appendTo($('#buttons2'));
    });
</script>