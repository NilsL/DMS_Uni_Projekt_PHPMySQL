<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class File_model
 */
class File_model extends CI_Model {

   /**
    * @param $document_id
    *
    * @return bool liefert <code> TRUE </code> wenn der Upload inkl. verknüpfung in der DB erfolgreich war, sonst <code> FALSE </code>
    */
   function create_File($document_id) {
      $this->load->model('document_model');
      $document = $this->document_model->get_Document($document_id);

      $fileName = $document->project . '-' . $document->title . '-' . uniqid();

      // libary loading
      $config ['upload_path']   = './uploads/';
      $config ['allowed_types'] = 'doc|docx|odt|pdf|txt';
      $config ['file_name']     = $fileName;
      $config ['max_size']      = '20480';
      $config ['max_filename']  = '100';

      $this->load->library('upload', $config);

      // uploading
      if ($this->upload->do_upload('file')) {
         $data = $this->upload->data();

         $this->db->trans_start();
         // eintrag in der db anlegen mit pfad, dateinamen und md5 checksumme
         $result = $this->db->insert('storage_file',
            array('filepath' => $data ['file_path'],
                  'file'     => $data['file_name'],
                  'md5'      => md5_file($data['full_path'])
            )
         );

         // eintrag in der m:n tabelle anlegen
         if ($result) {
            $query   = $this->db->query('select last_insert_id() as file_id');
            $file_id = $query->row()->file_id;
            $result  = $this->db->insert('storage_document_has_file',
               array('document_id' => $document_id,
                     'file_id'     => $file_id
               )
            );
            $this->db->trans_complete();

            if (!$result) {
               unlink($data['full_path']);

               return FALSE;
            }

            return TRUE;
         }
         else {
            unlink($data['full_path']);
         }
      }

      return FALSE;
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
         $data = file_get_contents($row->filepath . $row->file);
         $name = $row->file;

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
