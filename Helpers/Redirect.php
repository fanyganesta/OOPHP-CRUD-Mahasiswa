<?php 
    function redirect($page, $query = []){
        if(empty($query)){
            header("Location: /oophp_mahasiswa/{$page}");
            exit;
        }else{
            header("Location: /oophp_mahasiswa/{$page}?{$query}");
            exit;
        }
    }