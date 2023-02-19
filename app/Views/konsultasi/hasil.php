<?= view("_partial/header.php", ['title' => $title]) ?>
<?= view("_partial/top_menu.php") ?>
<?= view("_partial/side_menu.php") ?>
<style>
   .table td,
   .table th {
      padding: 0.55rem;
      vertical-align: top;
      border-top: 1px solid #dee2e6;
   }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <br>
      <!-- Default box -->
      <div class="card">
         <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
            <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
               </button>
            </div>
         </div>
         <div class="card-body">
            <?php if (!empty($session->getFlashdata('error'))) : ?>
               <div class="alert alert-warning alert-dismissible fade show" role="alert" align='center'>
                  <?= $session->getFlashdata('error') ?>
               </div>
            <?php endif; ?>
            <?php if (!empty($session->getFlashdata('success'))) : ?>
               <div class="alert alert-success alert-dismissible fade show" role="success" align='center'>
                  <?= $session->getFlashdata('success') ?>
               </div>
            <?php endif; ?>
            <div style="height: 62vh;overflow-y: scroll;padding-left:20px;padding-right:20px;">
               <h4>Hasil Konsultasi</h4>
               <div style="border: 1px solid #dee2e6;padding:20px;">
                  <p class='text-center'>Permasalahan yang dialami Siswa Adalah adalah:</p>
                  <br>
                  <p class='text-center' style="color:blueviolet;font-family:'Courier New';font-size:40px">
                     <b>
                        <?= $hasil->hasil ?>
                     </b>
                  </p>
                  <br>
                  <?php if ($hasil->solusi !== null) : ?>
                     <hr>
                     <h3>Solusi</h3>
                     <p style="color:black;font-family:'Courier New';font-size:26px">
                        <?= $hasil->solusi ?>
                     </p>
                     <br>
                  <?php endif; ?>
                  <hr>
                  <h6>Sikap Siswa</h6>
                  <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">

                     <tbody>
                        <?php
                        $sikaps = [];
                        foreach ($pilihans as $d)
                           if ($d->pilihan == 1) {
                              $sikaps[] = $d->nama_sikap;
                           }
                        ?>

                        <tr>
                           <td><?= implode(", ",  $sikaps) ?></td>
                        </tr>
                     </tbody>
                  </table>
                  <hr>
                  <h6>Kaidah yang terkait dengan sikap Siswa</h6>
                  <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                     <thead bgcolor='#02D3DA'>
                        <th style="width: 5%;">
                           No
                        </th>
                        <th style="width: 30%;">
                           Sikap
                        </th>
                        <th style="width: 30%;">
                           Permasalahan
                        </th>
                     </thead>
                     <tbody>
                        <?php foreach ($data->hasil as $i => $d) : ?>
                           <tr>
                              <td><?= $i + 1 ?></td>
                              <?php
                              $sikap = "";
                              foreach ($d->sikaps as $p) {
                                 $s = $p->nama_sikap;
                                 if ($p->pilihan == 2) {
                                    $s = '<s>' . $s . '</s>';
                                 } else {
                                    $s = '<b>' . $s . '</b>';
                                 }
                                 $sikap .=  $s . "<br>";
                              }
                              ?>
                              <td><?= $sikap ?></td>
                              <td>
                                 <?= $d->nama_permasalahan ?>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
                  <br>
               </div>
            </div>
         </div>
         <!-- /.card-body -->
         <div class="card-footer">
            -
         </div>
         <!-- /.card-footer-->
      </div>
      <!-- /.card -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= view("_partial/footer.php") ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
   var mode = 1;
   $(document).ready(function() {
      $("#_btn_hasil").on('click', function(e) {
         if (mode == 1) {
            $("#_hasil_simple").hide('slow')
            $("#_hasil_detail").show('slow')
            $('#_btn_hasil').text('Hasil Simple').button("refresh");
            mode = 2;
         } else {
            $('#_btn_hasil').text('Hasil Detail').button("refresh");
            $("#_hasil_simple").show('slow')
            $("#_hasil_detail").hide('slow')
            mode = 1;
         }
      })
   });
</script>