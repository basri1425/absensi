<?php 
    include '../../../config/database.php';
    $kelas=addslashes(trim($_POST['kelas']));
    $id_guru=addslashes(trim($_POST['id_guru']));
    $pilih=addslashes(trim($_POST['pilih']));

    if ($pilih=='ya'){
        $sql="update guru set
        wali_kelas='$kelas'
        where id_guru='$id_guru'";
       mysqli_query($kon,$sql);
    }else {
        $sql="update guru set
        wali_kelas=''
        where id_guru='$id_guru'";
       mysqli_query($kon,$sql);
    }

?>