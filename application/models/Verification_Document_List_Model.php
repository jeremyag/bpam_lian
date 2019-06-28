<?php
    class Verification_Document_List{
        public $id;
        public $description;
        public $office_agency;
    }

    class Verification_Document_List_Model extends CI_Model{
        public function get_verification_document_list_from_id($id){
            $sql = "SELECT * FROM `verification_documents_list` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Verification_Document_List');
        }

        public function update($id, $document_value){
            $sql = "UPDATE verification_documents_list SET `description` = ?, `office_agency` = ? WHERE id = $id";

            $this->db->query($sql, $document_value);
        }

        public function insert($values){
            $sql = "INSERT INTO verification_documents_list (`id`, `description`, `office_agency`) VALUES (0,?,?)";

            $this->db->query($sql, $values);

            return $this->db->insert_id();
        }

        public function delete($id){
            $sql = "DELETE FROM verification_documents_list WHERE id = $id";

            $this->db->query($sql);
        }

        public function get_all(){
            $sql = "SELECT * FROM verification_documents_list";

            $query = $this->db->query($sql);

            return $query->result('Verification_Document_List');
        }
    }
?>