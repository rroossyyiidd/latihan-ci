<?php include APPPATH . 'views/fragment/header.php'; ?>
<?php include APPPATH . 'views/fragment/menu.php'; ?>
    <h3 style="margin-bottom: 20px; font-family: 'Open Sans', sans-serif;">Data Karyawan</h3>
    <a class="btn bg-success pull-left" style="margin-bottom: 15px" href="<?= base_url('karyawan/tambah') ?>">Tambah
        Karyawan</a>
    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Divisi</th>
            <th>Tanggal lahir</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>

        <?php
        foreach ($records as $idx => $data) {
            ?>
            <tr>
                <td><?= $idx + 1 ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['jabatan'] ?></td>
                <td><?= $data['namadivisi'] ?></td>
                <td><?= $data['tgllahir'] ?></td>
                <td><img width="100" height="100" src="<?= BASE_ASSETS . '/uploads/' . $data['foto'] ?>"></td>
                <td>
                    <!--                <a href="--><?//= base_url('karyawan/detail') ?><!--?id=-->
                    <?//= $data['id'] ?><!--">Detail</a> ini pakai query string yg dibawah pakai segment-->
                    <a class="btn btn-small btn-primary" href="<?= base_url('karyawan/detail') ?>/<?= $data['id'] ?>">Detail</a>
                    <a class="btn btn-small btn-warning"
                       href="<?= base_url('karyawan/edit') ?>/<?= $data['id'] ?>">Edit</a>
                    <a onclick="return confirm('menghapus data?')" class="btn btn-small btn-danger"
                       href="<?= base_url('karyawan/hapus') ?>/<?= $data['id'] ?>">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php include APPPATH . 'views/fragment/footer.php'; ?>