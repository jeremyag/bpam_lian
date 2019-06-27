<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if ( ! function_exists('build_update_columns'))
    {
        function build_update_columns($assoc, $alias = ""){
            $update_column = "";
            $total = count($assoc);
            $c = 1;

            $alias = ($alias == "" ? "" : $alias.".");
            
            foreach($assoc as $a => $i){
                if($c == $total){
                    $update_column .= " $alias`$a` = '$i' ";
                }
                else{
                    $update_column .= " $alias`$a` = '$i', ";
                }
                $c++;
            }
            return $update_column;
        }
    }

?>