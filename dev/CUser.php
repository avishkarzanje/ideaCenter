<?php
    include_once("CUserSession.php");
    include_once("helper.php");
    include_once("CUtil.php");
    
       
    class User{
        
        public $_id;
        public $sl_no;
        public $email_id;
        public $password;
        public $salt;
        public $first_name;
        public $middle_name;
        public $last_name;
        public $organization_id;
        public $phone;
        public $country_name;
        public $country_code;
        public $authtype_id;
        public $securityquestion_id;
        public $securityquestion_text;
        public $securityquestion_ans;
        public $ts_created;
        public $reset_link;
        public $ts_reset;
        public $profile_change_link;
        public $ts_profile_change;
        public $ts_password_change;
        public $ts_last_login_success;
        public $login_success_count;
        public $ts_last_login_fail;
        public $ts_survey_completed;
        public $uses_sr;        // Flag for screen reader using users
        
        function populateFromDBRow( $row ){
            
            $this->_id = $row["_id"];
            $this->sl_no = $row["sl_no"];
            $this->email_id = $row["email_id"];
            $this->password = $row["password"];
            $this->salt = $row["salt"];
            $this->first_name = $row["first_name"];
            $this->middle_name = $row["middle_name"];
            $this->last_name = $row["last_name"];
            $this->organization_id = $row["organization_id"];
            $this->phone = $row["phone"];
            $this->country_name = $row["country_name"];
            $this->country_code = $row["country_code"];
            $this->authtype_id = $row["authtype_id"];
            $this->securityquestion_id = $row["securityquestion_id"];
            $this->securityquestion_text = $row["question"];
            $this->securityquestion_ans = $row["securityquestion_ans"];
            $this->ts_created = $row["ts_created"];
            $this->reset_link = $row["reset_link"];
            $this->ts_reset = $row["ts_reset"];
            $this->profile_change_link = $row["profile_change_link"];
            $this->ts_profile_change = $row["ts_profile_change"];
            $this->ts_password_change = $row["ts_password_change"];
            $this->ts_last_login_success = $row["ts_last_login_success"];
            $this->login_success_count = $row["login_success_count"];
            $this->ts_last_login_fail = $row["ts_last_login_fail"];
            $this->ts_survey_completed = $row["ts_survey_completed"];
            $this->uses_sr = $row["uses_sr"];

        }
        
    }

    function getPublicUserData($user){
        $n_user = json_decode(json_encode($user));
        $n_user->_id = "";
        $n_user->salt = "";
        $n_user->password = "";
        $n_user->authtype_id = "";
        $n_user->sl_no = "";
        $n_user->securityquestion_ans = "";  //Hide security answer as well
        $n_user->securityquestion_id = "";
        $n_user->securityquestion_text = "";
        $n_user->reset_link = "";
        $n_user->profile_change_link = "";
        
        return $n_user;
    }
    
    
    // Get user : Defaults to email search	
    function getUser($clause, $where = 'email_id'){
        
        $sql_conn = mysqli_connection();
        $clause = Util::escapeObject($clause);
        
        $s = "SELECT * FROM  `Users_temp` INNER JOIN  `SecurityQuestions` ON (  `Users_temp`.`securityquestion_id` =  `SecurityQuestions`.`sl_no` ) WHERE `Users_temp`.`".$where."` = ? ";
        if (!($stmt = $sql_conn->prepare($s))){
            echo "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error. $s;
        }
        
        if(!($stmt->bind_param("s", $clause))){
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
        }
                     
        if (!($stmt->execute())) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        if (!($ret = $stmt->get_result())) {
            echo "Getting Result failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        
        $user = new User();
        $res = array();
        while($row = mysqli_fetch_array($ret)) {
            $user = new User();
            $user->populateFromDBRow($row);
            $res[] = $user;
        }
        
        $stmt->close();

        mysqli_close($sql_conn);
        $r = json_encode($res);
        //echo "hello : ". $r;
        return $r;
        
    }
 
    
    /*
         Insert a new user
         
        [sl_no], email_id, password, salt, first_name, middle_name, last_name
        organization_id, authtype_id, securityquestion_id, securityquestion_ans,
        [ts_created]
    */
    
    function insertNewUser( $user ){

        $sql_conn = mysqli_connection();
        $user = Util::escapeObject($user);
        
        if (!($stmt = $sql_conn->prepare("INSERT INTO `Users_temp`(email_id, password, salt, first_name, middle_name, last_name, organization_id, authtype_id, securityquestion_id, securityquestion_ans, phone, country_name, country_code, _id, uses_sr) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))){
            $ret =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
        }
        
        if(!($stmt->bind_param("sssssssiisssssi",
                     $user->email_id,
                     $user->password,
                     $user->salt,
                     $user->first_name,
                     $user->middle_name,
                     $user->last_name,
                     $user->organization_id,
                     $user->authtype_id,
                     $user->securityquestion_id,
                     $user->securityquestion_ans,
                     $user->phone,
                     $user->country_name,
                     $user->country_code,
                     $user->_id,
                     $user->uses_sr
                      ))){
            $ret =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
        }
        
        if (!($ret = $stmt->execute())) {
            $ret =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        $stmt->close();
        mysqli_close($sql_conn);
        return $ret;
    }
    
    
    /*
         Create a new user
         
        [sl_no], email_id, password, salt, first_name, middle_name, last_name
        organization_id, authtype_id, securityquestion_id, securityquestion_ans,
        [ts_created]
    */
    
    function createNewUser( $email_id, $password, 
                            $first_name, $middle_name, $last_name,
                            $organization_id, $authtype_id, $securityquestion_id, $securityquestion_ans, $phone="", $country_name="", $country_code="", $uses_sr = 0 ){

        $sql_conn = mysqli_connection();
        
        $salt = Util::genRandText(10);
        $hashpassword = Util::hash_pbkdf2($password, $salt);
        
        $user = new User();
        $user->_id = strtolower($first_name)."-".Util::genRandText(10);
        $user->email_id = strtolower($email_id);
        $user->password = $hashpassword;
        $user->salt = $salt;
        $user->first_name = ucfirst(strtolower($first_name));
        $user->middle_name = ucfirst(strtolower($middle_name));
        $user->last_name = ucfirst(strtolower($last_name));
        $user->organization_id = $organization_id;
        $user->authtype_id = $authtype_id;
        $user->securityquestion_id = $securityquestion_id;
        $user->securityquestion_ans = strtolower($securityquestion_ans);
        $user->phone = $phone;
        $user->country_name = $country_name;
        $user->country_code = strtoupper($country_code);
        $user->uses_sr = $uses_sr;
        
        $user = Util::escapeObject($user);
        $response = insertNewUser($user);
        $ret['response'] = is_bool($response) && $response;
        $ret['message'] = $response;
        
        if (strpos($response, 'Duplicate') !== false) {
           $ret['message'] = "Duplicate User";
        } else if (strpos($response, ')') !== false) {
            $response = split(")", $response);
            $ret['message'] = $response[1];
        }
        return json_encode($ret);
    }

    function UpdateUser( $email_id, $password, 
                            $first_name, $middle_name, $last_name,
                            $organization_id, $authtype_id, $securityquestion_id, $securityquestion_ans, $phone="", $country_name="", $country_code="", $uses_sr = 0 ){

        $country_code = strtoupper($country_code);
        $sql_conn = mysqli_connection();
        $q_type = 1;
        $param = "ssssssss";
        $fields = " email_id = ?,
                    first_name = ?,
                    last_name = ?,
                    organization_id = ?,
                    phone = ?,
                    country_name = ?,
                    country_code = ?,
                    uses_sr = ?
                    ";
        
        if($securityquestion_ans !== ""){
            $q_type = 2;
            $fields .= ",securityquestion_id = ?,
                        securityquestion_ans = ?";
            $param .= "is";
        }

        if($password !== ""){
            $q_type = ($q_type === 2? 4 : 3);
            $fields .= ",password = ?,
                         ts_password_change = NOW()";
            $param .= "s";
        }

        $query = "UPDATE `Users_temp` SET ".$fields." WHERE _id = ?";
        $param .= "s";

        if (!($stmt = $sql_conn->prepare($query))){
            $resp["message"] =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            $resp["response"] = false;
        }
        
        if($q_type === 1 && !($stmt->bind_param($param,
                     $email_id,
                     $first_name,
                     $last_name,
                     $organization_id,
                     $phone,
                     $country_name,
                     $country_code,
                     $uses_sr,
                     $_SESSION["user"]->_id
                      ))){
            $resp["message"] =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            $resp["response"] = false;
        }

        if($q_type === 2 && !($stmt->bind_param($param,
                     $email_id,
                     $first_name,
                     $last_name,
                     $organization_id,
                     $phone,
                     $country_name,
                     $country_code,
                     $uses_sr,                     
                     $securityquestion_id,
                     $securityquestion_ans,
                     $_SESSION["user"]->_id
                      ))){
            $resp["message"] =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            $resp["response"] = false;
        }

        if($q_type === 4 && !($stmt->bind_param($param,
                     $email_id,
                     $first_name,
                     $last_name,
                     $organization_id,
                     $phone,
                     $country_name,
                     $country_code,
                     $uses_sr,
                     $securityquestion_id,
                     $securityquestion_ans,
                     Util::hash_pbkdf2($password, $_SESSION['user']->salt),
                     $_SESSION["user"]->_id
                      ))){
            $resp["message"] =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            $resp["response"] = false;
        }

        if($q_type === 3 && !($stmt->bind_param($param,
                     $email_id,
                     $first_name,
                     $last_name,
                     $organization_id,
                     $phone,
                     $country_name,
                     $country_code,
                     $uses_sr,                     
                     Util::hash_pbkdf2($password, $_SESSION['user']->salt),
                     $_SESSION["user"]->_id
                      ))){
            $resp["message"] =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            $resp["response"] = false;
        }
        
        if (!($ret = $stmt->execute())) {
            $resp["message"] =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $resp["response"] = false;
        }

        if($ret){
            $resp["response"] = true;
            $resp["message"] = "";
            $user = json_decode(getUser($_SESSION["user"]->_id,"_id"));
            $user = $user[0];
            $_SESSION["user"] = json_decode(json_encode($user));
        }

        $stmt->close();
        mysqli_close($sql_conn);
        return json_encode($resp);

    }
    
    function validateUser( $username, $password ){
        $user = json_decode(getUser($username));
        $user = $user[0];
        $hashpassword = Util::hash_pbkdf2($password, $user->salt);
        
        $ret['response'] = !is_null($user) && ($hashpassword === $user->password);
        $ret['message'] = 'SUCCESS';
        $ret['first_name'] = $user->first_name;
        $ret['last_name'] = $user->last_name;

        $sql_conn = mysqli_connection();
        
        if(is_null($user)){
            $ret['message'] = "NO USER";
        } else if (($hashpassword !== $user->password)){
            $ret['message'] = "PASSWORD MISMATCH";
            
            if (!($stmt = $sql_conn->prepare("UPDATE `Users_temp` SET ts_last_login_fail = NOW() WHERE email_id = ?"))){
                $sql_ret =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            }
            
            if(!($stmt->bind_param("s",
                        $username ))){
                $sql_ret =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            }
                        
            if (!($sql_ret = $stmt->execute())) {
                $sql_ret =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->close();
            mysqli_close($sql_conn);
            
        } else{
            loginUser($user);
            // echo(isLoggedIn());
            // var_dump($_SESSION["user"]);
            
            if (!($stmt = $sql_conn->prepare("UPDATE `Users_temp` SET ts_last_login_success = NOW(), `login_success_count` = `login_success_count` + 1 WHERE email_id = ?"))){
                $sql_ret =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            }
            
            if(!($stmt->bind_param("s",
                        $username ))){
                $sql_ret =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            }
                        
            if (!($sql_ret = $stmt->execute())) {
                $sql_ret =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->close();
            mysqli_close($sql_conn);
        }
        
        return json_encode($ret);
    }
    
    function checkPassword($username, $password){
        $user = json_decode(getUser($username));
        $user = $user[0];
        $hashpassword = Util::hash_pbkdf2($password, $user->salt);
        
        $ret['response'] = !is_null($user) && ($hashpassword === $user->password);
        $ret['message'] = 'SUCCESS';
        $ret['first_name'] = $user->first_name;
        $ret['last_name'] = $user->last_name;
        
        if(is_null($user)){
            $ret['message'] = "NO USER";
        } else if (($hashpassword !== $user->password)){
            $ret['message'] = "PASSWORD MISMATCH";
        } else{
            $micro = microtime();
            $micro = str_replace(' ', '', $micro);
            $profile_change_link = Util::hash_pbkdf2($username.$micro, $user->salt);
            
            $sql_conn = mysqli_connection();
            $profile_change_link = Util::escapeObject($profile_change_link);
            $current_ts = "NOW()";
            if (!($stmt = $sql_conn->prepare("UPDATE `Users_temp` SET profile_change_link = ?, ts_profile_change = NOW() WHERE email_id = ?"))){
                $sql_ret =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            }
            
            if(!($stmt->bind_param("ss",
                        $profile_change_link,
                        $username ))){
                $sql_ret =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            }
                        
            if (!($sql_ret = $stmt->execute())) {
                $sql_ret =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->close();
            mysqli_close($sql_conn);
            
            $ret['link'] = $profile_change_link;
            $ret['response'] = true;
        }
        return json_encode($ret);
    }
    
    /*
     *  Password reset flow
     *  Prep -> init -> retrieve -> conf
     *
     *
     * 
     */
    
    
    
    function resetPassword_init($username, $securityquestion_ans){
        $user = json_decode(getUser($username));
        $user = $user[0];
        if(is_null($user)){
            $ret['message'] = "NO USER";
            $ret['response'] = false;
            echo (1);
        } else if (($username === $user->email_id) && ($securityquestion_ans !== $user->securityquestion_ans)){
            $ret['message'] = "SECURITY ANSWER MISMATCH";
            $ret['response'] = false;
        } else if (($username === $user->email_id) && ($securityquestion_ans === $user->securityquestion_ans)){
            $micro = microtime();
            $micro = str_replace(' ', '', $micro);
            $reset_link = Util::hash_pbkdf2($username.$micro, $user->salt);
            
            $sql_conn = mysqli_connection();
            $reset_link = Util::escapeObject($reset_link);
            $current_ts = "NOW()";
            if (!($stmt = $sql_conn->prepare("UPDATE `Users_temp` SET reset_link = ?, ts_reset = NOW() WHERE email_id = ?"))){
                $sql_ret =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            }
            
            if(!($stmt->bind_param("ss",
                        $reset_link,
                        $username ))){
                $sql_ret =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            }
                        
            if (!($sql_ret = $stmt->execute())) {
                $sql_ret =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->close();
            mysqli_close($sql_conn);
            
            $ret['message'] = $reset_link;
            $ret['response'] = true;
        }
        return json_encode($ret);
    }
    
    function resetPassword_prep($email){
        $user = json_decode(getUser($email));
        $user = $user[0];
        
        if(is_null($user)){
            $ret['message'] = "NO SUCH USER";
            $ret['response'] = false;
        } else {
            //hide fields
            $n_user = new User();
            $n_user->email_id = $user->email_id;
            $n_user->securityquestion_text = $user->securityquestion_text;
            $ret['response'] = true;            
        }
        
        $ret['data'] = $n_user; 
        return json_encode($ret);
    }
    
    function resetPassword_retrieve($reset_link){
        $user = json_decode(getUser($reset_link, ""));
        $user = $user[0];
        
        if(is_null($user)){
            $ret['message'] = "NO SUCH USER";
            $ret['response'] = false;
        } else {
            //hide fields
            $user->password = "";
            $user->salt = "";
            $user->authtype_id = "";
            $ret['response'] = true;            
        }
        
        $ret['data'] = $user; 
        return json_encode($ret);
    }
    
    function resetPassword_conf($reset_link, $password, $confirm_password){
        $user = json_decode(getUser($reset_link, "reset_link"));
        $user = $user[0];
        $ret['response'] = false;
        if(is_null($user)){
            $ret['message'] = "NO SUCH LINK";
        } else if (strtotime($user->ts_reset) < strtotime('-3 day')){
            $ret['message'] = "LINK EXPIRED";
        } else if ($password !== Util::escapeObject($password)){
            $ret['message'] = "PASSWORD CONTAINS ILLEGAL CHARACTERS";
        } else if ($password !== $confirm_password){
            $ret['message'] = "PASSWORD MISMATCH";
        } else if ($password === $confirm_password){
            $salt = Util::genRandText(10);
            $password = Util::hash_pbkdf2($password, $salt);
            $sql_conn = mysqli_connection();
            $username = $user->email_id;
            
            if (!($stmt = $sql_conn->prepare("UPDATE `Users_temp` SET `password` = ?, `salt` = ?, `reset_link` = NULL, `ts_password_change` = NOW() WHERE email_id = ?"))){
                $sql_ret =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            }
            
            if(!($stmt->bind_param("sss",
                        $password,
                        $salt,
                        $username ))){
                $sql_ret =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            }
                        
            if (!($sql_ret = $stmt->execute())) {
                $sql_ret =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->close();
            mysqli_close($sql_conn);
            
            $ret['message'] = "PASSWORD RESET SUCCESS";
            $ret['response'] = ($sql_ret === true);
            
        }
        
        return json_encode($ret);
    }

    function updateSurveyStatus($complete){
        if(isLoggedIn()){
            $sql_conn = mysqli_connection();
            $val = $complete ? "NOW()" : "NULL";
            if(!($stmt = $sql_conn->prepare('UPDATE `Users_temp` SET `ts_survey_completed` = '.$val.' WHERE `_id` = "'.$_SESSION["user"]->_id.'"'))){
                $sql_ret =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            }

            if (!($sql_ret = $stmt->execute())) {
                $sql_ret =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->close();
            mysqli_close($sql_conn);

            $ret['response'] = ($sql_ret === true);
            return json_encode($ret);
        }
    }

    function getAllUsers($public = true){
        $sql_conn = mysqli_connection();
        $clause = Util::escapeObject($clause);
        
        $s = "SELECT * FROM  `Users_temp`";
        if (!($stmt = $sql_conn->prepare($s))){
            echo "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error. $s;
        }
                  
        if (!($stmt->execute())) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        if (!($ret = $stmt->get_result())) {
            echo "Getting Result failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        
        $user = new User();
        $res = array();
        while($row = mysqli_fetch_array($ret)) {
            $user = new User();
            $user->populateFromDBRow($row);
            if($public){
                $user = getPublicUserData($user);
            }
            $res[] = $user;
        }
        
        $stmt->close();

        mysqli_close($sql_conn);
        $r = json_encode($res);
        //echo "hello : ". $r;
        return $r;
    }
    
?>