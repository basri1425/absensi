<?php
    include '../../../config/database.php';
    $id_mapel=$_POST['id_mapel'];
    mysqli_query($kon,"delete from mapel where id_mapel='$id_mapel'");
   
?>