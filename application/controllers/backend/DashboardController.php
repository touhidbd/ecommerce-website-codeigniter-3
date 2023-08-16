<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
        $this->Authentication->check_isAdmin();
    }

    public function index()
    {
        $this->load->view('backend/dashboard');
    }
}