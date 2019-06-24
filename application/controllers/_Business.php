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
    }
?>