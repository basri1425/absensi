<?php 
    session_start(); 
    include '../../../config/database.php';
    $kelas=$_POST['kelas'];
    $mapel=$_POST['mapel'];
    $sql="select * from mapel where kode_mapel='".$mapel."'";
    $hasil=mysqli_query($kon,$sql);

    $cek = mysqli_num_rows($hasil);

    //Cek jika belum ada data maka result tidak akan ditampilkan
    if ($cek<=0){
        echo "<div class='alert alert-warning'>Data tidak ditemukan</div>";
        exit;
    }


    
    $data = mysqli_fetch_array($hasil);
    $nama_mapel=$data['nama_mapel'];
?>

<script>
$('title').text('DATA ABSENSI KELAS <?php echo $kelas; ?> MATA PELAJARAN <?php echo $nama_mapel; ?>');
</script>

<div class="table-responsive">
    <table class="table table-bordered table-striped" id="tabel_pertemuan" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th class="text-center">NISN</th>
                <th>Nama</th>
                <?php
                    $guru=$_SESSION['username'];
                    $kelas=$_POST['kelas'];
                    $mapel=$_POST['mapel'];
                    include '../../../config/database.php';
                    $sql="select * from pertemuan p where p.kelas='".$kelas."' and p.guru='".$guru."' and p.mapel='".$mapel."' order by p.pertemuan_ke asc";
                    $hasil=mysqli_query($kon,$sql);
                    while ($data = mysqli_fetch_array($hasil)):
                ?>
                <th class="text-center"> <span data-toggle="tooltip" title="<?php echo tanggal(date('Y-m-d', strtotime($data['tanggal']))); ?>"><?php echo $data['pertemuan_ke']; ?></span> </th>
                <?php endwhile; ?>
                <th><span data-toggle="tooltip" title="Jumlah Pertemuan">Jml</span></th>
                <th><span data-toggle="tooltip" title="Jumlah Hadir">Hadir</span></th>
                <th><span data-toggle="tooltip" title="Jumlah Izin">Izin</span></th>
                <th class="text-center"><span data-toggle="tooltip" title="Jumlah Sakit">Sakit</span></th>
                <th class="text-center"><span data-toggle="tooltip" title="Jumlah Alpa">Alpa</span></th>
                <th class="text-center"><span data-toggle="tooltip" title="Hadir (%)">Hadir (%)</span></th>
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
                    $result=mysqli_query($kon,"select * from pertemuan p where p.kelas='".$kelas."' and p.guru='".$guru."' and p.mapel='".$mapel."' order by p.tanggal asc");
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
                                    echo "<td class='text-center'><span class='text-warning' data-toggle='tooltip' title='Izin'>I</span> </td>";
                                }else {
                                    $alpa++;
                                    echo "<td class='text-center'><span class='text-danger' data-toggle='tooltip' title='Alpa'>A</span> </td>";
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
                    echo "<td>".(float)number_format($jumlah_hadir/$jumlah_pertemuan*100,2)." %</td>";
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

<h4>keterangan:</h4>
<table class="table">
    <tbody>
      <tr>
        <td width="7%"><span class="text-success">H</span></td>
        <td>Hadir</td>
      </tr>
      <tr>
        <td><span class="text-warning">I</span></td>
        <td>Izin</td>
      </tr>
      <tr>
        <td><span class="text-primary">S</span></td>
        <td>Sakit</td>
      </tr>
      <tr>
        <td><span class="text-danger">A</span></td>
        <td>Alpa</td>
      </tr>
    </tbody>
  </table>

<script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $(document).ready(function() {
        $('#tabel_pertemuan').DataTable( {
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
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }
?>