<?php 
    class Emergency_Contact_Details{
        public $id;
        public $full_name;
        public $telephone;
        public $email;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->full_name = $arr['full_name'];
            $this->telephone = $arr['telephone'];
            $this->email = $arr['email'];
        }
    }
    
    class Emergency_Contact_Details_Model extends CI_Model{
        public function insert($emergency_contact_details){
            $sql = "INSERT INTO `emergency_contact_details` (`id`, `full_name`, `telephone`, `email`) VALUES (?,?,?,?)";

            $this->db->query($sql, $emergency_contact_details);

            return $this->db->insert_id();
        }

        public function update($id, $ecd){
            $update_column = build_update_columns($ecd);
            
            $sql = "UPDATE `emergency_contact_details` SET $update_column WHERE `id` = $id";

            $this->db->query($sql);
        }

        public function get_emergency_contact_details_from_id($id){
            $sql = "SELECT * FROM emergency_contact_details WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Emergency_Contact_Details');
        }
    }
?>