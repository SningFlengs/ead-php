<?php

    session_start();

    if(!isset($_SESSION["user_email"])){
        header("Location:auth/erro.html");
        exit();
    }
    else {
        $user_email = $_SESSION["user_email"];
        
        // Verifica se o email é diferente de "admin@admin.com"
        if($user_email != "admin@admin.com"){
            header("Location:auth/erro.html");
            exit();
        }
    }
    
?>