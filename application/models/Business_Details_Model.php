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
            $sql = "INSERT INTO business_details (`id`, `business_area`, `total_no_employees`, `no_lgu_residing`) VALUES (?, ?, ?, ?)";

            $this->db->query($sql, $business_details);

            return $this->db->insert_id();
        }

        public function update($id, $bd){
            $update_column = build_update_columns($bd);
            
            $sql = "UPDATE `business_details` SET $update_column WHERE `id` = $id";

            $this->db->query($sql);
        }

        public function get_business_details_from_id($id){
            $sql = "SELECT * FROM business_details WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, "Business_Details");
        }
    }
?>