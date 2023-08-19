<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogoutController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
    }

    public function index()
    {
        // session_destroy();
        $this->session->unset_userdata('authenticated');
        $this->session->unset_userdata('auth_user');
        
        $this->session->set_flashdata('status', 'You are logout successfully!');
        $this->session->set_flashdata('alert', 'success');
        redirect('login');
    }
}