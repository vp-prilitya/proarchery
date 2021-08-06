<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-12">
                           <img class="w-80px mb-4" src="<?=base_url()?>assets/img/dummy/bootstrap-social-logo.png" alt="">

                           <div class="float-right">
                              <h4>Invoice #007612</h4><br>
                              <table>
                                 <tr>
                                    <td class="font-weight-normal">Date:</td>
                                    <td>2/10/2014</td>
                                 </tr>
                                 <tr>
                                    <td class="font-weight-normal">Order ID:</td>
                                    <td>4F3S8J</td>
                                 </tr>
                              </table>
                           </div>
                     
                     </div>
                  </div>

                  <!-- info row -->
                  <div class="row my-3 ">
                    <div class="col-sm-4">
                      From
                      <address>
                        <strong>Admin, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (804) 123-5432<br>
                        Email: info@almasaeedstudio.com
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      To
                      <address>
                        <strong>John Doe</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (555) 539-1037<br>
                        Email: john.doe@example.com
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                     
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <!-- Table row -->
                  <form action="<?=base_url('penjualan/update')?>" method="post">
                  <input type="hidden" name="id" id="id" value="<?=$data['id']?>">
                  <div class="row my-3">
                    <div class="col-12 table-responsive">
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
                        <tr>
                          <td>1</td>
                          <td>Call of Duty</td>
                          <td>IDR 50000</td>
                          <td><input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control" /></td>
                          <td>$64.50</td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody><tr>
                            <th style="width:50%">TOTAL GROSS (IDR) :</th>
                            <td><input type="text" name="total_gross" id="total_gross" class="form-control" readonly /></td>
                          </tr>
                          <tr>
                            <th>DISKON (%) : </th>
                            <td><input type="text" name="diskon" id="diskon" class="form-control" /></td>
                          </tr>
                          <tr>
                            <th>TOTAL TAGIHAN (IDR) : </th>
                            <td><input type="text" name="total_tagihan" id="total_tagihan" class="form-control" readonly /></td>
                          </tr>
                          <tr>
                            <th>TOTAL BAYAR (IDR) : </th>
                            <td><input type="text" name="total_bayar" id="total_bayar" class="form-control" required/></td>
                          </tr>
                          <tr>
                            <th>KEMBALIAN (IDR) :  </th>
                            <td><input type="text" name="kembalian" id="kembalian" class="form-control" readonly /></td>
                          </tr>
                        </tbody></table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <!-- this row will not appear when printing -->
                  <div class="row no-print">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary float-right">Ubah</button>
                        <a href="<?=base_url('penjualan')?>" class="btn btn-danger mr-2 float-right">Batal</a>
                    </div>
                  </div>
                  </form>

            </div>
          
          </div>
    </div>
</div>
               </div>
            </div>

        </div>
    </div>















    
</div>
