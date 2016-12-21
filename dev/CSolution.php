<?php
    include_once("helper.php");
    include_once("CUtil.php");

    class UD_S_Solution_Fig{
        public $fig_no;
        public $fig_caption;
    }

    class UD_S_Solution{

        public $sl_no;
        public $ref_no;
        public $item_no;
        public $standard_no;
        public $standard_text;
        public $prerequisite;
        public $goals;
        public $phases;
        public $points;
        public $fig_a_no;
        public $fig_a_caption;
        public $fig_a_alttag;
        public $fig_a_status;
        public $fig_b_no;
        public $fig_b_caption;
        public $fig_b_alttag;
        public $fig_b_status;
        public $fig_c_no;
        public $fig_c_caption;
        public $fig_c_alttag;
        public $fig_c_status;
        public $fig_d_no;
        public $fig_d_caption;
        public $fig_d_alttag;
        public $fig_d_status;
        public $fig_arr;

        public $h1;
        public $h2;
        public $h3;
        public $header_level;


        function populateFromDBRow( $row ){
            
            $this->sl_no = $row["sl_no"];
            $this->ref_no = $row["Ref#"];
            $this->item_no = $row["Item#"];
            $this->standard_no = $row["Standard#"];
            $this->standard_text = $row["Standard_Text"];
            $this->prerequisite = ($row["Prerequisite"] != '');
            $this->goals = $row["Goals"];
            $this->phases = $row["Phases"];
            $this->points = $row["Points"];

            $this->fig_arr = array();
            $this->fig_a_no = $row["FigA_No"];
            $this->fig_a_caption = $row["FigA_Caption"];
            $this->fig_a_alttag = $row["FigA_AltTag"];
            $this->fig_a_status = $row["FigA_Status"];
            if($this->fig_a_status != null && $this->fig_a_status === 'Latest Version'){
                $fig = new UD_S_Solution_Fig();
                $fig->fig_no = $this->fig_a_no;
                $fig->fig_no = Util::getEncodedFileName("solution_images/".$fig->fig_no);
                $fig->fig_caption = $this->fig_a_caption;
                $this->fig_arr[] = $fig;
            }
            $this->fig_b_no = $row["FigB_No"];
            $this->fig_b_caption = $row["FigB_Caption"];
            $this->fig_b_alttag = $row["FigB_AltTag"];
            $this->fig_b_status = $row["FigB_Status"];
            if($this->fig_b_status != null && $this->fig_b_status === 'Latest Version'){
                $fig = new UD_S_Solution_Fig();
                $fig->fig_no = $this->fig_b_no;
                $fig->fig_no = Util::getEncodedFileName("solution_images/".$fig->fig_no);                
                $fig->fig_caption = $this->fig_b_caption;
                $this->fig_arr[] = $fig;
            }
            $this->fig_c_no = $row["FigC_No"];
            $this->fig_c_caption = $row["FigC_Caption"];
            $this->fig_c_alttag = $row["FigC_AltTag"];
            $this->fig_c_status = $row["FigC_Status"];
            if($this->fig_c_status != null && $this->fig_c_status === 'Latest Version'){
                $fig = new UD_S_Solution_Fig();
                $fig->fig_no = $this->fig_c_no;
                $fig->fig_no = Util::getEncodedFileName("solution_images/".$fig->fig_no);
                $fig->fig_caption = $this->fig_c_caption;
                $this->fig_arr[] = $fig;
            }
            $this->fig_d_no = $row["FigD_No"];
            $this->fig_d_caption = $row["FigD_Caption"];
            $this->fig_d_alttag = $row["FigD_AltTag"];
            $this->fig_d_status = $row["FigD_Status"];
            if($this->fig_d_status != null && $this->fig_d_status === 'Latest Version'){
                $fig = new UD_S_Solution_Fig();
                $fig->fig_no = $this->fig_d_no;
                $fig->fig_no = Util::getEncodedFileName("solution_images/".$fig->fig_no);
                $fig->fig_caption = $this->fig_d_caption;
                $this->fig_arr[] = $fig;
            }

            $this->h1 = $row["H1#"];
            $this->h2 = $row["H2#"];
            $this->h3 = $row["H3#"];
            $this->header_level = $row["Head_Level"];
            
        }
    }
?>