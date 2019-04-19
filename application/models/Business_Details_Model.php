<?php 
    class Business_Details{
        public $id;
        public $business_area;
        public $total_no_employees;
        public $no_lgu_residing;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->business_area = $arr['business_area'];
            $this->total_no_employees = $arr['total_no_employees'];
            $this->no_lgu_residing = $arr['no_lgu_residing'];
        }
    }

    class Business_Details_Model extends CI_Model{
        public function insert($business_details){
            $sql = "INSERT INTO business_details VALUES (?, ?, ?, ?)";

            $this->db->query($sql, $business_details);

            return $this->db->insert_id();
        }
    }
?>