<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class File_model
 */
class File_model extends CI_Model {

   /**
    * @param $document_id übergebene Dokumenten ID
    *
    * @return bool|string <code> TRUE </code> wenn der Datei insert erfolgreich war, ansonsten ein Error String
    */
   function create_File($document_id) {
      // libary loading
      $config ['allowed_types'] = 'doc|docx|odt|pdf|txt';
      $config ['upload_path']   = './uploads/';
      $config ['max_size']      = '20480';
      $config ['max_filename']  = '100';
      //$config['file_name'] = $_FILES['userfile']['name'].'test';
      $this->load->library('upload', $config);

      // uploading
      if ($this->upload->do_upload('file')) {
         $data = $this->upload->data();

         // file Path
         $filePath = $data ['full_path'];
         //md5string erzeugen anhand fullpath
         $md5 = md5_file($filePath);
         // file endung
         $fileExt = $data ['file_ext'];
         // file name basteln, dafuer braucht man document_model
         $this->load->model('document_model');
         $document = $this->document_model->get_Document($document_id);

         // den zu speichernden namen zusammensetzen
         $fileName = $document->project . "-" . str_replace(' ', '_', $document->title) . $fileExt;

         $file = array(
            'file' => $filePath,
            'md5'  => $md5,
            'name' => $fileName
         );


         $query = $this->db->insert('storage_file', $file);

         // kreuztabelle, um mit document zu verbinden
         if (!$query) {
            return 'Upload failed!';
         }
         else {
            $query   = $this->db->query('select last_insert_id() as last_id');
            $row     = $query->row();
            $file_id = $row->last_id;
            $this->db->insert('storage_document_has_file', array(
               'document_id' => $document_id,
               'file_id'     => $file_id
            ));
         }

         return TRUE;
      }
      //geht es schief dann erros abliefern
      else {
         return $this->upload->display_errors('<p class="error">','</p>');
      }
   }

   /**
    * @param $file_id
    */
   function download_File($file_id) {
      $this->db->where('id', $file_id);
      $file = $this->db->get('storage_file');
      if ($file->num_rows() == 1) {
         $row = $file->row();

         //download starten
         $data = file_get_contents($row->file);
         $name = $row->name;

         force_download($name, $data);
      }
   }

   /**
    * updates a file
    */
   function update_File() {

   }

   /**
    * deletes a file
    */
   function delete_File() {

   }

   /**
    *
    * @param document_id $document_id
    *
    * @return bool
    */
   function get_File_By_DocumentID($document_id) {
      $this->db->select('storage_file.id as f_id, storage_file.file as f_file, storage_file.md5 as f_md5, storage_file.name as f_name');
      $this->db->join('storage_document_has_file', 'storage_document_has_file.file_id = storage_file.id');
      $this->db->where('storage_document_has_file.document_id', $document_id);
      $files = $this->db->get('storage_file');
      if ($files->num_rows() > 0) {
         return $files;
      }

      return FALSE;
   }
}
/* End of file file_model.php */
/* Location: ./application/models/file_model.php */
