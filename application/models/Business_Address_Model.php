<?php
    class Business_Address{
        public $id;
        public $business_id;
        public $street;
        public $brgy;
        public $postal_code;
        public $email;
        public $mobile;
        public $telephone;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->business_id = $arr['business_id'];
            $this->street = $arr['street'];
            $this->brgy = $arr['brgy'];
            $this->postal_code = $arr['postal_code'];
            $this->email = $arr['email'];
            $this->mobile = $arr['mobile'];
            $this->telephone = $arr['telephone'];
        }
    }

    class Business_Address_Model extends CI_Model{

    }
?>