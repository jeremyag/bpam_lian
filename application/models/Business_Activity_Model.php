<?php 
    class Business_Activity{
        public $id;
        public $application_id;
        public $line_of_business;
        public $no_of_units;
        public $capitalization;
        public $essential_receipts;
        public $non_essential_receipts;
    }

    class Business_Activity_Model extends CI_Model{
        public function insert($business_activity){
            $sql = "INSERT INTO `business_activity` VALUES (?,?,?,?,?,?,?)";

            $this->db->query($sql, $business_activity);

            return $this->db->insert_id();
        }
    }
?>