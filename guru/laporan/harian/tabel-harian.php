<?php session_start(); ?>

<?php
    $kelas=$_POST['kelas'];
    $tanggal=$_POST['tanggal'];
    include '../../../config/database.php';
    $sql="select mapel from pertemuan p where p.kelas='".$kelas."' and p.tanggal='".$tanggal."' order by p.tanggal asc";
    $cek=mysqli_query($kon,$sql);
    $jumlah_data = mysqli_num_rows($cek);

    if ($jumlah_data<=0){
        echo "<div class='alert alert-warning'> Data tidak ditemukan!</div>";
        exit;
    }
?>

<script>
$('title').text('DATA ABSENSI KELAS <?php echo $kelas; ?> TANGGAL <?php echo  tanggal(date('Y-m-d', strtotime($tanggal))); ?>');
</script>

<div class="table-responsive">
    <table class="table table-bordered table-striped" id="tabel_harian" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th class="text-center">NISN</th>
                <th>Nama</th>
                <?php
                    $kelas=$_POST['kelas'];
                    $tanggal=$_POST['tanggal'];
                    include '../../../config/database.php';
                    $sql="select kode_mapel,nama_mapel from pertemuan p inner join mapel m on m.kode_mapel=p.mapel where p.kelas='".$kelas."' and p.tanggal='".$tanggal."' order by p.tanggal asc";
                    $hasil=mysqli_query($kon,$sql);
                    while ($data = mysqli_fetch_array($hasil)):
                ?>
                <th class="text-center"> <span data-toggle="tooltip" title="<?php echo $data['nama_mapel']; ?>"><?php echo $data['kode_mapel']; ?></span> </th>
                <?php endwhile; ?>
                <th><span data-toggle="tooltip" title="Jumlah Pertemuan">Jml</span></th>
                <th><span data-toggle="tooltip" title="Jumlah Hadir">Hadir</span></th>
                <th><span data-toggle="tooltip" title="Jumlah Izin">Izin</span></th>
                <th class="text-center"><span data-toggle="tooltip" title="Jumlah Sakit">Sakit</span></th>
                <th class="text-center"><span data-toggle="tooltip" title="Jumlah Apla">Alpa</span></th>
                <th class="text-center"><span data-toggle="tooltip" title="Persentase Kehadiran">Hadir (%)</span></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no=0;
            $hadir=0;
            $sakit=0;
            $izin=0;
            $alpa=0;
            $jumlah_pertemuan=0;
            $jumlah_hadir=0;
            $total_hadir=0;
            $persentase=0;
            //Mendapatkan list siswa
            $sql="select * from siswa s where s.kelas='".$kelas."'  order by s.nisn asc";
            $hasil=mysqli_query($kon,$sql);
            while ($data = mysqli_fetch_array($hasil)):
                $no++;
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['nisn']; ?></td>
                <td><?php echo $data['nama_siswa'];?></td>
                <?php
                    //Mendapat list pertemuan
                    $result=mysqli_query($kon,"select id_pertemuan from pertemuan p where p.kelas='".$kelas."' and p.tanggal='".$tanggal."' order by p.tanggal asc");
                    while ($row = mysqli_fetch_array($result)){
                        $jumlah_pertemuan++;

                        $hasil1=mysqli_query($kon,"select * from kehadiran k where k.pertemuan='".$row['id_pertemuan']."' and k.siswa='".$data['nisn']."' limit 1");
                        $get = mysqli_fetch_array($hasil1);

                        if (isset($get['status_kehadiran'])){
                            if ($get['status_kehadiran']==1){
                                $hadir++;
                                echo "<td class='text-center'><span class='text-success' data-toggle='tooltip' title='Hadir'>H</span> </td>";
                            }else {
                                if ($get['keterangan']==1){
                                    $sakit++;
                                    echo "<td class='text-center'><span class='text-info' data-toggle='tooltip' title='Sakit'>S</span> </td>";
                                } else if ($get['keterangan']==2){
                                    $izin++;
                                    echo "<td class='text-center'><span class='text-warning' data-toggle='tooltip' title='Izin' >I</span> </td>";
                                }else {
                                    $alpa++;
                                    echo "<td class='text-center'><span class='text-danger' data-toggle='tooltip' title='Alpa' >A</span> </td>";
                                }
                            }
                        }else {
                            echo "<td></td>";
                        }

                    }

                    $jumlah_hadir=$hadir+$izin+$sakit;
                    echo "<td>".$jumlah_pertemuan."</td>";
                    echo "<td>".$hadir."</td>";
                    echo "<td>".$izin."</td>";
                    echo "<td>".$sakit."</td>";
                    echo "<td>".$alpa."</td>";
                    if ($jumlah_hadir!=0){
                        echo "<td>".(float)number_format($jumlah_hadir/$jumlah_pertemuan*100,2)." %</td>";
                        $persentase=($jumlah_hadir/$jumlah_pertemuan)*100;
                        if ($persentase>=60){
                            $total_hadir++;
                        }
                        
                    }else {
                        echo "<td>0 %</td>";
                    }

                    $jumlah_pertemuan=0;
                    $hadir=0;
                    $sakit=0;
                    $izin=0;
                    $alpa=0;
                ?>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-sm-3">
        <h4>Keterangan:</h4>
        <table class="table">
            <tbody>
            <tr>
                <td>Jumlah Siswa Hadir</td>
                <td width="7%"><span><?php echo $total_hadir; ?></span></td>
            </tr>
            <tr>
                <td>Jumlah Siswa Alpa</td>
                <td><span><?php echo $no-$total_hadir; ?></span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $(document).ready(function() {
        $('#tabel_harian').DataTable( {
            "searching": false,
            "paging":   false,
            "ordering": false,
            "info":     true,
            dom: 'Bfrtip',
            buttons: ['excel']
        });
    });
</script>

<?php 
    //Membuat format tanggal
    function tanggal($tanggal)
    {
        $bulan = array (1 =>   'Januari',
            'FEBRUARI',
            'MARET',
            'APRIL',
            'MEI',
            'JUNI',
            'JULI',
            'AGUSTUS',
            'SEPTEMBER',
            'OKTOBER',
            'NOVEMBER',
            'DESEMBER'
        );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }
?>