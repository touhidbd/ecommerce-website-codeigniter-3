<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model 
{
    public function insertCategory($data) 
    {
        return $this->db->insert('categories', $data);
    }

    public function get_categories() 
    {
        $query = $this->db->get('categories');
        return $query->result();
    }

    public function get_category($id) 
    {
        // $this->db->select('*');
        // $this->db->where('id', $id);
        // $this->db->from('categories');
        // $this->db->limit(1);
        
        
        $query = $this->db->get_where('categories', ['id' => $id]);
        if($query->num_rows() == 1) 
        {
            return $query->row();
        }
        else 
        {
            return false;
        }
    }

    public function updateCategory($data, $id)
    {
        return $this->db->update('categories', $data, ['id' => $id]);
    }
}
