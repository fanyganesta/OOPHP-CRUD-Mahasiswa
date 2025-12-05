<?php
    $helpers = [
        'Redirect.php',
        'CheckRole.php',
        'CheckLogin.php'
    ];
    
    foreach($helpers as $helper){
        require_once "{$helper}";
    }

    