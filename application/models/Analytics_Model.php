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

        public function reports($type, $filter)
        {
            if($type == "application_by_status")
            {
                $sql = "SELECT
                            a.status,
                            COUNT(*) as `count`
                        FROM
                            application a
                        WHERE
                            1=1
                            $filter
                        GROUP BY
                            a.status
                        ORDER BY
                            `count` DESC";
            }
            elseif($type=="application_by_day")
            {
                $sql = "SELECT
                            a.date_of_application,
                            COUNT(*) as `count`
                        FROM
                            application a
                        WHERE
                            1=1
                            $filter
                        GROUP BY
                            a.date_of_application
                        ORDER BY
                            `count` DESC";
            }
            elseif($type == "business_by_status")
            {
                $sql = "SELECT
                                *
                        FROM
                            (
                            SELECT
                                COUNT(*) AS `count`,
                                'active' AS `status`
                            FROM
                                business b
                            INNER JOIN
                                license l
                                    ON
                                l.license_no = b.bp_no
                            WHERE
                                NOW() BETWEEN l.date_start AND l.date_end
                                AND b.isClosed <> 1

                            UNION

                            SELECT 
                                COUNT(*) AS `count`,
                                'no license' AS `status`
                            FROM
                                business b
                            WHERE
                                b.bp_no = ''
                                AND b.isClosed <> 1

                            UNION

                            SELECT
                                COUNT(*) AS `count`,
                                'expired license' AS `status`
                            FROM
                                business b
                            INNER JOIN
                                license l
                                    ON
                                l.license_no = b.bp_no
                            WHERE
                                NOW() NOT BETWEEN l.date_start AND l.date_end 
                                AND b.isClosed <> 1

                            UNION

                            SELECT
                                COUNT(*) AS `count`,
                                'closed'
                            FROM
                                business b
                            WHERE
                                b.isClosed = 1

                            ORDER BY `count` DESC
                        ) t
                        WHERE 
                            1=1
                            $filter";
            }

            $query = $this->db->query($sql);

            return $query->result();
        }
    }