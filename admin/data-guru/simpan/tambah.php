<?php 
    include '../../../config/database.php';

    $nip=addslashes(trim($_POST['nip']));
    $nama_guru=strtoupper(addslashes(trim($_POST['nama_guru'])));
    $jk=addslashes(trim($_POST['jk']));
    $password=md5('12345');

    $sql="insert into guru (nip,nama_guru,jk,password) values
    ('$nip','$nama_guru','$jk','$password')";

   mysqli_query($kon,$sql);

?>