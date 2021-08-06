<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

            <div class="white shadow r-15">
               <div class="card-body">

                  <div class="row my-3 ">
                     <div class="col-sm-4">
                        Data Pelanggan
                        <address>
                           <strong><?=$data[0]['nama']?></strong><br>
                           <?=$data[0]['alamat']?><br>
                           Phone: <?=$data[0]['contact']?><br>
                           Email: <?=$data[0]['email']?>
                        </address>
                     </div>

                     <div class="col-sm-4">
                        <button type="button" data-remote="<?=base_url('piutang/detail/')?><?=$data[0]['penjualan_id']?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="icon-plus"></i> Detail</button>
                     </div>
                  </div>
                           
                  <div class="row my-3">
                     <div class="col-12 table-responsive">
                        <h6>Riwayat Pembayaran</h6>
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>No Transaksi</th>
                                 <th>Piutang</th>
                                 <th>Jumlah Bayar</th>
                                 <th>Tanggal</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if($data[0]['sisa'] == null):?>
                                 <tr>
                                    <td colspan='6' class="text-center"> Belum Ada Pembayaran</td>
                                 </tr>
                              <?php else :?>
                                 <?php $i=1; foreach($data as $db):?>
                                    <tr>
                                       <td><?=$i++?></td>
                                       <td><?=$db['no_transaksi']?></td>
                                       <td><?=number_format($db['sisa'],0,'','.')?></td>
                                       <td><?=number_format($db['bayar'],0,'','.')?></td>
                                       <td><?=$db['tgl']?></td>
                                       <td><a target="_blank" href="<?=base_url('piutang/print/')?><?=$db['pembayaran_id']?>" class="btn btn-success btn-xs"><i class="icon-edit"></i> Print</a></td>
                                    </tr>
                                 <?php endforeach?>
                              <?php endif?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                           
                  <div class="row">
                     <div class="col-6"></div>
                     <div class="col-6">
                        <div class="table-responsive">
                           <form action="<?=base_url('piutang/save')?>" method="post">
                           <input type="hidden" name="id" id="id" value="<?=$data[0]['id']?>">
                           <input type="hidden" name="penjualan_id" id="penjualan_id" value="<?=$data[0]['penjualan_id']?>">
                           <table class="table">
                              <tbody>
                              <tr>
                                 <th>TOTAL TAGIHAN (IDR) : </th>
                                 <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly value="<?=number_format($data[0]['total_tagihan'],0,'','.')?>" /></td>
                              </tr>
                              <tr>
                                 <th>SISA PIUTANG (IDR) : </th>
                                 <td>
                                 <input type="text" name="piutang2" id="piutang2" class="form-control" readonly value=<?=number_format($data[0]['piutang'],0,'','.')?> />
                                 <input type="hidden" name="piutang" id="piutang" class="form-control" readonly value=<?=$data[0]['piutang']?> />
                                 </td>
                              </tr>
                              <tr>
                                 <th>TOTAL BAYAR (IDR) : </th>
                                 <td>
                                    <input type="text" name="bayar2" id="bayar2" class="form-control" required onkeyup="totalBayar(this.value)" <?=$data[0]['piutang']==0?'readonly' : ''?>/>
                                    <input type="hidden" name="bayar" id="bayar" class="form-control" required <?=$data[0]['piutang']==0?'readonly' : ''?>/>
                                 </td>
                              </tr>
                              <tr>
                                 <th>KEMBALIAN (IDR) :  </th>
                                 <td><input type="text" name="kembalian" id="kembalian" class="form-control" readonly /></td>
                              </tr>
                              </tbody>
                           </table>

                           <button type="submit" class="btn btn-primary float-right">Simpan</button>
                           <a href="<?=base_url('piutang')?>" class="btn btn-danger mr-2 float-right">Batal</a>
                           </form>
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
        <h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <i class="fa fa-spinner fa-spin"></i>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
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

function totalBayar(value) {
   var value = value.replace(/\./g,'');
   var total_tagihan = $('#piutang').val().replace(/\./g,'');
   var total = rupiah(value - total_tagihan);
   parseInt(value) <  parseInt(total_tagihan) ? total = '- ' + rupiah(total) : rupiah(total);
   $('#kembalian').val(total);
   $('#bayar2').val(rupiah(value));
   $('#bayar').val(value);
}

   $(document).ready(function($) {
      $('#exampleModal').on('show.bs.modal', function(e){
            var button = $(e.relatedTarget);
            var modal = $(this);
            modal.find('.modal-body').load(button.data('remote'));
      });
   });
</script>