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
        $data['head'] = [
            'title' => 'Categories | CodeIgniter 3 Ecommerce Website'
        ];

        $categories = new CategoryModel;
        $data['categories'] = $categories->get_categories();
        $this->load->view('backend/category/view-category', $data);
    }

    public function insert()
    {
        $data['head'] = [
            'title' => 'Add Category | CodeIgniter 3 Ecommerce Website'
        ];
        $this->load->view('backend/category/add-category', $data);
    }

    public function check_unique_slug($slug) {
        $this->load->model('CategorySlugModel');
        $table = 'categories';
        $result = $this->CategorySlugModel->check_slug_exists($slug, $table);
    
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
                    'category_name' => $title,
                    'category_sub_title' => $this->input->post('sub_title'),
                    'category_slug' => $slug,
                    'category_description' => $this->input->post('description'),
                    'category_image' => $filename,
                    'category_meta_title' => $this->input->post('meta_title'),
                    'category_meta_description' => $this->input->post('meta_description'),
                    'category_meta_keywords' => $this->input->post('meta_keywords'),
                    'category_status' => $status
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
        $data['head'] = [
            'title' => 'Edit Category | CodeIgniter 3 Ecommerce Website'
        ];
        $category = new CategoryModel;
        $data['category'] = $category->get_category($id);
        $this->load->view('backend/category/edit-category', $data);
    }

    public function update($id) 
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('sub_title', 'Sub Title', 'required');
        $this->form_validation->set_rules('slug', 'Slug', 'required');
        $this->form_validation->set_rules('old_slug', 'Old Slug', 'required');
        $this->form_validation->set_rules('old_image_name', 'Old Image', 'required');
        $this->form_validation->set_rules('description', 'Description', '');
        $this->form_validation->set_rules('meta_title', 'Meta Title', '');
        $this->form_validation->set_rules('meta_description', 'Meta Description', '');
        $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', '');
        $status = $this->input->post('status') == '0' ? '0':'1';

        if($this->form_validation->run())
        {
            $old_filename = $this->input->post('old_image_name');
            $new_filename = $_FILES['image']['name'];

            if($new_filename == TRUE) {

                $update_filename =  time().'-'.str_replace(' ', '-', $new_filename);
                $config = [
                    'upload_path' => './assets/uploads/category',
                    'allowed_types' => 'gif|jpg|jpeg|png|webp|svg',
                    'file_name' => $update_filename,
                ];
                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')) {
                    if(file_exists('./assets/uploads/category/'.$old_filename)) {
                        unlink('./assets/uploads/category/'.$old_filename);
                    }
                }

            } else {
                $update_filename = $old_filename;
            }

            $input_slug = $this->input->post('slug');
            $old_slug = $this->input->post('old_slug');
            if($input_slug !== $old_slug) {
                $slug = url_title($input_slug, '-', TRUE);
                $count = 1;
                $base_slug = $slug;

                while ($this->check_unique_slug($slug) == FALSE) {
                    $slug = $base_slug . '-' . $count;
                    $count++;
                }
            } else {
                $slug = $old_slug;
            }

            $data = [
                'category_name' => $this->input->post('title'),
                'category_sub_title' => $this->input->post('sub_title'),
                'category_slug' => $slug,
                'category_description' => $this->input->post('description'),
                'category_image' => $update_filename,
                'category_meta_title' => $this->input->post('meta_title'),
                'category_meta_description' => $this->input->post('meta_description'),
                'category_meta_keywords' => $this->input->post('meta_keywords'),
                'category_status' => $status
            ];
            $category = new CategoryModel;
            $res = $category->updateCategory($data, $id);

            $this->session->set_flashdata('status', 'Category update successfully!');
            $this->session->set_flashdata('alert', 'success');
            redirect('admin/edit-category/'.$id);
        } 
        else 
        {
            $this->session->set_flashdata('status', 'Something went wrong!');
            $this->session->set_flashdata('alert', 'danger');
            redirect('admin/edit-category/'.$id);
        }
    }

    public function delete($id)
    {
        $category = new CategoryModel;
        if($category->checkCategory($id))
        {
            $data = $category->checkCategory($id);

            if(file_exists('./assets/uploads/category/'.$data->category_image)) {
                unlink('./assets/uploads/category/'.$data->category_image);
            }

            $category->deleteCategory($id);

            $this->session->set_flashdata('status', 'Category deleted successfully!');
            $this->session->set_flashdata('alert', 'success');
            redirect('admin/categories');
        }
    }
}