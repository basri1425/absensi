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
                    <h4 class="card-title"> Daftar Pertemuan</h4>
                    <div class="row">
                            <div class="col-sm-12">
                                <p>Daftar Pertemuan adalah rincian seluruh pertemuan yang telah diselenggarakan berdasarkan kelas dan mata pelajaran tertentu.</p>
                            </div>
                        </div>
                    <a href="index.php?halaman=input-absensi" class="btn btn-primary btn-fill btn-wd" role="button">Input Absensi</a>
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
                                        $sql="select distinct k.kode_kelas,k.nama_kelas from kelas k inner join pertemuan p on p.kelas=k.kode_kelas where p.guru='".$guru."' group by k.kode_kelas,k.nama_kelas order by k.id_kelas asc";
                                        $hasil=mysqli_query($kon,$sql);
                                        while ($data = mysqli_fetch_array($hasil)):
                                    ?>
                                    <option value="<?php echo $data['kode_kelas']; ?>"><?php echo $data['nama_kelas']; ?></option>
                                    <?php endwhile; ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Mata Pelajaran:</label>
                                    <select class="form-control" name="mapel" id="mapel">
       
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


<!-- The Modal -->

<!-- Modal -->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">

            </div>
            <div class="modal-body">
                <div id="tampil_form"></div>
            </div>
            <div class="modal-footer">
            
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready( function () {
        get_mapel();
        data_pertemuan();
       
    });

    $("#kelas").change(function() {
        get_mapel();
        data_pertemuan();
   
    });

    $("#mapel").change(function() {
        data_pertemuan();
    });

</script>

<script>
    function data_pertemuan(){
    var kelas = $("#kelas").val();
    var mapel = $("#mapel").val();
      $.ajax({
          type: "POST",
          data : {kelas:kelas,mapel:mapel},
          dataType: "html",
          async : false,
          url: 'guru/absensi/tabel-pertemuan.php',
          success: function(data) {
              $("#tampil_data").html(data);
          }
      });
    }

    function get_mapel(){
      var kelas=$("#kelas").val();
      $.ajax({
            url: 'guru/absensi/get-mapel.php',
            method : "POST",
            data : {kelas:kelas},
            async : false,
            dataType : 'json',
            success: function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].kode_mapel+'>'+data[i].nama_mapel+'</option>';
                }
                $('#mapel').html(html);

            }
        })
    }

</script>

