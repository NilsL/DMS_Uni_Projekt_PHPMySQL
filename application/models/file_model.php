<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 *
 */
class File_model extends CI_Model {

   /**
    *
    *
    *
    */
   function create_File() {

   }

   /**
    *
    *
    *
    */
   function get_File() {

   }

   /**
    *
    *
    *
    */
   function update_File() {

   }

   /**
    *
    *
    *
    */
   function delete_File() {

   }
   
   /**
    * 
    * @param document_id $document_id
    * @return bool
    */
   function get_File_By_DocumentID($document_id) {
   	$this->db->select('storage_file.id as f_id, storage_file.file as f_file, storage_file.md5 as f_md5, storage_file.name as f_name');
   	$this->db->join('storage_document_has_file', 'storage_document_has_file.file_id = storage_file.id');
   	$this->db->where('storage_document_has_file.document_id', $id);
   	$files = $this->db->get('storage_file');
   	if($files->num_rows()>0) {
   		return $files;
   	}
   	return false;
   }

}
/* End of file file_model.php */
/* Location: ./application/models/file_model.php */
