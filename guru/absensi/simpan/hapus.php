<?php
    include '../../../config/database.php';
    $id_pertemuan=$_POST['id_pertemuan'];
    mysqli_query($kon,"delete from pertemuan where id_pertemuan='$id_pertemuan'");
    mysqli_query($kon,"delete from kehadiran where pertemuan='$id_pertemuan'");
   
?>