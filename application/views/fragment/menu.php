<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SimSDM</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                if ($this->ion_auth->is_admin()) {
                    $user = $this->ion_auth->user()->row();
                    ?>
                    <li><a href="<?= base_url('welcome/cari') ?>">Pencarian</a></li>
<!--                    <li><a href="--><?//= base_url('login') ?><!--">Login</a></li>-->
                    <li><a href="<?= base_url('divisi') ?>">Divisi</a></li>
                    <li><a href="<?= base_url('karyawan') ?>">Karyawan</a></li>
                    <li><a href="<?= base_url('karyawan/surat') ?>">Surat Keluar</a></li>
                    <li><a href="<?= base_url('login/logout') ?>">Logout (<?= $user->email ?>)</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="<?= base_url('welcome/cari') ?>">Pencarian</a></li>
                    <li><a href="<?= base_url('login') ?>">Login</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>