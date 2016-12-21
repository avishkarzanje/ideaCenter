<?php

include_once("helper.php");   
class SecurityQuestion{
    
    public $question;
    public $sl_no;
    
    function populateQuestion( $row ){
        
        $this->question = $row["question"];
        $this->sl_no = $row["sl_no"];
        
    }
    
}

// Getting Security Questions	
function getSecurityQuestions(){
    
    $sql_conn = mysqli_connection();
    $sql = sprintf("SELECT  * FROM  SecurityQuestions ORDER BY `sl_no`");
    
    $result = mysqli_query($sql_conn, $sql);

    $res = array();
    while($row = mysqli_fetch_array($result)) {
        $question = new SecurityQuestion();
        $question->populateQuestion($row);
        $res[] = $question;
    }
    
    mysqli_close($sql_conn);
    $r = json_encode($res);
    return $r;
    
}

?>