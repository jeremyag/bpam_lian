<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if ( ! function_exists('is_treasurer'))
    {
        function is_treasurer(){
            $CI =& get_instance();
            $position = $CI->session->userdata("user_position");
            if($position == "Treasurer"){
                return true;
            }
            return false;
        }
    }

    if ( ! function_exists('can_edit'))
    {
        function can_edit($array = array()){
            if(is_treasurer()){
                return false;
            }
            return true;
        }
    }    

    if ( ! function_exists('can_add'))
    {
        function can_add($array = array()){
            if(is_treasurer()){
                return false;
            }
            return true;
        }
    }   

?>