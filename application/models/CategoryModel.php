<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model 
{
    public function insertCategory($data) {
        return $this->db->insert('categories', $data);
    }

    public function get_categories() {
        $query = $this->db->get('categories');
        return $query->result();
    }
}
