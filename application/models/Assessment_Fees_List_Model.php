<?php 
    class Assessment_Fees_List{
        public $id;
        public $local_taxes;
    }
    class Assessment_Fees_List_Model extends CI_Model{
        public function get_all(){
            $sql = "SELECT * FROM assessment_fees_list";

            $query = $this->db->query($sql);

            return $query->result('Assessment_Fees_List');
        }
    }
?>