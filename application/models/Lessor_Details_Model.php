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

        public function get_lessor(){
            $CI =& get_instance();

            return $CI->Lessor_Model->get_lessor_from_id($this->lessor_id);
        }
    }

    class Lessor_Details_Model extends CI_Model{
        public function insert($lessor_details){
            $sql = "INSERT INTO `lessor_details` (`id`, `business_id`, `lessor_id`, `monthly_rental`) VALUES (?, ?, ?, ?)";

            $this->db->query($sql, $lessor_details);

            return $this->db->insert_id();
        }

        public function get_lessor_details_from_business_id($id){
            $sql = "SELECT * FROM lessor_details WHERE business_id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Lessor_Details');
        }
    }
?>