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
                    "business"=>$this->Business_Model->get_business_from_id($this->input->get("business_id")),
                    "bd"=>$this->Business_Details_Model->get_business_details_from_id($this->input->get("bd_id"))
                ));
            }
        }

        public function business_address(){
            if($this->input->get("ba_id")){
                $this->load->view("business/business_address_view", array(
                    "ba"=>$this->Business_Address_Model->get_business_address_from_id($this->input->get("ba_id")),
                    "business" => $this->Business_Model->get_business_from_id($this->input->get("business_id"))
                ));
            }
        }

        public function owner_details(){
            if($this->input->get("o_id")){
                $this->load->view("business/owner_details_view", array(
                    "o"=>$this->Owner_Model->get_owner_from_id($this->input->get("o_id")),
                    "business" => $this->Business_Model->get_business_from_id($this->input->get("business_id"))
                ));
            }
        }

        public function emergency_contact_details(){
            if($this->input->get("ecd_id")){
                $this->load->view("business/emergency_contact_details_view", array(
                    "ecd"=>$this->Emergency_Contact_Details_Model->get_emergency_contact_details_from_id($this->input->get("ecd_id")),
                    "business" => $this->Business_Model->get_business_from_id($this->input->get("business_id"))
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
                    "l"=>$ld->get_lessor(),
                    "business" => $this->Business_Model->get_business_from_id($this->input->get("business_id"))
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

        public function business_details_form(){
            if($this->input->get("business_details_id")){
                $bd = $this->Business_Details_Model->get_business_details_from_id($this->input->get("business_details_id"));
                $business = $this->Business_Model->get_business_from_id($this->input->get("business"));
                $this->load->view(
                    "business/business_details_form",
                    array(
                        "bd" => $bd,
                        "business" => $business
                    )
                );
            }
        }

        public function business_details_form_submit(){
            if($this->input->post("business_details_id")){
                $this->Business_Details_Model->update(
                    $this->input->post("business_details_id"),
                    array(
                        "business_area" => $this->input->post("business_area"),
                        "total_no_employees" => $this->input->post("total_no_employees"),
                        "no_lgu_residing" => $this->input->post("no_lgu_residing")
                    )
                );
            }
            redirect(add_index().'_business?id='.$this->input->post("business_id"));
        }

        public function business_address_form(){
            if($this->input->get("business_address_id"))
            {
                $this->load->view(
                    "business/business_address_form",
                    array(
                        "ba" => $this->Business_Address_Model->get_business_address_from_id(
                            $this->input->get("business_address_id")
                        ),
                        "business" => $this->Business_Model->get_business_from_id(
                            $this->input->get("business_id")
                        ),
                        "brgy" => $this->Barangay_List_Model->get_all_formatted()
                    )
                );
            }
        }

        public function business_address_form_submit()
        {
            if($this->input->post("business_address_id"))
            {
                $this->Business_Address_Model->update(
                    $this->input->post("business_address_id"),
                    array(
                        "street" => $this->input->post("street"),
                        "brgy" => $this->input->post("brgy"),
                        "postal_code" => $this->input->post("postal_code"),
                        "email" => $this->input->post("email"),
                        "mobile" => $this->input->post("mobile"),
                        "telephone" => $this->input->post("telephone")
                    )
                );

                redirect(add_index().'_business?id='.$this->input->post("business_id"));
            }
        }

        public function owner_form()
        {
            if($this->input->get("owner_id"))
            {
                $this->load->view(
                    "business/owner_form",
                    array(
                        "o" => $this->Owner_Model->get_owner_from_id($this->input->get("owner_id")),
                        "business" => $this->Business_Model->get_business_from_id($this->input->get("business_id"))
                    )
                );
            }
        }

        public function owner_form_submit()
        {
            if($this->input->post("owner_id"))
            {
                $this->Owner_Model->update(
                    $this->input->post("owner_id"),
                    array(
                        "tin" => $this->input->post("tin"),
                        "last_name" => $this->input->post("last_name"),
                        "first_name" => $this->input->post("first_name"),
                        "middle_name" => $this->input->post("middle_name"),
                        "street" => $this->input->post("street"),
                        "brgy" => $this->input->post("brgy"),
                        "city" => $this->input->post("city"),
                        "province" => $this->input->post("province"),
                        "postal_code" => $this->input->post("postal_code"),
                        "email" => $this->input->post("email"),
                        "mobile" => $this->input->post("mobile"),
                        "telephone" => $this->input->post("telephone")
                    )
                );
            }

            redirect(add_index().'_business?id='.$this->input->post("business_id"));
        }

        public function emergency_contact_details_form()
        {
            if($this->input->get("emergency_contact_details_id"))
            {
                $this->load->view(
                    "business/emergency_contact_details_form",
                    array(
                        "ecd" => $this->Emergency_Contact_Details_Model->get_emergency_contact_details_from_id(
                            $this->input->get("emergency_contact_details_id")
                        ),
                        "business" => $this->Business_Model->get_business_from_id($this->input->get("business_id"))
                    )
                );
            }
        }

        public function emergency_contact_details_form_submit()
        {
            if($this->input->post("emergency_contact_details_id"))
            {
                $this->Emergency_Contact_Details_Model->update(
                    $this->input->post("emergency_contact_details_id"),
                    array(
                        "full_name" => $this->input->post("full_name"),
                        "telephone" => $this->input->post("telephone"),
                        "email" => $this->input->post("email")
                    )
                );
            }

            redirect(add_index().'_business?id='.$this->input->post("business_id"));
        }

        public function lessor_form()
        {
            if($this->input->get("lessor_id"))
            {
                $this->load->view(
                    "business/lessor_form",
                    array(
                        "ld" => $this->Lessor_Details_Model->get_lessor_details_from_id($this->input->get("lessor_details_id")),
                        "l" => $this->Lessor_Model->get_lessor_from_id($this->input->get("lessor_id")),
                        "business" => $this->Business_Model->get_business_from_id($this->input->get("business_id"))
                    )
                );
            }
        }

        public function lessor_form_submit()
        {
            if($this->input->post("lessor_id"))
            {
                $this->Lessor_Model->update(
                    $this->input->post("lessor_id"),
                    array(
                        "full_name" => $this->input->post("full_name"),
                        "full_address" => $this->input->post("full_address"),
                        "contact" => $this->input->post("contact"),
                        "email" => $this->input->post("email")
                    )
                );

                $this->Lessor_Details_Model->update(
                    $this->input->post("lessor_details_id"),
                    array(
                        "monthly_rental" => $this->input->post("monthly_rental")
                    )
                    );
            }

            redirect(add_index().'_business?id='.$this->input->post("business_id"));
        }
    }
?>