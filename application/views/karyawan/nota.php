<?php
include APPPATH . '/views/fragment/header.php';
include APPPATH . '/views/fragment/menu.php';
?>
<div class="page-header">
    <h1>Surat Keluar</h1>
</div>
<div class="row" id="nota">
    <table class="table table-bordered">
        <tr>
            <th>Nomor Surat</th>
            <td><?= $nomor ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?= $tanggal ?></td>
        </tr>
    </table>
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>Karyawan</th>
            <th>Biaya</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
        <?php
        for ($i = 0; $i < count($post['karyawan']); $i++) {
            ?>
            <tr>
                <td><?= $post['nama'][$i] ?></td>
                <td><?= $post['biaya'][$i] ?></td>
                <td><?= $post['qty'][$i] ?></td>
                <td><?= $post['subtotal'][$i] ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <h1>
        Total Biaya : <?= $total ?>
    </h1>
</div>
