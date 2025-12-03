<?php 

    if(isset($_POST['btn-cari'])) {
        $rows = $mahasiswa->cari($_POST['cari']);
        return $rows; 
    }

?>

<form action="" method="POST">
    <label for="cari">Cari Mahasiswa: </label>
    <input id="cari" type="text" name="cari">
    <button type="submit" name="btn-cari">Cari</button>
</form>