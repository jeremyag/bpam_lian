<?php
    class Verification_Document_Details{
        public $id;
        public $application_id;
        public $description;
        public $office_agency;
        public $remarks;
    }

    class Verification_Document_Details_Model extends CI_Model{
        public function insert($verification){
            $sql = "INSERT INTO verification_document_details (`id`, `application_id`, `description`, `office_agency`, `remarks`) VALUES (?, ?, ?, ?, ?)";

            $this->db->query($sql, $verification);

            return $this->db->insert_id();
        }

        public function update($verification){
            $values = array(
                "description" => $verification['desc'],
                "office" => $verification['office'],
                "remarks"=> $verification['remarks'],
                "id" => $verification['id']
            );

            $sql = "UPDATE verification_document_details
                    SET
                        `description` = ?,
                        `office_agency` = ?,
                        `remarks` = ?
                    WHERE
                        `id` = ?";

            $this->db->query($sql, $values);
        }

        public function get_verifications_from_application_id($id){
            $sql = "SELECT * FROM verification_document_details WHERE application_id = $id";

            $result = $this->db->query($sql);

            return $result->result('Verification_Document_Details');
        }
    }
?>