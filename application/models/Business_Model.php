<?php
    class Business{
        public $id;
        public $bp_no;
        public $mode_of_payment;
        public $dti_reg_no;
        public $dti_reg_date;
        public $type;
        public $category;
        public $tax_incentives;
        public $trade_name;
        public $business_name;
        public $lessor_details_id;
        public $emergency_contact_details_id;
        public $owner_id;
        public $business_details_id;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->bp_no = $arr['bp_no'];
            $this->mode_of_payment = $arr['mode_of_payment'];
            $this->dti_reg_no = $arr['dti_reg_no'];
            $this->dti_reg_date = $arr['dti_reg_date'];
            $this->type = $arr['type'];
            $this->category = $arr['category'];
            $this->tax_incentives = $arr['tax_incentives'];
            $this->trade_name = $arr['trade_name'];
            $this->business_name = $arr['business_name'];
            $this->lessor_details_id = $arr['lessor_details_id'];
            $this->emergency_contact_details_id = $arr['emergency_contact_details_id'];
            $this->owner_id = $arr['owner_id'];
            $this->business_details_id = $arr['business_details_id'];
        }
    }

    class Business_Model extends CI_Model{

    }
?>