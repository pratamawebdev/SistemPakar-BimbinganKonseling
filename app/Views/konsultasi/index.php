<?= view("_partial/header.php", ['title' => $title]) ?>
<?= view("_partial/top_menu.php") ?>
<?= view("_partial/side_menu.php") ?>
<?php
    $data_options = "<option value=''>- Pilih jika sesuai -</option>";
    $data_options .= "<option value='0'>Tidak</option>";
    $data_options .= "<option value='1'>Tidak Tahu</option>";
    $data_options .= "<option value='2'>Sedikit Yakin</option>";
    $data_options .= "<option value='3'>Cukup Yakin</option>";
    $data_options .= "<option value='4'>Yakin</option>";
    $data_options .= "<option value='5'>Sangat Yakin</option>";
?>
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
            
                <form method="post" id='_form'>

                    <h3 >Buat Data Siswa Baru</h3>
                    <hr>
                    <div style='width:100%;overflow:hidden;'>
                        <div style='width:48%;float:left'>                            
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input class="form-control" maxlength="10" type="text" name="nisn" placeholder="NISN" oninput="this.value = this.value.toUpperCase()"/>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div style='margin-left:51%;'>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input class="form-control" type="text" name="kelas" placeholder="Kelas" oninput="this.value = this.value.toUpperCase()"/>
                                <div class="invalid-feedback">
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input class="form-control" type="text" name="nama_siswa" placeholder="Nama Siswa" />
                        <div class="invalid-feedback">
                        </div>
                    </div>
                  
                    <div style='width:100%;overflow:hidden;'>
                        <div style='width:48%;float:left'>                            
                            <div class="form-group">                                
                                <label for="jenis_kelamin">Jenis Kelamin</label><br>
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value=''>- Pilih Jenis Kelamin -</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div style='margin-left:51%;'>                    
                            <div class="form-group">
                                <label for="no_hp_ortu">No. HP Orang Tua</label>
                                <input class="form-control" type="text" name="no_hp_ortu" placeholder="No. HP Orang Tua" />
                                <div class="invalid-feedback">
                                </div>
                            </div>      
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" type="text" name="alamat" rows="5" minlength="6" ></textarea>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <hr>
                    <h3 >Atau Pilih Data Siswa yang Sudah Dibuat</h3>
                    <hr>
                    
                    <div class="form-group">
                        <label for="nisn_select">Data Siswa</label>
                        <select class="form-control" name="nisn_select" id="nisn_select">
                            <option value=''>- Pilih Siswa -</option>
                            <?php foreach ($data as $g) : ?>
                                <option value="<?= $g->nisn ?>">
                                    <?= $g->nisn ?>&nbsp;<?= $g->nama_siswa ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <br>

                    <input class="btn btn-success" type="submit" name="btn" value="Lanjut"/>
                </form>
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

    $(document).ready(function() {
        $('#_form').submit(function(e) {            
            try {
                if($('#nisn_select').val() == '') {
                    if($('input[name="nisn"]').val() == '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'NISN tidak boleh kosong!',
                            icon: 'error',
                        })
                        e.preventDefault();
                    }
                    
                    if($('input[name="kelas"]').val() == '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Kelas tidak boleh kosong!',
                            icon: 'error',
                        })
                        e.preventDefault();
                    }
                    if($('input[name="nama_siswa"]').val() == '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Nama Siswa tidak boleh kosong!',
                            icon: 'error',
                        })
                        e.preventDefault();
                    }
                    if($('select[name="jenis_kelamin"]').val() == '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Jenis Kelamin tidak boleh kosong!',
                            icon: 'error',
                        })
                        e.preventDefault();
                    }
                    if($('input[name="no_hp_ortu"]').val() == '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'No. HP Orang Tua tidak boleh kosong!',
                            icon: 'error',
                        })
                        e.preventDefault();
                    }
                    if($('textarea[name="alamat"]').val() == '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Alamat tidak boleh kosong!',
                            icon: 'error',
                        })
                        e.preventDefault();
                    }
                }
            } catch (err) {
                console.log(err);
            }
        });
    });

    $('input[name="no_hp_ortu"]').on('keyup paste', delay(function(e) {
        var num = parseInt(this.value, 0),
            min = 0,
            max = 899999999999;
        if (isNaN(num)) {
            this.value = '';
            return;
        }
        this.value = '0'+ Math.max(num, min);
        this.value = '0'+Math.min(num, max);
    }, 500));

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