<?php
    spl_autoload_register(function($class){
        $class = str_replace('\\', '/', $class) . '.php';
        require_once $class; 
    });

    function checkLogin(){
        session_start();
        if(!$_SESSION['users']){
            header("Location: login.php?error=Anda harus login dahulu!");
            exit;
        }
    }