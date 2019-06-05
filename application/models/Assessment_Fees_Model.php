<?php 
    class Assessment_Fees{
        public $id;
        public $application_id;
        public $local_taxes;
        public $amount_due;
        public $penalty_subcharge;

        public function get_total(){
            return $this->amount_due + $this->penalty_subcharge;
        }
    }

    class Assessment_Fees_Model extends CI_Model{
        public function insert($assessment){
            $sql = "INSERT INTO assessment_fees VALUES (?, ?, ?, ?, ?)";

            $this->db->query($sql, $assessment);

            return $this->db->insert_id();
        }

        public function get_assessments_from_application_id($application_id){
            $sql = "SELECT * FROM assessment_fees WHERE application_id = $application_id";

            $result = $this->db->query($sql);

            return $result->result('Assessment_Fees');
        }
    }
?>