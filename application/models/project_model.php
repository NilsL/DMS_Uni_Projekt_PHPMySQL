<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 *
 */
class Project_model extends CI_Model {

   /**
    *
    *
    *
    */
	function create_Classification($name) {
		// mehrfache speicherung ¨¹berpr¨¹fen...
		$this->db->where ( 'name', $name );
		$query = $this->db->get ( 'storage_classification' );
		if ($query->num_rows == 1) {
			return false;
		}
		
		$data = array (
				'name' => $name 
		);
		$this->db->insert ( 'storage_classification', $data );
		return true;
	}

   /**
    * mit $id gesetzt wird nur das jeweilige project gefetched, sonst alle!
    *
    *
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
         $tmp[] = '--- view all ---';

         foreach ($projects->result() as $project) {
            $tmp[$project->id] = $project->name;
         }

         return $tmp;
      }

      return FALSE;

   }

   /**
    * noch nicht final nur fÃ¼r erste tests. lÃ¤uft aber ohne fehler schon
    *
    *
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
    *
    *
    */
   function update_Project() {

   }

   /**
    *
    *
    *
    */
   function delete_Project() {

   }

}
/* End of file project_model.php */
/* Location: ./application/models/project_model.php */