<?php 
    class Lessor{
        public $id;
        public $full_name;
        public $full_address;
        public $contact;
        public $email;

        public function set_instance_array($arr){
            $this->id = $arr['id'];
            $this->full_name = $arr['full_name'];
            $this->full_address = $arr['full_address'];
            $this->contact = $arr['contact'];
            $this->email = $arr['email'];
        }
    }

    class Lessor_Model extends CI_Model{

    }
?>