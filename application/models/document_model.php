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
    * @param $author
    *
    * @return bool
    */
   function create_Document($title, $abstract, $class, $project, $keyword, $author) {
      //transaction startet
      $this->db->trans_begin();
      //title darf nicht mehrfach in der DB vorhanden sein
      $this->db->where('title', $title);
      $query = $this->db->get('storage_document');
      if (!$query || $query->num_rows == 1) {
      $this->db->trans_rollback();
         return FALSE;
      }

      $time  = time();
      $data  = array(
         'title'             => $title,
         'abstract'          => $abstract,
         'classification_id' => $class,
         'project_id'        => $project,
         'created'           => $time,
         'last_edited'       => $time,
         'author_id'         => $author
      );
      $query = $this->db->insert('storage_document', $data);
      if (!$query) {
         $this->db->trans_rollback();
         return FALSE;
      }

      // jetzt kommen alle kreuztabelle dran
      // gerade eingefügte document_id wiederfinden
      $query = $this->db->query('select last_insert_id() as last_id');
      if (!$query) {
         $this->db->trans_rollback();
         return FALSE;
      }
      $row         = $query->row();
      $document_id = $row->last_id;

      // keyword
      $keywords = trim($keyword);
      if (!empty ($keywords)) {
         // split string
         $keys = explode(",", $keywords);
         if (!empty ($keys)) {
            // durchgehen
            foreach ($keys as $row) {
               $this->db->where('name', $row);
               $query = $this->db->get('storage_keyword');
               if (!$query) {
                  $this->db->trans_rollback();

                  return FALSE;
               }
               $keyword_id = 0;
               // falls dies wort noch nie benutzt wurde, wird zuerst angelegt werden
               if ($query->num_rows == 0) {
                  $data  = array(
                     'name' => $row
                  );
                  $query = $this->db->insert('storage_keyword', $data);
                  if (!$query) {
                     $this->db->trans_rollback();

                     return FALSE;
                  }
                  // die keyword_id wieder kriegen
                  $query = $this->db->query('select last_insert_id() as last_id');
                  if (!$query) {
                     $this->db->trans_rollback();

                     return FALSE;
                  }
                  $row        = $query->row();
                  $keyword_id = $row->last_id;
               }
               else {
                  // die keyword_id auch wieder kriegen falls dies wort schon da gewesen ist
                  $this->db->select('id');
                  $this->db->where('name', $row);
                  $query = $this->db->get('storage_keyword');
                  if (!$query) {
                     $this->db->trans_rollback();

                     return FALSE;
                  }
                  $row        = $query->row();
                  $keyword_id = $row->id;
               }

               // jetzt keyword mit document in verbindung setzen
               $data  = array(
                  'document_id' => $document_id,
                  'keyword_id'  => $keyword_id
               );
               $query = $this->db->insert('storage_document_has_keyword', $data);
               if (!$query) {
                  $this->db->trans_rollback();

                  return FALSE;
               }
            }
         }
      }

      $this->db->trans_complete();

      return TRUE;
   }

   /**
    * @param $id übergebene ID des gesuchten Dokuments
    *
    * @return bool liefert <code> FALSE </code> wenn kein Dokument gefunden wurde, ansonsten das Dokument
    */
   function get_Document($id) {
      $this->db->select('storage_document.id as document_id, title, abstract, created, last_edited, storage_project.name AS project, storage_author.name AS author, storage_classification.name AS classification, storage_file.id AS file_id, storage_file.name AS file_name, storage_file.md5 AS file_md5');
      $this->db->join('storage_project', 'storage_document.project_id = storage_project.id');
      $this->db->join('storage_author', 'storage_document.author_id = storage_author.id');
      $this->db->join('storage_file', 'storage_document.file_id = storage_file.id');
      $this->db->join('storage_classification', 'storage_document.classification_id = storage_classification.id');

      $this->db->where('storage_document.id', $id);
      $result = $this->db->get('storage_document');

      if ($result->num_rows() == 1) {
         return $result->row();
      }

      return FALSE;
   }

   /**
    * @param bool $title
    * @param bool $keywords
    * @param bool $project
    * @param bool $class
    * @param bool $dropdown
    *
    * @return array|bool
    */
   function get_Documents($title = FALSE, $keywords = FALSE, $project = FALSE, $class = FALSE, $dropdown = FALSE) {

      $this->db->select('storage_document.id, title, created, last_edited, storage_project.name AS project, storage_classification.name AS classification');
      $this->db->distinct('storage_document.id, title, created, last_edited, storage_project.name AS project, storage_classification.name AS classification');

      $this->db->join('storage_project', 'storage_document.project_id = storage_project.id');
      $this->db->join('storage_classification', 'storage_document.classification_id = storage_classification.id');

      if ($title) {
         $this->db->and_like('title', $title);
      }

      if ($keywords) {
         $this->db->join('storage_document_has_keyword', 'storage_document.id = storage_document_has_keyword.document_id');
         $this->db->join('storage_keyword', 'storage_document_has_keyword.keyword_id = storage_keyword.id');
         $this->db->or_where_in('storage_keyword.name', $keywords);
      }

      if ($project) {
          $this->db->or_where_in('storage_project.id', $project);
      }

      if ($class) {
         $this->db->or_where_in('storage_classification.id', $class);
      }

      $this->db->order_by('storage_document.title', 'asc');

      $result = $this->db->get('storage_document');

      if ($result->num_rows() > 0) {
         if ($dropdown) {
            $dropdown   = array();
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
    * @param $doc_id
    *
    * @return bool liefert <code> TRUE </code> wenn das update erfolgreich war, sonst <code> FALSE </code>
    */
   function update_Document_LastEdited($doc_id) {
      $result = $this->db->update('storage_document', array('last_edited' => time()), array('id' => $doc_id));
      if ($result) {
         return TRUE;
      }
      return FALSE;
   }

   /**
    * @return bool
    */
   function delete_Document() {
      return FALSE;
   }

   /**
    * @param $inputed
    * @param $id
    *
    * @return bool
    */
   function checking($inputed, $id) {
      $this->db->where('title', $inputed);
      $result = $this->db->get('storage_document');

      //falls was gefunden ist heisst der input vom user schon vorhanden ist
      if ($result->num_rows() > 0) {
         return "This title is already used!";
      }
      return FALSE;
   }
}
/* End of file document_model.php */
/* Location: ./application/models/document_model.php */