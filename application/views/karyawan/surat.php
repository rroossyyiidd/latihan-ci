<?php
include APPPATH . '/views/fragment/header.php';
include APPPATH . '/views/fragment/menu.php';
?>
<link rel="stylesheet" href="<?= BASE_ASSETS ?>/bootstrap-select/bootstrap-select.css">
<script type="text/javascript" src="<?= BASE_ASSETS ?>
/bootstrap-select/bootstrap-select.js"></script>
<style>
    pre {
        margin: 1em 0;
    }

    select.selectpicker {
        display: none; /* Prevent FOUC */
    }
</style>
<script>
    var idx = 0;

    function hapus(idx) {
        $("#tr_" + idx).remove();
    }

    function add_content(val) {
        //split = merubah string jadi array
        var explode = val.split('|');
        var value = explode[0];
        //konten kolom tabel
        var content = '<tr id="tr_' + idx + '">';
        content += '<td>';
        content += '<input value="' + value + '" type="hidden" name="karyawan[]"">';
        content += '<input value="' + val + ' " type="text" readonly name="nama[]"">';
        content += '</td>';
        content += '<td>';
        content += '<input type="text" name="biaya[]">';
        content += '</td>';
        content += '<td>';
        content += '<input type="text" name="qty[]">';
        content += '</td>';
        content += '<td>';
        content += '<input type="text" name="subtotal[]">';
        content += '</td>';
        content += '<td>';
        content += '<a href="#" onclick=\'hapus(' + idx + ')\'">hapus</a>';
        content += '</td>';
        content += '</tr>';
        //append (menambahkan data) kolom tabel ke data tabel
        $("#tabel").append(content);
    }

    //ini onchange, gk ada "on" nya
    $(function () {
        $("#karyawan").change(function () {
            //mengambil value dari drop down
            var value = $("#karyawan").selectpicker('val');
            //menjalankan fungsi add_content
            add_content(value);
            //ini untuk id hapus kolom (tr)
            idx++;
        });
    });
</script>
<div class="container">
    <h2>Input Surat Keluar Karyawan</h2>
    <form class="form-horizontal"
          name="form"
          method="POST"
          id="formbeli"
          action="<?= base_url("karyawan/surat_save") ?>">
        <div class="form-group">
            <label class="control-label col-sm-2" for="faktur">Karyawan</label>
            <div class="col-sm-10">
                <!--                ini id karyawan untuk event click-->
                <select title="Select your surfboard" class="selectpicker" id="karyawan">
                    <option>Pilih...</option>
                    <?php
                    foreach ($records as $key => $value) {
                        ?>
                        <option value="<?= $value['id'] ?>|<?= $value['nama'] ?>">
                            <?= $value['nama'] ?> </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="faktur">Nomor Surat</label>
            <div class="col-sm-10">
                <input type="text" name="nomor" id="nomor"/>
            </div>
        </div>
        <div class="form-group">
            <!--            punya id tabel untuk di javascript-->
            <!--            name untuk server, id untuk js, kalau name boleh dobel, id harus unik tidak boleh dobel-->
            <table id="tabel" class="table table-hover">
                <tr>
                    <th>Karyawan</th>
                    <th>Biaya</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </table>
        </div>
        <div class="form-group" style="float: right">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" value="Simpan" id="submit"
                       name="submit">
            </div>
        </div>
    </form>
</div>
