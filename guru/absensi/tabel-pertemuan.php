<?php
    session_start(); 
    include '../../config/database.php';
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
    $('title').text('DATA PERTEMUAN KELAS <?php echo $kelas; ?> MATA PELAJARAN <?php echo $nama_mapel; ?>');
</script>
<br>
<div class="content table-responsive">
    <table class="table table-hover table-striped table-bordered" id="tabel_absensi">
        <thead>
            <th>Pertemuan</th>
            <th>Topik/Pembahasan</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Jml Siswa</th>
            <th>Hadir</th>
            <th>Izin</th>
            <th>Sakit</th>
            <th>Alpa</th>
            <th>Edit</th>
            <th>Hapus</th>
        </thead>
        <tbody>
        <?php
            // include database
            include '../../config/database.php';

            $kelas=addslashes(trim($_POST['kelas']));
            $mapel=addslashes(trim($_POST['mapel']));
            $guru=$_SESSION['username'];
            $sql="select * from pertemuan where kelas='".$kelas."' and mapel='".$mapel."' and guru='".$guru."' order by pertemuan_ke asc";
            $hasil=mysqli_query($kon,$sql);
            $no=0;
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
            $no++;

            $query2=mysqli_query($kon,"select id_kehadiran from kehadiran where pertemuan='".$data['id_pertemuan']."'");
            $jumlah_murid = mysqli_num_rows($query2);

            $query3=mysqli_query($kon,"select id_kehadiran from kehadiran where status_kehadiran in (1) and pertemuan='".$data['id_pertemuan']."'");
            $hadir = mysqli_num_rows($query3);

            $query4=mysqli_query($kon,"select id_kehadiran from kehadiran where status_kehadiran='0' and keterangan='1' and pertemuan='".$data['id_pertemuan']."'");
            $sakit = mysqli_num_rows($query4);

            $query5=mysqli_query($kon,"select id_kehadiran from kehadiran where status_kehadiran='0' and keterangan='2' and pertemuan='".$data['id_pertemuan']."'");
            $izin = mysqli_num_rows($query5);

            $query6=mysqli_query($kon,"select id_kehadiran from kehadiran where status_kehadiran='0' and keterangan='3' and pertemuan='".$data['id_pertemuan']."'");
            $alpa = mysqli_num_rows($query6);
        ?>
        <tr>
            <td><?php echo $data['pertemuan_ke'];?></td>
            <td><?php echo $data['topik'];?></td>
            <td><?php echo format_tanggal(date('Y-m-d', strtotime($data['tanggal']))); ?></td>
            <td><?php echo date('H:i', strtotime($data['mulai']));?> - <?php echo date('H:i', strtotime($data['selesai']));?> WIB</td>
            <td><?php echo $jumlah_murid; ?></td>
            <td><?php echo $hadir;?></td>
            <td><?php echo $izin;?></td>
            <td><?php echo $sakit;?></td>
            <td><?php echo $alpa;?></td>
            <td> 
               <a href="index.php?halaman=edit-absensi&id=<?php echo $data['id_pertemuan'];?>" >Edit</a>
            </td>
            <td> 
               <a href="#" class="hapus" id_pertemuan="<?php echo $data['id_pertemuan'];?>" >Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>


<script>
    $(document).ready(function() {
        $('#tabel_absensi').DataTable( {
            "searching": false,
            "paging":   false,
            "ordering": false,
            "info":     true,
            dom: 'Bfrtip',
            buttons: ['excel']
        });
    });
</script>


<script>
$('.edit').on('click',function(){
    var id_pertemuan = $(this).attr("id_pertemuan");
    $.ajax({
        url: 'guru/absensi/edit.php',
        method: 'post',
        data: {id_pertemuan:id_pertemuan},
        success:function(data){
            $('#tampil_form').html(data);  
        }
    });
    // Membuka modal
    $('#myModal').modal('show');
});

$('.edit_kehadiran').on('click',function(){
    var id_pertemuan = $(this).attr("id_pertemuan");
    var kelas = $(this).attr("kelas");
    $.ajax({
        url: 'guru/absensi/edit-kehadiran.php',
        method: 'post',
        data: {id_pertemuan:id_pertemuan,kelas:kelas},
        success:function(data){
            $('#tampil_form').html(data);  
        }
    });
    // Membuka modal
    $('#MyModal').modal('show');
});

$('.hapus').on('click',function(){
    var agree=confirm("Adakah Anda yakin ingin menghapus data pertemuan ini?");
    if (!agree){
        return false;
    } else {
        var id_pertemuan = $(this).attr("id_pertemuan");
        $.ajax({
            url: 'guru/absensi/simpan/hapus.php',
            method: 'post',
            data: {id_pertemuan:id_pertemuan},
            success:function(data){
                data_pertemuan();
            }
        });
    }
});
</script>

<?php 
    //Membuat format tanggal
    function format_tanggal($tanggal)
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