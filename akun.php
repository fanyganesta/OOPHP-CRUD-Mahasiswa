<?php 
    require 'autoload.php';
    checkLogin();
    checkRole($_SESSION['users'][0]['role']);
    $users = new Stakeholder\Users\Users;
    $rows = $users->getAll();
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Manage Akun</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <?php require 'Components/infoFeedback.php'?>
    <h3> List akun yang terdaftar </h3>
    <a href="index.php"> Kembali ke beranda </a>
    <br>
    <br>
    <table class="br">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Action</th>
        </tr>
        <?php $j = 1; foreach($rows as $row) : ?>
            <tr>
                <td class="ct"><?=$j?></td>
                <td><?=$row['nama']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['telepon']?></td>
                <td class="ct">
                    <p style="display:inline">
                        <a href="editUser.php?ID=<?=$row['ID']?>">Edit</a>
                        |
                        <a href="hapusUsers.php" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </p>
                </td>
            </tr>
        <?php $j++; endforeach?>
</body>
</html>