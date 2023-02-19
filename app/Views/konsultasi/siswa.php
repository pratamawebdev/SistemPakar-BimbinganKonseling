<?= view("_partial/header.php", ["title" => $title]) ?>
<?= view("_partial/top_menu.php") ?>
<?= view("_partial/side_menu.php") ?>
<style>
    input[type="radio"] {
        -ms-transform: scale(2); /* IE 9 */
        -webkit-transform: scale(2); /* Chrome, Safari, Opera */
        transform: scale(2);
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <section class="content">

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
            <div class="card-body" style='padding-left:10%;padding-right:10%;'>

                <?php if (!empty($session->getFlashdata("error"))): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" align='center'>
                        <?= $session->getFlashdata("error") ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($session->getFlashdata("success"))): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="success" align='center'>
                        <?= $session->getFlashdata("success") ?>
                    </div>
                <?php endif; ?>
            
                <h3 class='text-center'><b><?= $data->nisn .
                  " " .
                  $data->nama_siswa ?></b></h3>
                <hr>
                <h3 class='text-center'>
                    <button class="btn btn-primary" type="button" disabled id="loading">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </h3>

                <div class='text-center' style='margin-top:64px !important; ' id="bungkus">
                    <p id='_soal' style='font-size: 2em;'></p>
                    <p id='_pertanyaan' style='font-size: 2em;'>Apakah ?</p>   
                    <div style='font-size: 1.5em;'>                                                         
                        <input type="radio" id="_ya" name="pilihan" value="Iya">
                        &nbsp;  <label for="_ya">Iya</label>&nbsp; &nbsp; &nbsp; 
                        <input type="radio" id="_tidak" name="pilihan" value="Tidak">
                        &nbsp; <label for="_tidak">Tidak</label>
                    </div>
                    <br>

                    <btn class="btn btn-success mt-4" id='_next'>Selanjutnya</btn>
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
  <input type='hidden' id='_id' value= '<?= $id_riwayat ?>'>
  <input type='hidden' id='_url_next' value= '<?= base_url() ?>/konsultasi/pertanyaan'>
  <input type='hidden' id='_url_jawab' value= '<?= base_url() ?>/konsultasi/jawab'>
  <input type='hidden' id='_url_hasil' value= '<?= base_url() ?>/konsultasi/hasil/<?= $id_riwayat ?>'>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    const PREFIX_PERTANYAAN = "Apakah Siswa tersebut ";
    var sikap;         
    $(document).ready(function() {
        hideLoading();
        $('#_form').submit(function(e) {            
            try {
            } catch (err) {
                console.log(err);
            }
        });
        next();
        $('#_next').on('click', function(e) {
            if(sikap !== null) {
                let jwbn = $('input[name="pilihan"]:checked').val();
                if(jwbn == 'Iya') {
                    $('#_next').hide();
                    $('#bungkus').hide();
                    const hide = setTimeout(showLoading, 100);
                    postJawaban({
                        id: $('#_id').val(),
                        kode_sikap: sikap.kode_sikap,
                        jawaban : 1
                    })
                } else if(jwbn == 'Tidak') {
                    $('#_next').hide();
                    $('#bungkus').hide();
                    const hide = setTimeout(showLoading, 100);
                    postJawaban({
                        id: $('#_id').val(),
                        kode_sikap: sikap.kode_sikap,
                        jawaban : 2
                    })
                }


                const show = setTimeout(hideLoading, 1000);

            }
            
        })
    });

    function showLoading(){
        $('#_next').hide();
        $('#bungkus').hide();
        $('#loading').show();
    }

    function hideLoading(){
        $('#bungkus').show();
        $('#_next').show();
        $('#loading').hide();
    }

    function postJawaban(data) {
        $.ajax({
        url: $('#_url_jawab').val(),
        type: "POST",
        data: data,
        success:function(response){
            var data = JSON.parse(response);
            console.log(data)
            if(data.success) {
                $('input[name="pilihan"]:checked').prop('checked', false);
                next();
            }
        },
        error:function(error){
            sikap = null
        }
        });
    }

    function next() {    
        $.ajax({
        url: $('#_url_next').val(),
        type: "POST",
        data: {
          id: $('#_id').val(),
        },
        success:function(response){
            var data = JSON.parse(response);
            console.log(data)
            sikap = null
            if(data.success) {
                if(data.sikap !== null) {
                    $('#_soal').text(data.sikap.kode_sikap.substring(1,3) + " dari "+data.total)
                    $('#_pertanyaan').text(PREFIX_PERTANYAAN + data.sikap.nama_sikap + "?")
                    sikap = data.sikap
                } else {
                    window.location =$('#_url_hasil').val()
                }
            }
        },
        error:function(error){
            sikap = null
        }
        });
    }


    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }
</script>