<?php 
    class Business_Category{
        public $id;
        public $name;
        public $definition;
    }

    class Business_Categories_List_Model extends CI_Model{
        public function get_business_category_from_id($id){
            $sql = "SELECT * FROM `business_categories_list` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Business_Category');
        }

        public function update($id, $update){
            $sql = "UPDATE business_categories_list SET `name` = ?, `definition` = ? WHERE id = $id";

            $this->db->query($sql, $update);
        }

        public function insert($values){
            $sql = "INSERT INTO business_categories_list (`id`, `name`, `definition`) VALUES (0,?,?)";

            $this->db->query($sql, $values);

            return $this->db->insert_id();
        }

        public function delete($id){
            $sql = "DELETE FROM business_categories_list WHERE id = $id";

            $this->db->query($sql);
        }

        public function get_all(){
            $sql = "SELECT * FROM business_categories_list";

            $query = $this->db->query($sql);

            return $query->result('Business_Category');
        }

        public function get_all_formatted(){
            $category = $this->get_all();

            $return = array();

            foreach($category as $c){
                $return = array_merge($return, array($c->name => $c->name));
            }

            return $return;
        }
    }
?>