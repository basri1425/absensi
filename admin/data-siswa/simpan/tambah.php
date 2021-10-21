<?php 
    include '../../../config/database.php';

    $nisn=addslashes(trim($_POST['nisn']));
    $nama_siswa=strtoupper(addslashes(trim($_POST['nama_siswa'])));
    $jk=addslashes(trim($_POST['jk']));
    $kelas=addslashes(trim($_POST['kelas']));

    $sql="insert into siswa (nisn,nama_siswa,jk,kelas) values
    ('$nisn','$nama_siswa','$jk','$kelas')";

   mysqli_query($kon,$sql);


?>