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
                    <h4 class="card-title"> Daftar Absensi Harian Kelas <?php echo $_SESSION['wali_kelas']; ?></h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Daftar absensi harian adalah rangkuman seluruh pertemuan yang diikuti oleh siswa pada hari tersebut. Siswa dinyatakan tidak hadir bila persentase kurang dari 60%, Siswa dengan keterangan izin dan sakit tetap dianggap hadir pada pertemuan tersebut. Halaman ini hanya dapat di lihat oleh wali kelas.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Kelas:</label>
                                    <select class="form-control" name="kelas" id="kelas">
                                    <?php
                                        $kelas=$_SESSION['wali_kelas'];
                                    ?>
                                    <option value="<?php echo $kelas; ?>"><?php echo $kelas; ?></option>
                               
                                    </select> 
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tanggal:</label>
                                        <?php $hari_ini=date('Y-m-d');?>
                                        <input type="date" name="tanggal" value="<?php echo $hari_ini; ?>" class="form-control" id="tanggal">
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


<script type="text/javascript">
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
    var day = dtToday.getDate() - 14;
    var year = dtToday.getFullYear();
    if(month < 10)
    month = '0' + month.toString();
    if(day < 10)
    day = '0' + day.toString();
   
    var maxDate = year + '-' + month + '-' + day;
    //atur 14 hari dari hari ini
    $('#tanggal').attr('min', maxDate);
    //disabled untuk hari berikutnya
    tanggal.max = new Date().toISOString().slice(0, -14);
</script>


<script>

    $(document).ready( function () {
        data_pertemuan();
    });

    $("#kelas").change(function() {
        data_pertemuan();
    });

    $("#tanggal").change(function() {
        data_pertemuan();
    });

</script>

<script>
    function data_pertemuan(){
    var kelas = $("#kelas").val();
    var tanggal = $("#tanggal").val();
      $.ajax({
          type: "POST",
          data : {kelas:kelas,tanggal:tanggal},
          dataType: "html",
          async : false,
          url: 'guru/laporan/harian/tabel-harian.php',
          success: function(data) {
              $("#tampil_data").html(data);
          }
      });
    }

</script>

