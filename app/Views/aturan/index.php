<?= view("_partial/header.php", ["title" => $title]) ?>
<?= view("_partial/top_menu.php") ?>
<?= view("_partial/side_menu.php") ?>
<style>

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
                        <li class="breadcrumb-item"><a href="<?= site_url(
                                                                    "home"
                                                                ) ?>">Home</a></li>
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
                <h3 class="card-title"></h3>

                <div class="card-tools">
                    <a type="button" class="btn btn-success" href="<?php echo site_url(
                                                                        "aturan/create"
                                                                    ); ?>">
                        <i class="fas fa-plus"></i></a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                <?php if (!empty($session->getFlashdata("error"))) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" align='center'>
                        <?= $session->getFlashdata("error") ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($session->getFlashdata("success"))) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="success" align='center'>
                        <?= $session->getFlashdata("success") ?>
                    </div>
                <?php endif; ?>

                <table id="table1" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style='width:10%;'>Kode Aturan</th>
                            <th>Sikap</th>
                            <th>Nama Permasalahan</th>
                            <th style='width:15%'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $d) : ?>
                            <tr>
                                <?php
                                $kode_sikap = "";
                                $sikap = "";
                                foreach ($d->sikaps as $p) {
                                    $sikap .= $p->nama_sikap . "<br>";
                                }
                                ?>
                                <td class='text-center'> <?= $d->kode_aturan ?> </td>
                                <td>
                                    <?= $sikap ?>
                                </td>
                                <td>
                                    <?= $d->nama_permasalahan ?>
                                </td>

                                <td style='width:15%;'>
                                    <a href="<?= site_url('aturan/update/' . $d->kode_aturan) ?>" class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
                                    <a onclick="deleteConfirm('<?= site_url('aturan/delete/' . $d->kode_aturan) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i>
                                        Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
        $('#table1').DataTable();
    });

    function deleteConfirm(url) {
        console.log(url)
        Swal.fire({
            title: 'Hapus?',
            text: "Pilih Ya untuk menghapus data!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                window.location = url;
            }
        });
    }
</script>