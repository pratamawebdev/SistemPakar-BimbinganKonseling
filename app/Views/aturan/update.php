<?= view("_partial/header.php", ['title' => $title]) ?>
<?= view("_partial/top_menu.php") ?>
<?= view("_partial/side_menu.php") ?>

<style>
    .select2-selection__choice__display{
        padding-left:16px !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="margin-left: 5%;"><?= $title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="margin-right: 5%;">
                        <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Basis Aturan</h3>

                <div class="card-tools">
                    <a type="button" class="btn btn-primary" href="<?= site_url('aturan') ?>">
                        <i class="fas fa-times"></i>
                    </a>
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

                <form method="post">
                    <div class="form-group">
                        <label for="kode_aturan">Kode aturan</label>
                        <input class="form-control" maxlength="8" type="text" name="kode_aturan" value="<?= $data->kode_aturan; ?>" required readonly/>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kode_permasalahan">Permasalahan</label>
                        <select class="form-control" name="kode_permasalahan" id="kode_permasalahan" required>
                            <option value=''>- Pilih Permasalahan -</option>
                            <?php foreach ($permasalahan as $p) : ?>
                                <option value="<?= $p->kode_permasalahan ?>" <?= $data->kode_permasalahan === $p->kode_permasalahan ? 'selected' : '' ?>>
                                <?= $p->kode_permasalahan ?>&nbsp;   <?= $p->nama_permasalahan ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sikaps">Detail Sikap</label>
                        <select class="form-control" name="sikaps[]" id="sikaps" multiple="multiple" required>
                           
                            <?php foreach ($sikap as $g) :  $selected = '';?>
                                <?php foreach( $data->sikaps as $at) {
                                    if($at == $g->kode_sikap) {$selected = 'selected'; break;}
                                }?>
                                <option value="<?= $g->kode_sikap ?>" <?= $selected ?> >
                                    <?= $g->kode_sikap ?>&nbsp;<?= $g->nama_sikap ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <br>
                    <input class="btn btn-success" type="submit" name="btn" value="Simpan" />
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

<script>
    
    $(document).ready(function() {         
        $('#sikaps').select2({
            multiple:true
        });
        $('#kode_permasalahan').select2();
    });

    document.querySelector('form').addEventListener('submit', async (e) => {
        
    });

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