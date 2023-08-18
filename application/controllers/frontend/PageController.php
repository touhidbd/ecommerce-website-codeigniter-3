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
        $data['head'] = [
            'title' => 'User details | CodeIgniter 3 Ecommerce'
        ];
        $this->load->view('frontend/user', $data);
    }
}