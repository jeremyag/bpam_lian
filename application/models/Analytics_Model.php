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

        public function ranks($type = "business_categories", $filter = "")
        {
            if($type == "business_categories")
            {
                $sql = "SELECT
                            b.category,
                            COUNT(*) AS `count`
                        FROM
                            business b
                        WHERE 
                            1=1
                            $filter
                        GROUP BY
                            b.category
                        ORDER BY 
                            `count` DESC";
            }
            elseif($type == "business_type")
            {
                $sql = "SELECT
                            b.type as `business_type`,
                            COUNT(*) as `count`
                        FROM
                            business b
                        WHERE 
                            1=1
                            $filter
                        GROUP BY
                            b.type
                        ORDER BY
                            `count` DESC";
            }

            $query = $this->db->query($sql);

            return $query->result();
        }
    }