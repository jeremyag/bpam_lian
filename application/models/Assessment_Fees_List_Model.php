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

        public function get_assessments_from_id($id){
            $sql = "SELECT * FROM `assessment_fees_list` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Assessment_Fees_List');
        }

        public function insert($local_taxes){
            $sql = "INSERT INTO assessment_fees_list (`id`, `local_taxes`) VALUES (0,'$local_taxes')";

            $this->db->query($sql);

            return $this->db->insert_id();
        }

        public function update($assessment){
            $sql = "UPDATE assessment_fees_list SET local_taxes = ? WHERE id = ?";

            $this->db->query($sql, $assessment);

            return 1;
        }

        public function delete($assessment){
            $sql = "DELETE FROM assessment_fees_list WHERE id = $assessment";

            $this->db->query($sql);
        }
    }
?>