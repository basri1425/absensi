<?php 
    include '../../../config/database.php';

    $kode_mapel=strtoupper(addslashes(trim($_POST['kode_mapel'])));
    $nama_mapel=strtoupper(addslashes(trim($_POST['nama_mapel'])));

    $sql="insert into mapel (kode_mapel,nama_mapel) values
    ('$kode_mapel','$nama_mapel')";

   mysqli_query($kon,$sql);


?>