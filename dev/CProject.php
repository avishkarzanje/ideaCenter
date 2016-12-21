<?php
    include_once("CUserSession.php");
    include_once("helper.php");
    include_once("CUtil.php");

    class UD_Project{

        public $sl_no;
        public $user_id;
        public $project_id;
        public $applicable_credits;
        public $earned_credits;
        public $bonus_credits;
        public $innovative_credits;
        public $innovative_credits_submitted_count;
        public $award_category;
        public $award_percentage;
        public $header_mask;
        public $h1_credits;
        /*
            Each solution credit fields are dynamic
            due to large count : ~500
        */ 

        function populateFromDBRow( $row ){
            
            $this->sl_no = $row["sl_no"];
            $this->user_id = $row["user_id"];
            $this->project_id = $row["project_id"];
            $this->applicable_credits = $row["applicable_credits"];
            $this->earned_credits = $row["earned_credits"];
            $this->bonus_credits = $row["bonus_credits"];
            $this->innovative_credits = $row["innovative_credits"];
            $this->innovative_credits_submitted_count = $row["innovative_credits_submitted_count"];
            $this->award_category = $row["award_category"];
            $this->award_percentage = $row["award_percentage"];
            $this->header_mask = $row["header_mask"];
            $this->h1_credits = $row["h1_credits"];
        }
        
    }
	
	// Getting a Project	
	function getProject($project_id){
        
		$sql_conn = mysqli_connection();
        if(isLoggedIn()){
            
            $where = "WHERE `user_id` like '".$_SESSION['user']->_id."'";
            if($project_id != -1){
                $where = $where." AND `project_id` like '".$project_id."'";
            }

            $sql = "SELECT  * FROM  UD_P_Projects ".$where." ORDER BY `sl_no`";
            $udProjectInfo = array();
            $res = array();
            try{
                $result = mysqli_query($sql_conn, $sql);
                while($row = mysqli_fetch_array($result)) {
                    //$project = new UD_Project();
                    //$project->populateFromDBRow($row);

                    // hide fields
                    unset($row["user_id"]);
                    unset($row["sl_no"]);
                    foreach($row as $key => $val){
                        if(gettype($key) === "integer"){
                            unset($row[$key]);
                        }
                    }
                    $udProjectInfo[] = $row;
                }
                mysqli_close($sql_conn);
                $res = $udProjectInfo;
            } catch (Exception $e){
                $res['message'] = "Error : ".$e->getMessage();
            }
        } else {
            $res['message'] = "Error : User not logged in";
        }
        
        $r = json_encode($res);
        return $r;
		
	}
    
    function createProject($sql_conn, $project_id, $user_id, $applicable_credits, $earned_credits, $bonus_credits, $innovative_credits, 
                           $innovative_credits_submitted_count, $award_percentage, $award_category){
        
        if($sql_conn == null){
            $sql_conn = mysqli_connection();
        }


        if(isLoggedIn()){
            $project = new UD_Project();
            $project->project_id = $project_id;
            $project->user_id = $user_id;
            $project->applicable_credits = $applicable_credits;
            $project->earned_credits = $earned_credits;
            $project->bonus_credits = $bonus_credits;
            $project->innovative_credits = $innovative_credits;
            $project->innovative_credits_submitted_count = $innovative_credits_submitted_count;
            $project->award_percentage = $award_percentage;
            $project->award_category = $award_category;

            $project = Util::escapeObject($project);
            $ret["response"] = false;
            $header_mask = '';
            $h1_credits_str = '';
            $h1_credits_earned_str = '';

            // create header mask
                        
            try{
                if (!($stmt1 = $sql_conn->prepare("SELECT  `H1#` , COUNT( DISTINCT (`H2#`) ), `H1_Credits` as count FROM  `UD_S_Headings` GROUP BY  `H1#` LIMIT 0 , 30"))){
                    $ret["message1"] =  "Mask Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
                    //print($ret["message"]);
                    throw new Exception($ret["message"]);
                }

                if (!($res = $stmt1->execute())) {
                    $ret["message"] =  "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
                    $ret["response"] = false;
                    throw new Exception($ret["message"]);
                } else {
                    $ret["message"] = "start";
                    $stmt1->bind_result($row_h1, $h2_count, $h1_credits);
                    while($stmt1->fetch()) {
                        $c = intval($h2_count,10)-1;
                        for($i=0;$i<$c;$i++){
                            $header_mask .= "1,";
                        }
                        $h1_credits_str .= $h1_credits.",";
                        $h1_credits_earned_str .= "0,";
                        $header_mask = substr($header_mask,0,-1); // remove trailing ,
                        $header_mask .= ";";
                    }
                    $header_mask = substr($header_mask,0,-1); // remove trailing ;
                    $h1_credits_str = substr($h1_credits_str,0,-1); // remove trailing ,
                    $h1_credits_earned_str = substr($h1_credits_earned_str,0,-1);
                    $ret['header_mask'] = $header_mask;
                }
            } catch (Exception $e){
                /*
                   hard coded from ver.1
                    1 - 2
                    2 - 4
                    3 - 12
                    4 - 4
                    5 - 8
                    6 - 16
                    7 - 12
                    8 - 6
                    9 - 3
                */
                $header_mask = '1,1;1,1,1,1;1,1,1,1,1,1,1,1,1,1,1,1;1,1,1,1;1,1,1,1,1,1,1,1;1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1;1,1,1,1,1,1,1,1,1,1,1,1;1,1,1,1,1,1;1,1,1';
                $h1_credits_str = '4,7,15,7,15,30,12,6,4';
            }

            $stmt1 ->close();



            if (!($stmt = $sql_conn->prepare("INSERT INTO `UD_P_Projects`(project_id, user_id, applicable_credits, earned_credits, bonus_credits,
                                            innovative_credits, innovative_credits_submitted_count, award_percentage, award_category, header_mask, h1_credits_applicable, h1_credits_earned) 
                                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"))){
                $ret["message"] =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
                print($ret["message"]);
            }

            if(!($stmt->bind_param("ssiiiiidssss",
                        $project->project_id,
                        $project->user_id,
                        $project->applicable_credits,
                        $project->earned_credits,
                        $project->bonus_credits,
                        $project->innovative_credits,
                        $project->innovative_credits_submitted_count,
                        $project->award_percentage,
                        $project->award_category,
                        $header_mask,
                        $h1_credits_str,
                        $h1_credits_earned_str
                        ))){
                $ret["message"] =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            }

            if (!($res = $stmt->execute())) {
                $ret["message"] =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $ret["response"] = false;
            } else {
                $ret["response"] = true;
                $ret["message"] = $res;
            }
        } else {
            $ret["message"] = "Error : User not logged in";
        }
        
        $stmt->close();
        return $ret;
    }
	
    
    function updateProject($_id, $project_title, $project_address, $building_type, $square_footage, $project_client, 
                           $project_builder, $project_architect, $project_cost, $project_description){
        $sql_conn = mysqli_connection();

        $project = new UD_Project_Info();
        $project->_id = $_id;
        $project->project_title = $project_title;
        $project->project_address = $project_address;
        $project->building_type = $building_type;
        $project->square_footage = $square_footage;
        $project->project_client = $project_client;
        $project->project_builder = $project_builder;
        $project->project_architect = $project_architect;
        $project->project_cost = $project_cost;
        $project->project_description = $project_description;

        $project = Util::escapeObject($project);
        $fields = " `project_title` = ?, 
                    `project_address` = ?,
                    `building_type` = ?,
                    `square_footage` = ?,
                    `project_client` = ?,
                    `project_builder` = ?,
                    `project_architect` = ?,
                    `project_cost` = ?,
                    `project_description` = ?";
        $param = "sssdsssds";
        $query = "UPDATE `UD_P_Info` SET ".$fields." WHERE _id = ?";
        $param .= "s";

        if (!($stmt = $sql_conn->prepare($query))){
            $resp["message"] =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            $resp["response"] = false;
        }

        if(!($stmt->bind_param($param,
                        $project->project_title,
                        $project->project_address,
                        $project->building_type,
                        $project->square_footage,
                        $project->project_client,
                        $project->project_builder,
                        $project->project_architect,
                        $project->project_cost,
                        $project->project_description,
                        $project->_id
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
        }

        $stmt->close();
        mysqli_close($sql_conn);
        return json_encode($resp);
    }

    function updateProjectSolutionValues($id,$data, $target, $applicable_credits, $earned_credits, $bonus_credits, $innovative_credits, $innovative_credits_submitted_count, $award_percentage, $award_category, $h1_credits_applicable, $h1_credits_earned){
        if(!isLoggedIn()){
            $resp["message"] = "User not logged in";
            $resp["response"] = false;
            return json_encode($resp);
        }

        $sql_conn = mysqli_connection();
        $header_mask = '';

        /* check for valid project */
        $query = "SELECT `sl_no`, `header_mask` FROM `UD_P_Projects` WHERE `project_id` like ? AND `user_id` like ?";
        if (!($stmt = $sql_conn->prepare($query))){
            $resp["message"] =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            $resp["response"] = false;
            return json_encode($resp);
        }
        
        if(!($stmt->bind_param("ss",
                $id,
                $_SESSION['user']->_id
        ))){
            $resp["message"] =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error; 
            $resp["response"] = false;
            return json_encode($resp);
        }
        
        if (!($ret = $stmt->execute())) {
            $resp["message"] =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $resp["response"] = false;
            return json_encode($resp);
        } else {
            $stmt->store_result();
            if($stmt->num_rows <=0){
                $resp["message"] =  "Execute failed: Current user doens't have a project with the given id";
                $resp["response"] = false;
                return json_encode($resp);
            } else {
                $stmt->bind_result($row_sl_no, $row_header_mask);
                while($stmt->fetch()) {
                    $header_mask = $row_header_mask;
                }

                $header_mask_new = '';
                $header_mask_arr = explode(";",$header_mask);

                $update_clause = "";
                $fields = "";

                list($h1,$h2) = explode("-",$target);
                $prefix = "`s_".$h1."_".$h2;
                
                foreach($data as $e2_key => $e2){
                    if(gettype($e2) === "array" && (gettype($e2["checked"]) !== "NULL")){
                        $update_clause .= $prefix."_".$e2_key."` = ".$e2["checked"].", ";                        
                    }

                    if(gettype($e2["1"]) === "array" && (gettype($e2["1"]["checked"]) !== "NULL")){
                        foreach($e2 as $e3_key => $e3){
                            if(gettype($e3) === "array" && (gettype($e3["checked"]) !== "NULL")){
                                $update_clause .= $prefix."_".$e2_key."_".$e3_key."` = ".$e3["checked"].", ";
                            }
                        }
                    }
                }

                $header_mask_test = "";
                foreach($header_mask_arr as $key_h1=>$mask_1){
                    $h2_mask = explode(",",$mask_1);
                    foreach($h2_mask as $key_h2=>$mask_2){
                        if(($key_h1+1) == intval($h1,10) && ($key_h2+1) == intval($h2,10)){
                            $mask_2 = intval($data["applicable_credits"],10) === 0? 0 :1;
                        }
                        $header_mask_new .= $mask_2;
                        $header_mask_new .= ",";
                    }
                    $header_mask_new = substr($header_mask_new,0,-1); // remove trailing ,
                    $header_mask_new .= ";";
                }
                $header_mask_new = substr($header_mask_new,0,-1); // remove trailing ;

                $update_clause .= " `applicable_credits` = {$applicable_credits}, `earned_credits` = {$earned_credits}, `bonus_credits` = {$bonus_credits}, `innovative_credits` = {$innovative_credits}, `innovative_credits_submitted_count` = {$innovative_credits_submitted_count}, `award_percentage` = {$award_percentage}, `award_category` = '{$award_category}', `header_mask` = '{$header_mask_new}', `h1_credits_applicable` = '{$h1_credits_applicable}', `h1_credits_earned` = '{$h1_credits_earned}'";
                $update_query = "UPDATE `UD_P_Projects` SET ".$update_clause." WHERE `project_id` like '".$id."' AND `user_id` like '".$_SESSION['user']->_id."'";
                if (!($u_stmt = $sql_conn->prepare($update_query))){
                    $resp["message"] =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
                    $resp["response"] = false;
                    return json_encode($resp);
                }
                
                if (!($ret = $u_stmt->execute())) {
                    $resp["message"] =  "Execute failed: (" . $u_stmt->errno . ") " . $u_stmt->error;
                    $resp["response"] = false;
                    return json_encode($resp);
                } else {
                    $resp["message"] =  $ret." q: ";//.$update_query;
                    $resp["response"] = true;
                }

                $u_stmt->close();
            }
        }

        $stmt->close();

        mysqli_close($sql_conn);
        return json_encode($resp);
    }
    
?>