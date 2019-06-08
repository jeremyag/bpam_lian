<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if ( ! function_exists('compute_pages'))
    {
        function compute_pages($total, $per_page){
            $pages = $total/$per_page;

            if($total % $per_page){
                $pages++;
            }

            return $pages;
        }
    }

?>