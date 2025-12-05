<?php
    require 'autoload.php';
    use Stakeholder\Users\Users;

    checkLogin();
    checkRole($_SESSION['users'][0]['role']);

    $users = new Users;
    $data = $users->getByID($_GET['ID'])[0];

    if(isset($_POST['btn-updateUsers'])){
        $result = $users->update($_POST);
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Ubah data user</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <?php require 'Components/infoFeedback.php'?>
    <h3>Ubah data user, <?=$data['nama']?></h3>
    <a href="akun.php">Kembali ke list akun</a>
    <br><br>
    <form action="" method="POST">
        <input type="hidden" name="ID" value="<?=$data['ID']?>">
        <input type="hidden" name="dbPassword" value="<?=$data['password']?>">
        <table>
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>: <input type="text" id="nama" name="nama" require value="<?=$data['nama']?>"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>: <input type="email" id="email" name="email" require value="<?=$data['email']?>"></td>
            </tr>
            <tr>
                <td><label for="telepon">Telepon</label></td>
                <td>: <input type="number" name="telepon" id="telepon" require value="<?=$data['telepon']?>"></td>
            </tr>
            <tr>
                <td><label for="role">Role</label></td>
                <td>: <input type="text" id="role" name="role" require value="<?=$data['role']?>"></td>
            </tr>
            <tr>
                <td><label for="newPassword" style="text-align:left">New Password</label></td>
                <td>: <input type="password" id="newPassword" name="newPassword"></td>
            </tr>
            <tr>
                <td><label for="konfirmasiPassword">Konfirmasi Password</label></td>
                <td>: <input type="password" id="konfirmasiPassword" name="konfirmasiPassword"></td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <button type="submit" name="btn-updateUsers">Ubah</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>