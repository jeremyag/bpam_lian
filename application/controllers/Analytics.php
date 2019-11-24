<?php
    class Analytics extends CI_Controller 
    {
        public function ranks()
        {
            header('Content-Type: application/json');

            $result = array();
            $filter = "";

            if(!$this->input->get("openOnly"))
            {
                $filter .= "AND b.isClosed <> 1 "; 
            }

            // Rankings of Business Categories
            if($this->input->get("business_categories"))
            {

                if($this->input->get("included"))
                {
                    $included = explode(",", $this->input->get("included"));

                    $filter .= "AND b.category IN ( ";
                    for($i = 0; $i < count($included); $i++)
                    {
                        if($i == count($included)-1)
                        {
                            $filter .= "'".$included[$i]."'";
                        }
                        else
                        {
                            $filter .= "'".$included[$i]. "', ";
                        }
                    }
                    $filter .= " ) ";
                }
                $query = $this->Analytics_Model->ranks("business_categories", $filter);
                if($query)
                {
                    foreach($query as $q)
                    {
                        $result["category"][] = $q->category;
                        $result["count"][] = $q->count;
                    }
                }
            }

            if($this->input->get("business_type"))
            {
                if($this->input->get("included"))
                {
                    $included = explode(",", $this->input->get("included"));

                    $filter .= "AND b.type IN ( ";
                    for($i = 0; $i < count($included); $i++)
                    {
                        if($i == count($included) - 1)
                        {
                            $filter .= "'".$included[$i]."'";
                        }
                        else
                        {
                            $filter .= "'".$included[$i]."'";
                        }
                    }
                    $filter .= " ) ";
                }

                $query = $this->Analytics_Model->ranks("business_type", $filter);
                if($query)
                {
                    foreach($query as $q)
                    {
                        $result["business_type"][] = $q->business_type;
                        $result["count"][] = $q->count;
                    }
                }
            }

            // Rankings of Type of Business

            echo json_encode($result);
        }

        public function report()
        {
            // Reports of Businesses by Status

            // Reports of applications by status

            // Reports of applicaitons by day

            // New vs Renewals
        }

        public function card()
        {
            header('Content-Type: application/json');

            $result = array();
            // Total no of applications
            if($this->input->get("total_no_of_applications"))
            {
                $r = ($this->Analytics_Model->getCount("applications"));
                
                $result = array(
                    "total_no_of_applications" => $r->count
                );
            }
            elseif($this->input->get("total_no_of_unfinished_applications"))
            {
                $r = $this->Analytics_Model->getCount("applications");
                $r1 = $this->Analytics_Model->getCount("finished-applications");

                $result = array(
                    "total_no_of_unfinished_applications" => $r->count - $r1->finished_count
                );
            }
            elseif($this->input->get("total_no_of_finished_applications"))
            {
                $r = $this->Analytics_Model->getCount("finished-applications");

                $result = array(
                    "total_no_of_finished_applications" => $r->finished_count
                );
            }
            else{
                $r = $this->Analytics_Model->getCount("applications");
                $r1 = $this->Analytics_Model->getCount("finished-applications");

                $result = array(
                    "total_no_of_applications" => intval($r->count),
                    "total_no_of_unfinished_applications" => intval($r->count - $r1->finished_count),
                    "total_no_of_finished_applications" => intval($r1->finished_count)
                );
            }

            echo json_encode($result);
        }

        public function reports()
        {
            header('Content-Type: application/json');

            $result = array();
            $inList = "";
            if($this->input->get("included"))
            {
                $included = explode(",", $this->input->get("included"));

                for($i = 0; $i < count($included); $i++)
                {
                    if($i == count($included)-1)
                    {
                        $inList .= "'".$included[$i]."'";
                    }
                    else
                    {
                        $inList .= "'".$included[$i]. "', ";
                    }
                }
            }

            if($this->input->get("between"))
            {
                $between = explode(",", $this->input->get("between"));
            }

            if($this->input->get("application_by_status"))
            {
                if($this->input->get("included"))
                {
                    $filter = "AND a.status IN ( $inList ) ";
                }
                $query = $this->Analytics_Model->reports("application_by_status", $filter);

                if($query)
                {
                    foreach($query as $q)
                    {
                        $result["status"][] = $q->status;
                        $result["count"][] = $q->count;
                    }
                }
            }

            if($this->input->get("application_by_day"))
            {
                if($this->input->get("between"))
                {
                    $filter = sprintf(
                        " AND a.date_of_application BETWEEN '%s' AND '%s'",
                        $between[0], $between[1]
                    );
                }

                $query = $this->Analytics_Model->reports("application_by_day", $filter);

                if($query)
                {
                    foreach($query as $q)
                    {
                        $result["date_of_application"][] = $q->date_of_application;
                        $result["count"][] = $q->count;
                    }
                }
            }

            if($this->input->get("business_by_status"))
            {
                if($this->input->get("included"))
                {
                    $filter = "AND t.status IN ( $inList ) ";
                }
                $query = $this->Analytics_Model->reports("business_by_status", $filter);

                if($query)
                {
                    foreach($query as $q)
                    {
                        $result["status"][] = $q->status;
                        $result["count"][] = $q->count;
                    }
                }
            }

            echo json_encode($result);
        }
    }