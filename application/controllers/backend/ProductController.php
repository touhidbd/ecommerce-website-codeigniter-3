<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
        $this->Authentication->check_isAdmin();
        $this->load->model('ProductModel');
        $this->load->model('CategoryModel');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['head'] = [
            'title' => 'All Products | CodeIgniter 3 Ecommerce Website'
        ];
        
        $productsModel = new ProductModel;

        $data['products'] = $productsModel->get_products();

        $this->load->view('backend/product/products', $data);
    }

    public function insert()
    {
        $data['head'] = [
            'title' => 'Add Products | CodeIgniter 3 Ecommerce Website'
        ];
        $categories = new CategoryModel;
        $data['categories'] = $categories->get_categories();
        $this->load->view('backend/product/add-product', $data);
    }    
    
    public function check_unique_slug($slug) {
        $this->load->model('SlugModel');
        $table = 'products';
        $result = $this->SlugModel->check_slug_exists($slug, $table);
    
        return $result;
    }

    public function create()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', '');
        $this->form_validation->set_rules('short_description', 'Short Description', '');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('sell_price', 'Selling Price', '');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta Title', '');
        $this->form_validation->set_rules('meta_description', 'Meta Description', '');
        $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', '');
        $this->form_validation->set_rules('category_id', 'Category', '');
        $trending = $this->input->post('trending') == '1' ? '1':'0';
        $status = $this->input->post('status') == '0' ? '0':'1';

        if($this->form_validation->run())
        {
            $ori_filename = $_FILES['image']['name'];
            $new_name = time().'-'.str_replace(' ', '-', $ori_filename);
            $config = [
                'upload_path' => './assets/uploads/products',
                'allowed_types' => 'gif|jpg|jpeg|png|webp|svg',
                'file_name' => $new_name,
            ];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image'))
            {
                $imageError = array('imageError' => $this->upload->display_errors());
                $this->load->view('backend/product/add-product', $imageError);
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
                    'slug' => $slug,
                    'description' => $this->input->post('description'),
                    'short_description' => $this->input->post('short_description'),
                    'price' => $this->input->post('price'),
                    'sell_price' => $this->input->post('sell_price'),
                    'quantity' => $this->input->post('quantity'),
                    'trending' => $trending,
                    'status' => $status,
                    'category_id' => $this->input->post('category_id'),
                    'image' => $filename,
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keywords')
                ];
                $product = new ProductModel;
                $res = $product->insertProduct($data);

                $this->session->set_flashdata('status', 'Product added successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect('admin/products');
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
            'title' => 'Edit Product | CodeIgniter 3 Ecommerce Website'
        ];
        $product = new ProductModel;
        $data['product'] = $product->get_product($id);

        $categories = new CategoryModel;
        $data['categories'] = $categories->get_categories();
        $this->load->view('backend/product/edit-product', $data);
    }

    public function update($id) 
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('slug', 'Slug', 'required');
        $this->form_validation->set_rules('description', 'Description', '');
        $this->form_validation->set_rules('short_description', 'Short Description', '');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('sell_price', 'Selling Price', '');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta Title', '');
        $this->form_validation->set_rules('meta_description', 'Meta Description', '');
        $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', '');
        $this->form_validation->set_rules('category_id', 'Category', '');
        $trending = $this->input->post('trending') == '1' ? '1':'0';
        $status = $this->input->post('status') == '0' ? '0':'1';

        if($this->form_validation->run())
        {
            $old_filename = $this->input->post('old_image_name');
            $new_filename = $_FILES['image']['name'];

            if($new_filename == TRUE) {

                $update_filename =  time().'-'.str_replace(' ', '-', $new_filename);
                $config = [
                    'upload_path' => './assets/uploads/products',
                    'allowed_types' => 'gif|jpg|jpeg|png|webp|svg',
                    'file_name' => $update_filename,
                ];
                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')) {
                    if(file_exists('./assets/uploads/products/'.$old_filename)) {
                        unlink('./assets/uploads/products/'.$old_filename);
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
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'description' => $this->input->post('description'),
                'short_description' => $this->input->post('short_description'),
                'price' => $this->input->post('price'),
                'sell_price' => $this->input->post('sell_price'),
                'quantity' => $this->input->post('quantity'),
                'trending' => $trending,
                'status' => $status,
                'category_id' => $this->input->post('category_id'),
                'image' => $update_filename,
                'meta_title' => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords' => $this->input->post('meta_keywords')
            ];
            $product = new ProductModel;
            $res = $product->updateProduct($data, $id);

            $this->session->set_flashdata('status', 'Product update successfully!');
            $this->session->set_flashdata('alert', 'success');
            redirect('admin/edit-product/'.$id);
        } 
        else 
        {
            $this->session->set_flashdata('status', 'Something went wrong!');
            $this->session->set_flashdata('alert', 'danger');
            redirect('admin/edit-product/'.$id);
        }
    }

    public function delete($id)
    {
        $product = new ProductModel;
        if($product->checkProduct($id))
        {
            $data = $product->checkProduct($id);

            if(file_exists('./assets/uploads/products/'.$data->image)) {
                unlink('./assets/uploads/products/'.$data->image);
            }

            $product->deleteProduct($id);

            $this->session->set_flashdata('status', 'Product deleted successfully!');
            $this->session->set_flashdata('alert', 'success');
            redirect('admin/products');
        }
    }
}