<?php 
    class _Business extends CI_Controller{
        public function index(){
            if($this->input->get("id")){
                $this->load->view("admin/main_view", array(
                    "view"=>"business/business_view",
                    "business"=>$this->Business_Model->get_business_from_id($this->input->get("id"))
                ));
            }
        }

        public function business_details(){
            if($this->input->get("bd_id")){
                $this->load->view("business/business_details_view",array(
                    "bd"=>$this->Business_Details_Model->get_business_details_from_id($this->input->get("bd_id"))
                ));
            }
        }
    }
?>