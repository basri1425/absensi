<!--
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
 <?php 
  session_start();
  if (!$_SESSION["username"]){
        header("Location:login.php");
  }
?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>APLIKASI ABSENSI SISWA BERBASIS WEB</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <script src="assets/js/core/jquery-3.6.0.min.js" type="text/javascript"></script>
    <!-- ChartJS -->
    <script src="assets/chart/chart.js"></script>

    <!-- DataTables -->
    <script src="assets/datatables/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="assets/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/datatables/jszip.min.js"></script>
    <script src="assets/datatables/vfs_fonts.js"></script>

</head>

<body>
    <div class="wrapper">
        <div class="sidebar"  data-color="blue" data-image="assets/img/sidebar-4.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        Aplikasi Absensi Siswa
                    </a>
                </div>
                <ul class="nav">
                <?php if (isset($_SESSION["username"])): ?>
                    <?php if ($_SESSION["level"]=='admin'):?>
                    <li class="nav-item <?php if ($_GET['halaman']=='beranda') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=beranda">
                            <i class="nc-icon nc-chart-bar-32"></i>
                            <p>Beranda</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($_GET['halaman']=='data-siswa') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=data-siswa">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Data Siswa</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($_GET['halaman']=='data-guru') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=data-guru">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Data Guru</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($_GET['halaman']=='data-kelas') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=data-kelas">
                            <i class="nc-icon nc-grid-45"></i>
                            <p>Data Kelas</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($_GET['halaman']=='data-mapel') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=data-mapel">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>Data Mata Pelajaran</p>
                        </a>
                    </li>
    
                    <?php endif; ?>
                    <?php if ($_SESSION["level"]=='guru'):?>
                        <li class="nav-item <?php if ($_GET['halaman']=='beranda') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=beranda">
                            <i class="nc-icon nc-chart-bar-32"></i>
                            <p>Beranda</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($_GET['halaman']=='daftar-pertemuan') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=daftar-pertemuan">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>Daftar Pertemuan</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($_GET['halaman']=='laporan-absensi') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=laporan-absensi">
                            <i class="nc-icon nc-notes"></i>
                            <p>Daftar Absensi</p>
                        </a>
                    </li>
                    <?php if ($_SESSION["wali_kelas"]!=''):?>
                        <li class="nav-item <?php if ($_GET['halaman']=='laporan-harian') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=laporan-harian">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>Laporan Harian</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($_GET['halaman']=='laporan-bulanan') echo 'active'; ?>">
                        <a class="nav-link" href="index.php?halaman=laporan-bulanan">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Laporan Bulanan</p>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <?php if (isset($_SESSION["username"])):?>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="no-icon"><?php echo $_SESSION["nama"]; ?></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="index.php?halaman=ubah-password">Ubah Password</a>
                                    <div class="divider"></div>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
            <?php 
            if(isset($_GET['halaman'])){
                $halaman = $_GET['halaman'];
            
                switch ($halaman) {
                    case 'data-siswa':
                        include "admin/data-siswa/index.php";
                        break;
                    case 'data-guru':
                        include "admin/data-guru/index.php";
                        break;
                    case 'data-kelas':
                        include "admin/data-kelas/index.php";
                        break;
                    case 'data-mapel':
                        include "admin/data-mapel/index.php";
                        break;
                    case 'beranda':
                        if ($_SESSION["level"]=='guru'){
                            include "guru/beranda/index.php";
                        }else {
                            include "admin/beranda/index.php";
                        }
                        break;
                    case 'daftar-pertemuan':
                        include "guru/absensi/index.php";
                        break;
                    case 'input-absensi':
                        include "guru/absensi/input.php";
                        break;
                    case 'edit-absensi':
                        include "guru/absensi/edit.php";
                        break;
                    case 'laporan-absensi':
                        include "guru/laporan/pertemuan/index.php";
                        break;
                    case 'laporan-harian':
                        include "guru/laporan/harian/index.php";
                        break;
                    case 'laporan-bulanan':
                        include "guru/laporan/bulanan/index.php";
                        break;
                    case 'ubah-password':
                        if ($_SESSION["level"]=='guru'){
                            include "guru/akun/ubah-password.php";
                        }else {
                            include "admin/akun/ubah-password.php";
                        }
                        
                        break;
                    default:
                    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                    break;
                }
            }else {
                header("Location:login.php");
            }
            ?>
            </div>
        </div>
        <div id='ajax-wait'>
            <img src="assets/img/loading.gif">   
        </div>

    <style>
        #ajax-wait {
        display: none;
        position: fixed;
        z-index: 1999
        }
    </style>
    <script>

    $(document).ready( function () {
        loading();
    });

    //Fungsi untuk efek loading
    function loading(){
        $( document ).ajaxStart(function() {
        $( "#ajax-wait" ).css({
            left: ( $( window ).width() - 32 ) / 2 + "px", // 32 = lebar gambar
            top: ( $( window ).height() - 32 ) / 2 + "px", // 32 = tinggi gambar
            display: "block"
        })
        })
        .ajaxComplete( function() {
            $( "#ajax-wait" ).fadeOut();
        });
    }
    </script>
    
</body>
<!--   Core JS Files   -->

<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
