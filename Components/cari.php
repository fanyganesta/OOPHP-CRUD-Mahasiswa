<?php 

    if(isset($_GET['cari'])) {
        $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
        $rows = $mahasiswa->cari($_GET['cari'], $halamanAktif);
        $jumlahHalaman = $rows[0]['jumlahHalaman'];
    }

?>

<form action="index.php" method="GET">
    <label for="cari">Cari Mahasiswa: </label>
    <input id="cari" type="text" name="cari" value="<?php echo (isset($_GET['cari'])) ? $_GET['cari'] : null ?>">
    <button type="submit">Cari</button>
</form>