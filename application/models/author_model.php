<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 *
 */
class Author_model extends CI_Model {

   /**
    *
    *
    *
    */
   function create_Author() {

   }


   /**
    * fetched den Author aus der DB
    *
    *
    */
   function get_Author($id) {
      $this->db->where('id', $id);
      $author = $this->db->get('storage_author');

      if ($author->num_rows() > 0) {
         $row = $author->result_array();

         return $row[0];
      }

   }

   /**
    *
    *
    *
    */
   function getAuthors() {
      $authors = $this->db->get('storage_author');

      if ($authors->num_rows() > 0) {
         return $authors;
      }
      return FALSE;
   }

   /**
    *
    *
    *
    */
   function update_Author() {

   }

   /**
    *
    *
    *
    */
   function delete_Author() {

   }

}
/* End of file author_model.php */
/* Location: ./application/models/author_model.php */