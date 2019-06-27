<?php 
    class License{
        public $id;
        public $license_no;
        public $business_id;
        public $date_start;
        public $date_end;

        public function get_status(){
            if(date("Y-m-d") <= $this->date_end){
                return "Active";
            }
            return "Expired";
        }

        public function get_bootstrap_color(){
            if($this->get_status() == "Active"){
                return "success";
            }
            return "danger";
        }
    }

    class License_Model extends CI_Model{
        public function get_licenses_from_business_id($business_id, $type = "all"){
            if($type == "all"){
                $sql = "SELECT * FROM license WHERE business_id = $business_id";
            }
            elseif($type == "current"){
                $sql = "SELECT * FROM license WHERE business_id = $business_id AND id = (SELECT MAX(id) FROM license WHERE business_id = $business_id)";
            }

            $query = $this->db->query($sql);

            return $query->result("License");
        }

        public function get_licenses_from_application_id($application_id){
            $sql = "SELECT * FROM license WHERE application_id = $application_id";
            
            $query = $this->db->query($sql);

            if($query->result("License")){
                return $query->result("License");
            }
            else{
                return false;
            }
            
        }

        public function insert($array){
            $sql = "INSERT INTO license (id, license_no, date_start, date_end, business_id, application_id) VALUES ('', ?, ?, ?, ?, ?)";

            $this->db->query($sql, $array);

            $updata = sprintf("UPDATE `business` SET bp_no = '%s' WHERE id = %s", $array["license_no"], $array["business_id"]);

            $this->db->query($updata);

            return $this->db->insert_id();
        }
    }
?>