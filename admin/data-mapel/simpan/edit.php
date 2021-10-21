<?php 
    include '../../../config/database.php';
    $id_mapel=addslashes(trim($_POST['id_mapel']));
    $kode_mapel_sebelum=strtoupper(addslashes(trim($_POST['kode_mapel_sebelum'])));
    $kode_mapel=strtoupper(addslashes(trim($_POST['kode_mapel'])));
    $nama_mapel=strtoupper(addslashes(trim($_POST['nama_mapel'])));

    if ($kode_mapel==$kode_mapel_sebelum){
        $sql="update mapel set
        nama_mapel='$nama_mapel'
        where id_mapel='$id_mapel'";
         mysqli_query($kon,$sql);
    }else {

        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");

        $sql="update mapel set
        kode_mapel='$kode_mapel',
        nama_mapel='$nama_mapel'
        where kode_mapel='$kode_mapel_sebelum'";
        $update_mapel=mysqli_query($kon,$sql);

        
        $sql="update pertemuan set
        mapel='$kode_mapel'
        where mapel='$kode_mapel_sebelum'";
        $pertemuan=mysqli_query($kon,$sql);

        if ($update_mapel and $pertemuan) {
            //Lakukan commit jika semua berhasil
            mysqli_query($kon,"COMMIT");
          }
          else {
            //Lakukan rollback jika salah satu tidak berhasil
            mysqli_query($kon,"ROLLBACK");
          }
    }




?>