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
	function create_Author($name, $email) {
		//zuerst prüfen ob der author oder email bereits existiert
		$this->db->where ( 'name', $name );
		$query = $this->db->get ( 'storage_author' );
		if ($query->num_rows == 1) {
			return false;
		} else {
			$this->db->where ( 'mail', $email );
			$query = $this->db->get ( 'storage_author' );
			if ($query->num_rows == 1) {
				return false;
			}
		}
		
		//falls das programm hier gegangen ist bedeutet kein doppelgänger ermittelt
		//insert anweisung veranlassen
		$data = array (
				'name' => $name,
				'mail' => $email
		);
		$this->db->insert ( 'storage_author', $data );
		return true;
	}


   /**
    * fetched den Author aus der DB
    *
    *
    */
	function get_Author($id = NULL) {
		if (isset ( $id )) {
			$this->db->where ( 'id', $id );
			$author = $this->db->get ( 'storage_author' );
			if ($author->num_rows () > 0) {
				$row = $author->result ();
				return $row;
			}
		}
		
		$authors = $this->db->get ( 'storage_author' );
		if ($authors->num_rows() > 0) {
         	$tmp[] = '--- view all ---';

         	foreach ($authors->result() as $author) {
        	    $tmp[$author->id] = $author->name;
      	   }

        	 return $tmp;
   	   }
		return false;
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
    * noch nicht final nur f眉r erste tests. l盲uft aber ohne fehler schon
    *
    *
    */
   function getHints($entered) {
   	$this->db->like('name', $entered, 'after');
   	$result = $this->db->get('storage_author');
   
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