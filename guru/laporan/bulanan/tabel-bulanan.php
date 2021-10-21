<?php 
    session_start();
    //Mengambil data wali kelas yang disimpan dalam variabel session
    $kelas=$_SESSION["wali_kelas"];
    $bulan=$_POST['bulan'];
    $tahun=$_POST['tahun'];

    include '../../../config/database.php';
    $sql="select * from analisis_kehadiran where bulan='".$bulan."' and tahun='".$tahun."' and kelas='".$kelas."'";
    $cek=mysqli_query($kon,$sql);
    $jumlah_data = mysqli_num_rows($cek);

    if ($jumlah_data<=0){
        echo "<div class='alert alert-warning'> Data tidak ditemukan!</div>";
        exit;
    }
?>

<script>
$('title').text('DATA ABSENSI BULAN <?php echo $bulan; ?> TAHUN <?php echo $tahun; ?>');
</script>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="tabel_bulanan" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th class="text-center">NISN</th>
                <th>Nama</th>
                <?php
                    include '../../../config/database.php';
                    $bulan=$_POST['bulan'];
                    $tahun=$_POST['tahun'];
                    $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    $bg="";
                    for($hari=1;$hari<=$jumHari;$hari++)
                    {
                        $tgl=$tahun.'-'.$bulan.'-'.$hari;
                        $tanggal = date("Y-m-d",strtotime($tgl));
                        $day = date('l',strtotime($tanggal));
                        if($day =='Sunday')
                        {
                        $bg="danger";
                        }else {
                            $bg="";
                        }

                    ?>
                    <th class="text-center"><span class="bg-<?php echo $bg; ?>"><?php echo $hari; ?></span></th>
                    <?php 
                    } 
                ?>
            </tr>
        </thead>
        <tbody>
        <?php
            $no=0;

            $jumlah_pertemuan=0;
            $jumlah_hadir=0;
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
                    $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    $bg="";
                    for($hari=1;$hari<=$jumHari;$hari++)
                    {
                        //Mengambil jumlah pertemuan
                        $result=mysqli_query($kon,"select * from analisis_kehadiran where siswa='".$data['nisn']."' and kelas='".$kelas."' and tanggal='".$hari."'  and bulan='".$bulan."'  and tahun='".$tahun."'");
                        $jumlah_pertemuan = mysqli_num_rows($result);


                        //Mengambil jumlah hadir
                        $result=mysqli_query($kon,"select * from analisis_kehadiran where siswa='".$data['nisn']."' and kelas='".$kelas."' and keterangan!='3' and tanggal='".$hari."'  and bulan='".$bulan."'  and tahun='".$tahun."'");
                        $jumlah_hadir = mysqli_num_rows($result);

                        if ($jumlah_pertemuan!=0){

                            if ($jumlah_hadir!=0){
                                //Hitung persentase
                                $persentase=(($jumlah_hadir/$jumlah_pertemuan)*100);
                            }else {
                                $persentase=0;
                            }
                            //Kondisi untuk menentukan kehadiran siswa bila mencapai persentase 70% maka siswa dinyatakan hadir, jika tidak maka tidak hadir
                            if ($persentase>=60){
                        
                                echo "<td class='text-center'><span class='text-success' data-toggle='tooltip' title='Hadir'>H</span> </td>";
                            }else {
                                echo "<td class='text-center'><span class='text-danger' data-toggle='tooltip' title='Alpa' >A</span> </td>";
                            }
                        }else {
                            echo "<td></td>";
                        }
                    }
                ?>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $(document).ready(function() {
        $('#tabel_bulanan').DataTable( {
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