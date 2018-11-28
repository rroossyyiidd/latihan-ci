<?php include APPPATH . 'views/fragment/header.php'; ?>

<div class="break"></div>
<div class="bg-login">
    <div>
    <h2>Login</h2>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post" action="<?= base_url('login/masuk') ?>">
        <div>
            <label>Email</label>
            <input type="email" name="username"/>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password"/>
        </div>
        <div>
            <input type="submit" value="login"/>
        </div>
    </form>
    </div>
</div>
<?php include APPPATH . 'views/fragment/footer.php'; ?>
