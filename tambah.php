<?php 
    require 'autoload.php';
    use Stakeholder\Mahasiswa\Mahasiswa;
    if(isset($_POST['btn-tambah'])){
        // var_dump($_POST['tanggalLahir']);die;
        $mahasiswa = new Mahasiswa();
        $result = $mahasiswa->insert($_POST, $_FILES);
        if(!$result){
            header("Location: index.php?error=Gagal tambah data, periksa sintaks!");
            exit;
        }else{
            header("Location: index.php?message=Data berhasil ditambahkan");
            exit;
        }
    }


?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Tambah Data</title>
    <link rel="stylesheet" href="css-index.css">
</head>
<body>
    <?php require 'infoFeedback.php'?>
    <h3> Tambah Data Mahasiswa </h3>
    <a href="index.php">Kembali ke beranda</a>
    <br>
    <br>
    <form method="POST" action="" enctype="multipart/form-data">
        <table>
            <tr>
                <td> <label for="nama">Nama Mahasiswa</label></td>
                <td>: <input type="text" id="nama" name="nama" requried></td>
            </tr>
            <tr>
                <td><label for="tanggalLahir">Tanggal Lahir</label></td>
                <td>: <input type="date" id="tanggalLahir" name="tanggalLahir" required></td>
            </tr>
            <tr>
                <td><label for="alamat">Alamat</label></td>
                <td>: <input name="alamat" type="text" id="alamat" required></td>
            </tr>
            <tr>
                <td> <label for="nim">NIM</label></td>
                <td>: <input type="number" name="nim" id="nim" required></td>
            </tr>
            <tr>
                <td> <label for="email">Email</label></td>
                <td>: <input type="email" name="email" id="email"required></td>
            </tr>
            <tr>
                <td> <label for="telepon">Telepon</label></td>
                <td>: <input type="number" id="number" name="telepon" required></td>
            </tr>
            <tr>
                <td><label for="image">Upload Foto</label></td>
                <td>: <input type="file" id="image" name="image" required></td>
            </tr>
            <tr> 
                <td class="ct" colspan="2">
                    <button type="submit" name="btn-tambah">Tambah</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>