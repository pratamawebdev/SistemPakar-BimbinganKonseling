<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('home'); ?>" class="brand-link">
        <div style="text-align: center;width:60%;margin:auto">
            <span class="brand-text" style="margin-left:-32px">SPBK</span>
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <br>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MENU</li>

                <li class="nav-item">
                    <a href="<?= site_url('home'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p> Dashboard</p>
                    </a>
                </li>
                <?php if (!empty($session->get('username'))) { ?>
                    <?php if ($session->get('role') == 1) : ?>

                        <li class="nav-item">
                            <a href="<?= site_url('konsultasi/index'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-search-plus"></i>
                                <p> Konsultasi </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('riwayat'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p> Riwayat Konsultasi</p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($session->get('role') == 2) : ?>
                        <li class="nav-item">
                            <a href="<?= site_url('permasalahan'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-bug"></i>
                                <p> Data Permasalahan </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('sikap'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-vial"></i>
                                <p> Data Sikap </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('aturan'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-book-medical"></i>
                                <p> Data Aturan </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('riwayat'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p> Data Riwayat </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('user'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p> Data User </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('user/logout'); ?>" class="nav-link">
                                <p> Logout </p>
                            </a>
                        </li>

                    <?php endif; ?>
                <?php } else { ?>

                <?php } ?>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>