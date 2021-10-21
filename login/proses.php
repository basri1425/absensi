<?php 
    session_start();
    //Jika terdetesi ada session pengguna yang aktif, maka session tersebut di hapuskan
    if  (isset($_SESSION["username"])){
        session_unset();
        session_destroy();
    }
    
    $pesan="";

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
        include "../config/database.php";
        //Mengambil uername dan password
        $username = addslashes(trim($_POST["username"]));
        $password = addslashes(trim(md5($_POST["password"])));


        $cek_tabel_guru = mysqli_query ($kon,"select * from guru where nip='".$username."' and password='".$password."' limit 1");
        $guru = mysqli_num_rows($cek_tabel_guru);

        $cek_tabel_admin = mysqli_query ($kon,"select * from admin where username='".$username."' and password='".$password."' limit 1");
        $admin = mysqli_num_rows($cek_tabel_admin);


        //jika rememberme di klik
        if(!empty($_POST["remember"])) {
          //buat cookie
          setcookie ("username",$_POST["username"],time()+ (3600 * 365 * 24 * 60 * 60));
          setcookie ("password",$_POST["password"],time()+ (3600 * 365 * 24 * 60 * 60));
        } else {
          if(isset($_COOKIE["username"])) {
          setcookie ("username","");
          }
          if(isset($_COOKIE["password"])) {
          setcookie ("password","");
          }
        }

        //Kondisi jika pengguna merupakan guru
        if ($guru>0){
            $row = mysqli_fetch_assoc($cek_tabel_guru);
            //menyimpan data guru dalam session
            $_SESSION["nama"]=$row["nama_guru"];
            $_SESSION["username"]=$row["nip"];
            $_SESSION["wali_kelas"]=$row["wali_kelas"];
            $_SESSION["level"]='guru';
       
            header("Location:../index.php?halaman=beranda");
        } else if ($admin>0){

          $row = mysqli_fetch_assoc($cek_tabel_admin);
          //menyimpan data admin dalam session
          $_SESSION["nama"]=$row["nama"];
          $_SESSION["username"]=$row["username"];
          $_SESSION["level"]='admin';

          header("Location:../index.php?halaman=beranda");
      } else {
        header("Location:../index.php?halaman=login&alert=gagal");
        }
	}
?>