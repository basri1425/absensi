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
?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Aplikasi Absensi Siswa</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/datatables/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
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
                    <li>
                        <a class="nav-link" href="dashboard.html">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?halaman=data-siswa">
                            <i class="nc-icon nc-notes"></i>
                            <p>Data Siswa</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.php?halaman=data-guru">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Data Guru</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.php?halaman=data-kelas">
                            <i class="nc-icon nc-atom"></i>
                            <p>Data Kelas</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.php?halaman=data-mapel">
                            <i class="nc-icon nc-pin-3"></i>
                            <p>Data Mata Pelajaran</p>
                        </a>
                    </li>
    
                    <?php endif; ?>
                    <?php if ($_SESSION["level"]=='guru'):?>
                    <li>
                        <a class="nav-link" href="index.php?halaman=dashboard-guru">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.php?halaman=daftar-pertemuan">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>Daftar Pertemuan</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.php?halaman=laporan-absensi">
                            <i class="nc-icon nc-notes"></i>
                            <p>Daftar Absensi</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.php?halaman=laporan-harian">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>Laporan Harian</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.php?halaman=laporan-bulanan">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>Laporan Bulanan</p>
                        </a>
                    </li>
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
                <form action="login/proses.php" method="post">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header ">
                                        <h4 class="card-title text-center"> Aplikasi Absensi Siswa Berbasis Web</h4>
                                    </div>
                                    <div class="card-body table-full-width table-responsive">
                            
                                        <div class="col-sm-12">
                                                <div class="row">
                                                    <?php if (isset($_GET['alert'])):?>
                                                    <?php if ($_GET['alert']=='gagal'):?>
                                                    <div class="col-sm-12">
                                                        <div class="alert alert-danger">
                                                            Username dan atau password salah
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Username:</label>
                                                            <input type="text" class="form-control" name="username" id="username">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Password:</label>
                                                            <input type="password" class="form-control" name="password" id="password">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label><input type="checkbox" name="remember" id="remember" > Remember Me</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                            &ensp;&ensp;<button type="submit" class="btn btn-primary btn-fill btn-wd" >Login</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div id='ajax-wait'>
        <div class="spinner-border text-dark"></div>
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
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
