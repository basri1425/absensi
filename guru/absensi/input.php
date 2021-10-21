<form id="form_input_absensi">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title"> Input Absensi</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Kelas:</label>
                                        <select class="form-control" name="kelas" id="kelas">
                                        <?php
                                            include 'config/database.php';
                                            $guru=$_SESSION['username'];
                                            $sql="select distinct k.kode_kelas,k.nama_kelas from kelas k inner join siswa s on s.kelas=k.kode_kelas group by k.kode_kelas,k.nama_kelas order by k.kode_kelas asc";
                                            $hasil=mysqli_query($kon,$sql);
                                            while ($data = mysqli_fetch_array($hasil)):
                                        ?>
                                        <option value="<?php echo $data['kode_kelas']; ?>"><?php echo $data['nama_kelas']; ?></option>
                                        <?php endwhile; ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Mata Pelajaran:</label>
                                                <select class="form-control" name="mapel" id="mapel">
                                                <?php
                                                    include 'config/database.php';
                                                    $sql="select * from mapel order by id_mapel asc";
                                                    $hasil=mysqli_query($kon,$sql);
                                                    while ($data = mysqli_fetch_array($hasil)):
                                                ?>
                                                <option value="<?php echo $data['kode_mapel']; ?>"><?php echo $data['nama_mapel']; ?></option>
                                                <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Pertemuan Ke:</label>
                                                <input type="number" class="form-control" name="pertemuan_ke" min="1" id="pertemuan_ke" placeholder="Masukan pertemuan ke">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Topik/Pembahasan:</label>
                                        <input type="text" class="form-control" name="topik" id="topik" placeholder="Masukan nama topik atau pembahasan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tanggal:</label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" onkeydown="return false">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Mulai:</label>
                                        <input type="time" class="form-control" name="mulai" id="mulai">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Selesai:</label>
                                        <input type="time" class="form-control" name="selesai" id="selesai">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="tampil_data"></div>
                                    <button type="button" class="btn btn-primary btn-fill btn-wd" id="submit" >Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

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

    $('#submit').click(function(){
        if ($("#kelas").val().length == 0) {
            alert('Kelas harus dipilih');
            return false;
        } else if ($("#mapel").val().length == 0) {
            alert('Mata pelajaran harus dipilih');
            return false;
        } else if ($("#pertemuan_ke").val().length == 0) {
            alert('Pertemuan Ke harus diisi');
            return false;
        } else if ($("#topik").val().length == 0) {
            alert('Topik harus dimasukan');
            return false;
        } else if ($("#tanggal").val().length == 0) {
            alert('Tanggal harus dipilih');
            return false;
        } else if  ($("#mulai").val().length == 0) {
            alert('Waktu mulai harus diisi');
            return false;
        } else if  ($("#selesai").val().length == 0) {
            alert('Waktu selesai harus diisi');
            return false;
        } else {

            var nilai=0;
            var nomor=0;
            no = document.getElementsByName('no[]');
            cek = document.getElementsByName('check[]');
            pil = document.getElementsByName('pil[]');
            kehadiran = document.getElementsByName('kehadiran[]');
            for(var i=0, n=cek.length;i<n;i++)
            {

                if (kehadiran[i].value==0){
                    if (pil[i].value==0){
                        nomor=i+1;
                        nilai++;
                    }
                }
             

            }

            if (nilai==0){
                submit_absensi();
                return true;
            }else {
                alert('Keterangan nomor '+nomor+' belum dipilih');
                return false;
            }

        }
    });
</script>


<script>

    $(document).ready( function () {
        data_absensi();
    });

    $("#kelas").change(function() {
        data_absensi();
    });

</script>

<script>
    function data_absensi(){
        var kelas = $("#kelas").val();
      $.ajax({
          type: "POST",
          data : {kelas:kelas},
          dataType: "html",
          async : false,
          url: 'guru/absensi/tabel-absensi.php',
          success: function(data) {
              $("#tampil_data").html(data);
          }
      });
    }

</script>

<script>
     function submit_absensi(){
        var form = $('#form_input_absensi')[0];
        var data = new FormData(form);
        $.ajax({
            type	: 'POST',
            url	: "guru/absensi/simpan/submit.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success	: function(data){
                window.location.href = "index.php?halaman=daftar-pertemuan";
            }
        });
    };
</script>

