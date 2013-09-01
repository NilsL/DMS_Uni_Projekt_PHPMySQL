<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Document_model
 */
class Document_model extends CI_Model {

   /**
    * @param $title
    * @param $abstract
    * @param $class
    * @param $project
    * @param $keyword
    * @param $array_authors
    *
    * @return bool
    */
   function create_Document($title, $abstract, $class, $project, $keyword, $array_authors) {
      $this->db->where('title', $title);
      $query = $this->db->get('storage_document');
      if ($query->num_rows == 1) {
         return FALSE;
      }

      $data = array(
         'title'             => $title,
         'abstract'          => $abstract,
         'classification_id' => $class,
         'project_id'        => $project
      );
      $this->db->insert('storage_document', $data);

      // jetzt kommen alle kreuztabelle dran
      // gerade eingefügte document_id wiederfinden
      $query       = $this->db->query('select last_insert_id() as last_id');
      $row         = $query->row();
      $document_id = $row->last_id;

      // author
      foreach ($array_authors as $row) {
         //ueberpruefen ob author noch da ist oder evtl von anderen geloescht ist
         $this->load->model('author_model');
         if ($query = $this->author_model->get_Author($row)) {
            $data = array(
               'document_id' => $document_id,
               'author_id'   => $row
            );
            $this->db->insert('storage_document_has_author', $data);
         }
         //eig. sollte es nicht geloescht werden, hier ist transaction angesagt...
         else {

         }
      }

      // keyword
      $keywords = trim($keyword);
      if (!empty ($keywords)) {
         // split string
         $keys = explode(",", $keywords);
         if (!empty ($keys)) {
            // durchgehen
            foreach ($keys as $row) {
               $this->db->where('name', $row);
               $query      = $this->db->get('storage_keyword');
               $keyword_id = 0;
               // falls dies wort noch nie benutzt wurde, wird zuerst angelegt werden
               if ($query->num_rows == 0) {
                  $data = array(
                     'name' => $row
                  );
                  $this->db->insert('storage_keyword', $data);
                  // die keyword_id wieder kriegen
                  $query      = $this->db->query('select last_insert_id() as last_id');
                  $row        = $query->row();
                  $keyword_id = $row->last_id;
               }
               else {
                  // die keyword_id auch wieder kriegen falls dies wort schon da gewesen ist
                  $this->db->select('id');
                  $this->db->where('name', $row);
                  $query      = $this->db->get('storage_keyword');
                  $row        = $query->row();
                  $keyword_id = $row->id;
               }

               // jetzt keyword mit document in verbindung setzen
               $data = array(
                  'document_id' => $document_id,
                  'keyword_id'  => $keyword_id
               );
               $this->db->insert('storage_document_has_keyword', $data);
            }
         }
      }

      return TRUE;
   }

   /**
    * @param $id übergebene ID des gesuchten Dokuments
    *
    * @return bool liefert <code> FALSE </code> wenn kein Dokument gefunden wurde, ansonsten das Dokument
    */
   //modifiziert auf neues datenbankstruktur (author join deleted)
   function get_Document($id) {
      $this->db->select('storage_document.id as document_id, title, abstract, storage_project.name AS project, storage_classification.name AS classification');

      // join fuer project und classification id zu name
      $this->db->join('storage_project', 'storage_document.project_id = storage_project.id');
      $this->db->join('storage_classification', 'storage_document.classification_id = storage_classification.id');

      $this->db->where('storage_document.id', $id);
      $result = $this->db->get('storage_document');

   	  if ($result->num_rows () == 1) {
		 return $result->row ();
	  }

      return FALSE;
   }

   /**
    * @param bool $title    übergebener Titel des gesuchten Dokuments
    * @param bool $keywords übergebene Keywords des gesuchten Dokuments
    * @param bool $dropdown default auf <code> FALSE </code>, wenn TRUE wird Rückgabe Dropdown konform
    *
    * @return bool liefert alle Dokumente anhand der Parameter bzw einfach alle Dokumente ohne Parameter
    */
   function get_Documents($title = FALSE, $keywords = FALSE, $dropdown = FALSE) {

      $this->db->select('storage_document.id, title, storage_project.name AS project, storage_classification.name AS classification');

      // join fuer project und classification id zu name
      $this->db->join('storage_project', 'storage_document.project_id = storage_project.id');
      $this->db->join('storage_classification', 'storage_document.classification_id = storage_classification.id');

      if ($keywords) {
         $this->db->distinct('storage_document.id, title, storage_project.name AS project, storage_classification.name AS classification');
         // join fuer keyword id zu name
         $this->db->join('storage_document_has_keyword', 'storage_document.id = storage_document_has_keyword.document_id');
         $this->db->join('storage_keyword', 'storage_document_has_keyword.keyword_id = storage_keyword.id');
         $this->db->or_where_in('storage_keyword.name', $keywords);
      }

      if ($title) {
         $this->db->or_like('title', $title);
      }

      $this->db->order_by('storage_document.title', 'asc');

      $result = $this->db->get('storage_document');

      if ($result->num_rows() > 0) {
         // wenn $dropdown TRUE ist wird ein Dropdown konformes Array produziert, sonst normale Resultset Rückgabe
         if ($dropdown) {
         	//bugfix: $dropdown war noch ein bool, kann nicht direkt als array verwenden
         	$dropdown = array();
            $dropdown[] = '--- view all ---';

            foreach ($result->result() as $docu) {
               $dropdown[$docu->id] = $docu->title;
            }

            return $dropdown;
         }

         return $result;
      }

      return FALSE;
   }

   /**
    * @param $entered
    *
    * @return bool
    */
   function getHints($entered) {
      //here muss alias gestellt werden, denn showHint() in insert.php hat $hint->name fest geschrieben, aber hier heisst es title
      $this->db->select('id, title as name');
      $this->db->like('title', $entered, 'after');
      $result = $this->db->get('storage_document');

      if ($result->num_rows() > 0) {
         return $result;
      }

      return FALSE;
   }

   /**
    * @return bool
    */
   function update_Document() {
      return FALSE;
   }

   /**
    * @return bool
    */
   function delete_Document() {
      return FALSE;
   }
}

/* End of file document_model.php */
/* Location: ./application/models/document_model.php */