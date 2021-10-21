<?php
    session_start();

    include '../../../config/database.php';
    $id_pertemuan=addslashes(trim($_POST['id_pertemuan']));
    $mapel=addslashes(trim($_POST['mapel']));
    $pertemuan_ke=addslashes(trim($_POST['pertemuan_ke']));
    $topik=addslashes(trim($_POST['topik']));
    $tanggal=addslashes(trim($_POST['tanggal']));
    $mulai=addslashes(trim($_POST['mulai']));
    $selesai=addslashes(trim($_POST['selesai']));
    $guru=$_SESSION['username'];

    
    $sql="update pertemuan set
    guru='$guru',
    mapel='$mapel',
    pertemuan_ke='$pertemuan_ke',
    topik='$topik',
    tanggal='$tanggal',
    mulai='$mulai',
    selesai='$selesai'
    where id_pertemuan='$id_pertemuan'";

    mysqli_query($kon,$sql);

 
   $siswa=$_POST['siswa'];
   $kehadiran=$_POST['kehadiran'];
   $keterangan=$_POST['keterangan'];

   for ($i=0; $i < count($siswa) ; $i++){ 
        $sql1="update kehadiran set
        status_kehadiran='$kehadiran[$i]',
        keterangan='$keterangan[$i]'
        where siswa='$siswa[$i]' and pertemuan='$id_pertemuan'";
        mysqli_query($kon,$sql1);
    }

?>