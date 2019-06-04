<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if ( ! function_exists('add_index'))
    {
        function add_index(){
            $server = $_SERVER["SERVER_NAME"];

            if($server == "localhost"){
                return "";
            }
            elseif($server == "bpamlian.000webhostapp.com"){
                return "index.php/";
            }
        }
    }

?>