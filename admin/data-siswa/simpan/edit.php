<?php 
    include '../../../config/database.php';
    $id_siswa=addslashes(trim($_POST['id_siswa']));
    $nisn=addslashes(trim($_POST['nisn']));
    $nisn_sebelum=addslashes(trim($_POST['nisn_sebelum']));
    $nama_siswa=strtoupper(addslashes(trim($_POST['nama_siswa'])));
    $jk=addslashes(trim($_POST['jk']));
    $kelas=addslashes(trim($_POST['kelas']));

    if ($nisn==$nisn_sebelum){
        $sql="update siswa set
        nama_siswa='$nama_siswa',
        jk='$jk',
        kelas='$kelas'
        where id_siswa='$id_siswa'";
        mysqli_query($kon,$sql);

    } else {
        mysqli_query($kon,"START TRANSACTION");

        $sql="update siswa set
        nisn='$nisn',
        nama_siswa='$nama_siswa',
        jk='$jk',
        kelas='$kelas'
        where id_siswa='$id_siswa'";
        $update_siswa=mysqli_query($kon,$sql);

        $sql="update kehadiran set
        siswa='$nisn'
        where siswa='$nisn_sebelum'";
        $kehadiran=mysqli_query($kon,$sql);
    
       if ($update_siswa and $kehadiran) {
            //Lakukan commit jika semua berhasil
            mysqli_query($kon,"COMMIT");
        }
        else {
            //Lakukan rollback jika salah satu tidak berhasil
            mysqli_query($kon,"ROLLBACK");
        }
    }



?>