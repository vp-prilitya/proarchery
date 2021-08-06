<div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">

        <div class="row ml-1">
               <div class="r-15 mb-3 gradient shadow">
                  <div class="card-body" >
                     <h5 class="text-white text-bold"><strong>Tambah <?=$judul?> </strong></h5>
                  </div>
               </div>
         </div>

         <div class="white shadow r-15">
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-2">
                     <h6>Pilih Semua</h6>
                  </div>
                  <div class="col-sm">
                     <div class="material-switch mt-1" style="margin-left:-60px;">
                        <input id="all" name="all" type="checkbox" value="all"/>
                        <label for="all" class="bg-primary"></label>
                     </div>
                  </div>
               </div>

               <?php $my_menu = explode(',', $mymenu['menu'])?>

               <form action="<?=base_url('menu/save')?>" method="post" enctype="multipart/form-data">
               <!-- <input type="hidden" name="divisi_id" id="divisi_id" value="<?=$divisi['id']?>"> -->
               <input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>">
               <div class="table-responsive">
               <table id="example" class="table table-bordered table-striped table-hover ">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; $menutemp = ''; foreach($menu as $key => $db2):?>
                        <?//php if($menutemp !== $db2['menu']) :?>
                           <tr>
                              <td><?=$i++?></td>
                              <td><?=$key?></td>
                              <td>
                                 <?php foreach ($menu[$key] as $db) :?>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$db['id']?>" name="menu_id[]" id="menu_id<?=$db['id']?>" <?= in_array($db['id'], $my_menu) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="menu_id<?=$db['id']?>">
                                       <?=$db['nama']?>
                                    </label>
                                 </div>
                                 <?php endforeach?>
                              </td>
                           </tr>
                        <?//php endif?>
                        <!-- <tr>
                           <td><?//=$i++?></td>
                           <td><?//=$db['nama']?></td>
                           <td>
                              <div class="material-switch">
                                    <input id="menu_id<?=$i?>" name="menu_id[]" type="checkbox" value="<?=$db['id']?>" <?= in_array($db['id'], $my_menu) ? 'checked' : '' ?>/>
                                    <label for="menu_id<?=$i?>" class="bg-primary"></label>
                              </div>
                           </td>
                        </tr> -->
                     <?php endforeach?>
                  </tbody>
               </table>
               </div>

               <div class="text-right">
                     <a href="<?=base_url('menu')?>" class="btn btn-danger mr-2">Batal</a>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                  </form>
               </div>
            </div>
         </div>

        </div>
    </div>















    
</div>

<script>
    $(document).ready(function() {
        var table2 = $('#example').DataTable({'paging':false});

         $("#all").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
         });
    });
</script>