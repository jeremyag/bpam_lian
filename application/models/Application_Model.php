<?php
    class Application{
        public $id;
        public $code;
        public $isNew;
        public $date_of_application;
        public $amendment_from;
        public $amendment_to;
        public $municipality;
        public $business_id;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->code = $arr['code'];
            $this->isNew = $arr['isNew'];
            $this->date_of_application = $arr['date_of_application'];
            $this->amendment_from = $arr['amendment_from'];
            $this->amendment_to = $arr['amendment_to'];
            $this->municipality = $arr['municipality'];
            $this->business_id = $arr['business_id'];
        }

        public function get_type(){
            return ($this->isNew ? 'New' : 'Renewal');
        }

        public function get_date_of_application($format = 'Y-m-d'){
            $date = new DateTime($this->date_of_application);

            return $date->format($format);
        }

        public function get_business(){
            $CI =& get_instance();
            return $CI->Business_Model->get_business_from_id($this->business_id);
        }

        public function get_business_activities(){
            $CI =& get_instance();

            return $CI->Business_Activity_Model->get_business_activities_from_application_id($this->id);
        }
    }

    class Application_Model extends CI_Model{
        public function insert($application){
            $sql = "INSERT INTO `application` VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($sql, $application);

            return $this->db->insert_id();
        }

        public function get_all_application($order_by = "`id` DESC"){
            $sql = "SELECT * FROM `application` ORDER BY $order_by ";

            $applications = array();

            $result = $this->db->query($sql);

            foreach($result->result('Application') as $a){
                $applications[] = $a;
            }

            return $applications;
        }

        public function get_application_from_id($id){
            $sql = "SELECT * FROM `application` WHERE id = ?";

            $query = $this->db->query($sql, $id);

            return $query->row(0, 'Application');
        }
    }
?>