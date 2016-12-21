<?php
include_once("CUserSession.php");
include_once("CStandard.php");
include_once("CQuestion.php");
include_once("CProjectInfo.php");
include_once("CUser.php");

if(isset($_POST['chapter'])){

    $chapter = $_POST['chapter'];
    $chapter = mysqli_real_escape_string(mysqli_connection(), $chapter);
    
    print(getStandards($chapter));
  

} else if(isset($_POST['columns'])){

    $columns = $_POST['columns'];

    if($columns === "GOALS"){
        print(getGoalColumnNames());
    } elseif($columns === "PHASES") {
        print(getPhaseColumnNames());
    }

} else if(isset($_POST['register'])){
    $columns = $_POST['register'];
    if($columns === "QUESTIONS"){
        print(getSecurityQuestions());
    }
    
    if($columns === "REGISTER"){
        $data = json_decode(stripslashes( $_POST['data']), true);
        $recaptcha = $data['recaptcha'];
        
        // verify recaptcha
        $url ="https://www.google.com/recaptcha/api/siteverify";
        $fields = array('secret' => '6LcmTSATAAAAAFtJj2F9XlF6wl9gUmIX9Vu-4af7', 'response' => $recaptcha);
        
        //open connection
        $ch = curl_init($url);

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $captchaResponse = curl_exec($ch);
        curl_close($ch);
        $captchaResponse = json_decode($captchaResponse,true);
        $ret = new stdClass();
        if($captchaResponse['success']){ 
            $ret = createNewUser($data['email_id'], $data['password'],
                                $data['first_name'], $data['middle_name'], $data['last_name'],
                                $data['organization_id'], $data['authtype_id'], $data['securityquestion_id'], $data['securityquestion_ans'],$data['phone'],$data['country_name'],$data['country_code']);
                                       
            
            $ret = json_decode($ret);
            $ret->mail = false;
            if($ret->response){
                $ret->mail = Util::send_mail($data['email_id'], "Registration Confirmation", "Thank you for registering with the isUD website. Please login to visit the inclusive design solutions.");
            }
        } else {
            $ret->response = false;
            $ret->message = "Recaptcha verification failed.";
        }
        
        //$ret->m = $captchaResponse['challenge_ts']." ".$captchaResponse['success'];
        
        print(json_encode($ret));
    }
    
    if($columns === "LOGIN"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        print(validateUser($username, $password));
    }
    
    if($columns === "EDIT_PROFILE_RETRIEVE"){
        $ret["response"] = isLoggedIn();
        $ret["data"] = getPublicUserData($_SESSION["user"]); 
        print(json_encode($ret));
    }
    
    if($columns === "EDIT_PROFILE_SAVE"){
        $data = json_decode(stripslashes( $_POST['data']), true);
        $ret = UpdateUser($data['email_id'], $data['password'],
                                $data['first_name'], $data['middle_name'], $data['last_name'],
                                $data['organization_id'], $data['authtype_id'], $data['securityquestion_id'], $data['securityquestion_ans'],$data['phone'],$data['country_name'],$data['country_code']);

        print($ret);
    }

    if($columns === "LOGOUT"){
        logoutUser();
    }
    
    if($columns === "RESET_PASSWORD_PREP"){
        $username = $_POST['username'];
        print(resetPassword_prep($username));
    }
    
    if($columns === "RESET_PASSWORD_INIT"){
        $username = $_POST['username'];
        $securityanswer = $_POST['securityanswer'];

        $ret = new stdClass();
        $ret = resetPassword_init($username, $securityanswer);
        $ret = json_decode($ret);
        $ret->mail = false;
        if($ret->response){
            $ret->mail = Util::send_mail($username, "Password Reset link", "This is your reset link : http://www.thisisud.com/register.php?reset=true&rl=".$ret->message." . The link expires in 3 days.");
        }
        print(json_encode($ret));
    }
    
    if($columns === "RESET_PASSWORD_CONF"){
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $reset_link = $_POST['reset_link'];
        
        $ret = resetPassword_conf($reset_link, $password, $confirmpassword);
        print($ret);
    }
    
    if($columns === "RE_CONFIRM_PASS"){
        $password = $_POST['password'];
        $ret = checkPassword($_SESSION["user"]->email_id, $password);
        print($ret);
    }
} else if(isset($_POST['contact'])){
    $contact = $_POST['contact'];

    if($contact === "CONTACT_EMAILER"){
        $data = json_decode(stripslashes( $_POST['data']), true);
        $name = $data['name'];
        $email = $data['email'];
        $comment = $data['comment'];

        $msg = "<html><body><table style='max-width: 800px; border-radius: 5px; border: 1px solid black;'>";
        $msg.= '<tr><td style="width:180px; background-color: gray; color: white; padding: 10px;">Name</td><td style="width: 600px; padding: 10px;">'.$name.'</td></tr>';
        $msg.= '<tr><td style="width:180px; background-color: gray; color: white; padding: 10px;">Email</td><td style="width: 600px; padding: 10px;">'.$email.'</td></tr>';
        $msg.= '<tr><td style="width:180px; background-color: gray; color: white; padding: 10px;">Question/Comment</td><td style="width: 600px; padding: 10px;">'.$comment.'</td></tr>';
        $msg.= "</table></body></html>";
        $ret = new stdClass();
        $ret->response = true;
        $ret->mail = false;
        if($ret->response){
            $ret->mail = Util::send_mail("info@thisisud.com", "New question/comment from: ".$name, $msg);
        }
        print(json_encode($ret));
    }
} else if(isset($_POST['query'])){
    $query = $_POST['query'];

    if($query === "sr_version"){
        $ret = new stdClass();
        $ret->response = ($_SESSION["user"]->uses_sr === 1);
        print(json_encode($ret));
    }
} else if(isset($_POST['survey_complete'])){
    updateSurveyStatus($_POST['survey_complete']);
} else if(isset($_POST['all_users'])){
    print(getAllUsers($_POST['all_users']));
} else if(isset($_POST['project'])){

    if($_POST['project'] === "CREATE"){
        $data = json_decode(stripslashes( $_POST['data']), true);
        $ret = createProjectInfo($data['title'], $data['owner'], $data['architect'], $data['habitable_floor_area'], $data['site_area'], $data['cost'],
                                 $data['a_start_date'], $data['a_end_date'], $data['building_type'], $data['contact_person'], $data['contact_email'], $data['contact_telephone'], $data['contact_telephone_c_code'],
                                 $data['address_line_1'], $data['address_line_2'], $data['city'], $data['state'], $data['country'], $data['zipcode']);
        print(json_encode($ret));
        
    }

    if($_POST['project'] === "LIST"){
        // -1 for listing all projects
        print(getProjectInfo(-1));
    }

    if($_POST['project'] === "DETAILS"){
        // -1 for listing all projects
        print(getProjectInfo($_POST["id"]));
    }

    if($_POST['project'] === "UPDATE_INFO"){
        // -1 for listing all projects
        $data = json_decode(stripslashes( $_POST['data']), true);
        $ret = updateProjectInfo($data["id"], $data['title'], $data['owner'], $data['architect'], $data['habitable_floor_area'], $data['site_area'], $data['cost'],
                                 $data['a_start_date'], $data['a_end_date'], $data['building_type'], $data['contact_person'], $data['contact_email'], $data['contact_telephone'], $data['contact_telephone_c_code'],
                                 $data['address_line_1'], $data['address_line_2'], $data['city'], $data['state'], $data['country'], $data['zipcode']);
        print($ret);
    }

    if($_POST['project'] === "UPDATE"){
        // -1 for listing all projects
        print(updateProjectSolutionValues($_POST["id"],$_POST["data"],$_POST["target"], $_POST["applicable_credits"], $_POST["earned_credits"], $_POST["bonus_credits"],0,0, $_POST["award_percentage"], $_POST["award_category"], $_POST["h1_credits_applicable"], $_POST["h1_credits_earned"]));
    }

}

?>