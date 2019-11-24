<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 25/01/2019
 * Time: 12:06 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function index(){
        $this->acccount_check();

        $data = array('view'=>'admin/home/home_view');
        $this->load->view('admin/main_view', $data);
    }

    public function applications(){
        $this->acccount_check();

        $data = array(
            'view'=>'admin/application/application_view'
        );
        $this->load->view('admin/main_view',$data);
    }

    public function view_application(){
        if($this->input->get('id')){
            $view = "admin/application/view_application_view";
            $section = "";

            if($this->input->get('section')){
                if($this->input->get('section') == 2){
                    $view = "admin/application/view_lgu_view";
                }
                elseif($this->input->get('section') == 3){
                    $view = "admin/application/view_city_view";
                    $section = "view_application/city_section_form";
                }
            }
            $data = array(
                'view'=>$view,
                'section'=> $section,
                'application'=>$this->Application_Model->get_application_from_id($this->input->get('id'))
            );
            $this->load->view('admin/main_view', $data);
        }
        else{
            redirect(add_index().'admin/applications');
        }
    }

    public function businesses(){
        $this->acccount_check();

        if($this->input->get("quick-search")){
            $businesses = $this->Business_Model->search($this->input->get("quick-search"));
        }
        elseif(
            $this->input->get("filter_categories") ||  $this->input->get("filter_brgy")  
        ){
            $businesses = $this->Business_Model->filter(
                $category = $this->input->get("filter_categories"), 
                $brgy = $this->input->get("filter_brgy"), 
            );
        }
        else{
            if($this->input->get("status") == "active"){
                $join = " INNER JOIN `license` l ON b.bp_no = l.license_no ";
                $filter = " AND NOW() BETWEEN l.date_start AND l.date_end
                            AND b.isClosed = 0 ";
            }
            elseif($this->input->get("status") == "no-license"){
                $join = "";
                $filter = " AND b.bp_no = '' 
                            AND b.isClosed = 0 ";
            }
            elseif($this->input->get("status") == "expired"){
                $join = " INNER JOIN `license` l ON b.bp_no = l.license_no ";
                $filter = " AND NOW() NOT BETWEEN l.date_start AND l.date_end
                            AND b.isClosed = 0 ";
            }
            elseif($this->input->get("status") == "closed"){
                $join = "";
                $filter = " AND b.isClosed = 1 ";
            }
            else{
                $join = "";
                $filter = "";
            }
            
            $businesses = $this->Business_Model->get_all_businesses($filter = $filter, $order_by = "b.`id` DESC", $limit = "0, 1000",$join = $join, $type="all");
        }
        $data = array(
            'view'=>'admin/businesses/businesses_view',
            'businesses'=>$businesses
        );
        $this->load->view('admin/main_view', $data);
    }

    public function accounts(){
        $this->acccount_check();

        $data = array(
            'view'=>'admin/accounts/accounts_view',
            'users'=>$this->User_Model->get_all_users(),
            'statistics'=>$this->User_Model->get_account_statistics()
        );
        $this->load->view('admin/main_view', $data);
    }

    public function settings(){
        $this->acccount_check();

        $data = array(
            'view'=>'admin/settings/settings_view'
        );
        $this->load->view('admin/main_view', $data);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function profile(){
        $this->acccount_check();

        $profile = ($this->input->get('id') ? : $this->session->userdata('user_id'));

        $data = array(
            'view'=>'admin/accounts/profile_view',
            'profile'=>$this->User_Model->get_user_from_id($profile)
        );

        if($this->input->get('edit') == 'true'){
            $data = array(
                'view'=>'admin/accounts/edit_view',
                'profile'=>$this->User_Model->get_user_from_id($profile)
            );
        }

        $this->load->view('admin/main_view', $data);
    }

    public function register(){
        $this->acccount_check();

        $data = array(
            'view'=>'admin/accounts/register_view'
        );
        $this->load->view('admin/main_view', $data);
    }

    public function step1(){
        $this->acccount_check();

        $data = array('view'=>'admin/application/step1_view');

        if($this->input->post('submit')){
            // Create an empty application form;
            if($this->input->post("form_type_application") == 2){
                $_business = $this->Business_Model->get_business_from_id($this->input->post("business_id"));

                $application = array(
                    'id'=>'',
                    'code'=>'',
                    'isNew'=>0,
                    'date_of_application'=>date("Y-m-d"),
                    'amendment_from'=>'',
                    'amendment_to'=>'',
                    'municipality'=>$this->General_Settings_Model->get_municipality()->settings_value.', '.$this->General_Settings_Model->get_province()->settings_value,
                    'business_id'=>$_business->id
                );

                $owner = (array) $_business->get_owner();

                $business = (array) $_business;

                $business_address = (array) $_business->get_business_address();

                $emergency_contact = (array) $_business->get_emergency_contact_details();

                $business_details = (array) $_business->get_business_details();

                if($_business->get_lessor_details()){
                    $lessor_details = (array) $_business->get_lessor_details();

                    $lessor = (array) $_business->get_lessor_details()->get_lessor();
                }
                else{
                    $lessor = array(
                        'id'=>'',
                        'full_name'=>'',
                        'full_address'=>'',
                        'contact'=>'',
                        'email'=>''
                    );

                    $lessor_details = array(
                        'id'=>'',
                        'business_id'=>'',
                        'lessor_id'=>'',
                        'monthly_rental'=>''
                    );
                }

                $business_activities = array();
            }
            else{
                $application = array(
                        'id'=>'',
                        'code'=>'',
                        'isNew'=>1,
                        'date_of_application'=>date("Y-m-d"),
                        'amendment_from'=>'',
                        'amendment_to'=>'',
                        'municipality'=>$this->General_Settings_Model->get_municipality()->settings_value.', '.$this->General_Settings_Model->get_province()->settings_value,
                        'business_id'=>''
                );

                $owner = array(
                    'id'=>'',
                    'tin'=>'',
                    'last_name'=>'',
                    'first_name'=>'',
                    'middle_name'=>'',
                    'street'=>'',
                    'brgy'=>'',
                    'city'=>'',
                    'province'=>'',
                    'postal_code'=>'',
                    'email'=>'',
                    'mobile'=>'',
                    'telephone'=>''
                );
                
                $business = array(
                    'id'=>'',
                    'bp_no'=>'',
                    'mode_of_payment'=>'',
                    'dti_reg_no'=>'',
                    'dti_reg_date'=>'',
                    'type'=>'',
                    'category'=>'',
                    'tax_incentives'=>'',
                    'trade_name'=>'',
                    'business_name'=>'',
                    'emergency_contact_details_id'=>'',
                    'owner_id'=>'',
                    'business_details_id'=>'',
                    'business_address_id'=>''
                );

                $business_address = array(
                    'id'=>'',
                    'street'=>'',
                    'brgy'=>'',
                    'postal_code'=>'',
                    'email'=>'',
                    'mobile'=>'',
                    'telephone'=>''
                );

                $emergency_contact = array(
                    'id'=>'',
                    'full_name'=>'',
                    'telephone'=>'',
                    'email'=>''
                );

                $business_details = array(
                    'id'=>'',
                    'business_area'=>'',
                    'total_no_employees'=>'',
                    'no_lgu_residing'=>''
                );

                $lessor = array(
                    'id'=>'',
                    'full_name'=>'',
                    'full_address'=>'',
                    'contact'=>'',
                    'email'=>''
                );

                $lessor_details = array(
                    'id'=>'',
                    'business_id'=>'',
                    'lessor_id'=>'',
                    'monthly_rental'=>''
                );

                $business_activities = array();
            }

            $application_form = array(
                "application_form"=>array(
                    "application"=>$application,
                    "owner"=>$owner,
                    "business"=>$business,
                    "business_address"=>$business_address,
                    "emergency_contact" => $emergency_contact,
                    "business_details" => $business_details,
                    "lessor" => $lessor,
                    "lessor_details" => $lessor_details,
                    "business_activities"=>$business_activities
                )
            );

            $this->session->set_userdata($application_form);
            
            redirect(add_index().'admin/step2');
        }
        else if($this->input->post('cancel')){
            redirect(add_index().'admin/applications');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function step2(){
        $this->acccount_check();

        $data = array(
            'view'=>'admin/application/step2_view',
            'business_categories'=>$this->Business_Categories_List_Model->get_all()
        );

        if($this->session->userdata('application_form')){
            $data = array_merge($data, $this->setApplicationInstanceArray());
        }

        $this->load->view('admin/main_view', $data);
    }

    public function step3(){
        $this->acccount_check();

        $this->checkApplicationExist();

        $data = array(
            'view'=>'admin/application/step3_view',
            'brgy'=>$this->Barangay_List_Model->get_all_formatted()
        );

        if($this->session->userdata('application_form')){
            $data = array_merge($data, $this->setApplicationInstanceArray());
        }

        $this->load->view('admin/main_view', $data);
    }

    public function step4(){
        $this->acccount_check();

        $this->checkApplicationExist();

        $data = array('view'=>'admin/application/step4_view');

        if($this->session->userdata('application_form')){
            $data = array_merge($data, $this->setApplicationInstanceArray());
        }

        $this->load->view('admin/main_view', $data);
    }

    public function step5(){
        $this->acccount_check();

        $data = array('view'=>'admin/application/step5_view');

        $data = array_merge($data, $this->setApplicationInstanceArray());

        if($this->input->post('submit')){
            redirect(add_index().'admin/submit_application');
        }

        if($this->input->post('cancel')){
            redirect(add_index().'admin/applications');
        }

        if($this->input->post('back')){
            redirect(add_index().'admin/step4');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function submit_application(){
        $this->acccount_check();

        $data = array('view'=>'admin/application/submit_application_view');

        if($this->input->post('cancel')){
            redirect(add_index().'admin/applications');
        }

        if($this->input->post('submit')){
            redirect(add_index().'admin/verification');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function verification(){
        $this->acccount_check();

        if($this->input->get('id')){
            $application = $this->Application_Model->get_application_from_id($this->input->get('id'));
            $data = array(
                'view'=>'admin/application/verification_view',
                'application'=>$application,
                'verification_documents'=>$this->Verification_Document_List_Model->get_all()
            );

            $status = $application->get_status();

            if($status->verifyAgain){
                $data['verify_again'] = $application->get_verifications();
            }

            if($this->input->post('cancel')){
                redirect(add_index().'admin/applications');
            }

            if($this->input->post('submit')){
                redirect(add_index().'admin/check_verification');
            }

            $this->load->view('admin/main_view', $data);
        }
        else{
            echo "An error occured";
        }
    }

    public function check_verification(){
        $this->acccount_check();

        $data = array(
            'view'=>'admin/application/check_verification_view'
        );



        if($this->input->post('submit')){
            redirect(add_index().'admin/applications');
        }

        $this->load->view('admin/main_view', $data);
    }

    private function acccount_check(){
       if(!$this->session->userdata('user_id')){
            redirect('/');
       }
       
       if(!in_array($this->session->userdata('user_position'), array("Administrator", "Checker"))){
           redirect('/');
       }
    }

    private function checkApplicationExist(){
        if(!$this->session->userdata('application_form')){
            redirect(add_index().'admin/step1');
        }
    }

    private function setApplicationInstanceArray(){
        $data = array();

        if(isset($this->session->userdata('application_form')['application'])){
            $data['application'] = new Application();
            $data['application']->set_instance_array($this->session->userdata('application_form')['application']);
        }

        if(isset($this->session->userdata('application_form')['owner'])){
            $data['owner'] = new Owner();
            $data['owner']->set_instance_array($this->session->userdata('application_form')['owner']);
        }

        if(isset($this->session->userdata('application_form')['business'])){
            $data['business'] = new Business();
            $data['business']->set_instance_array($this->session->userdata('application_form')['business']);
        }
    
        if(isset($this->session->userdata('application_form')['business_address'])){
            $data['business_address'] = new Business_Address();
            $data['business_address']->set_instance_array($this->session->userdata('application_form')['business_address']);
        }

        if(isset($this->session->userdata('application_form')['emergency_contact'])){
            $data['emergency_contact'] = new Emergency_Contact_Details();
            $data['emergency_contact']->set_instance_array($this->session->userdata('application_form')['emergency_contact']);
        }

        if(isset($this->session->userdata('application_form')['business_details'])){
            $data['business_details'] = new Business_Details();
            $data['business_details']->set_instance_array($this->session->userdata('application_form')['business_details']);
        }

        if(isset($this->session->userdata('application_form')['lessor'])){
            $data['lessor'] = new Lessor();
            $data['lessor']->set_instance_array($this->session->userdata('application_form')['lessor']);
        }

        if(isset($this->session->userdata('application_form')['lessor_details'])){
            $data['lessor_details'] = new Lessor_Details();
            $data['lessor_details']->set_instance_array($this->session->userdata('application_form')['lessor_details']);
        }
        return $data;
    }
}