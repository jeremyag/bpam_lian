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
            $sql = "INSERT INTO `business_activity` (`id`, `application_id`, `line_of_business`, `no_of_units`, `capitalization`, `essential_receipts`, `non_essential_receipts`) VALUES (?,?,?,?,?,?,?)";

            $this->db->query($sql, $business_activity);

            return $this->db->insert_id();
        }

        public function get_business_activities_from_application_id($id){
            $sql = "SELECT * FROM business_activity WHERE application_id = ?";

            $query = $this->db->query($sql, $id);

            return $query->result("Business_Activity");
        }

        public function get_business_activity_from_id($id){
            $sql = "SELECT * FROM business_activity WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->result("Business_Activity")[0];
        }

        public function delete($id){
            $sql = "DELETE FROM business_activity WHERE id = $id";

            $this->db->query($sql);
        }
    }
?>