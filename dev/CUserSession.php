<?php
    session_start();
    /*
        Date :  June 1, 2016
        Maintaining sessions directly with PHP Sessions for the time being.
        Assuming that the traffic at any given point in time is limited, it might suffice.$_COOKIE
        
        Will need to rework later for more persistant and scalable sessions.
    */
    
    function loginUser($user){
        if(session_start()){
            $_SESSION["user"] = json_decode(json_encode($user));
        }
    }
    
    function logoutUser($user = NULL){
        session_start();
        session_unset();
        session_destroy();
    }
    
    function isLoggedIn(){
        return (isset($_SESSION["user"]) && !is_null($_SESSION["user"]));
    }
?>