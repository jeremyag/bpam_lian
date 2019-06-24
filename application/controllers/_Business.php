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

        public function business_address(){
            if($this->input->get("ba_id")){
                $this->load->view("business/business_address_view", array(
                    "ba"=>$this->Business_Address_Model->get_business_address_from_id($this->input->get("ba_id"))
                ));
            }
        }

        public function owner_details(){
            if($this->input->get("o_id")){
                $this->load->view("business/owner_details_view", array(
                    "o"=>$this->Owner_Model->get_owner_from_id($this->input->get("o_id"))
                ));
            }
        }
    }
?>