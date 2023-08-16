<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SlugModel extends CI_Model 
{
    public function check_slug_exists($slug) {
        $this->db->where('slug', $slug);        
        $this->db->from('categories');

        $query = $this->db->get();

        if($query->num_rows() > 0) 
        {
            return false;
        }
        else 
        {
            return true;
        }
    }
}
