<?php include APPPATH . 'views/fragment/header.php'; ?>
<?php include APPPATH . 'views/fragment/menu.php'; ?>

    <style>
        .bg-login {
            /*background: url("");*/
            background-position: center;
            background-repeat: no-repeat;
            margin: auto;
            /*atas kanan kiri bawah*/
            -webkit-box-shadow: 9px 9px 22px 1px rgba(5, 5, 5, 0.41);
            -moz-box-shadow: 9px 9px 22px 1px rgba(5, 5, 5, 0.41);
            box-shadow: 9px 9px 22px 1px rgba(5, 5, 5, 0.41);
            min-width: 350px;
            min-height: 250px;
            border-radius: 8px;
            background-color: #F5F5F6;
        }

        .layout-login {
            display: flex;
            flex-direction: column;
            height: 80vh;
        }

        .content-login {
            display: flex;
            flex-direction: column;
            width: 100%;
            min-height: 200px;
            justify-content: center;
            align-items: center;
        }
    </style>

    <div class="layout-login">
        <div class="bg-login">
            <div class="content-login">
                <h3 style="margin-bottom: 20px; font-family: 'Open Sans', sans-serif;">Tambah Divisi</h3>
                <?php echo validation_errors(); ?>
                <form action="<?= base_url('divisi/tambah_save') ?>" method="post">
                    <div>
                        <input style="margin-top: 10px" name="kode" type="text" class="form-control"
                               placeholder="Kode Divisi"
                               aria-describedby="basic-addon1" required>
                    </div>
                    <div>
                        <input style="margin-top: 10px" name="nama" type="text" class="form-control"
                               placeholder="Kode Divisi"
                               aria-describedby="basic-addon1" required>
                    </div>
                    <div>
                        <input style="width: 100%; margin-top: 10px" class="btn btn-primary text-center btn-small"
                               type="submit"
                               value="simpan"/>
                    </div>
                </form>
            </div>
        </div>
        <div style="height: 20vh"></div>
    </div>
<?php include APPPATH . 'views/fragment/footer.php'; ?>