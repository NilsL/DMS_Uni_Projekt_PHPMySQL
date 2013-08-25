<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 *
 */
class Classification_model extends CI_Model {

   /**
    *
    *
    *
    */
   function create_Classification() {

   }

   /**
    *
    *
    *
    */
   function get_Classification() {
      $classifications = $this->db->get('storage_classification');
      if ($classifications->num_rows() > 0) {
         $tmp = array();

         foreach ($classifications->result() as $class) {
            $tmp[$class->id] = $class->name;
         }

         return $tmp;
      }

      return FALSE;
   }

   /**
    *
    *
    *
    */
   function update_Classification() {

   }

   /**
    *
    *
    *
    */
   function delete_Classification() {

   }
}
/* End of file classification_model.php */
/* Location: ./application/models/classification_model.php */