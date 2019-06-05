<?php 
    class Assessments_Controller extends CI_Controller{
        public function assess() {
            if($this->input->get("id")){
                $view = "treasurer/assessments/assess_form_view";
                $data = array(
                    "assessment_fees_list"=>$this->Assessment_Fees_List_Model->get_all()
                );

                $this->load->view($view, $data);
            }
        }    
        
        public function send_assessment(){
            if($this->input->post("assess")){
                $id = "";
                $assessments = $this->input->post("assess");

                if(count($assessments)>0){
                    $id = $assessments[0]["application_id"];
                    foreach($assessments as $a){
                        $this->Assessment_Fees_Model->insert($a);
                    }
                    redirect(add_index()."treasurer/view_application?id=".$id);
                }
            }
        }
    }
?>