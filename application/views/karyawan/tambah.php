<?php include APPPATH . 'views/fragment/header.php'; ?>
<?php include APPPATH . 'views/fragment/menu.php'; ?>

    <!--script jquery untuk datepicker agar support di beberapa browser-->
    <script type="text/javascript">
        $(function () {
            $('input.datepicker').each(function () {
                var datepicker = $(this);
                datepicker.bootstrapDatePicker(datepicker.data());
            })
        })
    </script>

    <h3>Tambah Karyawan</h3>
    <!--ini untuk validasi error-->
<?php echo validation_errors(); ?>
    <form enctype="multipart/form-data" action="<?= base_url('karyawan/tambah_save') ?>" method="post">
        <div>
            <label>Nama:</label>
            <input type="text" name="nama" required/>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required/>
        </div>
        <div>
            <label>Telpon:</label>
            <input type="tel" name="telpon" required/>
        </div>
        <div>
            <label>Jabatan:</label>
            <select name="jabatan">
                <?php
                foreach ($jabatan as $key => $label) {
                    ?>
                    <option value="<?= $key ?>"><?= $label ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Jenis kelamin:</label>
            <input type="radio" name="jeniskelamin" value="L" checked/>L
            <input type="radio" name="jeniskelamin" value="P"/>P
        </div>
        <div>
            <label>Divisi:</label>
            <select name="iddivisi">
                <?php
                foreach ($divisi as $key => $label) {
                    ?>
                    <option value="<?= $label['id'] ?>"><?= $label['nama'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div style="width: 300px">
            <label>Tanggal lahir:</label>
            <input
                    type="text"
                    name="tgllahir"
                    id="tgllahir"
                    data-default-today="true"
                    data-date-format="DD-MM-YYYY"
                    required
                    class="form-control datepicker col-sm-4"
            />
        </div>
        <div>
            <label>Foto: </label>
            <input type="file" name="foto"/>
        </div>

        <div>
            <input type="submit" value="simpan"/>
        </div>
    </form>
<?php include APPPATH . 'views/fragment/footer.php'; ?>