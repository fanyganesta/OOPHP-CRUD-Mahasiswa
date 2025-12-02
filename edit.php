<?php
    require 'autoload.php';
    use Stakeholder\Mahasiswa\Mahasiswa;
    $mahasiswa = new Mahasiswa;
    $row = $mahasiswa->getById($_GET['ID']);
    if(isset($_POST['btn-ubah'])){
        $result = $mahasiswa->update($_POST);
        if(!$result){
            header("Location: index.php?error=Gagal menambah data!");
            exit;
        }else{
            header("Location: index.php?message=Data berhasil diubah!");
            exit;
        }
    }
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Data</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <?php require 'Components/infoFeedback.php'?>
    <h3>Ubah data, <?= $row['nama']?> </h3>
    <a href="index.php">Kembali ke beranda</a>
    <br><br>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="oldImage" value="<?= $row['foto'] ?>">
        <input type="hidden" name="ID" value="<?=$row['ID']?>">
        <table>
            <tr>
                <td colspan="2" class="ct">
                    <div  style="margin-left: -60px">
                        <?php require 'Components/getImageProfile.php'?>
                    </div>
                </td>
            <tr>
                <td> <label for="nama">Nama</label></td>
                <td>: <input type="text" id="nama" name="nama" value="<?= $row['nama']?>"></td>
            </tr>
            <tr>
                <td><label for="tanggalLahir">Tanggal Lahir</label></td>
                <td>: <input type="date" id="tanggalLahir" name="tanggalLahir" value="<?=$row['tanggalLahir']?>"></td>
            </tr>
            <tr>
                <td> <label for="alamat">Alamat</label></td>
                <td>: <input type="text" id="alamat" name="alamat" value="<?=$row['alamat']?>"></td>
            </tr>
            <tr>
                <td> <label for="nim">NIM</label></td>
                <td>: <input type="number" id="nim" name="nim" value="<?=$row['nim']?>"></td>
            </tr>
            <tr>
                <td> <label for="email">Email</label></td>
                <td>: <input type="email" id="email" name="email" value="<?=$row['email']?>"></td>
            </tr>
            <tr>
                <td> <label for="telepon">Telepon</label></td>
                <td>: <input type="number" id="telepon" name="telepon" value="<?=$row['telepon']?>"></td>
            </tr>
            <tr>
                <td><label for="image">Upload foto</label></td>
                <td>: <input type="file" name="image" id="image"></td>
            <tr>
                <td colspan="2" class="ct">
                    <button type="submit" name="btn-ubah">Ubah</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>