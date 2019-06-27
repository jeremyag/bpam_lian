<?php 
    class Lessor{
        public $id;
        public $full_name;
        public $full_address;
        public $contact;
        public $email;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->full_name = $arr['full_name'];
            $this->full_address = $arr['full_address'];
            $this->contact = $arr['contact'];
            $this->email = $arr['email'];
        }
    }

    class Lessor_Model extends CI_Model{
        public function insert($lessor){
            $sql = "INSERT INTO `lessor` (`id`, `full_name`, `full_address`, `contact`, `email`) VALUES (?, ?, ?, ?, ?)";

            $this->db->query($sql, $lessor);

            return $this->db->insert_id();
        }

        public function update($id, $l){
            $update_column = build_update_columns($l);
            
            $sql = "UPDATE `lessor` SET $update_column WHERE `id` = $id";

            $this->db->query($sql);
        }

        public function get_lessor_from_id($id){
            $sql = "SELECT * FROM lessor WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Lessor');
        }
    }
?>