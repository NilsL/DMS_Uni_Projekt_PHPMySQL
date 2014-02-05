<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Classification_model
 */
class Classification_model extends CI_Model {

   /**
    * @param $name Name der neuen Klassifizierung
    *
    * @return bool liefert <code> TRUE </code> wenn der Insert erfolgreich war
    */
   function create_Classification($name) {
     // mehrfache speicherung Ueberpruefen...
     $this->db->where('name', $name);
     $query = $this->db->get('storage_classification');
     if ($query->num_rows == 1) {
            return FALSE;
     }

      $data   = array('name' => $name);
      $result = $this->db->insert('storage_classification', $data);

      return $result;
   }

   /**
    * @param null $id die Übergebene ID der Klassifizierung
    *
    * @return array|bool gibt entweder die gesuchte Klassifizierung zurück oder ein Array für ein Dropdown
    */
   function get_Classification($id = NULL) {
      if (isset ($id)) {
         $this->db->where('id', $id);
         $classification = $this->db->get('storage_classification');
         if ($classification->num_rows() > 0) {
            return $classification->row();
         }
      }
      $classifications = $this->db->get('storage_classification');
      if ($classifications->num_rows() > 0) {
         //$tmp[] = '--- view all ---';

         foreach ($classifications->result() as $class) {
            $tmp[$class->id] = $class->name;
         }

         return $tmp;
      }

      return FALSE;
   }

   /**
    * @param $entered
    *
    * @return bool
    *
    * noch nicht final
    */
   function getHints($entered) {
      $this->db->like('name', $entered, 'after');
      $result = $this->db->get('storage_classification');

      if ($result->num_rows() > 0) {
         return $result;
      }

      return FALSE;
   }

   /**
    * updates a classification
    * @return bool
    */
   function update_Classification() {
      return TRUE;
   }

   /**
    * classification deletion
    * @return bool
    */
   function delete_Classification() {
      return TRUE;
   }

   /**
    * @param $inputed
    * @param $id
    *
    * @return bool
    */
   function checking($inputed, $id) {
      $this->db->where('name', $inputed);

      $result = $this->db->get('storage_classification');

      //falls was gefunden ist heisst der input vom user schon vorhanden ist, return false
      if ($result->num_rows() > 0) {
         return "This classification name is already used!";
      }
      return FALSE;
   }
}
/* End of file classification_model.php */
/* Location: ./application/models/classification_model.php */