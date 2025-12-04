<?php
    require 'autoload.php';
    use Stakeholder\Users\Users;

    if(isset($_POST['btn-submit'])){
        $user = new Users();
        $result = $user->register($_POST);
    }
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Register User</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <?php require 'Components/infoFeedback.php'?>
    <h3>Selamat datang, silahkan mendaftar</h3>
    
    <form action="register.php" method="POST">
        <table>
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>: <input type="text" name="nama" id="nama"></td>                
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>: <input type="email" name="email" id="email"></td>
            </tr>
            <tr>
                <td><label for="telepon">Telepon</label></td>
                <td>: <input type="number" name="telepon" id="telepon"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td>: <input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td><label for="konfirmasiPassword">Konfirmasi Password</label></td>
                <td>: <input type="password" id="konfirmasiPassword" name="konfirmasiPassword"></td>
            </tr>
            <input type="hidden" name="role" value="guest">
            <tr>
                <td colspan="2" class="ct" style="padding-top: 7px">
                    <button type="submit" name="btn-submit">Daftar</button>
                </td>
            </tr>
    </form>
        <tr>
            <td colspan="2" class="ct">
                <p> Sudah punya akun? <a href="login.php">login di sini</a></p>
            </td>
        </tr>
    
</body>
</html>