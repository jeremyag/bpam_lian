<?php
    class Owner{
        public $id;
        public $tin;
        public $last_name;
        public $first_name;
        public $middle_name;
        public $street;
        public $brgy;
        public $city;
        public $province;
        public $postal_code;
        public $email;
        public $mobile;
        public $telephone;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->tin = $arr['tin'];
            $this->last_name = $arr['last_name'];
            $this->first_name = $arr['first_name'];
            $this->middle_name = $arr['middle_name'];
            $this->street = $arr['street'];
            $this->brgy = $arr['brgy'];
            $this->city = $arr['city'];
            $this->province = $arr['province'];
            $this->postal_code = $arr['postal_code'];
            $this->email = $arr['email'];
            $this->mobile = $arr['mobile'];
            $this->telephone = $arr['telephone'];
        }
    }

    class Owner_Model extends CI_Model{

    }
?>