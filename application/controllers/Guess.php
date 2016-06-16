<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guess extends CI_Controller
{
    //
    public function index()
    {

        $this->load->view('inc/header');
        //var_dump($this->config->item('role_user'));
        //var_dump($this->session->roles);

        //var_dump($this->verify->authorize_by_role('role_xx_admin',$this->session->roles));

        $this->load->view('guess/index');
        $this->load->view('inc/footer');
    }
}
