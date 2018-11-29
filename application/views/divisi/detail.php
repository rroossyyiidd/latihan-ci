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
            <h3 style="margin-bottom: 20px; font-family: 'Open Sans', sans-serif;">Detail Divisi</h3>

            <!--            <table>-->
            <!--                <tr>-->
            <!--                    <th>Kode Divisi</th>-->
            <!--                    <td>--><? //= $divisi['kode'] ?><!--</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <th>Nama Divisi</th>-->
            <!--                    <td>--><? //= $divisi['nama'] ?><!--</td>-->
            <!--                </tr>-->
            <!--            </table>-->
            <h5 style="font-family: 'Open Sans', sans-serif; font-weight: bold; margin-bottom: 3px">Kode Divisi:</h5>
            <p><?= $divisi['kode'] ?></p>
            <h5 style="font-family: 'Open Sans', sans-serif; font-weight: bold; margin-bottom: 3px">Nama Divisi:</h5>
            <p><?= $divisi['nama'] ?></p>
        </div>
    </div>

    <div style="height: 20vh"></div>
</div>
<?php include APPPATH . 'views/fragment/footer.php'; ?>

