<?php
    
    if(isLoggedIn() && $_SESSION["user"]->authtype_id === 1){
        // Correct authtype
    } else {
        header("Location: https://www.thisisud.com");
        die();
    }
?>