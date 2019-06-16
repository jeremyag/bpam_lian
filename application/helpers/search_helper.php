<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if(!function_exists("build_search_filter")){
        function build_search_filter($columns = array(), $keyword = "", $alias = "t", $first = FALSE){
            $search_filter = "";
            $count = count($columns);

            if($count && $keyword != ""){
                if(TRUE){
                    $search_filter .= " OR ";
                }

                $search_filter = " ( ";
                for($i = 0; $i < $count; $i++){
                    if($i == $count-1){
                        $search_filter .= " $alias.{$columns[$i]} LIKE '%$keyword%' ) ";
                    }
                    else{
                        $search_filter .= " $alias.{$columns[$i]} LIKE '%$keyword%' OR ";
                    }
                }

                return $search_filter;
            }
        }
    }
?>