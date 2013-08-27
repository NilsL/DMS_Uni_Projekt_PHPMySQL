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
	function create_Document($title, $abstract, $class, $project, $keyword, $array_authors) {
		$this->db->where ( 'title', $title );
		$query = $this->db->get ( 'storage_document' );
		if ($query->num_rows == 1) {
			return false;
		}

		$data = array (
				'title' => $title,
				'abstract' => $abstract,
				'classification_id' => $class,
				'project_id' => $project
		);
		$this->db->insert ( 'storage_document', $data );
		
		// jetzt kommen alle kreuztabelle dran
		// gerade eingefügte document_id wiederfinden
		$query = $this->db->query ( 'select last_insert_id() as last_id' );
		$row = $query->row();
		$document_id = $row-> last_id;
		
		// author
		foreach ( $array_authors as $row ) {
			//ueberpruefen ob author noch da ist oder evtl von anderen geloescht ist
			$this->load->model('author_model');
			if($query = $this->author_model->get_Author($row)) {
				$data = array (
						'document_id' => $document_id,
						'author_id' => $row
				);
				$this->db->insert ( 'storage_document_has_author', $data );
			}
			//eig. sollte es nicht geloescht werden, hier ist transaction angesagt...
			else {
				
			}
		}
		
		// keyword
		$keywords = trim ( $keyword );
		if (! empty ( $keywords )) {
			// split string
			$keys = explode ( ",", $keywords );
			if (! empty ( $keys )) {
				// durchgehen
				foreach ( $keys as $row ) {
					$this->db->where ( 'name', $row );
					$query = $this->db->get ( 'storage_keyword' );
					$keyword_id = 0;
					// falls dies wort noch nie benutzt wurde, wird zuerst angelegt werden
					if ($query->num_rows == 0) {
						$data = array (
								'name' => $row
						);
						$this->db->insert ( 'storage_keyword', $data );
						// die keyword_id wieder kriegen
						$query = $this->db->query ( 'select last_insert_id() as last_id' );
						$row = $query->row();
						$keyword_id = $row-> last_id;
					} else {
						// die keyword_id auch wieder kriegen falls dies wort schon da gewesen ist
						$this->db->select ( 'id' );
						$this->db->where ( 'name', $row );
						$query = $this->db->get ( 'storage_keyword' );
						$row = $query->row ();
						$keyword_id = $row->id;
					}
						
					// jetzt keyword mit document in verbindung setzen
					$data = array (
							'document_id' => $document_id,
							'keyword_id' => $keyword_id
					);
					$this->db->insert ( 'storage_document_has_keyword', $data );
				}
			}
		}
		return true;
	}

   /**
    *
    *
    *
    */
	//jetzt sieht diese getmethode ähnlich aus wie die in anderen models. einziger unterschied ist, dass es die
	//anderen tabellen beziehen um documents zu fetchen. die anderen tabellen sind vor allem die die unmittelbar
	//durch foreignkey verknuepfbar sind
   function get_Document($id=NULL) {
   	if (isset ( $id )) {
   		//"storage_author.name AS author" geloescht denn author nicht durch foreignkey zu verknuepfen ist
      $this->db->select('storage_document.id as document_id, title, abstract, storage_project.name AS project, storage_classification.name AS classification');

      // join fuer project und classification id zu name
      $this->db->join('storage_project', 'storage_document.project_id = storage_project.id');
      $this->db->join('storage_classification', 'storage_document.classification_id = storage_classification.id');

      $this->db->where('storage_document.id', $id);
      $result = $this->db->get('storage_document');

   	  if ($result->num_rows () == 1) {
		 $row = $result->row ();
		 return $row;
	  }
   	} 
   	
   	$this->db->select ( 'storage_document.id as document_id, title, abstract, storage_classification.name as c_name, storage_project.name as p_name' );
	$this->db->join ( 'storage_classification', 'storage_classification.id = storage_document.classification_id' );
	$this->db->join ( 'storage_project', 'storage_project.id = storage_document.project_id' );
	$documents = $this->db->get ( 'storage_document' );
	if ($documents->num_rows () > 0) {
		return $documents->result ();
	}
    return FALSE;
   }
   
   /**
    * diese funktion dient nur zum dropdownanforderung, kann leider nicht da oben angehaengt werden
    *
    *
    */
   function get_all_Document() {
   	$documents = $this->db->get('storage_document');
      if ($documents->num_rows() > 0) {
         $tmp[] = '--- view all ---';

         foreach ($documents->result() as $docu) {
            $tmp[$docu->id] = $docu->title;
         }

         return $tmp;
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

      // join f眉r author id zu name
      $this->db->join('storage_document_has_author', 'storage_document.id = storage_document_has_author.document_id');
      $this->db->join('storage_author', 'storage_document_has_author.author_id = storage_author.id');

      // join f眉r classification id zu name
      $this->db->join('storage_project', 'storage_document.project_id = storage_project.id');
      $this->db->join('storage_classification', 'storage_document.classification_id = storage_classification.id');

      if ($keywords) {
         $this->db->distinct('storage_document.id, title, storage_author.name AS author, storage_project.name AS project, storage_classification.name AS classification, keyword_id');
         // join f眉r keyword id zu name
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
    * noch nicht final nur f眉r erste tests. l盲uft aber ohne fehler schon
    *
    *
    */
   function getHints($entered) {
   	//here muss alias gestellt werden, denn showHint() in insert.php hat $hint->name fest geschrieben, aber hier heisst es aber title
   	$this->db->select('id, title as name');
   	$this->db->like('title', $entered, 'after');
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
   
   /**
    *anhand document_id authors, keywords bzw. Files finden
    *
    *
    */
	function get_Author($id) {
		$this->db->select('storage_author.name as a_name');
		$this->db->join('storage_document_has_author', 'storage_document_has_author.author_id = storage_author.id');
		$this->db->where('storage_document_has_author.document_id', $id);
		$authors = $this->db->get('storage_author');
		if ($authors->num_rows () > 0) {
			return $authors;
		}
	}
	function get_Keyword($id) {
		$this->db->select('storage_keyword.name as k_name');
		$this->db->join('storage_document_has_keyword', 'storage_document_has_keyword.keyword_id = storage_keyword.id');
		$this->db->where('storage_document_has_keyword.document_id', $id);
		$keywords = $this->db->get('storage_keyword');
		if($keywords->num_rows()>0) {
			return $keywords;
		}
	}
	function get_File($id) {
		$this->db->select('storage_file.id as f_id, storage_file.file as f_file, storage_file.md5 as f_md5, storage_file.name as f_name');
		$this->db->join('storage_document_has_file', 'storage_document_has_file.file_id = storage_file.id');
		$this->db->where('storage_document_has_file.document_id', $id);
		$files = $this->db->get('storage_file');
		if($files->num_rows()>0) {
			return $files;
		}
	}

}
/* End of file document_model.php */
/* Location: ./application/models/document_model.php */