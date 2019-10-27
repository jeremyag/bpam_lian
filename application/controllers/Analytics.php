<?php
    class Analytics extends CI_Controller 
    {
        public function ranks()
        {
            // Rankings of Business Categories

            // Rankings of Type of Business
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