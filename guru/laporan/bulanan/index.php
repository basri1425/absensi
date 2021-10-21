<?php
//Jika user yang mengakses halaman ini bukan guru maka halaman akan di kunci
if ($_SESSION["level"]!='guru'){
    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
    exit;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title"> Daftar Absensi Bulanan Kelas <?php echo $_SESSION['wali_kelas']; ?></h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Daftar absensi bulanan adalah rekap seluruh absensi harian dalam satu bulan dengan ketentuan siswa dinyatakan hadir bila kehadiran mencapai 60% dari setiap mata pelajaran yang diikuti pada hari tersebut. Halaman ini hanya dapat di lihat oleh wali kelas.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Bulan:</label>
                                    <select class="form-control" name="bulan" id="bulan">
                                        <?php
                                        $bulan_sekarang=date('m');
                                        $nama_bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                                        $bulan = ["01","02","03","04","05","06","07","08","09","10","11","12"];
                                        for($i = 0;$i <= 11;$i++):
                                        ?>
                                        <option  <?php if ($bulan_sekarang==$bulan[$i]) echo "selected"; ?> value="<?php echo $bulan[$i]; ?>" ><?php echo $nama_bulan[$i]; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tahun:</label>
                                    <select class="form-control" name="tahun" id="tahun">
                                    <?php
                                        include 'config/database.php';
                                        $guru=$_SESSION['username'];
                                        $sql="select distinct year(tanggal) as tahun from pertemuan group by tahun order by tahun desc";
                                        $hasil=mysqli_query($kon,$sql);
                                        while ($data = mysqli_fetch_array($hasil)):
                                    ?>
                                    <option value="<?php echo $data['tahun']; ?>"><?php echo $data['tahun']; ?></option>
                                    <?php endwhile; ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="tampil_data"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready( function () {
        data_pertemuan();
    });

    $("#bulan").change(function() {
        data_pertemuan();
    });

    $("#tahun").change(function() {
        data_pertemuan();
    });

</script>

<script>
    function data_pertemuan(){
    var bulan = $("#bulan").val();
    var tahun = $("#tahun").val();
      $.ajax({
          type: "POST",
          data : {bulan:bulan,tahun:tahun},
          dataType: "html",
          async : false,
          url: 'guru/laporan/bulanan/tabel-bulanan.php',
          success: function(data) {
              $("#tampil_data").html(data);
          }
      });
    }

</script>

