<?php
    include '../../../config/database.php';
    $id_kelas=$_POST['id_kelas'];
    mysqli_query($kon,"delete from kelas where id_kelas='$id_kelas'");
   
?>