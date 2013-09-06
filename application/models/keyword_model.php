<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Keyword_model
 */
class Keyword_model extends CI_Model {

   /**
    *
    */
   function create_Keyword() {

   }

   /**
    *
    */
   function get_Keyword() {

   }

   /**
    *
    */
   function update_Keyword() {

   }

   /**
    *
    */
   function delete_Keyword() {

   }

   /**
    * @param $document_id
    *
    * @return bool
    */
   function get_Keyword_by_DocumentID($document_id) {
      $this->db->select('storage_keyword.name as keyword_name');
      $this->db->join('storage_document_has_keyword', 'storage_document_has_keyword.keyword_id = storage_keyword.id');
      $this->db->where('storage_document_has_keyword.document_id', $document_id);
      $keywords = $this->db->get('storage_keyword');
      if ($keywords->num_rows() > 0) {
         return $keywords;
      }

      return FALSE;
   }
}
/* End of file keyword_model.php */
/* Location: ./application/models/keyword_model.php */