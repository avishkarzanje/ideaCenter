<?php
    include_once("helper.php");
    include_once("CHeader.php");
    include_once("CSolution.php");

    class UDStandard{
        
        public $header;
        
        // function __construct(){
        //     $headers = array();
        // }

        // function populateFromDBRow( $row ){
            
        //     $this->ref = $row["Ref"];
        //     $this->h1 = $row["H1"];
        //     $this->h1_title = $row["H1_Title"];
        //     $this->h2 = $row["H2"];
        //     $this->h2_title = $row["H2_Title"];
        //     $this->h3 = $row["H3"];
        //     $this->h3_title = $row["H3_Title"];
        //     $this->h4 = $row["H4"];
        //     $this->h4_title = $row["H4_Title"];
        //     $this->standard_no = $row["Standard_No"];
		// 	$this->standard_text = $row["Standard_Text"];
		// 	$this->item_no = $row["Item_No"];
		// 	$this->points = $row["Points"];
		// 	$this->critical = $row["Critical"];
            
        //     // Goals
		// 	$this->goal_awareness = $row["Goal_Awareness"];
		// 	$this->goal_body_fit = $row["Goal_Body_Fit"];
		// 	$this->goal_comfort = $row["Goal_Comfort"];
		// 	$this->goal_cultural_appropriateness = $row["Goal_Cultural_Appropriateness"];
		// 	$this->goal_personalization = $row["Goal_Personalization"];
		// 	$this->goal_social_participation = $row["Goal_Social_Participation"];
		// 	$this->goal_understanding = $row["Goal_Understanding"];
		// 	$this->goal_wellness = $row["Goal_Wellness"];
            
        //     // Phases
        //     $this->phase_close = $row["Phase_Close"];
		// 	$this->phase_construct = $row["Phase_Construct"];
		// 	$this->phase_design = $row["Phase_Design"];
		// 	$this->phase_initiate = $row["Phase_Initiate"];
		// 	$this->phase_operations = $row["Phase_Operations"];
        //     $this->phase_plan = $row["Phase_Plan"];


            
            
        // }
        
    }
	
	// Getting Standards	
	function getStandards($H1_No){
        
		$sql_conn = mysqli_connection();
        if($H1_No != -1){

            //get all for Screen reader version
            if($H1_No === "sr"){
                $H1_No = "";
            }

            $where = "WHERE `Credit` like '".$H1_No."%'";  
            $sql = "SELECT  * FROM  UD_S_Headings ".$where." ORDER BY `H1#`, `H2#`, `H3#`";
            $udStandard = new UDStandard();
            $res = array();

            $result = mysqli_query($sql_conn, $sql);
            while($row = mysqli_fetch_array($result)) {
                $header = new UD_S_Header();
                $header->populateFromDBRow($row);

                if($header->header_level === "H1"){
                    $udStandard = new UDStandard();
                    $udStandard->header = $header;
                    $res[$header->h1] = $udStandard;
                } else if($header->header_level === "H2"){
                    $res[$header->h1]->header->h2_elems[$header->h2] = $header;
                } else if($header->header_level === "H3"){
                    $res[$header->h1]->header->h2_elems[$header->h2]->h3_elems[$header->h3] = $header;
                } 
            }

            $where = "WHERE `Standard#` like '".$H1_No."%'";  
            $sql = "SELECT  * FROM  UD_S_Solutions ".$where." ORDER BY `H1#`, `H2#`, `H3#`, `Item#`, `Standard#`";
            
            $result = mysqli_query($sql_conn, $sql);
            while($row = mysqli_fetch_array($result)) {
                $solution = new UD_S_Solution();
                $solution->populateFromDBRow($row);

                if(substr_count($solution->standard_no,".") === 1){
                    $res[$solution->h1]->header->solutions[$solution->item_no] = $solution;
                } else if(substr_count($solution->standard_no,".") === 2){
                    $res[$solution->h1]->header->h2_elems[$solution->h2]->solutions[$solution->item_no] = $solution;
                } else if(substr_count($solution->standard_no,".") === 3){
                    $res[$solution->h1]->header->h2_elems[$solution->h2]->h3_elems[$solution->h3]->solutions[$solution->item_no] = $solution;
                } 
            }

        } else {
            $where = "";  
            $sql = "SELECT  * FROM  UD_S_Headings ".$where." ORDER BY `H1#`, `H2#`, `H3#`";
            $udStandard = new UDStandard();
            $res = array();

            $result = mysqli_query($sql_conn, $sql);
            while($row = mysqli_fetch_array($result)) {
                $header = new UD_S_Header();
                $header->populateFromDBRow($row);

                if($header->header_level === "H1"){
                    $udStandard = new UDStandard();
                    $udStandard->header = $header;
                    $res[$header->h1] = $udStandard;
                } else if($header->header_level === "H2"){
                    $res[$header->h1]->header->h2_elems[$header->h2] = $header;
                } else if($header->header_level === "H3"){
                    $res[$header->h1]->header->h2_elems[$header->h2]->h3_elems[$header->h3] = $header;
                } 
            }
        }
        
        mysqli_close($sql_conn);
        $r = json_encode($res);
        return $r;
		
	}
    
    function getPhaseColumnNames(){
        $sql_conn = mysqli_connection();
        $sql = 'SELECT `phase_text` FROM UD_S_Phases';
        $result = mysqli_query($sql_conn,$sql);
        $res = array();
        while($row = mysqli_fetch_array($result)) {
            $res[] = $row["phase_text"];
        }
        
        mysqli_close($sql_conn);
        $r = json_encode($res);
        return $r;
    }
	
    
    function getGoalColumnNames(){
        $sql_conn = mysqli_connection();
        $sql = 'SELECT `goal_text` FROM UD_S_Goals';
        $result = mysqli_query($sql_conn,$sql);
        $res = array();
        while($row = mysqli_fetch_array($result)) {
            $res[] = $row["goal_text"];
        }
        
        mysqli_close($sql_conn);
        $r = json_encode($res);
        return $r;
    }
    
?>