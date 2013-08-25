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
   function get_Classification ($id = NUll) {
	if (isset ( $id )) {
		$this->db->where ( 'id', $id );
		$classification = $this->db->get ( 'storage_classification' );
		if ($classification->num_rows () > 0) {
			$row = $classification->result();
			return $row;
		}
	}
      $classifications = $this->db->get('storage_classification');
      if ($classifications->num_rows() > 0) {
         $tmp[] = '--- view all ---';

         foreach ($classifications->result() as $class) {
            $tmp[$class->id] = $class->name;
         }

         return $tmp;
      }

      return FALSE;
   }

   
   /**
    * noch nicht final nur für erste tests. läuft aber ohne fehler schon
    *
    *
    */
   function getHints($entered) {
   	$this->db->like('name', $entered, 'after');
   	$result = $this->db->get('storage_classfication');
   
   	if ($result->num_rows() > 0) {
   		return $result;
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