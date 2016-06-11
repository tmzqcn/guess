<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guess extends CI_Controller
{
    //
    public function index()
    {
        $this->load->view('inc/header');
        $this->load->view('guess/index');
        $this->load->view('inc/footer');
    }
}
