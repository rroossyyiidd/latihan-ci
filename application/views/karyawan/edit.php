<?php include APPPATH . 'views/fragment/header.php'; ?>
<?php include APPPATH . 'views/fragment/menu.php'; ?>

    <script type="text/javascript">
        $(function () {
            $('input.datepicker').each(function () {
                var datepicker = $(this);
                datepicker.bootstrapDatePicker(datepicker.data());
            })
        })
    </script>
    <h3>Edit Karyawan</h3>
    <!--ini untuk validasi error-->
<?php echo validation_errors(); ?>
    <form action="<?= base_url('karyawan/edit_save') ?>" method="post">
        <input type="hidden" name="id" value="<?= $karyawan['id'] ?>"/>
        <div>
            <label>Nama:</label>
            <input type="text" name="nama" value="<?= $karyawan['nama'] ?>" required/>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?= $karyawan['email'] ?>" required/>
        </div>
        <div>
            <label>Telpon:</label>
            <input type="tel" name="telpon" value="<?= $karyawan['telpon'] ?>" required/>
        </div>
        <div>
            <label>Jabatan:</label>
            <select name="jabatan">
                <?php
                foreach ($jabatan as $key => $label) {
                    $selected = "";
                    if ($key == $karyawan['jabatan']) {
                        $selected = "selected";
                    }
                    ?>
                    <option value="<?= $key ?>" <?= $selected ?>><?= $label ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Jenis kelamin:</label>
            <?php
            $checkL = "";
            $checkP = "";
            if ($karyawan['jeniskelamin'] == "L") {
                $checkL = "checked";
                $checkP = "";
            } else {
                $checkL = "";
                $checkP = "checked";
            }
            ?>
            <input type="radio" name="jeniskelamin" value="L" <?= $checkL ?>/> L
            <input type="radio" name="jeniskelamin" value="P" <?= $checkP ?>/> P
        </div>
        <div>
            <label>Divisi:</label>
            <select name="iddivisi">
                <?php
                foreach ($divisi as $key => $label) {
                    $selected = "";
                    if ($label['id'] == $karyawan['iddivisi']) {
                        $selected = "selected";
                    }
                    ?>
                    <option value="<?= $label['id'] ?>" <?= $selected ?>><?= $label['nama'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div style="width: 300px">
            <label>Tanggal lahir:</label>
            <input
                    value="<?= $karyawan['tgllahir'] ?>"
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
            <input type="submit" value="simpan"/>
        </div>
    </form>
<?php include APPPATH . 'views/fragment/footer.php'; ?>