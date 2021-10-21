<?php
    session_start();

    include '../../../config/database.php';

    $kelas=addslashes(trim($_POST['kelas']));
    $mapel=addslashes(trim($_POST['mapel']));
    $pertemuan_ke=addslashes(trim($_POST['pertemuan_ke']));
    $topik=addslashes(trim($_POST['topik']));
    $tanggal=addslashes(trim($_POST['tanggal']));
    $mulai=addslashes(trim($_POST['mulai']));
    $selesai=addslashes(trim($_POST['selesai']));
    $guru=$_SESSION['username'];

    $sql="insert into pertemuan (kelas,guru,mapel,pertemuan_ke,topik,tanggal,mulai,selesai) values
    ('$kelas','$guru','$mapel','$pertemuan_ke','$topik','$tanggal','$mulai','$selesai')";
    mysqli_query($kon,$sql);


    $hasil=mysqli_query($kon,"select * from pertemuan order by id_pertemuan desc limit 1");
    $row = mysqli_fetch_array($hasil);
    $id_pertemuan=$row['id_pertemuan'];
 

   $siswa=$_POST['siswa'];
   $kehadiran=$_POST['kehadiran'];
   $keterangan=$_POST['keterangan'];

   for ($i=0; $i < count($siswa) ; $i++){
        $sql1="insert into kehadiran (pertemuan,siswa,status_kehadiran,keterangan) values
        ('$id_pertemuan','$siswa[$i]','$kehadiran[$i]','$keterangan[$i]')";
        mysqli_query($kon,$sql1);
    }

?>