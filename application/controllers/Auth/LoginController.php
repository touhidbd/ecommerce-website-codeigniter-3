<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->has_userdata('authenticated'))
        {            
            $this->session->set_flashdata('status', 'You are already loggedin!');
            $this->session->set_flashdata('alert', 'success');                    
            redirect('account');
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('UserModel');
    }

    public function index()
    {
        $this->load->view('frontend/login');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');

        if($this->form_validation->run() == FALSE)
        {
            // Fails
            $this->index();
        }
        else
        {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            $login_user = new UserModel;
            $result = $login_user->loginUser($data);

            if($result != FALSE) {
                
                $auth_userdetails = [
                    'first_name' => $result->first_name,
                    'last_name' => $result->last_name,
                    'email' => $result->email,
                    'role_as' => $result->role_as
                ];

                $this->session->set_userdata('authenticated', 1);
                $this->session->set_userdata('auth_user', $auth_userdetails);
                $this->session->set_flashdata('status', 'Login successfully!');
                $this->session->set_flashdata('alert', 'success');
                
                if($this->session->userdata('auth_user')['role_as'] == '1') {
                    redirect('admin/dashboard');
                } else {
                   redirect('account'); 
                }                
            } else {                    
                $this->session->set_flashdata('status', 'Invalid Email or Password!');
                $this->session->set_flashdata('alert', 'danger');
                redirect('login');
            }
        }
    }
}