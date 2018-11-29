<?php include APPPATH . 'views/fragment/header.php'; ?>

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
        justify-content: center;
        align-items: center;
        flex-direction: row;
        height: 100vh;
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
            <h2 style="margin-bottom: 20px; font-family: 'Open Sans', sans-serif;">Masuk SIM SDM</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="<?= base_url('login/masuk') ?>">
                <div>
                    <input style="margin-top: 10px" name="username" type="email" class="form-control"
                           placeholder="email@mail.com"
                           aria-describedby="basic-addon1">
                </div>
                <div>
                    <input style="margin-top: 10px" name="password" type="password" class="form-control"
                           placeholder="email@mail.com"
                           aria-describedby="basic-addon1">
                </div>
                <div>
                    <input style="width: 100%; margin-top: 10px" class="btn btn-primary text-center btn-small"
                           type="submit"
                           value="login"/>
                </div>
            </form>
        </div>
    </div>
</div>