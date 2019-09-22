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

        public function emergency_contact_details(){
            if($this->input->get("ecd_id")){
                $this->load->view("business/emergency_contact_details_view", array(
                    "ecd"=>$this->Emergency_Contact_Details_Model->get_emergency_contact_details_from_id($this->input->get("ecd_id"))
                ));
            }
        }

        public function applications(){
            if($this->input->get("b_id")){
                $this->load->view("business/applications_view", array(
                    "as"=>$this->Application_Model->get_all_application($filter = " AND a.`business_id` = ".$this->input->get("b_id"), $order_by = "a.`id` DESC", $limit = "0, 1000",$join = "", $type="all")
                ));
            }
        }

        public function lessor(){
            if($this->input->get("ld_id")){
                $ld = $this->Lessor_Details_Model->get_lessor_details_from_id($this->input->get("ld_id"));
                
                $this->load->view("business/lessor_view", array(
                    "ld"=>$ld,
                    "l"=>$ld->get_lessor()
                ));
            }
        }

        public function licenses(){
            if($this->input->get("b_id")){
                $this->load->view("business/licenses_view", array(
                    "l"=>$this->License_Model->get_licenses_from_business_id($this->input->get("b_id"))
                ));
            }
        }

        public function close_business(){
            if($this->input->post("business_id")){
                $this->Business_Model->update(
                    $this->input->post("business_id"),
                    array(
                        "isClosed" => "1"
                    )
                );
            }
            redirect(add_index().'_business?id='.$this->input->post("business_id"));
        }

        public function reopen_business(){
            if($this->input->post("business_id")){
                $this->Business_Model->update(
                    $this->input->post("business_id"),
                    array(
                        "isClosed" => "0"
                    )
                );
            }
            redirect(add_index().'_business?id='.$this->input->post("business_id"));
        }

        public function business_form_view(){
            if($this->input->get("business_id")){
                $business = $this->Business_Model->get_business_from_id($this->input->get("business_id"));
                $this->load->view(
                    "business/business_form_view",
                    array(
                        "business" => $business
                    )
                );
            }
        }

        public function business_form_submit(){
            if($this->input->post("business_id")){
                $this->Business_Model->update(
                    $this->input->post("business_id"),
                    array(
                        "trade_name" => $this->input->post("form_trade_name"),
                        "business_name" => $this->input->post("form_business_name"),
                        "mode_of_payment" => $this->input->post("form_mode_of_payment"),
                        "dti_reg_no" => $this->input->post("form_reg_no"),
                        "dti_reg_date" => $this->input->post("form_reg_date"),
                        "category" => $this->input->post("form_category"),
                        "type" => $this->input->post("form_type_of_business"),
                        "tax_incentives" => $this->input->post("form_tax_incentives")
                    )
                );
            }
            redirect(add_index().'_business?id='.$this->input->post("business_id"));
        }
    }
?>