<?php
    include_once("helper.php");
    include_once("CUtil.php");

    class UD_S_Header{

        public $sl_no;
        public $header_level;
        public $header_text;
        public $h1;
        public $h1_title;
        public $h1_points;
        public $h2;
        public $h2_title;
        public $h2_points;
        public $h3;
        public $h3_title;
        public $h3_points;
        public $credits;
        public $item_count;
        public $min_points_1;
        public $min_points_2;
        public $min_points_3;
        public $instruction;
        public $design_resource;

        // references to the elements
        public $h2_elems;
        public $h3_elems;
        public $solutions; 

        function populateFromDBRow( $row ){
            
            $this->sl_no = $row["sl_no"];
            $this->header_text = $row["Credit"];
            $this->header_level = $row["Head_Level"];
            $this->h1 = $row["H1#"];
            $this->h1_title = $row["H1_Ch_Title"];
            $this->h1_points = $row["H1_Credits"];
            $this->h2 = $row["H2#"];
            $this->h2_title = $row["H2_Sec_Title"];
            $this->h2_points = $row["H2_Credits"];
            $this->h3 = $row["H3#"];
            $this->h3_title = $row["H3_Sec_Title"];
            $this->h3_points = $row["H3_Credits"];
            $this->credits = $row["Credits"];
            $this->item_count = $row["Item_Count"];
			$this->min_points_1 = $row["Min_Points_1"];
			$this->min_points_2 = $row["Min_Points_2"];
			$this->min_points_3 = $row["Min_Points_3"];
			$this->instruction = $row["Instruction"];
			$this->design_resource = $row["Design_Resource"];

			$this->design_resource = Util::getEncodedFileName("Docs/content/".$this->design_resource);
            
            // Elems
			$this->h2_elems = array();
			$this->h3_elems = array();
			$this->solutions = array();
        }
    }
?>