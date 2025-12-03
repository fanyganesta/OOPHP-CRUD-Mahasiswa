<?php 
    require 'autoload.php';
    use Stakeholder\Mahasiswa\Mahasiswa;

    $mahasiswa = new Mahasiswa;
    $result = $mahasiswa->delete($_GET['ID']);
    if(!$result){
        header("Location: index.php?error=Gagal menghapus data!");
        exit;
    }else{
        header("Location: index.php?message=Data berhasil dihapus!");
        exit;
    }