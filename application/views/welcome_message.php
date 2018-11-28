<?php include APPPATH . 'views/fragment/header.php'; ?>

<!--disini letak kode kode js-->
<script type="text/javascript">
    //blok jquery
    $(function () {
        // alert("jquery telah di load")
        //cara mengakses id lalu memberikan value
        $('#content').html('<b>hello world!</b>');
        $('.biru').html('class biru');
        $('#content').click(function () {
            $('#content').html('<b>content di klik</b>');
        });
        $('#tombol').click(function () {
            $('.biru').append('halo')
        })
    })

</script>

<!--styling-->
<style>
    /*    class biru*/
    .biru {
        background-color: blue;
        color: white;
    }
    /*id content*/
    #content{
        background-color: yellow;
    }
</style>

<!--untuk memanipulasi 1 objek-->
<div id="content"></div>
<!--untuk memanipulasi banyak objek, kerana class bisa dipakai dibeberapa tempat-->
<div class="biru"></div>

<button id="tombol">
    Klik
</button>