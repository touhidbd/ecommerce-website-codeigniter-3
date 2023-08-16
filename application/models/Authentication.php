<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->has_userdata('authenticated')){
           
        }
        else
        {
            $this->session->set_flashdata('status', 'Login First!');
            $this->session->set_flashdata('alert', 'danger');
            redirect('login');
        }
    }

    public function check_isAdmin()
    {
        if($this->session->has_userdata('authenticated'))
        {
            if($this->session->userdata('auth_user')['role_as'] != '1')
            {
                $this->session->set_flashdata('status', 'Access denied! You are not an admin!');
                $this->session->set_flashdata('alert', 'danger');
                redirect('account');
            }
        }
        else
        {            
            $this->session->set_flashdata('status', 'Login First!');
            $this->session->set_flashdata('alert', 'danger');
            redirect('login');
        }
    }
}