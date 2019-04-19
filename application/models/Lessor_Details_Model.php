<?php
    class Lessor_Details{
        public $id;
        public $lessor_id;
        public $business_id;
        public $monthly_rental;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->lessor_id = $arr['lessor_id'];
            $this->business_id = $arr['business_id'];
            $this->monthly_rental = $arr['monthly_rental'];
        }
    }

    class Lessor_Details_Model extends CI_Model{
        public function insert($lessor_details){
            $sql = "INSERT INTO `lessor_details` VALUES (?, ?, ?, ?)";

            $this->db->query($sql, $lessor_details);

            return $this->db->insert_id();
        }
    }
?>