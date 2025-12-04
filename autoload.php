<?php
    spl_autoload_register(function($class){
        $class = str_replace('\\', '/', $class) . '.php';
        require_once $class; 
    });

    function checkLogin(){
        session_start();
        if(!$_SESSION['users'] && isset($_COOKIE['key']) && isset($_COOKIE['token'])){
            $user = new Stakeholder\Users\Users;
            $result = $user->getByID($_COOKIE['key']);
            $token = $_COOKIE['token'];
            $dbPassword = $result[0]['password'];
            if($token == $dbPassword){
                $_SESSION['users'] = $result;
            }
            header("Location: index.php?message=Anda otomatis login!");
            exit;
        }
        elseif(!$_SESSION['users']){
            header("Location: login.php?error=Anda harus login dahulu!");
            exit;
        }
    }