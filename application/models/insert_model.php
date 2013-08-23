<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*************************************************/
// alle funktionen bedürfen noch transactionbehandlung!!!
class Insert_model extends CI_Model {
   function __construct() {
      parent::__construct();
   }

   function validate_author() {
      $this->db->where('name', $this->input->post('i_author_name'));
      $query = $this->db->get('storage_author');
      if ($query->num_rows == 1) {
         return TRUE;
      }
      else {
         $this->db->where('mail', $this->input->post('i_author_mail'));
         $query = $this->db->get('storage_author');
         if ($query->num_rows == 1) {
            return TRUE;
         }
      }

      return FALSE;
   }

   function insert_author() {
      $data = array(
         'name' => $this->input->post('i_author_name'),
         'mail' => $this->input->post('i_author_mail')
      );
      $this->db->insert('storage_author', $data);
   }

   function validate_class() {
      $this->db->where('name', $this->input->post('i_class_name'));
      $query = $this->db->get('storage_classification');
      if ($query->num_rows == 1) {
         return TRUE;
      }

      return FALSE;
   }

   function insert_class() {
      $data = array(
         'name' => $this->input->post('i_class_name')
      );
      $this->db->insert('storage_classification', $data);
   }

   //
   function validate_project() {
      $this->db->where('name', $this->input->post('i_project_name'));
      $query = $this->db->get('storage_project');
      if ($query->num_rows == 1) {
         return TRUE;
      }
      else {
         $this->db->where('number', $this->input->post('i_project_mail'));
         $query = $this->db->get('storage_project');
         if ($query->num_rows == 1) {
            return TRUE;
         }
      }

      return FALSE;
   }

   function insert_project() {
      $data = array(
         'name'   => $this->input->post('i_project_name'),
         'number' => $this->input->post('i_project_number')
      );
      $this->db->insert('storage_project', $data);
   }

   function validate_document() {
      $this->db->where('title', $this->input->post('i_document_title'));
      $query = $this->db->get('storage_document');
      if ($query->num_rows == 1) {
         return TRUE;
      }

      return FALSE;
   }

   /*************************************************************************/
   //dieser methode fehlt noch die grundsätzliche fehlererkennung und fehlerbehandlungsmechanismus
   //
   function insert_document() {
      $data = array(
         'title'             => $this->input->post('i_document_title'),
         'abstract'          => $this->input->post('i_document_abstract'),
         'classification_id' => $this->input->post('classification'),
         'project_id'        => $this->input->post('projects')
      );
      $this->db->insert('storage_document', $data);

      // jetzt kommen alle kreuztabelle dran

      // gerade eingefügte document_id wiederfinden

      $query       = $this->db->query('select last_insert_id() as last_insert_id');
      foreach ($query->result() as $result) {
         $document_id = $result->last_insert_id;
      }



      // author
      $array_authors = $this->input->post('authors');
      foreach ($array_authors as $row) {
         $data = array(
            'document_id' => $document_id,
            'author_id'   => $row
         );
         $this->db->insert('storage_document_has_author', $data);
      }

      // keyword
      $keywords = trim($this->input->post('i_document_keywords'));
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
                  $query      = $this->db->query('select last_insert_id()');
                  $row_array  = $query->row_array();
                  $keyword_id = $row_array ['last_insert_id()'];
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

   //
   function insert_file($content, $filename, $tmpname) {
      $file  = array(
         'file' => $content,
         'md5'  => md5_file($tmpname),
         'name' => $filename
      );
      $query = $this->db->insert('storage_file', $file);

      return $query;
   }

   function insert_document_has_file() {
      $query     = $this->db->query('select last_insert_id()');
      $row_array = $query->row_array();
      $file_id   = $row_array ['last_insert_id()'];

      $this->db->select('id');
      $this->db->where('title', $this->input->post('i_document_title'));
      $query       = $this->db->get('storage_document');
      $document_id = $query->row()->id;

      $this->db->insert('storage_document_has_file', array(
         'document_id' => $document_id,
         'file_id'     => $file_id
      ));
   }
}
