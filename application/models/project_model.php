<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Project_model
 */
class Project_model extends CI_Model {

   /**
    * @param $name
    * @param $number
    *
    * @return bool
    */
   function create_Project($name, $number) {
      // mehrfache speicherung ueberpruefen...
      $this->db->where('name', $name);
      $query = $this->db->get('storage_project');
      if ($query->num_rows == 1) {
          return FALSE;
      }
      $this->db->where('number', $number);
      $query = $this->db->get('storage_project');
      if ($query->num_rows == 1) {
          return FALSE;
      }
      $data = array(
         'name'   => $name,
         'number' => $number
      );
      $this->db->insert('storage_project', $data);

      return TRUE;
   }

   /**
    * @param null $id
    *
    * @return array|bool
    */
   function get_Project($id = NULL) {
      if (isset($id)) {
         $this->db->where('id', $id);
         $project = $this->db->get('storage_project');
         if ($project->num_rows() == 1) {
            $row = $project->row();

            return $row;
         }
      }

      $projects = $this->db->get('storage_project');
      if ($projects->num_rows() > 0) {
         //$tmp[] = '--- view all ---';

         foreach ($projects->result() as $project) {
            $tmp[$project->id] = $project->name;
         }

         return $tmp;
      }

      return FALSE;

   }

   /**
    * @param $entered
    *
    * @return bool
    */
   function getHints($entered) {
      $this->db->like('name', $entered, 'after');
      $result = $this->db->get('storage_project');

      if ($result->num_rows() > 0) {
         return $result;
      }

      return FALSE;
   }

   /**
    *
    */
   function update_Project() {

   }

   /**
    *
    */
   function delete_Project() {

   }

   /**
    * @param $inputed
    * @param $id
    *
    * @return bool
    */
   function checking($inputed, $id) {
      if ($id == "project_name") {
         $this->db->where('name', $inputed);
         $result = $this->db->get('storage_project');
         //falls was gefunden ist heisst der input vom user schon vorhanden ist, return false
         if ($result->num_rows() > 0) {
             return "This project name is already used!";
         }
         return FALSE;
      }
      else if ($id == "project_number") {
         $this->db->where('number', $inputed);
         $result = $this->db->get('storage_project');
         //falls was gefunden ist heisst der input vom user schon vorhanden ist, return false
         if ($result->num_rows() > 0) {
             return "This project number is already used!";
         }
         return FALSE;
      }



   }
}
/* End of file project_model.php */
/* Location: ./application/models/project_model.php */