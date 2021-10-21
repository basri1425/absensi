<?php
    session_start();
    $_SESSION['nama_guru']='';
    $_SESSION['username']='';
    $_SESSION['level']='';

    unset($_SESSION['nama_guru']);
    unset($_SESSION['username']);
    unset($_SESSION['level']);

    session_unset();
    session_destroy();

    header('Location:index.php');

?>