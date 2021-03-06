<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong><?=$judul?> QR-Code</strong></h5>
                  </div>
               </div>
         </div>

         <form action="<?=base_url('scan/save')?>" method="post">
            <div class="row justify-content-center">
               <div  id="scan-row" class="col-sm-6 mb-3">
                  <div class="white shadow r-15">
                     <div class="card-body">
                     <div class="alert alert-primary" id="head" role="alert">
                        
                     </div>
                        <div id="qr-reader"></div>
                        <div id="qr-reader-results"></div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6 mb-3">
                  <div class="white shadow r-15">
                     <div class="card-body">
                        <div class="form-group">
                           <label for="invoice">No Invoice</label>
                           <input type="text" class="form-control" placeholder="Masukan No Invoice" id="invoice" name="invoice" required>
                        </div>

                        <hr>
                        <div class="form-group">
                           <label for="nama">Jasa Hasil Scan</label>
                           <input type="text" class="form-control" placeholder="Nama Jasa Hasil Scan" id="item" name="item" required readonly>
                           <input type="hidden" class="form-control" placeholder="Nama Jasa Hasil Scan" id="id_barang" name="id_barang" required readonly>
                        </div>
                        <label for="invoice">Detail Invoice</label>
                        <div class="table-responsive">
                           <table  id="example" class="table table-bordered table-striped table-hover" width="100%">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>  
                        
                     </div>
                  </div>
               </div>

               <div class="col-sm-6 mb-3">
                  <div class="white shadow r-15">
                     <div class="card-body">

                        <div class="form-group">
                           <label for="nip">NIP Karyawan</label>
                           <input type="text" class="form-control" placeholder="Masukan NIP Karyawan" id="nip" name="nip" required>
                           <input type="hidden" class="form-control" placeholder="Masukan NIP Karyawan" id="karyawan_id" name="karyawan_id" required>
                           <input type="hidden" class="form-control" placeholder="Masukan NIP Karyawan" id="code" name="code" required>
                        </div>

                        <div class="form-group">
                           <label for="nama">Nama Karyawan</label>
                           <input type="text" class="form-control" placeholder="Masukan Nama Karyawan" id="nama" name="nama" required readonly>
                        </div>

                     </div>
                  </div>
               </div>
               <div style="display:none;" id="submit" class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">
                        <div class="text-right">
                           <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>

            </div>

            <!-- <div class="row">
               <div class="col-sm-12">
                  <div class="white shadow r-15">
                     <div class="card-body">
                        <div class="text-right">
                           <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div> -->

        </div>
    </div>















    
</div>

<script>

$(document).ready(function(){

   let a = 1;
   document.getElementById("head").innerHTML = "SCAN INVOICE"
   
   
   function docReady(fn) {
      // see if DOM is already available
      if (document.readyState === "complete"
         || document.readyState === "interactive") {
         // call on next available tick
         setTimeout(fn, 1);
      } else {
         document.addEventListener("DOMContentLoaded", fn);
      }
    }

   docReady(function () {
      var resultContainer = document.getElementById('qr-reader-results');
      var lastResult, countResults = 0;
      function onScanSuccess(decodedText, decodedResult) {
         if (decodedText !== lastResult) {
               ++countResults;
               lastResult = decodedText;
               // Handle on success condition with the decoded message.
               console.log(`Scan result ${decodedText}`, decodedResult);
               var obj = JSON.parse(decodedText);
               console.log(a);
               if(a == 1){
                  document.getElementById("invoice").value = obj.qr_code;
                  show_table(obj);
               }

               if(a == 2){
                  document.getElementById("nip").value = obj.qr_code;
                  getNip(obj.qr_code);
               }
         }
      }

   var html5QrcodeScanner = new Html5QrcodeScanner(
         "qr-reader", { fps: 10, qrbox: 250 });
      html5QrcodeScanner.render(onScanSuccess);
      document.getElementById("qr-reader__dashboard_section_swaplink").style.visibility = "hidden";
      var x = document.getElementById("qr-reader");
      x.children[0].children[0].innerHTML = "Scan QRcode";
   });

   var table = $("#example").DataTable();

   function show_table(invoice) {
      $.ajax({
         url:"<?= base_url('scan/getBarangDetail')?>",
         type:"POST",
         dataType: 'json',
         data:invoice,
         success:function(data){
            
            table.clear();
            if(data.hasil.length == 0){
               if(data.status == 0){
                  Swal.fire({
                     position: 'center',
                     icon: 'error',
                     title: 'Error',
                     text: 'Data Tidak Ditemukan',
                     showConfirmButton: false,
                     timer: 2500
                  });
               }
               
               if(data.status == 1){
                  Swal.fire({
                     position: 'center',
                     icon: 'error',
                     title: 'Error',
                     text: 'Invoice Sudah Digunakan',
                     showConfirmButton: false,
                     timer: 2500
                  });
               }
               
               
               $("#invoice").val('');
            } else {
               a = 2;
               document.getElementById("head").innerHTML = "SCAN NIP KARYAWAN"
               Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Sukses',
                  text: 'Data Ditemukan',
                  showConfirmButton: false,
                  timer: 2500
               });
               var no = 1;
               $.each(data.hasil, function (i, key) {

                  var nama = data.hasil[i].item;
                  nama += `<input type="hidden" class="form-control" id="barang_jual_id`+data.hasil[i].barang_jual_id+`" name="barang_jual_id[]" required value=`+data.hasil[i].barang_jual_id+` />`;

                  var qty = data.hasil[i].quantity;
                  qty += `<input type="hidden" class="form-control" id="quantity`+data.hasil[i].quantity+`" name="quantity[]" required value=`+data.hasil[i].quantity+` />`;

                  qty += `<input type="hidden" class="form-control" id="jenis_barang`+data.hasil[i].jenis_barang+`" name="jenis_barang[]" required value=`+data.hasil[i].jenis_barang+` />`;

                  $('#code').val(invoice.uniq_code);

                  if(data.hasil[i].id == invoice.id_barang){
                     $('#id_barang').val(data.hasil[i].id);
                     $('#item').val(data.hasil[i].item);
                  }

                  table.row.add([
                     no++,
                     nama,
                     qty
                  ]);
               });
               
               table.draw();
            }
         }
      });
   }

   $('#invoice').change(function(){
      var invoice = $(this).val();
      show_table(invoice);
   });

   function docReady2(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady2(function () {
        var resultContainer = document.getElementById('qr-reader-results2');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                var obj = JSON.parse(decodedText);
                document.getElementById("nip").value = obj.qr_code;
                getNip(obj.qr_code);
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader2", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
        document.getElementById("qr-reader2__dashboard_section_swaplink").style.visibility = "hidden";
        var x = document.getElementById("qr-reader2");
        x.children[0].children[0].innerHTML = "Scan NIP Karyawan";
    });

   function getNip(nip) {
      $.ajax({
         url:"<?= base_url('scan/getKaryawan')?>",
         type:"POST",
         dataType: 'json',
         data:{nip:nip},
         success:function(data){
            if(data === null){
               Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Error',
                  text: 'Data Karyawan Tidak Ditemukan',
                  showConfirmButton: false,
                  timer: 2500
               });
               $("#nip").val('');
               $('#karyawan_id').val('');
               $('#nama').val('');
            } else {
               a = 1;
               document.getElementById("scan-row").style.display = "none";
               document.getElementById("submit").style.display = "block";
               Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Sukses',
                  text: 'Data Karyawan Ditemukan',
                  showConfirmButton: false,
                  timer: 2500
               });
               $('#karyawan_id').val(data.id);
               $('#nama').val(data.nama);
            }
         }
      });
   }

   $('#nip').change(function(){
      var nip = $(this).val();
      getNip(nip);
   });

})
</script>