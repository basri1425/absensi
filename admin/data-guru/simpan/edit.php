<?php 
    include '../../../config/database.php';
    $id_guru=addslashes(trim($_POST['id_guru']));
    $nip_sebelum=addslashes(trim($_POST['nip_sebelum']));
    $nip=addslashes(trim($_POST['nip']));
    $nama_guru=strtoupper(addslashes(trim($_POST['nama_guru'])));
    $jk=addslashes(trim($_POST['jk']));


    if ($nip_sebelum==$nip){
        $sql="update guru set
        nama_guru='$nama_guru',
        jk='$jk'
        where id_guru='$id_guru'";
    
       mysqli_query($kon,$sql);
    }else {

        //Bila NIP di ubah maka tabel yang berelasi juga ikut diubah
        $sql="update guru set
        nip='$nip',
        nama_guru='$nama_guru',
        jk='$jk'
        where id_guru='$id_guru'";
    
       mysqli_query($kon,$sql);

       $sql1="update pertemuan set
       guru='$nip'
       where guru='$nip_sebelum'";
   
        mysqli_query($kon,$sql1);


    }



?>