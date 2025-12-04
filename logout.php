<?php 

    session_start();
    $_SESSION['BASE_DIR'] = '';
    session_destroy();
    setcookie('token', '', time()-3600);
    setcookie('key', '', time()-3600);
    header("Location: login.php?message=Anda berhasil logout");
    exit;


