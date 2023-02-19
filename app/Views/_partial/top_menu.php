<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= site_url('home'); ?>" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <?php if (!empty($session->get('username'))) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('user/profile'); ?>" role="button">
                    <i class="fas fa-user"> Profile (<?= $session->get('nama') ?>)</i>
                </a>
            </li>

        <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('user/login'); ?>" role="button">
                    <i class="fas fa-user"> Login</i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('user/register'); ?>" role="button">
                    <i class="fas fa-user-plus"> Register</i>
                </a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->