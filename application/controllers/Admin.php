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
        $data = array('view'=>'admin/home/home_view');
        $this->load->view('admin/main_view', $data);
    }

    public function applications(){
        $data = array('view'=>'admin/application/application_view');
        $this->load->view('admin/main_view',$data);
    }

    public function businesses(){
        $data = array('view'=>'admin/businesses/businesses_view');
        $this->load->view('admin/main_view', $data);
    }

    public function accounts(){
        $data = array('view'=>'admin/accounts/accounts_view');
        $this->load->view('admin/main_view', $data);
    }

    public function settings(){
        $data = array('view'=>'admin/settings/settings_view');
        $this->load->view('admin/main_view', $data);
    }

    public function logout(){
        redirect(base_url());
    }

    public function profile(){
        $data = array('view'=>'admin/accounts/profile_view');

        if($this->input->get('edit') == 'true'){
            $data = array('view'=>'admin/accounts/edit_view');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function register(){
        $data = array('view'=>'admin/accounts/register_view');
        $this->load->view('admin/main_view', $data);
    }

    public function step1(){
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
        $data = array('view'=>'admin/application/step2_view');

        if($this->input->post('submit')){
            redirect('admin/step3');
        }

        if($this->input->post('cancel')){
            redirect('admin/applications');
        }

        if($this->input->post('back')){
            redirect('admin/step1');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function step3(){
        $data = array('view'=>'admin/application/step3_view');

        if($this->input->post('submit')){
            redirect('admin/step4');
        }

        if($this->input->post('cancel')){
            redirect('admin/applications');
        }

        if($this->input->post('back')){
            redirect('admin/step2');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function step4(){
        $data = array('view'=>'admin/application/step4_view');

        if($this->input->post('submit')){
            redirect('admin/step5');
        }

        if($this->input->post('cancel')){
            redirect('admin/applications');
        }

        if($this->input->post('back')){
            redirect('admin/step3');
        }

        $this->load->view('admin/main_view', $data);
    }

    public function step5(){
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
        $data = array('view'=>'admin/application/check_verification_view');

        if($this->input->post('submit')){
            redirect('admin/applications');
        }

        $this->load->view('admin/main_view', $data);
    }
}