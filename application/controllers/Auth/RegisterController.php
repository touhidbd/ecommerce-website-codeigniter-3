<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->has_userdata('authenticated'))
        {            
            $this->session->set_flashdata('status', 'You are already loggedin!');
            $this->session->set_flashdata('alert', 'success');                    
            redirect('userpage');
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('UserModel');
    }

	public function index()
	{
		$this->load->view('frontend/register');
	}

    public function register()
    {
        if(isset($_POST)) {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|md5|matches[password]');

            if($this->form_validation->run() == FALSE)
            {
                // Faild
                $this->index();
            } 
            else 
            {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password')
                );
                $register_user = new UserModel;
                $checking = $register_user->registerUser($data);

                if($checking) {
                    $this->session->set_flashdata('status', 'Registered successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect('login');
                } else {                    
                    $this->session->set_flashdata('status', 'Something went wrong!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect('register');
                }
            }
        }
    }
}
