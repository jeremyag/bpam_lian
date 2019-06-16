<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if ( ! function_exists('c_log'))
    {
        function c_log($str){
            echo "<script>console.log('".$str."')</script>";
        }
    }

    if(!function_exists('c_table'))
    {
        function c_table($str){
            echo "<script>console.table('".$str."')</script>";
        }
    }
?>