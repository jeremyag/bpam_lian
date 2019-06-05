<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Treasurer extends CI_Controller{
        public function index(){
            $this->acccount_check();

            $data = array('view'=>'treasurer/home/home_view');
            $this->load->view('treasurer/main_view', $data);
        }

        public function assessments(){
            $this->acccount_check();

            $data = array(
                'view'=>'treasurer/assessments/assessments_view',
                'applications'=>$this->Application_Model->get_all_application("`id` DESC", "assessment")
            );
            $this->load->view('treasurer/main_view', $data);
        }

        public function logout(){
            $this->session->sess_destroy();
            redirect(base_url());
        }

        private function acccount_check(){
            if(!$this->session->userdata('user_id')){
                    redirect('/');
            }
            
            if($this->session->userdata('user_position') != 'Treasurer'){
                redirect('/');
            }
        }

        public function view_application(){
            if($this->input->get('id')){
            $view = "treasurer/assessments/view_application_view";
            $section = "";
            if($this->input->get('section')){
                if($this->input->get('section') == 2){
                    $view = "treasurer/assessments/view_lgu_view";
                }
                elseif($this->input->get('section') == 3){
                    $view = "treasurer/assessments/view_city_view";
                    $section = "view_application/city_section_form";
                }
            }
            $data = array(
                'view'=>$view,
                'section'=>$section,
                'application'=>$this->Application_Model->get_application_from_id($this->input->get('id'))
            );
            $this->load->view('treasurer/main_view', $data);
            }
            else{
                redirect('treasurer/assessments');
            }
        }
    }
?>