<?php
include_once("CUser.php");
include_once("CUserSession.php");
include_once("CProject.php");

if(isset($_POST['project_id']) && isset($_POST['reviewer']) )
{
    print (updateProjectReviewer($_POST['project_id'],$_POST['reviewer']));      
}
else
{
    //echo "user is not set";
}

?>