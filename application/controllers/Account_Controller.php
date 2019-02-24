<?php
    class Account_Controller extends CI_Controller{
        public function register(){
            $this->form_validation->set_rules('form_first_name', 'First name', 'trim|required');
            $this->form_validation->set_rules('form_last_name', 'Last name', 'trim|required');
            $this->form_validation->set_rules('form_username', 'Username', 'trim|required|callback_check_username');
            $this->form_validation->set_rules('form_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('form_confirm_password', 'Confirm Password', 'trim|required|matches[form_password]');
            $this->form_validation->set_rules('form_email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('form_contact_no', 'Contact No.', 'trim|required');

            if(!$this->form_validation->run()){
                $data = array(
                    'register_errors' => validation_errors()
                );

                $this->session->set_flashdata($data);

                redirect('admin/register');
            }
            else{
                $param = array(
                    'first_name'=>$this->input->post('form_first_name'),
                    'middle_name'=>$this->input->post('form_middle_name'),
                    'last_name'=>$this->input->post('form_last_name'),
                    'username'=>$this->input->post('form_username'),
                    'password'=>md5($this->input->post('form_password')),
                    'email'=>$this->input->post('form_email'),
                    'contact_no'=>$this->input->post('form_contact_no'),
                    'gender'=>$this->input->post('form_gender'),
                    'position'=>$this->input->post('form_position')
                );

                $this->User_Model->register($param);
            }
           
            redirect('admin/accounts');

        }

        public function check_username($username){
            if($this->User_Model->is_username_exist($username)){
                $this->form_validation->set_message('check_username', 'The {field} must be unique!');
                return FALSE;
            }
            return TRUE;
        }

        public function login(){
            $this->form_validation->set_rules('form_username', 'Username', 'trim|required');
            $this->form_validation->set_rules('form_password', 'Password', 'trim|required');

            if(!$this->form_validation->run()){
                $data = array(
                    'login_errors'=>validation_errors()
                );
            }
            else{
                if($this->User_Model->is_username_exist($this->input->post('form_username'))){
                    $user = $this->User_Model->get_user_from_username($this->input->post('form_username'));
                    if(md5($this->input->post('form_password')) == $user->password){
                        $this->session->set_userdata(array(
                            'user_id'=>$user->id,
                            'user_position'=>$user->position
                        ));
                        if($user->position == "Administrator"){
                            redirect('admin/');
                        }
                    }
                    else{
                        $data = array(
                            'login_errors'=>'User credentials doesn\'t match'
                        );
                    }
                }
            }
            $this->session->set_flashdata($data);
            redirect('/');
        }

        public function update(){
            if($this->input->post('submit') == 'Disable Account'){
                $this->User_Model->disable_account($this->input->post('id'));
            }

            if($this->input->post('submit') == 'Activate'){
                $this->User_Model->enable_account($this->input->post('id'));
            }

            if($this->input->post('submit') == 'Update'){
                $this->User_Model->update($this->input->post());
            }

            //redirect('admin/profile');
        }
    }

?>