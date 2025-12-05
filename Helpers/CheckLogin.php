<?php 
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
            redirect('login.php', 'error=Anda belum login!');
            // header("Location: login.php?error=Anda harus login dahulu!");
            exit;
        }
    }
