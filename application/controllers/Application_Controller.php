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
                'lessor_details_id'=>'',
                'emergency_contact_details_id'=>'',
                'owner_id'=>'',
                'business_details_id'=>'',
            );

            $data = array(
                    'application'=>$application,
                    'owner'=>$owner,
                    'business'=>$business
                );

            $this->session->set_flashdata($data);

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
    }

?>