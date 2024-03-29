<?php
    class Business_Address{
        public $id;
        public $street;
        public $brgy;
        public $postal_code;
        public $email;
        public $mobile;
        public $telephone;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->street = $arr['street'];
            $this->brgy = $arr['brgy'];
            $this->postal_code = $arr['postal_code'];
            $this->email = $arr['email'];
            $this->mobile = $arr['mobile'];
            $this->telephone = $arr['telephone'];
        }

        public function get_full_address(){
            $CI =& get_instance();
            return $this->street . ", " . $this->brgy . ", " . $CI->General_Settings_Model->get_municipality()->settings_value.", " .$CI->General_Settings_Model->get_province()->settings_value;
        }
    }

    class Business_Address_Model extends CI_Model{
        public function insert($business_address){
            $sql = "INSERT INTO `business_address` (`id`, `street`, `brgy`, `postal_code`, `email`, `mobile`, `telephone`) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($sql, $business_address);

            return $this->db->insert_id();
        }

        public function update($id, $ba){
            $update_column = build_update_columns($ba);
            
            $sql = "UPDATE `business_address` SET $update_column WHERE `id` = $id";

            $this->db->query($sql);
        }

        public function get_business_address_from_id($id){
            $sql = "SELECT * FROM `business_address` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Business_Address');
        }
    }
?>