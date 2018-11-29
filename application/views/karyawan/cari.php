<?php include APPPATH . 'views/fragment/header.php'; ?>
<?php include APPPATH . 'views/fragment/menu.php'; ?>

<h3 style="margin-bottom: 20px; font-family: 'Open Sans', sans-serif;">Pencarian Data Karyawan</h3>
<form method="post" action="<?= base_url('welcome/cari_action') ?>">
<!--    <div>-->
<!--        <input type="text" name="nama" placeholder="ketik nama..."/>-->
<!--        <input type="submit" value="Cari"/>-->
<!--    </div>-->
    <div class="input-group" style="width: 40%; margin-bottom: 15px">
        <input type="text" name="nama" class="form-control" placeholder="Ketik nama...">
        <span class="input-group-btn">
        <button value="Cari" class="btn btn-default" type="submit">Cari</button>
      </span>
    </div>
    <table class="table table-striped">
        <tr>
            <!--        <th>No</th>-->
            <th>Nama</th>
            <th>Email</th>
            <th>Telpon</th>
            <th>Jabatan</th>
            <th>Jenis Kelamin</th>
            <th>Divisi</th>
        </tr>

        <?php
        if (isset($records)) {
            foreach ($records as $idx => $data) {
                ?>
                <tr>
                    <!--            <td>--><?//= $idx + 1 ?><!--</td>-->
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['telpon'] ?></td>
                    <td><?= $data['jabatan'] ?></td>
                    <td><?= $data['jeniskelamin'] ?></td>
                    <td><?= $data['namadivisi'] ?></td>
                </tr>
                <?php
            }
        } ?>
    </table>
</form>