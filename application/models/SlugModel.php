<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SlugModel extends CI_Model 
{
    public function check_slug_exists($slug, $table) {
        $this->db->where('slug', $slug);        
        $this->db->from($table);

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
