<?php
    class Table_Model extends CI_Model{
        public function get_columns($table_name){
            $columns = array();
            if($table_name != ""){
                $sql = "SHOW COLUMNS FROM $table_name";
                
                $columns_result = $this->db->query($sql);

                foreach($columns_result->result_array() as $row){
                    array_push($columns, $row["Field"]);
                }
            }

            return $columns;
        }
    }
?>