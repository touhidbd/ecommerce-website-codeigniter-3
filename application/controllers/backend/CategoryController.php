<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Authentication');
        $this->Authentication->check_isAdmin();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('CategoryModel');
    }

    public function index()
    {
        $categories = new CategoryModel;
        $data['categories'] = $categories->get_categories();
        $this->load->view('backend/category/view-category', $data);
    }

    public function insert()
    {
        $this->load->view('backend/category/add-category');
    }

    public function check_unique_slug($slug) {
        $this->load->model('SlugModel');
        $result = $this->SlugModel->check_slug_exists($slug);
    
        return $result;
    }

    public function create()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('sub_title', 'Sub Title', 'required');
        $this->form_validation->set_rules('description', 'Description', '');
        $this->form_validation->set_rules('meta_title', 'Meta Title', '');
        $this->form_validation->set_rules('meta_description', 'Meta Description', '');
        $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', '');
        $status = $this->input->post('status') == '0' ? '0':'1';

        if($this->form_validation->run())
        {
            $ori_filename = $_FILES['image']['name'];
            $new_name = time().'-'.str_replace(' ', '-', $ori_filename);
            $config = [
                'upload_path' => './assets/uploads/category',
                'allowed_types' => 'gif|jpg|jpeg|png|webp|svg',
                'file_name' => $new_name,
            ];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image'))
            {
                $imageError = array('imageError' => $this->upload->display_errors());
                $this->load->view('backend/category/add-category', $imageError);
            }
            else
            {
                $filename = $this->upload->data('file_name');    

                $title = $this->input->post('title');
                $slug = url_title($title, '-', TRUE);
                $count = 1;
                $base_slug = $slug;
                while ($this->check_unique_slug($slug) == FALSE) {
                    $slug = $base_slug . '-' . $count;
                    $count++;
                }

                $data = [
                    'title' => $title,
                    'sub_title' => $this->input->post('sub_title'),
                    'slug' => $slug,
                    'description' => $this->input->post('description'),
                    'image' => $filename,
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'status' => $status
                ];
                $category = new CategoryModel;
                $res = $category->insertCategory($data);

                $this->session->set_flashdata('status', 'Category added successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect('admin/categories');
            }
        } 
        else 
        {
            $this->insert();

            $this->session->set_flashdata('status', 'Something went wrong!');
            $this->session->set_flashdata('alert', 'danger');
        }
    }

    public function edit($id)
    {
        return print_r($id);
    }
}