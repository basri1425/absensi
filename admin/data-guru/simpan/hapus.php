<?php
    include '../../../config/database.php';

    //Jika admin memilih hanya menghapus data guru
    if (isset($_POST['id_guru'])){
        $id_guru=$_POST['id_guru'];
        mysqli_query($kon,"delete from guru where id_guru='$id_guru'");
       
    }

    //Jika admin memilih hanya menghapus data guru dan semua data absensi Guru tersebut akan ikut dihapus
    if (isset($_POST['nip'])){
        $nip=$_POST['nip'];
        mysqli_query($kon,"delete from guru where nip='$nip'");
        mysqli_query($kon,"delete from pertemuan where guru='$nip'");
       
    }
?>