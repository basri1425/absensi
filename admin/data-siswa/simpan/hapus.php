<?php
    include '../../../config/database.php';
    $id_siswa=$_POST['id_siswa'];
    mysqli_query($kon,"delete from siswa where id_siswa='$id_siswa'");
   
?>