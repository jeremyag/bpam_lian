<?php 
    class Application{
        public $id; // int
        public $code; //String
        public $isNew; //Boolean
        public $date_of_application;
        public $amendment_from;
        public $amendment_to;
        public $municipality;
        public $business_id;
        public $progress;

        public function get_assessment_fees(){
            if($this->id){
                // TODO: Get the assessment fees from the database.
            }
            return false;
        }

        public function get_verification_document_details(){
            if($this->id){
                // TODO: Get verification document details from the database.
            }
            return false;
        }

        public funtion get_business_activity(){
            if($this->id){
                // TODO: Get business activities from the database.
            }
        }

        public function insert(){
            if(!$this->id){
                // TODO: Inserting here.
            }
            return false;
        }
    }
?>