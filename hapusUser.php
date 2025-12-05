<?php 

    require 'autoload.php';
    use Stakeholder\Users\Users;
    checkLogin();
    checkRole($_SESSION['users'][0]['role']);

    $user = new Users();
    if(!isset($_GET['ID'])){
        return redirect('akun.php', "error=Pilih user yang ingin dihapus dahulu!");
    }else{
        $result = $user->hapus($_GET['ID']);
        (!$result) ?
        redirect('akun.php', 'error=Gagal hapus, hubungi admin!') :
        redirect('akun.php', 'message=Berhasil hapus data!');
    }