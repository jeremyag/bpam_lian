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

        public function general_settings(){
            $view = "admin/settings/ajax/settings_general_view";
            $this->load->view($view,array(
                "settings"=>$this->General_Settings_Model->get_all()
            ));
        }

        public function general_settings_form(){
            $this->load->view("admin/settings/form/general_settings_form",array(
                "settings"=>$this->General_Settings_Model->get_general_settings_from_id($this->input->get("id"))
            ));
        }

        public function submit_general_settings(){
            if($this->input->post("settings_value")){
                $this->General_Settings_Model->update($this->input->post("id"), array(
                    $this->input->post("name"),
                    $this->input->post("settings_value")
                ));
            }
            redirect(add_index()."admin/settings");
        }

        public function verification_documents(){
            $this->load->view("admin/settings/ajax/settings_verification_documents_view", array(
                "verifications"=>$this->Verification_Document_List_Model->get_all()
            ));
        }

        public function verification_documents_form(){
            $disabled = "";
            if($this->input->get("disabled") == 1){
                $disabled = "disabled";
            }

            if($this->input->get("id")){
                $this->load->view("admin/settings/form/verification_document_form", array(
                    "disabled"=>$disabled,
                    "v"=>$this->Verification_Document_List_Model->get_verification_document_list_from_id($this->input->get("id"))
                ));
            }
            else{
                $this->load->view("admin/settings/form/verification_document_form", array(
                    "disabled"=>$disabled,
                    "v"=>0
                ));
            }
            
        }

        public function submit_verification_document(){
            if($this->input->post("id")){
                $this->Verification_Document_List_Model->update($this->input->post("id"), array(
                    $this->input->post("description"),
                    $this->input->post("office_agency")
                ));
            }
            else{
                $this->Verification_Document_List_Model->insert(array(
                    $this->input->post("description"),
                    $this->input->post("office_agency")
                ));
            }
            redirect(add_index()."admin/settings");
        }

        public function delete_verification_document(){
            if($this->input->post("id")){
                $this->Verification_Document_List_Model->delete($this->input->post("id"));
            }
            redirect(add_index()."admin/settings");
        }

        public function business_categories(){
            $this->load->view("admin/settings/ajax/settings_business_categories_view", array(
                "business_categories"=>$this->Business_Categories_List_Model->get_all()
            ));
        }

        public function business_categories_form(){
            $bc = 0;
            $disabled = $this->input->get("disabled");

            if($this->input->get("id")){
                $bc = $this->Business_Categories_List_Model->get_business_category_from_id($this->input->get("id"));
            }

            $this->load->view("admin/settings/form/business_categories_form", array(
                "disabled"=>$disabled,
                "bc"=>$bc,
                "action"=>$this->input->get("action")
            ));
        }

        public function submit_business_categories(){
            if($this->input->post("action") == "edit"){
                $this->Business_Categories_List_Model->update($this->input->post("id"), array(
                    $this->input->post("name"),
                    $this->input->post("definition")
                ));
            }
            elseif($this->input->post("action") == "add"){
                $this->Business_Categories_List_Model->insert(array(
                    $this->input->post("name"),
                    $this->input->post("definition")
                ));
            }
            elseif($this->input->post("action") == "delete"){
                $this->Business_Categories_List_Model->delete($this->input->post("id"));
            }
            redirect(add_index()."admin/settings");
        }

        public function barangay_list(){
            $this->load->view("admin/settings/ajax/settings_barangay_list_view", array(
                "barangays"=>$this->Barangay_List_Model->get_all()
            ));
        }

        public function barangay_list_form(){
            $b = 0;
            $disabled = $this->input->get("disabled");

            if($this->input->get("id")){
                $b = $this->Barangay_List_Model->get_barangay_from_id($this->input->get("id"));
            }

            $this->load->view("admin/settings/form/barangay_form", array(
                "disabled"=>$disabled,
                "b"=>$b,
                "action"=>$this->input->get("action")
            ));
        }

        public function submit_barangay(){
            if($this->input->post("action") == "edit"){
                $this->Barangay_List_Model->update($this->input->post("id"), array(
                    $this->input->post("name")
                ));
            }
            elseif($this->input->post("action") == "add"){
                $this->Barangay_List_Model->insert(array(
                    $this->input->post("name")
                ));
            }
            elseif($this->input->post("action") == "delete"){
                $this->Barangay_List_Model->delete($this->input->post("id"));
            }
            redirect(add_index()."admin/settings");
        }
    }
?>