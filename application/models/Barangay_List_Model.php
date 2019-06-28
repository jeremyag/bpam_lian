<?php 
    class Barangay{
        public $id;
        public $name;
    }
    class Barangay_List_Model extends CI_Model{
        public function get_barangay_from_id($id){
            $sql = "SELECT * FROM `barangay_list` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Barangay');
        }

        public function update($id, $update){
            $sql = "UPDATE barangay_list SET `name` = ? WHERE id = $id";

            $this->db->query($sql, $update);
        }

        public function insert($values){
            $sql = "INSERT INTO barangay_list (`id`, `name`) VALUES (0,?)";

            $this->db->query($sql, $values);

            return $this->db->insert_id();
        }

        public function delete($id){
            $sql = "DELETE FROM barangay_list WHERE id = $id";

            $this->db->query($sql);
        }

        public function get_all(){
            $sql = "SELECT * FROM barangay_list";

            $query = $this->db->query($sql);

            return $query->result('Business_Category');
        }

        public function get_all_formatted(){
            $brgy = $this->get_all();

            $return = array();

            foreach($brgy as $b){
                $return = array_merge($return, array($b->name => $b->name));
            }

            return $return;
        }
    }
?>