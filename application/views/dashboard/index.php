<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

            <div class="row ml-1">
                  <div class="r-15 mb-3 gradient shadow">
                     <div class="card-body">
                        <h5 class="text-dark text-bold"><strong><?=$judul?> </strong></h5>
                     </div>
                  </div>
            </div>
            
            <div class="row mb-3">
               <div class="col-sm-3">
                  <a href="#">
                     <!-- <div class=" p-40 text-dark white bg-warning r-15 text-center card__hover" > -->
                     <div class="counter-box p-40 text-white r-15 text-center card__hover gradient-yellow" >
                        <?php $harta = $saldo['debit'] - $saldo['kredit']; 
                              $harta>0? $harta = number_format($harta,0,'',',') : $harta = "(". str_replace("-", "", number_format($harta,0,'',',')) .")"
                        ?>
                        <div class="s-36"><?= $harta?></div>
                        <h6 class="counter-title text-dark">Harta (IDR)</h6>
                     </div>
                  </a>
               </div>
               <div class="col-sm-3">
                  <a href="#">
                     <!-- <div class="counter-box p-40 text-dark white bg-danger r-15 text-center card__hover" > -->
                     <div class="counter-box p-40 text-white r-15 text-center card__hover gradient-red" >
                        <?php $hutang = $hutang['hutang']; 
                              $hutang>0? $hutang = number_format($hutang,0,'',',') : $hutang = "(". str_replace("-", "", number_format($hutang,0,'',',')) .")"
                        ?>
                        <div class="s-36"><?= $hutang ?></div>
                        <h6 class="counter-title text-dark">Hutang (IDR)</h6>
                     </div>
                  </a>
               </div>
               <div class="col-sm-3">
                  <a href="#">
                     <!-- <div class="counter-box p-40 text-dark white bg-success r-15 text-center card__hover" > -->
                     <div class="counter-box p-40 text-white r-15 text-center card__hover gradient-green" >
                        <?php $piutang = $piutang['piutang']; 
                              $piutang>0? $piutang = number_format($piutang,0,'',',') : $piutang = "(". str_replace("-", "", number_format($piutang,0,'',',')) .")"
                        ?>
                        <div class="s-36"><?=$piutang?></div>
                        <h6 class="counter-title text-dark">Piutang (IDR)</h6>
                     </div>
                  </a>
               </div>
               <div class="col-sm-3">
                  <a href="#">
                     <!-- <div class="counter-box p-40 text-dark white bg-primary r-15 text-center card__hover" > -->
                     <div class="counter-box p-40 text-white r-15 text-center card__hover gradient-blue" >
                        <div class="sc-counter s-36"><?=$stok['stok']?></div>
                        <h6 class="counter-title text-dark">Stok (Barang Jual)</h6>
                     </div>
                  </a>
               </div>
            </div>

            <div class="row">
               <div class="col-sm-3">
                  <a href="#">
                     <!-- <div class="counter-box p-40 text-dark blue lighten-3 r-15 text-center card__hover" > -->
                     <div class="counter-box p-40 text-white r-15 text-center card__hover gradient-sky" >
                        <div class="sc-counter s-36"><?=$penjualan_hari['total_tagihan'] + $penjualan_hariPOS['total_tagihan']?></div>
                        <h6 class="counter-title text-dark">Penjualan Hari Ini (IDR)</h6>
                     </div>
                  </a>
               </div>
               <div class="col-sm-3">
                  <a href="#">
                     <!-- <div class="counter-box p-40 text-dark blue r-15 text-center card__hover" > -->
                     <div class="counter-box p-40 text-white r-15 text-center card__hover gradient-blue-2" >
                        <div class="sc-counter s-36"><?=$penjualan_bulan['total_tagihan'] + $penjualan_bulanPOS['total_tagihan']?></div>
                        <h6 class="counter-title text-dark">Penjualan Bulan Ini (IDR)</h6>
                     </div>
                  </a>
               </div>
               <div class="col-sm-3">
                  <a href="#">
                     <!-- <div class="counter-box p-40 text-dark deep-purple lighten-3 r-15 text-center card__hover" > -->
                     <div class="counter-box p-40 text-white r-15 text-center card__hover gradient-purple-lighten" >
                        <div class="sc-counter s-36"><?=$pembelian_hari['total_tagihan']?></div>
                        <h6 class="counter-title text-dark">Pembelian Hari Ini (IDR)</h6>
                     </div>
                  </a>
               </div>
               <div class="col-sm-3">
                  <a href="#">
                     <!-- <div class="counter-box p-40 text-dark deep-purple accent-2 r-15 text-center card__hover" > -->
                     <div class="counter-box p-40 text-white r-15 text-center card__hover gradient-purple" >
                        <div class="sc-counter s-36"><?=$pembelian_bulan['total_tagihan']?></div>
                        <h6 class="counter-title text-dark">Pembelian Bulan Ini (IDR)</h6>
                     </div>
                  </a>
               </div>
            </div>

        </div>
    </div>















    
</div>

