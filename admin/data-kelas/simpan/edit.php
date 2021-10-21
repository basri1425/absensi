<?php 
    include '../../../config/database.php';
    $id_kelas=addslashes(trim($_POST['id_kelas']));
    $kode_kelas_sebelum=strtoupper(addslashes(trim($_POST['kode_kelas_sebelum'])));
    $kode_kelas=strtoupper(addslashes(trim($_POST['kode_kelas'])));
    $nama_kelas=strtoupper(addslashes(trim($_POST['nama_kelas'])));


    if ($kode_kelas==$kode_kelas_sebelum){
        $sql="update kelas set
        nama_kelas='$nama_kelas'
        where id_kelas='$id_kelas'";
        mysqli_query($kon,$sql);
    }else {
        //Mulai menggunakan transaksi
        mysqli_query($kon,"START TRANSACTION");

        //Update pada tabel kelas
        $sql="update kelas set
        kode_kelas='$kode_kelas',
        nama_kelas='$nama_kelas'
        where kode_kelas='$kode_kelas_sebelum'";
        $kelas=mysqli_query($kon,$sql);

        //Update pada tabel pertemuan
        $sql="update pertemuan set
        kelas='$kode_kelas'
        where kelas='$kode_kelas_sebelum'";
        $pertemuan=mysqli_query($kon,$sql);

        //Update pada tabel guru
        $sql="update guru set
        wali_kelas='$kode_kelas'
        where wali_kelas='$kode_kelas_sebelum'";
        $guru=mysqli_query($kon,$sql);

        //Update pada tabel siswa
        $sql="update siswa set
        kelas='$kode_kelas'
        where kelas='$kode_kelas_sebelum'";
        $siswa=mysqli_query($kon,$sql);

        if ($siswa and $guru and $pertemuan and $kelas) {
            //Lakukan commit jika semua berhasil
            mysqli_query($kon,"COMMIT");
          }
          else {
            //Lakukan rollback jika semua berhasil
            mysqli_query($kon,"ROLLBACK");
          }
    
    }



?>