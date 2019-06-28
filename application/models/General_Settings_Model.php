<?php 
    class General_Settings{
        public $id;
        public $name;
        public $settings_value;
    }

    class General_Settings_Model extends CI_Model{
        public function get_general_settings_from_id($id){
            $sql = "SELECT * FROM `general_settings` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'General_Settings');
        }

        public function update($id, $settings_value){
            $sql = "UPDATE general_settings SET `name` = ?, `settings_value` = ? WHERE id = $id";

            $this->db->query($sql, $settings_value);
        }
        public function get_all(){
            $sql = "SELECT * FROM general_settings";

            $query = $this->db->query($sql);

            return $query->result('General_Settings');
        }
    }
?>