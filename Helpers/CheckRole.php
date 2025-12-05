<?php 

    function checkRole(String $role){
        if($role != 'admin'){
            return redirect('login.php','error=Anda bukan admin!');
        }
    }