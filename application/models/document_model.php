<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 *
 */
class Document_model extends CI_Model {

   /**
    *
    *
    *
    */
   function create_Document() {

   }

   /**
    *
    *
    *
    */
   function get_Document($id) {
      $this->db->select('storage_document.id, title, abstract, storage_author.name AS author, storage_project.name AS project, storage_classification.name AS classification');

      // join für author id zu name
      $this->db->join('storage_document_has_author', 'storage_document.id = storage_document_has_author.document_id');
      $this->db->join('storage_author', 'storage_document_has_author.author_id = storage_author.id');

      // join für classification id zu name
      $this->db->join('storage_project', 'storage_document.project_id = storage_project.id');
      $this->db->join('storage_classification', 'storage_document.classification_id = storage_classification.id');

      $this->db->where('storage_document.id', $id);
      $result = $this->db->get('storage_document');

      if ($result->num_rows() == 1) {
         return $result;
      }

      return FALSE;
   }

   /**
    *
    *
    *
    */
   function get_Documents($title = FALSE, $keywords = FALSE) {

      $this->db->select('storage_document.id, title, storage_author.name AS author, storage_project.name AS project, storage_classification.name AS classification');

      // join für author id zu name
      $this->db->join('storage_document_has_author', 'storage_document.id = storage_document_has_author.document_id');
      $this->db->join('storage_author', 'storage_document_has_author.author_id = storage_author.id');

      // join für classification id zu name
      $this->db->join('storage_project', 'storage_document.project_id = storage_project.id');
      $this->db->join('storage_classification', 'storage_document.classification_id = storage_classification.id');

      if ($keywords) {
         $this->db->distinct('storage_document.id, title, storage_author.name AS author, storage_project.name AS project, storage_classification.name AS classification, keyword_id');
         // join für keyword id zu name
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
         return $result;
      }

      return FALSE;
   }

   /**
    *
    *
    *
    */
   function update_Document() {

   }

   /**
    *
    *
    *
    */
   function delete_Document() {

   }

}
/* End of file document_model.php */
/* Location: ./application/models/document_model.php */