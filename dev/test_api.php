<?php
include_once("CUser.php");
include_once("CProject.php");

// echo "Now calling function from CUser.php";
// echo "<br>";

// print ( json_encode(getReviewers()) );

echo "<br><br>Now calling function from CProject.php";
print(updateProjectReviewer('pr_d25e182fac','hsubryan@buffalo.edu'));

?>