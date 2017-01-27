<?php
    include_once("CUserSession.php");
    include_once("CProject.php");
    include_once("helper.php");
    include_once("CUtil.php");

    class UD_Project_Info{

        public $sl_no;
        public $_id;
        public $creating_user_id;
        public $project_title;
        public $project_owner;
        public $project_architect;
        public $habitable_floor_area;
        public $site_area;
        public $project_cost;
        public $project_isud_creation_date;
        public $project_a_start_date;               // Anticipated start date
        public $project_a_end_date;                 // Anticipated end date
        public $building_type;
        public $contact_person;
        public $contact_email;
        public $contact_telephone;
        public $contact_telephone_c_code;
        public $project_address_line_1;
        public $project_address_line_2;
        public $project_city;
        public $project_state;
        public $project_country;
        public $project_zipcode;                    // Zipcode/Pincode
        public $isud_status;                        // 0 - in-progress, 1 - completed

        function populateFromDBRow( $row ){
            
            $this->sl_no = $row["sl_pr_no"];
            $this->_id = $row["_id"];
            $this->creating_user_id = $row["creating_user_id"];
            $this->project_title = $row["project_title"];
            $this->project_owner = $row["project_owner"];
            $this->project_architect = $row["project_architect"];
            $this->habitable_floor_area = $row["habitable_floor_area"];
            $this->site_area = $row["site_area"];
            $this->project_cost = $row["project_cost"];
            $this->project_isud_creation_date = $row["project_isud_creation_date"];
            $this->project_a_start_date = $row["project_a_start_date"];
            $this->project_a_end_date = $row["project_a_end_date"];
            $this->building_type = $row["building_type"];
            $this->contact_person = $row["project_contact_person"];
            $this->contact_email = $row["project_contact_email"];
            $this->contact_telephone = $row["project_contact_telephone"];
            $this->contact_telephone_c_code = $row["project_contact_telephone_c_code"];
            $this->project_address_line_1 = $row["project_address_line_1"];
            $this->project_address_line_2 = $row["project_address_line_2"];
            $this->project_city = $row["project_city"];
            $this->project_state = $row["project_state"];
            $this->project_country = $row["project_country"];
            $this->project_zipcode = $row["project_zipcode"];
            $this->isud_status = $row["isud_status"];
        }
        
    }
	
	// Getting Projects	
	function getProjectInfo($project_id){
        
		$sql_conn = mysqli_connection();
        if(isLoggedIn()){
            
            $where = "WHERE `creating_user_id` like '".$_SESSION['user']->_id."'";
            if($project_id != -1){
                $where = $where." AND `_id` like '".$project_id."'";
            }

            $sql = "SELECT * FROM  UD_P_Info INNER JOIN UD_P_Projects ON (`UD_P_Info`.`_id` = `UD_P_Projects`.`project_id`) ".$where." ORDER BY `UD_P_Info`.`sl_pr_no`";
            // my change to remove where clause to list all the project for admin

            // if user is admin show him all the projects
            if($_SESSION['user']->authtype_id == 1) {
                $sql = "SELECT * FROM  UD_P_Info INNER JOIN UD_P_Projects ON (`UD_P_Info`.`_id` = `UD_P_Projects`.`project_id`) ORDER BY `UD_P_Info`.`sl_pr_no`";
            }  
            $udProjectInfo = array();
            $res = array();
            try{
                $result = mysqli_query($sql_conn, $sql);
                while($row = mysqli_fetch_array($result)) {
                    //$project = new UD_Project_Info();
                    //$project->populateFromDBRow($row);

                    // hide fields
                    unset($row["creating_user_id"]);
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
    
    function createProjectInfo($project_title, $project_owner, $project_architect, $habitable_floor_area, $site_area, $project_cost,
                               $project_a_start_date, $project_a_end_date, $building_type, $contact_person, $contact_email, $contact_telephone, $contact_telephone_c_code, 
                               $project_address_line_1, $project_address_line_2, $project_city, $project_state, $project_country, $project_zipcode){
        $sql_conn = mysqli_connection();
        $sql_conn->begin_transaction();

        if(isLoggedIn()){
            $project = new UD_Project_Info();
            $project->_id = "pr_".Util::genRandText(10);
            $project->creating_user_id = $_SESSION['user']->_id;
            $project->project_title = $project_title;
            $project->project_owner = $project_owner;
            $project->project_architect = $project_architect;
            $project->habitable_floor_area = $habitable_floor_area;
            $project->site_area = $site_area;
            $project->project_cost = $project_cost;
            $project->project_a_start_date = $project_a_start_date." 00:00:00";
            $project->project_a_end_date = $project_a_end_date." 00:00:00";
            $project->building_type = $building_type;
            $project->contact_person = $contact_person;
            $project->contact_email = $contact_email;
            $project->contact_telephone = $contact_telephone;
            $project->contact_telephone_c_code = $contact_telephone_c_code;
            $project->project_address_line_1 = $project_address_line_1;
            $project->project_address_line_2 = $project_address_line_2;
            $project->project_city = $project_city;
            $project->project_state = $project_state;
            $project->project_country = $project_country;
            $project->project_zipcode = $project_zipcode;


            $project = Util::escapeObject($project);
            $ret["response"] = false;
            //$ret["data"] = var_dump($project);
            if (!($stmt = $sql_conn->prepare("INSERT INTO `UD_P_Info`(_id, creating_user_id, project_title, project_owner, project_architect, habitable_floor_area, site_area,
                                            project_cost, project_a_start_date, project_a_end_date, building_type, project_contact_person, project_contact_email, project_contact_telephone, project_contact_telephone_c_code,
                                            project_address_line_1, project_address_line_2, project_city, project_state, project_country, project_zipcode) 
                                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))){
                $ret["message"] =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error." ll";
                return $ret;
            }

            if(!($stmt->bind_param("sssssdddsssssssssssss",
                            $project->_id,
                            $project->creating_user_id,
                            $project->project_title,
                            $project->project_owner,
                            $project->project_architect,
                            $project->habitable_floor_area,
                            $project->site_area,
                            $project->project_cost,
                            $project->project_a_start_date,
                            $project->project_a_end_date,
                            $project->building_type,
                            $project->contact_person,
                            $project->contact_email,
                            $project->contact_telephone,
                            $project->contact_telephone_c_code,
                            $project->project_address_line_1,
                            $project->project_address_line_2,
                            $project->project_city,
                            $project->project_state,
                            $project->project_country,
                            $project->project_zipcode
                        ))){
                $ret["message"] =  "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
                return ret; 
            }

            $res = $stmt->execute();
            $stmt->close();

            //Setup main project
            $projectReturnVal = createProject($sql_conn, $project->_id, $project->creating_user_id, 100, 0, 0, 0, 0, 0.0, "None");

            if (!($res && $projectReturnVal["response"])) {
                $ret["message"] =  "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $ret["message"] .= "Execute failed: ".$projectReturnVal["message"];
                $sql_conn->rollBack();
            } else {
                $ret["response"] = true;
                $ret["message"] = $res;
                $sql_conn->commit();
            }

        
            
        } else {
            $ret["message"] = "Error : User not logged in";
        }
        mysqli_close($sql_conn);
        
        return $ret;
    }
	
    
    function updateProjectInfo($_id, $project_title, $project_owner, $project_architect, $habitable_floor_area, $site_area, $project_cost,
                               $project_a_start_date, $project_a_end_date, $building_type, $contact_person, $contact_email, $contact_telephone, $contact_telephone_c_code, 
                               $project_address_line_1, $project_address_line_2, $project_city, $project_state, $project_country, $project_zipcode, $isud_status = 0){
        $sql_conn = mysqli_connection();

        $project = new UD_Project_Info();
        $project->_id = $_id;
        $project->project_title = $project_title;
        $project->project_owner = $project_owner;
        $project->project_architect = $project_architect;
        $project->habitable_floor_area = $habitable_floor_area;
        $project->site_area = $site_area;
        $project->project_cost = $project_cost;
        $project->project_a_start_date = $project_a_start_date." 00:00:00";
        $project->project_a_end_date = $project_a_end_date." 00:00:00";
        $project->building_type = $building_type;
        $project->contact_person = $contact_person;
        $project->contact_email = $contact_email;
        $project->contact_telephone = $contact_telephone;
        $project->contact_telephone_c_code = $contact_telephone_c_code;
        $project->project_address_line_1 = $project_address_line_1;
        $project->project_address_line_2 = $project_address_line_2;
        $project->project_city = $project_city;
        $project->project_state = $project_state;
        $project->project_country = $project_country;
        $project->project_zipcode = $project_zipcode;
        $project->isud_status = $isud_status;

        $project = Util::escapeObject($project);
        $fields = " `project_title` = ?, 
                    `project_owner` = ?,
                    `project_architect` = ?,
                    `habitable_floor_area` = ?,
                    `site_area` = ?,
                    `project_cost` = ?,
                    `project_a_start_date` = ?,
                    `project_a_end_date` = ?,
                    `building_type` = ?,
                    `project_contact_person` = ?,
                    `project_contact_email` = ?,
                    `project_contact_telephone` = ?,
                    `project_contact_telephone_c_code` = ?,
                    `project_address_line_1` = ?,
                    `project_address_line_2` = ?,
                    `project_city` = ?,
                    `project_state` = ?,
                    `project_country` = ?,
                    `project_zipcode` = ?,
                    `isud_status` = ?";
        $param = "sssdddssssssssssssss";
        $query = "UPDATE `UD_P_Info` SET ".$fields." WHERE _id = ?";
        $param .= "s";

        if (!($stmt = $sql_conn->prepare($query))){
            $resp["message"] =  "Prepare failed: (" . $sql_conn->errno . ") " . $sql_conn->error;
            $resp["response"] = false;
        }

        if(!($stmt->bind_param($param,
                            $project->project_title,
                            $project->project_owner,
                            $project->project_architect,
                            $project->habitable_floor_area,
                            $project->site_area,
                            $project->project_cost,
                            $project->project_a_start_date,
                            $project->project_a_end_date,
                            $project->building_type,
                            $project->contact_person,
                            $project->contact_email,
                            $project->contact_telephone,
                            $project->contact_telephone_c_code,
                            $project->project_address_line_1,
                            $project->project_address_line_2,
                            $project->project_city,
                            $project->project_state,
                            $project->project_country,
                            $project->project_zipcode,
                            $project->isud_status,
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
    
?>