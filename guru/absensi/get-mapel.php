<?php
    session_start(); 
    include '../../config/database.php';
    $guru=$_SESSION['username'];
    $kelas=$_POST['kelas'];
    $results = array();
    $query = mysqli_query($kon, "select distinct m.kode_mapel,m.nama_mapel from mapel m inner join pertemuan p on p.mapel=m.kode_mapel where p.guru='".$guru."' and p.kelas='".$kelas."' group by m.kode_mapel,m.nama_mapel order by m.id_mapel asc");
    while ($data = mysqli_fetch_array($query)):
        $results[] = $data;
    endwhile;
    echo json_encode($results);
?>

