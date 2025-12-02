<?php

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body> 

    <?php require 'Components/infoFeedback.php'?>
    <h3> Selamat datang, silahkan login</h3>

    <a href="register.php">Daftar Masuk</a>
    <br><br>
    <form method="POST" action="">
        <table>
            <tr> 
                <td><label for="username">Username</label></td>
                <td>: <input type="text" id="username" name="username"> </td>
            </tr>
            <tr>
                <td><label for="passoword">Password</label></td>
                <td>: <input type="password" id="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <button type="submit" name="btn-login">Login</button>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>