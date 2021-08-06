<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong><?=$judul?> Transaksi</strong></h5>
                  </div>
               </div>
         </div>

         <form action="<?=base_url('validasi/save')?>" method="post">
            <div class="white shadow r-15">
               <div class="card-body">

                  <div class="row my-3 ">
                     <div class="col-sm-4">
                        Nama Pelanggan
                        <address>
                           <strong><?=$data[0]['pelanggan']??'NON MEMBER'?></strong><br>
                        </address>
                     </div>
                  </div>
                           
                  <div class="row my-3">
                     <div class="col-12 table-responsive">
                        <h6>Transaksi Penjualan</h6>
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Product</th>
                                 <th>Harga</th>
                                 <th>Quantity</th>
                                 <th>Subtotal</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $i=1; foreach($data as $db) :?>
                              <tr>
                                 <td><?=$i++?></td>
                                 <td><?=$db['item']?> <?=$db['paket']?':<br>'.$db['paket']:''?></td>
                                 <td>IDR <?=number_format($db['harga_jual'],0,'','.')?></td>
                                 <td><?=$db['quantity']?> <?=$db['satuan']?></td>
                                 <td>IDR <?=number_format($db['harga_jual']*$db['quantity'],0,'','.')?></td>
                              </tr>
                              <?php endforeach?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  
                  <div class="row">
                     <div class="col-6"></div>
                     <div class="col-6">
                        <input type="hidden" name="is_kasir" id="is_kasir" value="<?=$is_kasir?>" required>
                        <input type="hidden" name="id" id="id" value="<?=$data[0]['id']?>" required>

                        <?php if($is_kasir == 1 AND $data[0]['is_bank'] == 1):?>
                           <input type="hidden" name="transaksi_bank_id" id="transaksi_bank_id" value="<?=$data[0]['transaksi_bank_id']?>" required>
                        <?php endif;?>

                        <div class="table-responsive">
                           <table class="table">
                           <tbody><tr>
                              <th style="width:50%">TOTAL GROSS (IDR) :</th>
                              <td><?=number_format($data[0]['total_gross'],0,'','.')?></td>
                           </tr>
                           <tr>
                              <th>DISKON (%) : </th>
                              <td><?=$data[0]['diskon']?></td>
                           </tr>
                           <tr>
                              <th>DISKON (IDR) : </th>
                              <td><?=number_format($data[0]['diskon_idr'],0,'','.')?></td>
                           </tr>
                           <tr>
                              <th>PPN : </th>
                              <td><?=number_format($data[0]['ppn'],0,'','.')?></td>
                           </tr>
                           <tr>
                              <th>TOTAL TAGIHAN (IDR) : </th>
                              <td><?=number_format($data[0]['total_tagihan'],0,'','.')?>
                              <input type="hidden" name="total_tagihan" id="total_tagihan" value="<?=$data[0]['total_tagihan']?>" required>
                              </td>
                           </tr>
                           <tr>
                              <th>TOTAL BAYAR (IDR) : </th>
                              <td><?//=number_format($data[0]['total_bayar'],0,'','.')?>
                              <input class="form-control" type="text" name="total_bayar" id="total_bayar" value="<?=number_format($data[0]['total_bayar'],0,'','.')?>" required onkeyup="totalBayar(this.value)">
                              </td>
                           </tr>
                           <?php if($is_kasir == 1):?>
                              <input type="hidden" name="is_bank_before" id="is_bank_before" value="<?=$data[0]['is_bank']?>" required>
                              <tr>
                                 <th>JENIS PEMBAYARAN : </th>
                                 <td>
                                       <select class="custom-select select2" name="jenis_pembayaran" id="jenis_pembayaran" required>
                                          <?php if($data[0]['jenis'] == 'debit'){
                                                   $jns = 'debit';
                                                }
                                                if($data[0]['jenis'] == 'kredit'){
                                                   $jns = 'kredit';
                                                }
                                                if($data[0]['jenis'] == 'transfer'){
                                                   $jns = 'transfer';
                                                }
                                                if($data[0]['jenis'] != 'transfer' AND $data[0]['jenis'] != 'kredit' AND $data[0]['jenis'] != 'debit'){
                                                   $jns = 'cash';
                                                }
                                          ?>
                                          <option value="" disabled selected>Pilih Jenis Pembayaran</option>
                                          <option value="cash" <?=$jns=='cash'?'selected':''?>>Cash</option>
                                          <option value="debit" <?=$jns=='debit'?'selected':''?>>Debit</option>
                                          <option value="kredit" <?=$jns=='kredit'?'selected':''?>>Kartu Kredit</option>
                                          <option value="transfer" <?=$jns=='transfer'?'selected':''?>>Tranfer</option>
                                       </select>
                                 </td>
                              </tr>
                              <tr class="bank_id <?=$data[0]['is_bank']==1?'':'hilang'?>">
                                 <th>BANK : </th>
                                 <td>
                                       <select class="custom-select select2 mt-3" name="bank_id" id="bank_id" <?=$data[0]['is_bank']==1?'required':''?>>
                                          <option value="" disabled selected>Pilih Bank</option>
                                          <?php foreach($bank as $db):?>
                                             <option value="<?=$db['id']?>" <?=$data[0]['bank_id']==$db['id']?'selected':''?>><?=$db['nama']?></option>
                                          <?php endforeach?>
                                       </select>
                                 </td>
                              </tr>
                           <?php endif;?>
                           <tr>
                              <th>BIAYA LAIN (IDR) : </th>
                              <td>
                                 <input type="text" class="form-control" name="biaya_lain2" id="biaya_lain2" value="0" required onkeyup="biayaLain(this.value)">
                                 <input type="hidden" class="form-control" name="biaya_lain" id="biaya_lain" value="0" required >
                              </td>
                           </tr>
                           </tbody>
                           </table>
                        </div>
                     </div>
                  </div>

               </div>
            </div>

            <div class="row my-3">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-striped" width="100%">
                              <col style="width:25%">
                              <col style="width:25%">
                              <col style="width:25%">
                              <col style="width:25%">
                              <thead>
                                 <tr>
                                    <th>AKUN</th>
                                    <th>KETERANGAN</th>
                                    <th>DEBIT</th>
                                    <th>KREDIT</th>
                                    <th>#</th>
                                 </tr>
                              </thead>
                              <tbody id="tbody">
                                 <?php $no=1; foreach($data_akun as $db2): $no++;?>
                                 <tr id="row<?=$no?>">
                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2 abc data_akun" required name="akun_id[]" id="akun_id<?=$no?>" disabled>
                                             <option value="" disabled selected>Pilih Akun </option>
                                             <?php $i=1; foreach($akun as $db):?>
                                             <option value="<?=$db['id']?>" <?=$db['id']==$db2['akun_id']?'selected':''?>><?=$db['kode']?> - <?=$db['nama']?></option>
                                             <?php endforeach?>
                                          </select>
                                          <input type="hidden" name="akun_id[]" id="input_akun_id<?=$no?>" value="<?=$db2['akun_id']?>" required>
                                       </div>
                                    </td>
<!-- 
                                    <td>
                                       <div class="form-group">
                                          <select class="custom-select select2" required name="jenis[]" id="jenis<?=$no?>">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="kredit" <?='kredit'==$db2['jenis']?'selected':''?>>Kredit</option>
                                                <option value="debit" <?='debit'==$db2['jenis']?'selected':''?>>Debit</option>
                                             </select>
                                       </div>
                                    </td> -->

                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="keterangan<?=$no?>" name="keterangan[]" required  placholder="Masukan Keterangan" value="<?=$db2['keterangan']?>" readonly>
                                       </div>
                                    </td>

                                    <?php if('kredit'==$db2['jenis']){
                                             $kredit = $db2['harga_jual'];
                                             $debit = 0;
                                          } else {
                                             $debit = $db2['harga_jual'];
                                             $kredit = 0;
                                          }?>

                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="show-debit<?=$no?>" name="show-debit<?=$no?>" required onkeyup="totalDebit(<?=$no?>, this.value)" value="<?=number_format($debit,0,'','.')?>">
                                          <input type="hidden" class="form-control" id="debit<?=$no?>" name="debit[]" required value="<?=$debit?>">
                                       </div>
                                    </td>

                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="show-kredit<?=$no?>" name="show-kredit<?=$no?>" required onkeyup="totalKredit(<?=$no?>, this.value)" value="<?=number_format($kredit,0,'','.')?>">
                                          <input type="hidden" class="form-control" id="kredit<?=$no?>" name="kredit[]" required  value="<?=$kredit?>">
                                       </div>
                                    </td>

                                    <!-- <td>
                                       <button type="button" class="btn btn-danger btn-xs" onclick="hapusTable('#row<?=$no?>')"><i class="icon-delete_forever"></i></button>
                                    </td> -->
                                 </tr>
                                 <?php endforeach?>
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th><strong>Total</strong></th>
                                    <th></th>
                                    <th>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="total_debit" name="total_debit" required readonly value=0>
                                       </div>
                                    </th>
                                    <th>
                                       <div class="form-group">
                                          <input type="text" class="form-control" id="total_kredit" name="total_kredit" required readonly value=0>
                                       </div>
                                    </th>
                                 </tr>
                              </tfoot>
                           </table>
                           <div class="text-center">
                              <button type="button" class="btn btn-success" id="tambah">Tambah Baris</button>
                              <input type="hidden" name="jml" id="jml" required value=<?=$no?>>
                           </div>
                           <hr>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row my-3">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">
                     <div class="text-right ">
                        <a href="<?=base_url('validasi')?>" class="btn btn-danger mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary simpan hilang">Validasi</button>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>

        </div>
    </div>


<!-- Modal -->
<!-- <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> -->












    
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

function biayaLain(value) {
   var value = value.replace(/\./g,'');
   $('#biaya_lain2').val(rupiah(value));
   $('#biaya_lain').val(value);
}

function totalBayar(value) {
   var value = value.replace(/\./g,'');
   $('#total_bayar').val(rupiah(value));
}

function _cek() {
   if($('#total_debit').val().replace(/\./g,'') == $('#total_kredit').val().replace(/\./g,'')){
      $('.simpan').show();
   } else {
      $('.simpan').hide();
   }
}

function _subtotal() {
   var totalDebit = 0;
   var totalKredit = 0;
   
   $('input[name="debit[]"]').each(function() {
      totalDebit += parseInt(this.value.replace(/\./g,''));
   });
   
   $('input[name="kredit[]"]').each(function() {
      totalKredit += parseInt(this.value.replace(/\./g,''));
   });

   $('#total_debit').val(rupiah(totalDebit));
   $('#total_kredit').val(rupiah(totalKredit));
   _cek();
}

function totalDebit(id, value){
   var value = value.replace(/\./g,'');

   $('#show-debit'+id).val(rupiah(value));
   $('#debit'+id).val(value);
   _subtotal();
}

function totalKredit(id, value){
   var value = value.replace(/\./g,'');

   $('#show-kredit'+id).val(rupiah(value));
   $('#kredit'+id).val(value);
   _subtotal();
}

function hapusTable(id){
   $(id).empty();
}

   $(document).ready(function($) {
      _subtotal();

      $('#jenis_pembayaran').change(function(){
         var jenis = $(this).val();

         if(jenis == 'cash'){
            $('.bank_id').hide();
            $("#bank_id").prop('required',false);
         } else {
            $('.bank_id').show();
            $("#bank_id").prop('required',true);
         } 
            
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
                                 <input type="text" class="form-control" id="keterangan`+id+`" name="keterangan[]" required  placholder="Masukan Keterangan">
                              </div>
                           </td>

                           <td>
                              <div class="form-group">
                                 <input type="text" class="form-control" id="show-debit`+id+`" name="show-debit`+id+`" required onkeyup="totalDebit(`+id+`, this.value)" value=0>
                                 <input type="hidden" class="form-control" id="debit`+id+`" name="debit[]" required value=0>
                              </div>
                           </td>

                           <td>
                              <div class="form-group">
                                 <input type="text" class="form-control" id="show-kredit`+id+`" name="show-kredit`+id+`" required onkeyup="totalKredit(`+id+`, this.value)" value=0>
                                 <input type="hidden" class="form-control" id="kredit`+id+`" name="kredit[]" required  value=0>
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
   });
</script>