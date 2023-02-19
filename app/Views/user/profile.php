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
                <h3 class="card-title"><?= $session->nama ?></h3>

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

                <form method="post">
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input class="form-control" minlength="8" type="text" name="nama" placeholder="Nama User" value="<?= $session->nama ?>" required />
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Password Sekarang" required />
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input class="form-control" type="password" name="password_baru" placeholder="Password Baru" minlength="6" id='password_baru' />
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Ulangi Password Baru</label>
                        <input class="form-control" type="password" name="re_password_baru" placeholder="Password Baru" minlength="6" id='re_password_baru' />
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <input class="btn btn-success" type="submit" name="btn" value="Ubah Data" />
                    <input class="btn btn-danger" name="btn" value="Logout" id='btn_logout' />
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
<input type="hidden" id='url_logout' value="<?= site_url('user/logout'); ?>" />

<script>
    $('#btn_logout').on('click', function(e) {
        Swal.fire({
            title: 'Logout?',
            text: "Pilih Ya untuk Logout!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout!'
        }).then((result) => {
            if (result.value) {
                window.location = $('#url_logout').val();
            }
        });
    })
    const form = document.querySelector('form');
    form.addEventListener('submit', async (e) => {
        const password_baru = form.password_baru.value;
        const re_password_baru = form.re_password_baru.value;
        try {
            if (password_baru !== '' && password_baru !== re_password_baru) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Jika ubah Password, Ulangi Password Baru diisi',
                    icon: 'error',
                })
                e.preventDefault();
            }
        } catch (err) {
            console.log(err);
        }
    });
</script>