<?php
    $nip=$_POST['nip'];
    include "../../config/database.php";
    $hasil = mysqli_query ($kon,"select * from guru where nip='".$nip."' limit 1");
    $jumlah = mysqli_num_rows($hasil);

    if ($jumlah>=1){
        echo "<div class='alert alert-danger'> NIP telah digunakan</div>";
        echo "<script>  $('#submit').prop('disabled', true); </script>";
    }else {
        echo "<div class='alert alert-success'> NIP Tersedia</div>";
        echo "<script>  $('#submit').prop('disabled', false); </script>";
    }
?>
