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

        $data = array('view'=>'admin/application/application_view');
        $this->load->view('admin/main_view',$data);
    }

    public function businesses(){
        $this->acccount_check();

        $data = array(
            'view'=>'admin/businesses/businesses_view'
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

        $data = array('view'=>'admin/settings/settings_view');
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
            redirect('admin/step2');
        }
        else if($this->input->post('cancel')){
            redirect('admin/applications');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function step2(){
        $this->acccount_check();

        $data = array('view'=>'admin/application/step2_view');

        if($this->session->userdata('application_form')){
            $data = array_merge($data, $this->setApplicationInstanceArray());
        }

        $this->load->view('admin/main_view', $data);
    }

    public function step3(){
        $this->acccount_check();

        $this->checkApplicationExist();

        $data = array('view'=>'admin/application/step3_view');

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

        if($this->input->post('submit')){
            redirect('admin/submit_application');
        }

        if($this->input->post('cancel')){
            redirect('admin/applications');
        }

        if($this->input->post('back')){
            redirect('admin/step4');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function submit_application(){
        $this->acccount_check();

        $data = array('view'=>'admin/application/submit_application_view');

        if($this->input->post('cancel')){
            redirect('admin/applications');
        }

        if($this->input->post('submit')){
            redirect('admin/verification');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function verification(){
        $this->acccount_check();

        $data = array('view'=>'admin/application/verification_view');

        if($this->input->post('cancel')){
            redirect('admin/applications');
        }

        if($this->input->post('submit')){
            redirect('admin/check_verification');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function check_verification(){
        $this->acccount_check();

        $data = array('view'=>'admin/application/check_verification_view');

        if($this->input->post('submit')){
            redirect('admin/applications');
        }

        $this->load->view('admin/main_view', $data);
    }

    private function acccount_check(){
       if(!$this->session->userdata('user_id')){
            redirect('/');
       }
       
       if($this->session->userdata('user_position') != 'Administrator'){
           redirect('/');
       }
    }

    private function checkApplicationExist(){
        if(!$this->session->userdata('application_form')){
            redirect('admin/step1');
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