<?php

class Blog_model extends CI_Model {



   function getBlogSettings()
   {
       $this->db->select('*');
       $q = $this->db->get('blog_settings');
       return $q->row();
   }
   function getBlogs()
   {
       $this->db->select('*');
       $q = $this->db->get('blogs');
       return $q->result();
   }
}
