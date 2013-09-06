<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Sidebar_model
 */
class Sidebar_model extends CI_Model {

   /**
    *
    */
   function get_Sidebar() {

   }

   /**
    * @return bool
    */
   function get_recent_Uploads() {
      $this->db->order_by('created', 'desc');
      $this->db->limit(5);
      $query = $this->db->get('storage_document');
      if ($query->num_rows() > 0) {
         return $query;
      }

      return FALSE;
   }

   /**
    * @return bool
    */
   function get_last_Edited() {
      $this->db->order_by('last_edited', 'desc');
      $this->db->limit(5);
      $query = $this->db->get('storage_document');
      if ($query->num_rows() > 0) {
         return $query;
      }

      return FALSE;
   }
}
/* End of file sidebar_model.php */
/* Location: ./application/models/sidebar_model.php */