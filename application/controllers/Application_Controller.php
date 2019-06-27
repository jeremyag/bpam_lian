<?php 
    class Application_Controller extends CI_Controller{
        public function application_list(){
            $this->load->view("applications/application_list",array(
                "total"=>compute_pages($this->Application_Model->count(
                    $filter="",
                    $join = ""
                ), 20),
                "current_page"=>1
            ));
        }

        public function application_rows(){
            $filter = $this->build_filter_status($this->input->get("sort_status"));
            
            $sort_filter = $this->input->get("sort_filter");
            if($sort_filter["activated"] == "true"){
                $filter .= $this->filter(
                    $filter = $filter,
                    $application_no = $sort_filter["application_no"],
                    $type = $sort_filter["type"],
                    $business_name = $sort_filter["business_name"],
                    $start_date_of_application = $sort_filter["start_date_of_application"],
                    $end_date_of_application = $sort_filter["end_date_of_application"],
                    $dti_reg_no = $sort_filter["dti_reg_no"],
                    $first_name = $sort_filter["first_name"],
                    $last_name = $sort_filter["last_name"]
                );
            };

            if($this->input->get("sort_keyword") != ""){
                $filter .= $this->search($this->input->get("sort_keyword"));
            }

            $order_by = $this->input->get("sort_field")." ".$this->input->get("sort_sort");

            $start_page = $this->input->get("sort_start_page");

            $per_page = $this->input->get("sort_per_page");

            $limit = "$start_page, $per_page";

            $limit = "";

            $join = "INNER JOIN
                        `business` b
                            ON a.business_id = b.id
                    INNER JOIN
                        `owner` o
                            ON b.owner_id = o.id
                    INNER JOIN
                        `business_address` ba
                            ON ba.id = b.business_address_id";

            $count = $this->Application_Model->count(
                $filter = $filter, 
                $join = $join
            );

            $applications = $this->Application_Model->get_all_application(
                $filter = $filter, 
                $order_by = $order_by, 
                $limit = $limit,
                $join = $join, 
                $type="all"
            );

            $this->load->view("applications/application_rows", array(
                "applications" => $applications,
                "per_page" => $per_page,
                "curr_page" => 1,
                "start_page" => $start_page,
                "total" => $this->Application_Model->count(
                    $filter,
                    $join
                )
            ));
        }

        private function build_filter_status($status){
            if($status == "all"){
                $filter = "";
            }
            elseif($status == "unverified"){
                $filter = "AND 
                            (SELECT IF(
                                (SELECT COUNT(*) FROM verification_document_details WHERE application_id = a.id) > 0,
                                1,
                                0
                            )) = 0 ";
            }
            elseif($status == "missing_docs"){
                $filter = "AND
                            (SELECT IF(
                                (SELECT COUNT(*) FROM verification_document_details WHERE application_id = a.id AND remarks = 'No') > 0,
                            1,
                            0
                            )) = 1 ";
            }
            elseif($status == "assessment"){
                $filter = "AND (((SELECT IF(
                                (SELECT COUNT(*) FROM verification_document_details WHERE application_id = a.id) > 0,
                                1,
                                0
                            )) = 1) AND ((SELECT IF(
                                (SELECT COUNT(*) FROM verification_document_details WHERE application_id = a.id AND remarks = 'No') > 0,
                            1,
                            0
                            )) = 0)) AND
                            (SELECT IF(
                                (SELECT COUNT(*) FROM assessment_fees WHERE application_id = a.id) > 0,
                            1,
                            0
                            )) = 0 ";
            }
            elseif($status == "done"){
                $filter = "AND
                            (SELECT IF(
                                (SELECT COUNT(*) FROM assessment_fees WHERE application_id = a.id) > 0,
                            1,
                            0
                            )) = 1
                            AND
                                (SELECT IF(
                                    (SELECT 
                                        COUNT(*)
                                    FROM
                                        license
                                    WHERE application_id = a.id) > 0, 1, 0
                                )) = 1";
            }
            elseif($status == "needs-license"){
                $filter = "AND
                            (SELECT IF(
                                (SELECT COUNT(*) FROM assessment_fees WHERE application_id = a.id) > 0,
                            1,
                            0
                            )) = 1 
                            AND
                                (SELECT IF(
                                    (SELECT 
                                        COUNT(*)
                                    FROM
                                        license
                                    WHERE application_id = a.id) > 0, 1, 0
                                )) = 0";
            }
            return $filter;
        }

        private function filter($filter = "", $application_no = "", $type = "", $business_name = "", $start_date_of_application = "", $end_date_of_application = "", $dti_reg_no = "", $first_name = "", $last_name=""){
            if($application_no != ""){
                $filter .= " AND a.id = $application_no ";
            }

            if($type != ""){
                $filter .= " AND a.isNew = $type ";
            }

            if($business_name != ""){
                $filter .= " AND b.business_name = '$business_name' ";
            }

            if($dti_reg_no != ""){
                $filter .= " AND b.dti_reg_no = '$dti_reg_no' ";
            }

            if($first_name != ""){
                $filter .= " AND o.first_name = '$first_name' ";
            }

            if($last_name != ""){
                $filter .= " AND o.last_name = '$last_name' ";
            }

            if($start_date_of_application != "" && $end_date_of_application != ""){
                $filter .= " AND (a.date_of_application BETWEEN '$start_date_of_application' AND '$end_date_of_application')";
            }

            return $filter;
        }

        private function search($keyword){
            $search_filter = "";
            if($keyword != ""){
                $search_filter = " AND ( ";
                $application_columns = $this->Table_Model->get_columns("application");

                $a_search_filter = build_search_filter($application_columns, $keyword, "a", true);

                $search_filter .= $a_search_filter;

                $search_filter .= " OR " . build_search_filter($this->Table_Model->get_columns("owner"), $keyword, "o");

                $search_filter .= " OR " . build_search_filter($this->Table_Model->get_columns("business"), $keyword, "b");

                $search_filter .= " OR " . build_search_filter($this->Table_Model->get_columns("business_address"), $keyword, "ba");

                $search_filter .= " ) ";
            }

            return $search_filter;
        }

        public function step2_submit(){

            $this->form_validation->set_rules('form_date_application', 'Date of Application', 'required|trim');
            $this->form_validation->set_rules('form_dti_registration_no', 'DTI/SEC/CDA Registration No.', 'required|trim');
            $this->form_validation->set_rules('form_tin', 'TIN', 'required|trim');
            $this->form_validation->set_rules('form_dti_registration_date', 'DTI/SEC/CDA Date of Registration', 'required|trim');
            $this->form_validation->set_rules('form_type_of_business', 'Type of Business', 'required|trim');
            $this->form_validation->set_rules('form_amendment_from', 'Amendment From', 'required|trim');
            $this->form_validation->set_rules('form_amendment_to', 'Amendment To', 'required|trim');
            $this->form_validation->set_rules('form_taxpayer_last_name', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('form_taxpayer_first_name', 'First Name', 'required|trim');
            $this->form_validation->set_rules('form_taxpayer_middle_name', 'Middle Name', 'required|trim');
            $this->form_validation->set_rules('form_trade_name', 'Trade Name/Franchise', 'required|trim');
            $this->form_validation->set_rules('form_business_name', 'Business Name', 'required|trim');

            //Update application array instance
            $application = $_SESSION["application_form"]["application"];
            
            $application["date_of_application"] = $this->input->post('form_date_application');
            $application["amendment_from"] = $this->input->post('form_amendment_from');
            $application["amendment_to"] = $this->input->post('form_amendment_to');

            //Update Owner array instance
            $owner = $_SESSION["application_form"]["owner"];

            $owner["tin"] = $this->input->post('form_tin');
            $owner["last_name"] = $this->input->post('form_taxpayer_last_name');
            $owner["first_name"] = $this->input->post('form_taxpayer_first_name');
            $owner["middle_name"] = $this->input->post('form_taxpayer_middle_name');

            //Update Business array instance
            $business = $_SESSION["application_form"]["business"];

            $business["mode_of_payment"] = $this->input->post('form_mode_of_payment');
            $business["dti_reg_no"] = $this->input->post('form_dti_registration_no');
            $business["dti_reg_date"] = $this->input->post('form_dti_registration_date');
            $business["type"] = $this->input->post('form_type_of_business');
            $business["tax_incentives"] = $this->input->post('form_tax_incentives');
            $business["trade_name"] = $this->input->post('form_trade_name');
            $business["business_name"] = $this->input->post('form_business_name');

            $_SESSION["application_form"]["application"] = $application;
            $_SESSION["application_form"]["owner"] = $owner;
            $_SESSION["application_form"]["business"] = $business;

            if($this->input->post('submit')){
                // Form validation fail.
                if(!$this->form_validation->run()){
                    $data['step2_errors'] = validation_errors();
                    $this->session->set_flashdata($data);
                    redirect(add_index().'admin/step2');
                }
                redirect('admin/step3');
            }
    
            if($this->input->post('cancel')){
                $this->cancel_application();
                redirect(add_index().'admin/applications');
            }
    
            if($this->input->post('back')){
                redirect(add_index().'admin/step1');
            }
        }

        public function step3_submit(){
            if($this->input->post('submit')){
                $this->form_validation->set_rules('form_business_sitio', 'Street/Sitio', 'required|trim');
                $this->form_validation->set_rules('form_business_brgy', 'Barangay', 'required|trim');
                $this->form_validation->set_rules('form_business_postal', 'Postal Code', 'required|trim');
                $this->form_validation->set_rules('form_business_email', 'Business Email Address', 'required|trim');
                $this->form_validation->set_rules('form_owner_sitio', 'Owner\'s Sitio/Street','required|trim');
                $this->form_validation->set_rules('form_owner_brgy', 'Owner Barangay', 'required|trim');
                $this->form_validation->set_rules('form_owner_municipality','Owner Municipality / City', 'required|trim');
                $this->form_validation->set_rules('form_owner_province', 'Owner Province','required|trim');
                $this->form_validation->set_rules('form_owner_postal', 'Owner Postal Code', 'required|trim');
                $this->form_validation->set_rules('form_owner_email', 'Owner Email', 'required|trim');
                $this->form_validation->set_rules('form_emergency_person','Name of Contact Person (Emergency)','required|trim');
                $this->form_validation->set_rules('form_emergency_contact', 'Emergency Contact No.','required|trim');
                $this->form_validation->set_rules('form_emergency_email', 'Emergency Email', 'required|trim');

                // Get Application Form
                $application_form = $this->session->userdata('application_form');

                $business_address = array(
                    'id'=>$_SESSION["application_form"]["business_address"]["id"],
                    'street'=>$this->input->post('form_business_sitio'),
                    'brgy'=>$this->input->post('form_business_brgy'),
                    'postal_code'=>$this->input->post('form_business_postal'),
                    'email'=>$this->input->post('form_business_email'),
                    'mobile'=>$this->input->post('form_business_mobile_no'),
                    'telephone'=>$this->input->post('form_business_tel_no')
                );

                $application_form['business_address'] = $business_address;

                // Set Street, Barangay, Municipality, Province, Postal Code, Email
                $owner = $application_form['owner'];

                $owner['street'] = $this->input->post('form_owner_sitio');
                $owner['brgy'] = $this->input->post('form_owner_brgy');
                $owner['city'] = $this->input->post('form_owner_municipality');
                $owner['province'] = $this->input->post('form_owner_province');
                $owner['postal_code'] = $this->input->post('form_owner_postal');
                $owner['email'] = $this->input->post('form_owner_email');
                $owner['telephone'] = $this->input->post('form_owner_tel_no');
                $owner['mobile'] = $this->input->post('form_owner_mobile_no');

                $application_form['owner'] = $owner;

                // Set full name, telephone, email (emergency)
                $emergency_contact = array(
                    'id'=>$_SESSION["application_form"]["emergency_contact"]["id"],
                    'full_name'=>$this->input->post('form_emergency_person'),
                    'telephone'=>$this->input->post('form_emergency_contact'),
                    'email'=>$this->input->post('form_emergency_email')
                );

                $application_form['emergency_contact'] = $emergency_contact;

                $this->session->set_userdata('application_form', $application_form);
                
                if(!$this->form_validation->run()){
                    $data = array();
                    $data['step3_errors'] = validation_errors();
                    $this->session->set_flashdata($data);
                    redirect(add_index().'admin/step3');
                }
                redirect(add_index().'admin/step4');
            }

            if($this->input->post('cancel')){
                $this->cancel_application();
                redirect(add_index().'admin/applications');
            }
    
            if($this->input->post('back')){
                redirect(add_index().'admin/step2');
            }
        }

        public function step4_submit(){
            if($this->input->post('submit')){
                $this->form_validation->set_rules('form_business_area', 'Business Area', 'required|trim');
                $this->form_validation->set_rules('form_employee_no', 'Employee No.', 'required|trim');
                $this->form_validation->set_rules('form_employee_lgu', 'Employee No. residing w/in LGU', 'required|trim');

                $application_form = $this->session->userdata('application_form');

                $business_details = array(
                    'id'=>$application_form["business_details"]["id"],
                    'business_area'=>$this->input->post('form_business_area'),
                    'total_no_employees'=>$this->input->post('form_employee_no'),
                    'no_lgu_residing'=>$this->input->post('form_employee_lgu')
                );

                $application_form['business_details'] = $business_details;

                $lessor = array(
                    'id'=>$application_form['lessor']["id"],
                    'full_name'=>$this->input->post('form_lessor_name'),
                    'full_address'=>$this->input->post('form_lessor_address'),
                    'contact'=>$this->input->post('form_lessor_contact'),
                    'email'=>$this->input->post('form_lessor_email')
                );

                $application_form['lessor'] = $lessor;

                $lessor_details = array(
                    'id'=>$application_form['lessor_details']["id"],
                    'business_id'=>$application_form['business']["id"],
                    'lessor_id'=>$application_form['lessor_details']["lessor_id"],
                    'monthly_rental'=>$this->input->post('form_lessor_rental')
                );

                $application_form['lessor_details'] = $lessor_details;

                $this->session->set_userdata('application_form', $application_form);

                if(!$this->form_validation->run()){
                    $data = array();
                    $data['step4_errors'] = validation_errors();
                    $this->session->set_flashdata($data);
                    redirect(add_index().'admin/step4');
                }
                redirect(add_index().'admin/step5');
            }

            if($this->input->post('cancel')){
                $this->cancel_application();
                redirect(add_index().'admin/applications');
            }

            if($this->input->post('back')){
                redirect(add_index().'admin/step3');
            }
        }

        public function step5_submit(){
            if($this->input->post('add')){
                $application_form = $this->session->userdata('application_form');
                echo '<br>';

                $business_activity = array(
                    'id'=>'',
                    'application_id'=>'',
                    'line_of_business'=>$this->input->post('form_line_of_business'),
                    'no_of_units'=>$this->input->post('form_no_of_unit'),
                    'capitalization'=>$this->input->post('form_capitalization'),
                    'essential_receipts'=>$this->input->post('form_essential_receipts'),
                    'non_essential_receipts'=>$this->input->post('form_non_essential_receipts')
                );

                // 1. Kapag ang wala pang session for Business Activity, gumawa.
                if(!isset($application_form['business_activities'])){
                    $application_form['business_activities'] = array();

                    $application_form['business_activities_cnt'] = count($application_form['business_activities']);

                    $application_form['business_activities']['b-'. $application_form['business_activities_cnt']] = $business_activity;

                    $application_form['business_activities_cnt']++;
                }
                else{

                    $application_form['business_activities']['b-'. $application_form['business_activities_cnt']] = $business_activity;

                    $application_form['business_activities_cnt']++;
                }

                $this->session->set_userdata('application_form', $application_form);

                redirect(add_index().'admin/step5');
            }
            elseif($this->input->post('delete')){
                unset($_SESSION['application_form']['business_activities'][$this->input->post('delete')]);
                redirect(add_index().'admin/step5');
            }
            elseif($this->input->post('submit')){
                redirect(add_index().'Application_Controller/submit_application');
            }
            elseif($this->input->post('cancel')){
                $this->cancel_application();
                redirect(add_index().'admin/applications');
            }
            elseif($this->input->post('back')){
                redirect(add_index().'admin/step4');
            }
        }

        public function submit_application(){
            if($this->session->userdata('application_form')){
                $application_form = $this->session->userdata('application_form');

                if($application_form["application"]["isNew"]){
                    // THIS IS FOR NEW APPLICATIONS

                    // Insert Owner
                    $owner_id = $this->Owner_Model->insert($application_form["owner"]);

                    // Insert Business_Address
                    $business_address_id = $this->Business_Address_Model->insert($application_form['business_address']);

                    // Insert Business_Details
                    $business_details_id = $this->Business_Details_Model->insert($application_form['business_details']);

                    // Insert Emergency_Contact_Details
                    $emergency_contact_details_id = $this->Emergency_Contact_Details_Model->insert($application_form['emergency_contact']);

                    // Insert Business
                    $application_form['business']['emergency_contact_details_id'] = $emergency_contact_details_id;
                    $application_form['business']['owner_id'] = $owner_id;
                    $application_form['business']['business_details_id'] = $business_details_id;
                    $application_form['business']['business_address_id'] = $business_address_id;

                    $business_id = $this->Business_Model->insert($application_form['business']);

                    // Insert Lessor
                    if($application_form['lessor']['full_name'] != "" && $application_form['lessor']['full_address'] != ""){
                        $lessor_id = $this->Lessor_Model->insert($application_form["lessor"]);

                        // Insert Lessor_Details
                        $application_form['lessor_details']['lessor_id'] = $lessor_id;
                        $application_form['lessor_details']['business_id'] = $business_id;

                        $lessor_details_id = $this->Lessor_Details_Model->insert($application_form['lessor_details']);
                    }
                }
                else{
                    print_r($application_form);
                    // FOR RENEWALS
                    
                    // Update Owner
                    $owner_id = $application_form["owner"]["id"];
                    $owner = $application_form["owner"];
                    unset($owner["id"]);

                    $this->Owner_Model->update($owner_id, $owner);

                    // Update Business_Address
                    $business_address_id = $application_form["business_address"]["id"];
                    $business_address = $application_form["business_address"];
                    unset($business_address["id"]);

                    $this->Business_Address_Model->update($business_address_id, $business_address);

                    // Update Business_Details
                    $business_details_id = $application_form["business_details"]["id"];
                    $business_details = $application_form["business_details"];
                    unset($business_details["id"]);

                    $this->Business_Details_Model->update($business_details_id, $business_details);

                    // Update Emergency_Contact_Details
                    $emergency_contact_details_id = $application_form["emergency_contact"]["id"];
                    $emergency_contact = $application_form["emergency_contact"];
                    unset($emergency_contact["id"]);

                    $this->Emergency_Contact_Details_Model->update($emergency_contact_details_id, $emergency_contact);

                    // Update Business
                    $business_id = $application_form["business"]["id"];
                    $business = $application_form["business"];;
                    unset($business["id"]);

                    $this->Business_Model->update($business_id, $business);

                    // Update Lessor
                    if($application_form['lessor']['id'] != ""){
                        $lessor_id = $application_form["lessor"]["id"];
                        $lessor = $application_form["lessor"];
                        unset($lessor["id"]);

                        $this->Lessor_Model->update($lessor_id, $lessor);

                        // Insert Lessor_Details
                        $lessor_details_id = $application_form["lessor_details"]["id"];
                        $lessor_details = $application_form["lessor_details"];
                        unset($lessor_details["id"]);

                        $this->Lessor_Details_Model->update($lessor_details_id, $lessor_details);
                    }
                    elseif($application_form["lessor"]["id"] == "" && $application_form["lessor"]["full_name"] != "" && $application_form["lessor"]["full_address"] != ""){
                        $lessor_id = $this->Lessor_Model->insert($application_form["lessor"]);

                        // Insert Lessor_Details
                        $application_form['lessor_details']['lessor_id'] = $lessor_id;
                        $application_form['lessor_details']['business_id'] = $business_id;

                        $lessor_details_id = $this->Lessor_Details_Model->insert($application_form['lessor_details']);
                    }

                    // Update Lessor Lessor_Details
                }

                $application_form['application']['business_id'] = $business_id;
                $application_id = $this->Application_Model->insert($application_form['application']);

                $business_activities_id = array();

                if(count($application_form['business_activities'])){
                    foreach($application_form['business_activities'] as $ba){
                        $ba['application_id'] =$application_id;
                        
                        $business_activities_id[] = $this->Business_Activity_Model->insert($ba);
                    }
                }

                unset($_SESSION['application_form']);

                redirect(add_index().'admin/submit_application?id='.$application_id);
            }
        }

        private function cancel_application(){
            unset($_SESSION['application_form']);
        }

        public function view_other_information(){
            if($this->input->get('business_id')){
                $data = array(
                    'business'=>$this->Business_Model->get_business_from_id($this->input->get('business_id')),
                    'application'=>$this->Application_Model->get_application_from_id($this->input->get('app_id'))
                );

                $this->load->view("admin/application/ajax/view_other_information", $data);
            }
            elseif($this->input->get('application_id')){
                $data = array(
                    'application'=>$this->Application_Model->get_application_from_id($this->input->get('application_id'))
                );

                $this->load->view("admin/application/ajax/view_business_activities", $data);
            }
            else{
                echo 'An error occured.';
            }
        }

        public function verify(){
            if($this->input->post('verification')){
                $verifications = $this->input->post('verification');
                $inserts = array();
                $not_accomplished = array();
                foreach($verifications as $v){
                    $v['application'] = intval($v['application']);
                    if($v['id'] != ""){
                            $v['id'] = intval($v['id']);

                            $inserts[] = $this->Verification_Document_Details_Model->update($v);
                    }
                    else{
                            $inserts[] = $this->Verification_Document_Details_Model->insert($v);
                    }

                    if($v['remarks'] == 'No'){
                        $not_accomplished[] = $v;
                    }
                }

                $this->session->set_flashdata('not_accomplished', $not_accomplished);
                redirect(add_index().'admin/check_verification');
            }
        }

        public function print(){
            if($this->input->get("id")){
                $id = $this->input->get("id");
                $application = $this->Application_Model->get_application_from_id($id);
                $this->load->view("applications/print_view", array(
                    "application" => $application
                ));
            }
            else{
                $this->load->view("applications/print_view");
            }
        }

        public function basic_information_form(){
            if($this->input->get("action") == "edit"){
                if($this->input->get("id")){
                    $this->load->view("applications/basic_information_form", array(
                        "application"=>$this->Application_Model->get_application_from_id($this->input->get("id"))
                    ));
                }
            }
        }

        public function submit_basic_information_form(){
            if($this->input->post("application_id")){
                $this->Application_Model->update_basic_information(
                    $application_id = $this->input->post("application_id"), 
                    $mode_of_payment = $this->input->post("form_mode_of_payment"), 
                    $date_application = $this->input->post("form_date_application"), 
                    $dti_reg_no = $this->input->post("form_dti_registration_no"), 
                    $tin = $this->input->post("form_tin"), 
                    $dti_reg_date = $this->input->post("form_dti_registration_date"), 
                    $type = $this->input->post("form_type_of_business"), 
                    $amendment_from = $this->input->post("form_amendment_from"), 
                    $amendment_to = $this->input->post("amendment_to"), 
                    $tax_incentives = $this->input->post("form_tax_incentives"), 
                    $last_name = $this->input->post("form_taxpayer_last_name"), 
                    $first_name = $this->input->post("form_taxpayer_first_name"), 
                    $middle_name = $this->input->post("form_taxpayer_middle_name"), 
                    $business_name = $this->input->post("form_business_name"), 
                    $trade_name = $this->input->post("form_trade_name"));

                redirect(base_url().add_index()."admin/view_application?id=".$this->input->post("application_id"));
            }
        }

        public function other_information_form(){
            if($this->input->get("action") == "edit"){
                if($this->input->get("id")){
                    $this->load->view("applications/other_information_form", array(
                        "business"=>$this->Business_Model->get_business_from_id($this->input->get("id")),
                        "application"=>$this->Application_Model->get_application_from_id($this->input->get("app_id"))
                    ));
                }
            }
        }

        public function submit_other_information_form(){
            if($this->input->post("business_id")){
                    $this->Application_Model->update_other_information(
                        $business_id = $this->input->post("business_id"), 
                        $street = $this->input->post("form_business_sitio"), 
                        $brgy = $this->input->post("form_business_brgy"), 
                        $postal_code = $this->input->post("form_business_postal"), 
                        $email = $this->input->post("form_business_email"), 
                        $mobile = $this->input->post("form_business_tel_no"), 
                        $telephone = $this->input->post("form_business_mobile_no"),
                        $owner_street = $this->input->post("form_owner_sitio"),
                        $owner_brgy = $this->input->post("form_owner_brgy"), 
                        $owner_city = $this->input->post("form_owner_municipality"), 
                        $owner_province = $this->input->post("form_owner_province"), 
                        $owner_postal_code = $this->input->post("form_owner_postal"), 
                        $owner_email = $this->input->post("form_owner_email"), 
                        $owner_mobile = $this->input->post("form_owner_mobile_no"), 
                        $owner_telephone = $this->input->post("form_owner_tel_no"), 
                        $ecd_full_name = $this->input->post("form_emergency_person"), 
                        $ecd_telephone = $this->input->post("form_emergency_contact"), 
                        $ecd_email = $this->input->post("form_emergency_email"), 
                        $business_area = $this->input->post("form_business_area"), 
                        $total_no_employees = $this->input->post("form_employee_no"), 
                        $no_lgu_residing = $this->input->post("form_employee_lgu")
                    );
                
                    redirect(base_url().add_index()."admin/view_application?id=".$this->input->post("application_id"));
            }
        }

        public function business_activity_form(){
            if($this->input->get("action") == "edit"){
                if($this->input->get("id")){
                    $this->load->view("applications/business_activity_form", array(
                        "isNew"=>$this->input->get("isNew"),
                        "business_activity"=>$this->Business_Activity_Model->get_business_activity_from_id($this->input->get("id")),
                        "application"=> $this->Application_Model->get_application_from_id($this->input->get("app_id"))
                    ));
                }
            }

            if($this->input->get("action") == "add"){
                $this->load->view("applications/business_activity_form", array(
                    "isNew"=>$this->input->get("isNew"),
                    "application"=>$this->Application_Model->get_application_from_id($this->input->get("app_id"))
                ));
            }
        }

        public function submit_business_activity_form(){
            if($this->input->post("id")){
                $this->Application_Model->submit_business_activity(
                    $business_activity_id = $this->input->post("id"), 
                    $line_of_business = $this->input->post("line_of_business"), 
                    $no_of_units = $this->input->post("no_of_units"), 
                    $capitalization = $this->input->post("capitalization"), 
                    $essential_receipts = $this->input->post("gross_sales_essential"), 
                    $non_essential_receipts = $this->input->post("gross_sales_non_essentials")
                );

                redirect(base_url().add_index()."admin/view_application?id=".$this->input->post("application_id"));
            }
        }

        public function add_business_activity(){
            if($this->input->post("application_id")){
                $this->Business_Activity_Model->insert($_POST);
            }

            redirect(base_url().add_index()."admin/view_application?id=".$this->input->post("application_id"));
        }

        public function delete_business_activity(){
            $this->Business_Activity_Model->delete($this->input->post("id"));

            redirect(base_url().add_index()."admin/view_application?id=".$this->input->post("application_id"));
        }

        public function delete_application(){
            $this->Application_Model->delete($this->input->post("application_id"));

            redirect(base_url().add_index()."admin/applications");
        }

        public function license_form(){
            $this->load->view("applications/license_form", array(
                "business_id" => $this->input->get("b_id"),
                "applicaiton_id"=>$this->input->get("a_id")
            ));
        }

        public function add_license_form(){
            $this->License_Model->insert($this->input->post());

            redirect(base_url().add_index()."_business?id=".$this->input->post("business_id"));
        }

        public function auto_license_search(){
            $keyword = $this->input->get("keyword");
            $_filter = " AND b.bp_no != '' AND (CONCAT(b.bp_no, ' - ', b.business_name) LIKE '%$keyword%' OR b.bp_no LIKE '%$keyword%' OR b.business_name LIKE '%$keyword%')";

            $businesses = $this->Business_Model->get_all_businesses(
                $filter = $_filter, 
                $order_by = "b.`id` DESC", 
                $limit = "0, 1000",
                $join = "", 
                $type="all"
            );
            $this->load->view("admin/application/ajax/view_auto_license", array(
                "results" => $businesses
            ));
        }
    }

?>