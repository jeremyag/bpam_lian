<?php
    class Owner{
        public $id;
        public $tin;
        public $last_name;
        public $first_name;
        public $middle_name;
        public $street;
        public $brgy;
        public $city;
        public $province;
        public $postal_code;
        public $email;
        public $mobile;
        public $telephone;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->tin = $arr['tin'];
            $this->last_name = $arr['last_name'];
            $this->first_name = $arr['first_name'];
            $this->middle_name = $arr['middle_name'];
            $this->street = $arr['street'];
            $this->brgy = $arr['brgy'];
            $this->city = $arr['city'];
            $this->province = $arr['province'];
            $this->postal_code = $arr['postal_code'];
            $this->email = $arr['email'];
            $this->mobile = $arr['mobile'];
            $this->telephone = $arr['telephone'];
        }

        public function get_full_name(){
            return $this->first_name . " " . $this->middle_name . " " . $this->last_name;
        }

        public function get_full_address(){
            return $this->street . ", " . $this->brgy . ", " . $this->city .", ".$this->province;
        }
    }

    class Owner_Model extends CI_Model{
        public function insert($owner){
            $sql = "INSERT INTO `owner` (`id`, `tin`, `last_name`, `first_name`, `middle_name`, `street`, `brgy`, `city`, `province`, `postal_code`, `email`, `mobile`, `telephone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($sql, $owner);

            return $this->db->insert_id();
        }

        public function update($id, $owner){
            $update_column = build_update_columns($owner);
            
            $sql = "UPDATE `owner` SET $update_column WHERE `id` = $id";

            $this->db->query($sql);
        }

        public function get_owner_from_id($id){
            $sql = "SELECT * FROM `owner` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Owner');
        }
    }
?>