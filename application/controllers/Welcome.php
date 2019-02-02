<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 25/01/2019
 * Time: 12:06 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller
{
    public function index(){
        $this->load->view('login_view');
    }
}