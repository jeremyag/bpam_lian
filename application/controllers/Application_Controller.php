<?php 
    class Application_Controller extends CI_Controller{
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

            //Create application array instance
            $application =  array(
                'id'=>'',
                'code'=>'',
                'isNew'=>1,
                'date_of_application'=>$this->input->post('form_date_application'),
                'amendment_from'=>$this->input->post('form_amendment_from'),
                'amendment_to'=>$this->input->post('form_amendment_to'),
                'municipality'=>'Lian,Batangas',
                'business_id'=>''
            );

            //Create Owner array instance
            $owner = array(
                'id'=>'',
                'tin'=>$this->input->post('form_tin'),
                'last_name'=>$this->input->post('form_taxpayer_last_name'),
                'first_name'=>$this->input->post('form_taxpayer_first_name'),
                'middle_name'=>$this->input->post('form_taxpayer_middle_name'),
                'street'=>'',
                'brgy'=>'',
                'city'=>'',
                'province'=>'',
                'postal_code'=>'',
                'email'=>'',
                'mobile'=>'',
                'telephone'=>''

            );

            //Create Business array instance
            $business = array(
                'id'=>'',
                'bp_no'=>'',
                'mode_of_payment'=>$this->input->post('form_mode_of_payment'),
                'dti_reg_no'=>$this->input->post('form_dti_registration_no'),
                'dti_reg_date'=>$this->input->post('form_dti_registration_date'),
                'type'=>$this->input->post('form_type_of_business'),
                'category'=>'',
                'tax_incentives'=>$this->input->post('form_tax_incentives'),
                'trade_name'=>$this->input->post('form_trade_name'),
                'business_name'=>$this->input->post('form_business_name'),
                'emergency_contact_details_id'=>'',
                'owner_id'=>'',
                'business_details_id'=>'',
                'business_address_id'=>''
            );

            $data = array(
                'application_form'=> array(
                    'application'=>$application,
                    'owner'=>$owner,
                    'business'=>$business
                )
            );

            $this->session->set_userdata($data);


            if($this->input->post('submit')){
                // Form validation fail.
                if(!$this->form_validation->run()){
                    $data['step2_errors'] = validation_errors();
                    $this->session->set_flashdata($data);
                    redirect('admin/step2');
                }
                redirect('admin/step3');
            }
    
            if($this->input->post('cancel')){
                redirect('admin/applications');
            }
    
            if($this->input->post('back')){
                redirect('admin/step1');
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
                    'id'=>'',
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
                    'id'=>'',
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
                    redirect('admin/step3');
                }
                redirect('admin/step4');
            }

            if($this->input->post('cancel')){
                redirect('admin/applications');
            }
    
            if($this->input->post('back')){
                redirect('admin/step2');
            }
        }

        public function step4_submit(){
            if($this->input->post('submit')){
                $this->form_validation->set_rules('form_business_area', 'Business Area', 'required|trim');
                $this->form_validation->set_rules('form_employee_no', 'Employee No.', 'required|trim');
                $this->form_validation->set_rules('form_employee_lgu', 'Employee No. residing w/in LGU', 'required|trim');

                $application_form = $this->session->userdata('application_form');

                $business_details = array(
                    'id'=>'',
                    'business_area'=>$this->input->post('form_business_area'),
                    'total_no_employees'=>$this->input->post('form_employee_no'),
                    'no_lgu_residing'=>$this->input->post('form_employee_lgu')
                );

                $application_form['business_details'] = $business_details;

                $lessor = array(
                    'id'=>'',
                    'full_name'=>$this->input->post('form_lessor_name'),
                    'full_address'=>$this->input->post('form_lessor_address'),
                    'contact'=>$this->input->post('form_lessor_contact'),
                    'email'=>$this->input->post('form_lessor_email')
                );

                $application_form['lessor'] = $lessor;

                $lessor_details = array(
                    'id'=>'',
                    'business_id'=>'',
                    'lessor_id'=>'',
                    'monthly_rental'=>$this->input->post('form_lessor_rental')
                );

                $application_form['lessor_details'] = $lessor_details;

                $this->session->set_userdata('application_form', $application_form);

                if(!$this->form_validation->run()){
                    $data = array();
                    $data['step4_errors'] = validation_errors();
                    $this->session->set_flashdata($data);
                    redirect('admin/step4');
                }
                redirect('admin/step5');
            }

            if($this->input->post('cancel')){
                redirect('admin/applications');
            }

            if($this->input->post('back')){
                redirect('admin/step3');
            }
        }

        public function step5_submit(){
            if($this->input->post('add')){
                $application_form = $this->session->userdata('application_form');
                print_r($this->input->post());
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

                redirect('admin/step5');
            }
            elseif($this->input->post('delete')){
                unset($_SESSION['application_form']['business_activities'][$this->input->post('delete')]);
                redirect('admin/step5');
            }
            elseif($this->input->post('submit')){
                redirect('Application_Controller/submit_application');
            }
            elseif($this->input->post('cancel')){
                redirect('admin/applications');
            }
            elseif($this->input->post('back')){
                redirect('admin/step4');
            }
        }

        public function submit_application(){
            if($this->session->userdata('application_form')){
                $application_form = $this->session->userdata('application_form');

                
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

                redirect('admin/submit_application?id='.$application_id);
            }
        }
    }

?>