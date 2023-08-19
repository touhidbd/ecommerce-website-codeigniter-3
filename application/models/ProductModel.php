<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model 
{
    public function get_products() 
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('categories', 'products.category_id = categories.category_id');

        $query = $this->db->get();
        return $query->result();
    }

    public function insertProduct($data)
    {
        return $this->db->insert('products', $data);
    }

    public function get_product($id) 
    {        
        $query = $this->db->get_where('products', ['id' => $id]);
        if($query->num_rows() == 1) 
        {
            return $query->row();
        }
        else 
        {
            return false;
        }
    }

    public function updateProduct($data, $id)
    {
        return $this->db->update('products', $data, ['id' => $id]);
    }

    public function checkProduct($id)
    {
        $query = $this->db->get_where('products', ['id' => $id]);
        return $query->row();
    }

    public function deleteProduct($id)
    {
        return $this->db->delete('products', ['id' => $id]);
    }
}
