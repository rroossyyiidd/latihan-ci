<?php include APPPATH . 'views/fragment/header.php'; ?>
<?php include APPPATH . 'views/fragment/menu.php'; ?>
    <h3>Detail Divisi</h3>

    <table>
        <tr>
            <th>Kode Divisi</th>
            <td><?= $divisi['kode'] ?></td>
        </tr>
        <tr>
            <th>Nama Divisi</th>
            <td><?= $divisi['nama'] ?></td>
        </tr>
    </table>
<?php include APPPATH . 'views/fragment/footer.php'; ?>

