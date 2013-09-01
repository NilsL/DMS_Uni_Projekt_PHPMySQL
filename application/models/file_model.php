<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class File_model
 */
class File_model extends CI_Model {

	function __construct() {
		parent::__construct ();
		// upload ordner lokalisieren
//		$this->F_PATH = realpath ( APPPATH . '../uploads/' );
	}
   
	function do_upload() {
		// libary loading
		$config ['allowed_types'] = 'doc|docx|odt|pdf';
		$config ['upload_path'] = base_url() . 'uploads/';
		$config ['max_size'] = '20480';
		$config ['max_filename'] = '100';
		// $config['max_width'] = '1024';
		// $config['max_height'] = '768';
		$this->load->library ( 'upload', $config );
	}

   /**
    * @param $document_id übergebene Dokumenten ID
    *
    * @return bool|string <code> TRUE </code> wenn der Datei insert erfolgreich war, ansonsten ein Error String
    */
   function create_File($document_id) {
		//uploding libray loaden
		$this->do_upload();
		
		// uploading
		if ($this->upload->do_upload ( 'input_file' )) {
			// die info aus der hochgeladenen datei zugreifen
			$data = $this->upload->data ();
			
			// file original name
			$tmpName = $data ['raw_name'];
			// file Path
			$filePath = $data ['full_path'];
			//md5string erzeugen anhand fullpath
			$md5 = md5_file($filePath);
			// file endung
			$fileExt = $data ['file_ext'];
			// file name basteln, dafuer braucht man document_model
			$this->load->model ( 'document_model' );
			$document = $this->document_model->get_Document ( $document_id );
			
			// den zu speichernden namen zusammensetzen
			$fileName = $tmpName . "_" . $document->title . "_" . $document->project . $fileExt;
			
			$file = array (
					
					'file' => $filePath,
					
					'md5' =>  $md5,
					
					'name' => $fileName 
			);
			
			
			$query = $this->db->insert ( 'storage_file', $file );
			
			// kreuztabelle, um mit document zu verbinden
			if (! $query) {
				return 'Upload failed!';
			} else {
				$query = $this->db->query ( 'select last_insert_id() as last_id' );
				
				$row = $query->row ();
				
				$file_id = $row->last_id;
				
				$this->db->insert ( 'storage_document_has_file', array (
						
						'document_id' => $document_id,
						
						'file_id' => $file_id 
				) );
			}
			return true;
		} 
		//geht es schief dann erros abliefern
		else {
			return $this->upload->display_errors ();
		}
	}
	function download_File($id) {
		$this->db->where('id', $id);
		$file = $this->db->get('storage_file');
		if($file->num_rows() == 1 ) {
			$row = $file->row();
			
			//download starten
			$data = file_get_contents($row->file);
			$name = $row->name;
			
			force_download($name, $data);
		}	
	}
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
   	$this->db->where('storage_document_has_file.document_id', $document_id);
   	$files = $this->db->get('storage_file');
   	if($files->num_rows()>0) {
   		return $files;
   	}
   	return false;
   }

}
/* End of file file_model.php */
/* Location: ./application/models/file_model.php */
