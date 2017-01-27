<?php
include_once("CUser.php");
include_once("CUserSession.php");

if(isset($_POST['user']))
{
    if($_POST['user'] === "REVIEWERS")
    {
        print (getReviewers());
    }
       
}
else
{
    //echo "user is not set";
}

?>