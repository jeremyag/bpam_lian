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
    
    /*
            APPLICATION
        ["application"] =>
            ["status"] = {Unverified, Missing Docs, On Assessment, Done}
    */

    if ( ! function_exists('can_edit'))
    {
        function can_edit($array = array()){
            if(is_treasurer()){
                return false;
            }

            /*
                APPLICATION CHECKING
            */
            if(isset($array["application"])){
                $application = $array["application"];
                if(isset($application["status"])){
                    $s = $application["status"];
                    if($s != "unverified"){
                        return false;
                    }
                }
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

            /*
                APPLICATION CHECKING
            */
            if(isset($array["application"])){
                $application = $array["application"];
                if(isset($application["status"])){
                    $s = $application["status"];
                    if($s != "unverified"){
                        return false;
                    }
                }
            }

            return true;
        }
    }   

    if ( ! function_exists('can_delete'))
    {
        function can_delete($array = array()){
            if(is_treasurer()){
                return false;
            }

            /*
                APPLICATION CHECKING
            */
            if(isset($array["application"])){
                $application = $array["application"];
                if(isset($application["status"])){
                    $s = $application["status"];
                    if($s != "unverified"){
                        return false;
                    }
                }
            }
            
            return true;
        }
    }   

?>