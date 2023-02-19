<?= view("_partial/header.php", ['title' => $title]) ?>
<?= view("_partial/top_menu.php") ?>
<?= view("_partial/side_menu.php") ?>

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
                <h3 class="card-title">Form sikap</h3>

                <div class="card-tools">
                    <a type="button" class="btn btn-primary" href="<?= site_url('sikap') ?>">
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
                        <label for="kode_sikap">Kode Sikap</label>
                        <input class="form-control" maxlength="8" type="text" name="kode_sikap" value="<?= $kode; ?>" placeholder="Kode sikap" oninput="this.value = this.value.toUpperCase()"  required />
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_sikap">Nama Sikap</label>
                        <input class="form-control" type="text" name="nama_sikap" value="<?= old('nama_sikap'); ?>" placeholder="Nama sikap" required />
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
    const form = document.querySelector('form');

    form.addEventListener('submit', async (e) => {
        try {

        } catch (err) {
            console.log(err);
        }
    });
</script>