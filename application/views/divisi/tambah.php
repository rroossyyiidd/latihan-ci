<?php include APPPATH . 'views/fragment/header.php'; ?>
<?php include APPPATH . 'views/fragment/menu.php'; ?>
<h3>Tambah Divisi</h3>
<?php echo validation_errors(); ?>
<form action="<?= base_url('divisi/tambah_save') ?>" method="post">
    <div>
        <label>Kode:</label>
        <input type="text" name="kode" required/>
    </div>
    <div>
        <label>Nama:</label>
        <input type="text" name="nama" required/>
    </div>
    <div>
        <input type="submit" value="simpan"/>
    </div>
</form>
<?php include APPPATH . 'views/fragment/footer.php'; ?>