<?php include APPPATH . 'views/fragment/header.php'; ?>
<?php include APPPATH . 'views/fragment/menu.php'; ?>
<h3>Detail Karyawan</h3>

<table>
    <tr>
        <td><img width="100" height="100" src="<?= BASE_ASSETS . '/uploads/' . $karyawan['foto'] ?>"></td>
    </tr>
    <tr>
        <th>Nama</th>
        <td><?= $karyawan['nama'] ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?= $karyawan['email'] ?></td>
    </tr>
    <tr>
        <th>Telpon</th>
        <td><?= $karyawan['telpon'] ?></td>
    </tr>
    <tr>
        <th>Jenis Kelamin</th>
        <td><?= $karyawan['jeniskelamin'] ?></td>
    </tr>
    <tr>
        <th>Jabatan</th>
        <td><?= $karyawan['jabatan'] ?></td>
    </tr>
    <tr>
        <th>Divisi</th>
        <td><?= $karyawan['namadivisi'] ?></td>
    </tr>
    <tr>
        <th>Tanggal lahir</th>
        <td><?= $karyawan['tgllahir'] ?></td>
    </tr>
</table>
<?php include APPPATH . 'views/fragment/footer.php'; ?>

