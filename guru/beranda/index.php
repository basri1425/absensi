<?php
//Jika user yang mengakses halaman ini bukan guru maka halaman akan di kunci
if ($_SESSION["level"]!='guru'){
    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
    exit;
}
?>
<script>
    $('title').text('BERANDA');
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title"> Beranda</h4>
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
                                <div id="tampil_data_harian"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready( function (){
        data_harian();
    });

    $("#kelas").change(function(){
        data_harian();
    });

    $("#bulan").change(function(){
        data_harian();
    });

    $("#tahun").change(function(){
        data_harian();
    });

    function data_harian(){
        var kelas = $("#kelas").val();
        var bulan = $("#bulan").val();
        var tahun = $("#tahun").val();
        $.ajax({
            type: "POST",
            data : {kelas:kelas,bulan:bulan,tahun:tahun},
            dataType: "html",
            async : false,
            url: 'guru/beranda/data-harian.php',
            success: function(data) {
                $("#tampil_data_harian").html(data);
            }
        });
    }

</script>