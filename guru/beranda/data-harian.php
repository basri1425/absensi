<?php 
    $kelas = $_POST['kelas'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    include '../../config/database.php';
    $sql="select * from analisis_kehadiran where bulan='".$bulan."' and tahun='".$tahun."' and kelas='".$kelas."'";
    $cek=mysqli_query($kon,$sql);
    $jumlah_data = mysqli_num_rows($cek);

    if ($jumlah_data<=0){
        echo "<div class='alert alert-warning'> Data tidak ditemukan!</div>";
        exit;
    }
?>

<div class="chart">
    <canvas id="data_harian" ></canvas>
</div>
<?php 
    //Membuat format tanggal
    function tanggal($tanggal)
    {
        $bulan = array (1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split = explode('-', $tanggal);
        return $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }
?>

<?php

    $kelas = $_POST['kelas'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
 

    $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    include '../../config/database.php';
    for($hari=1;$hari<=$jumHari;$hari++)
    {

        $query1=mysqli_query($kon,"select * from analisis_kehadiran where status_kehadiran in (1,0) and keterangan not in (3) and tanggal='".$hari."' and bulan='".$bulan."' and tahun='".$tahun."' and kelas='".$kelas."'");
        $hadir = mysqli_num_rows($query1);
    
        $total[] = $hadir;
        $tgl[] = $hari;
        $bg_hadir[]='#0080ff';

        $query2=mysqli_query($kon,"select * from analisis_kehadiran where status_kehadiran in (0) and keterangan in (3) and tanggal='".$hari."' and bulan='".$bulan."' and tahun='".$tahun."' and kelas='".$kelas."'");
        $tidak_hadir = mysqli_num_rows($query2);
        $total_2[] = $tidak_hadir;
        $bg_absen[]='#ff0000';
    }


?>
<script>
    var ctx = document.getElementById('data_harian').getContext('2d');
    ctx.height = 500;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels : <?php echo json_encode($tgl); ?>,
            datasets: [{
                label:'Hadir',
                backgroundColor: <?php echo json_encode($bg_hadir); ?>,
                data: <?php echo json_encode($total); ?>
            },{
                label:'Tidak Hadir',
                backgroundColor: <?php echo json_encode($bg_absen); ?>,
                data: <?php echo json_encode($total_2); ?>
            },]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        precision: 0
                    }
                }]
            }
        }
    });
</script>
