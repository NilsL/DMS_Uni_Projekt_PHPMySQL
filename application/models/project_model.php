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
	function create_Project($name, $number) {
		// mehrfache speicherung ueberpruefen...
		$this->db->where ( 'name', $name );
		$query = $this->db->get ( 'storage_project' );
		if ($query->num_rows == 1) {
			return false;
		}
		$this->db->where ( 'number', $number );
		$query = $this->db->get ( 'storage_project' );
		if ($query->num_rows == 1) {
			return false;
		}
		
		$data = array (
				'name' => $name,
				'number' => $number
		);
		$this->db->insert ( 'storage_project', $data );
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
    * noch nicht final nur für erste tests. läuft aber ohne fehler schon
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

    function checking($inputed, $id) {
        if($id=="project name") {
            $this->db->where('name', $inputed);
        } else if($id=="project number") {
            $this->db->where('number', $inputed);
        }
        $result = $this->db->get('storage_project');

        //falls was gefunden ist heisst der input vom user schon vorhanden ist, return false
        if($result->num_rows()>0) {
            return false;
        }
        return true;
    }
}
/* End of file project_model.php */
/* Location: ./application/models/project_model.php */