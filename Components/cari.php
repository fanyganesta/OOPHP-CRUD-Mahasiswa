<?php 

    if(isset($_POST['btn-cari'])) {
        $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
        $rows = $mahasiswa->cari($_POST['cari'], $halamanAktif);
    }

?>

<form action="index.php" method="POST">
    <label for="cari">Cari Mahasiswa: </label>
    <input id="cari" type="text" name="cari">
    <button type="submit" name="btn-cari">Cari</button>
</form>