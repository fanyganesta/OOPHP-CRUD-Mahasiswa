<?php
    require 'autoload.php';
    use Stakeholder\Mahasiswa\Mahasiswa;

    $mahasiswa = new Mahasiswa();
    $halamanAktif = $_GET['halaman'] ?? 1;
    $rows = $mahasiswa->allWithPagination($halamanAktif);
    $jumlahHalaman = $rows[0]['jumlahHalaman'];

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>List Mahasiwa</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body> 
    <?php require 'Components/infoFeedback.php'?>
    <h3> Selamat datang</h3>
    <a href="tambah.php"> Tambah data</a>
    <p style="display: inline">|</p>
    <a href="logout.php">Keluar</a>

    <br> <br>
    <form action="" method="POST">
        <label for="cari">Cari Mahasiswa: </label>
        <input id="cari" type="text" name="cari">
        <button type="submit" name="btn-cari">Cari</button>
    </form>
    <br>
    <table class="br">
        <?php if(count($rows) < 1) : ?>
            <tr>
                <td class="ct"> Tidak ada data ditemukan </td>
            </tr>
        <?php else : ?>
            <tr>
                <th>No.</th>
                <th>Foto Profile</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; foreach($rows as $row) : ?>
                <tr>
                    <td class="ct"><?= $i ?></td>
                    <td class="ct">
                        <?php require 'Components/getImageProfile.php'?>
                    </td>
                    <td class="ct"><?= $row['nama']?></td>
                    <td class="ct"><?= $row['nim']?></td>
                    <td class="ct"><?= $row['email']?></td>
                    <td class="ct"><?= $row['telepon']?></td>
                    <td class="ct"><?= $row['tanggalLahir'] ?></td>
                    <td class="ct"><?= $row['alamat']?></td>
                    <td class="ct">
                        <a href="edit.php?ID=<?= $row['ID']?>">Edit</a>
                        <p style="display:inline"> | </p>
                        <a href="hapus.php?ID=<?= $row['ID']?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </tr>
            <?php $i++; endforeach ?>
            <?php require 'Components/pagination.php'?>
        <?php endif ?>
    </table>
</body>
</html>