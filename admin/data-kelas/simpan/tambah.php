<?php 
    include '../../../config/database.php';

    $kode_kelas=strtoupper(addslashes(trim($_POST['kode_kelas'])));
    $nama_kelas=strtoupper(addslashes(trim($_POST['nama_kelas'])));

    $sql="insert into kelas (kode_kelas,nama_kelas) values
    ('$kode_kelas','$nama_kelas')";

   mysqli_query($kon,$sql);


?>