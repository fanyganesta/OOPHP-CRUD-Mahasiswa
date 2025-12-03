<?php 

    session_start();
    $_SESSION['BASE_DIR'] = '';
    session_destroy();
    header("Location: login.php?message=Anda berhasil logout");
    exit;


