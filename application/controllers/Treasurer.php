<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Treasurer extends CI_Controller{
        public function index(){
            // $this->acccount_check();

            $data = array('view'=>'treasurer/home/home_view');
            $this->load->view('treasurer/main_view', $data);
        }

        public function assessments(){
            // $this->acccount_check();

            $data = array('view'=>'treasurer/assessments/assessments_view');
            $this->load->view('treasurer/main_view', $data);
        }

        public function logout(){
            
        }

        private function acccount_check(){
            if(!$this->session->userdata('user_id')){
                    redirect('/');
            }
            
            if($this->session->userdata('user_position') != 'Treasurer'){
                redirect('/');
            }
        }
    }
?>