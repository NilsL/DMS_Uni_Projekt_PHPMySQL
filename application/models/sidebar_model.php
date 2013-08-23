<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 *
 */
class Sidebar_model extends CI_Model {

   /**
    *
    *
    *
    */
   function get_Sidebar() {

   }

   /**
    *
    *
    *
    */
   function get_recent_Uploads() {
      $this->db->limit(3);
      $recent_Uploads = $this->db->get('storage_document');

      return $recent_Uploads;
   }

   /**
    *
    *
    *
    */
   function get_last_Edited() {
      $this->db->limit(3);
      $last_Edited = $this->db->get('storage_document');

      return $last_Edited;
   }
}
/* End of file sidebar_model.php */
/* Location: ./application/models/sidebar_model.php */