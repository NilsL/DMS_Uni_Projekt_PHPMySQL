<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Author_model
 */
class Author_model extends CI_Model {

   /**
    * @param $name  übergebene Name des Authors
    * @param $email übergebene E-Mail Adresse des Authors
    *
    * @return bool liefert <code> TRUE </code> wenn der Author erfolgreich Inserted wurde
    */
   function create_Author($name, $email) {
      //zuerst prüfen ob der author oder email bereits existiert
      $this->db->where('name', $name);
      $query = $this->db->get('storage_author');
      if ($query->num_rows == 1) {
         return FALSE;
      }
      else {
         $this->db->where('mail', $email);
         $query = $this->db->get('storage_author');
         if ($query->num_rows == 1) {
            return FALSE;
         }
      }

      $data = array(
         'name' => $name,
         'mail' => $email
      );
      $this->db->insert('storage_author', $data);

      return TRUE;
   }

   /**
    * @param null $id übergebene ID des gesuchten Authors
    *
    * @return bool liefert <code> FALSE </code> wenn kein Author mit der $id vorhanden ist, ansonsten den Author
    */
   function get_Author($id = NULL) {
      if (isset ($id)) {
         $this->db->where('id', $id);
         $author = $this->db->get('storage_author');
         if ($author->num_rows() > 0) {
            $row = $author->result();

            return $row;
         }
      }

      return FALSE;
   }

   /**
    * @param bool $dropdown ist default auf FALSE, bei <code> TRUE </code> wird ein Dropdown konformes Array erzeugt
    *
    * @return array|bool liefert <code> FALSE </code> sollte kein Author vorhanden sein.
    */
   function get_Authors($dropdown = FALSE) {
      if ($dropdown == FALSE) {
         $authors = $this->db->get('storage_author');

         if ($authors->num_rows() > 0) {
            return $authors;
         }
      }

      $authors = $this->db->get('storage_author');
      if ($authors->num_rows() > 0) {
         $tmp[] = '--- view all ---';

         foreach ($authors->result() as $author) {
            $tmp[$author->id] = $author->name;
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
      $result = $this->db->get('storage_author');

      if ($result->num_rows() > 0) {
         return $result;
      }

      return FALSE;
   }

   /**
    * @return bool
    */
   function update_Author() {
      return FALSE;
   }

   /**
    * @return bool
    */
   function delete_Author() {
      return FALSE;
   }
   
   /**
    * @param document_id 
    * @return bool
    */
   function get_Author_by_DocumentID($document_id) {
    $this->db->select('storage_author.name as author_name');
    $this->db->join('storage_document_has_author', 'storage_document_has_author.author_id = storage_author.id');
    $this->db->where('storage_document_has_author.document_id', $document_id);
    $authors = $this->db->get('storage_author');
    if ($authors->num_rows () > 0) {
        return $authors;
    }
    return false;
   }

   function checking($inputed, $id) {
       if($id=="author mail") {
           $this->db->where('mail', $inputed);
       } else if($id=="author name") {
           $this->db->where('name', $inputed);
       }
       $result = $this->db->get('storage_author');

       //falls was gefunden ist heisst der input vom user schon vorhanden ist, return false
       if($result->num_rows()>0) {
           return false;
       }
       return true;
   }
}

/* End of file author_model.php */
/* Location: ./application/models/author_model.php */