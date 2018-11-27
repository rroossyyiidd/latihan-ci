<?php include APPPATH . 'views/fragment/header.php'; ?>
<?php include APPPATH . 'views/fragment/menu.php'; ?>
    <h3>Data Divisi</h3>
    <a class="btn bg-success pull-right" href="<?= base_url('divisi/tambah') ?>">Tambah</a>
    <table class="table table-striped">
        <tr>
            <!--        <th>No</th>-->
            <th>Kode</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>

        <?php
        foreach ($records as $idx => $data) {
            ?>
            <tr>
                <!--            <td>--><?//= $idx + 1 ?><!--</td>-->
                <td><?= $data['kode'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td>
                    <!--                <a href="--><?//= base_url('divisi/detail') ?><!--?id=-->
                    <?//= $data['id'] ?><!--">Detail</a> ini pakai query string yg dibawah pakai segment-->
                    <a class="btn btn-small btn-primary" href="<?= base_url('divisi/detail') ?>/<?= $data['id'] ?>">Detail</a>
                    <a class="btn btn-small btn-warning"
                       href="<?= base_url('divisi/edit') ?>/<?= $data['id'] ?>">Edit</a>
                    <a onclick="return confirm('menghapus data?')" class="btn btn-small btn-danger"
                       href="<?= base_url('divisi/hapus') ?>/<?= $data['id'] ?>">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php include APPPATH . 'views/fragment/footer.php'; ?>