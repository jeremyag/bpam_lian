<?php
    class Analytics_Model extends CI_Model {
        public function getCount($type = "finished-applications", $filter = "")
        {
            if($type == "finished-applications")
            {
                $sql = "SELECT 
                            COUNT(*) as finished_count 
                        FROM `application` a
                        INNER JOIN `license` l
                            ON a.id = l.application_id";
            }
            else{
                $sql = "SELECT COUNT(*) as count FROM `application` WHERE 1=1 $filter";
            }

            $query = $this->db->query($sql);

            return $query->row(0);
        }
    }