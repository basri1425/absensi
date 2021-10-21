<?php
    if (isset($_POST['submit'])) {
        //Koneksi database
        include '../../config/database.php';
        session_start();

        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");

        $username = $_SESSION["username"];
        $password_baru = md5(addslashes(trim($_POST["password_baru"])));

        $sql="update admin set
        password='$password_baru'
        where username='$username'";

        $simpan=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($simpan) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?halaman=ubah-password&alert=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?halaman=ubah-password&alert=gagal");
        }
    }
?>
<?php
//Jika user yang mengakses halaman ini bukan admin maka halaman akan di kunci
if ($_SESSION["level"]!='admin'){
    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
    exit;
}
?>
<script>
    $('title').text('UBAH PASSWORD');
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title"> Ubah Password</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <form action="admin/akun/ubah-password.php" method="post">
                        <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                            <?php
                                if (isset($_GET['alert'])) {
                                    if ($_GET['alert']=='berhasil'){
                                        echo"<div class='alert alert-success'>Password berhasil diubah</div>";
                                    }   
                                }
                            ?>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password Saat Ini:</label>
                                            <input type="password" name="password_lama" value="" class="form-control" id="password_lama">
                                        <br>
                                        <div id="get_ajax"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password Baru:</label>
                                            <input type="password" name="password_baru" value="" class="form-control" id="password_baru" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password Baru:</label>
                                        <input type="password" name="konfirmasi_password" value="" class="form-control" id="konfirmasi_password" disabled>
                                        <br>
                                        <div id="show_konfirmasi"></div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" disabled class="btn btn-primary btn-fill btn-wd" id="submit" >Submit</button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <br>
                                    <div class="card">
                                        <div class="card-header ">
                                            <h4 class="card-title"> <strong>Keterangan</strong></h4>
                                        </div>
                                        <div class="card-body">
                                            <p>Password saat ini adalah password yang digunakan saat ini. </p>
                                            <p>Password baru adalah password yang ingin anda buat baru </p>
                                            <p>Konfirmasi password baru adalah Anda mengetik password baru kembali </p>
                                            <p>Tombol submit akan aktif saat semua isian terisi dengan sesuai.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="status" id="status" value="0" />

<script>
    $('#password_lama').bind('keyup', function () {

        var password_lama=$("#password_lama").val();

        $.ajax({
          url: 'admin/akun/cek-password.php',
          method: 'POST',
          data:{password_lama:password_lama},
          success:function(data){
            $("#get_ajax").html(data);
          }
      }); 
    });

</script>

<script>

    $('#password_lama').bind('keyup', function () {
        cek();
    });


    $('#konfirmasi_password').bind('keyup', function () {
        cek();
    });

    function cek(){
        var password_baru=$("#password_baru").val();
        var konfirmasi_password=$("#konfirmasi_password").val();
        var status=$("#status").val();

        if (status==1){
            if ($("#konfirmasi_password").val().length != 0) {
                if (password_baru!=konfirmasi_password){
                $("#show_konfirmasi").html("<div class='alert alert-danger'> Konfirmasi password salah</div>  ");
                $("#submit").prop('disabled', true);
            }else {
                $("#show_konfirmasi").html("<div class='alert alert-success'>Konfirmasi password benar</div>");
                $("#submit").prop('disabled', false);
            }
        }

        }else {
            $("#submit").prop('disabled', true);
        }
    }

</script>



