<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
    }
    
    public function index()
    {
        $this->load->view('frontend/user');
    }
}