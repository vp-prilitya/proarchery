<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
         <div class="control-sidebar-bg shadow white fixed"></div>
</div>

<div class="info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="gagal" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>
<div class="sukses" data-flashdata="<?= $this->session->flashdata('sukses'); ?>"></div>
<div class="warning" data-flashdata="<?= $this->session->flashdata('warning'); ?>"></div>
<!--/#app -->
<script src="<?=base_url()?>assets/js/app.js"></script>
<script src="<?=base_url()?>assets/js/html5-qrcode.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<?php if(isset($download)): ?>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<?php endif?>


<script>
    const gagal = $('.gagal').data('flashdata');
    if (gagal) {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Gagal',
        text: gagal,
        showConfirmButton: false,
        timer: 2500
      })
    }

    const sukses = $('.sukses').data('flashdata');
    if (sukses) {
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Berhasil',
        text: sukses,
        showConfirmButton: false,
        timer: 2500
      })
    }

    const warning = $('.warning').data('flashdata');
    if (warning) {
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Peringatan',
        text: warning,
        showConfirmButton: false,
        timer: 2500
      })
    }

    const info = $('.info').data('flashdata');
    if (info) {
      Swal.fire({
        position: 'center',
        icon: 'info',
        title: 'Informasi',
        text: info,
        showConfirmButton: false,
        timer: 2500
      })
    }

    $('.tombol-hapus').on('click', function (e) {
      e.preventDefault();
      const href = $(this).attr('href');
      Swal.fire({
        title: 'Yakin?',
        text: "Data ini Akan dihapus..?",
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

  </script>

<!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->
<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
</body>
</html>