<?php 
    class Settings_Controller extends CI_Controller{
        public function settings_assessments(){
            $view = "admin/settings/ajax/settings_assessments_view";
            $form = "admin/settings/form/taxes_form";

            $this->load->view($view, array(
                "form"=>$form,
                "taxes"=>$this->Assessment_Fees_List_Model->get_all()
            ));
        }

        public function settings_assessments_form(){

            if($this->input->get("id")>=0){
                $view = "admin/settings/form/taxes_form";

                $tax = new Assessment_Fees_List;
                if($this->input->get("id") != 0){
                    $tax = $this->Assessment_Fees_List_Model->get_assessments_from_id($this->input->get("id"));
                }

                $this->load->view($view, array(
                    "tax"=>$tax,
                    "action"=>$this->input->get("action")
                ));
            }
        }

        public function submit_assessment_form(){
            if($this->input->post("action")){
                $action = $this->input->post("action");

                if($action == "add"){
                    $assessment = $this->input->post("local_taxes");

                    $this->Assessment_Fees_List_Model->insert($assessment);

                }elseif($action == "edit"){
                    $assessment = array(
                        "local_taxes"=>$this->input->post("local_taxes"),
                        "id"=>$this->input->post("id")
                    );

                    $this->Assessment_Fees_List_Model->update($assessment);
                }
                elseif($action == "delete"){
                    $assessment = $this->input->post("id");

                    $this->Assessment_Fees_List_Model->delete($assessment);
                }

            }

            redirect(add_index()."admin/settings");
        }
    }
?>