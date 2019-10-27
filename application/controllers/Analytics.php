<?php
    class Analytics extends CI_Controller 
    {
        public function ranks()
        {
            header('Content-Type: application/json');

            $result = array();
            $filter = "";

            // Rankings of Business Categories
            if($this->input->get("business_categories"))
            {

                if(!$this->input->get("isClosed"))
                {
                    $filter .= "AND b.isClosed <> 1 "; 
                }

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
    }