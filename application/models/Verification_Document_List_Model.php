<?php
    class Verification_Document_List{
        public $id;
        public $description;
        public $office_agency;
    }

    class Verification_Document_List_Model extends CI_Model{
        public function get_all(){
            $sql = "SELECT * FROM verification_documents_list";

            $query = $this->db->query($sql);

            return $query->result('Verification_Document_List');
        }
    }
?>