<?php
class Insert extends CI_Controller {
	// CI_Controller Konstruktor + check ob user eingelogt ist
	function __construct() {
		parent::__construct ();
		$this->is_logged_in ();
	}
	
	// soll noch ausgelagert werden in einen helper
	function is_logged_in() {
		$is_logged_in = $this->session->userdata ( 'is_logged_in' );
		
		if (! isset ( $is_logged_in ) || $is_logged_in != TRUE) {
			redirect ( 'login' );
		}
	}
	
	// insert hauptview, darunter liegen weiter vier weiteren
	function index() {
		$data ['view'] = 'insert/insert_view';
		$this->load->view ( 'template/content', $data );
	}
	
	// insert author
	function insert_author() {
		$data ['view'] = 'insert/insert_author_view';
		$this->load->view ( 'template/content', $data );
	}
	
	// insert class
	function insert_class() {
		$data ['view'] = 'insert/insert_class_view';
		$this->load->view ( 'template/content', $data );
	}
	
	// insert project
	function insert_project() {
		$data ['view'] = 'insert/insert_project_view';
		$data ['dropdown'] = 'true';
		$this->load->view ( 'template/content', $data );
	}
	
	// insert document
	function insert_document() {
		$data = $this->insert_document_helper ();
		
		$data ['jQuery'] = TRUE;
		$data ['view'] = 'insert/insert_document_view';
		$this->load->view ( 'template/content', $data );
	}
	
	// helper, um insert_document_view zu unterstützen
	function insert_document_helper() {
		$this->load->model ( 'project_model' );
		$this->load->model ( 'author_model' );
		$this->load->model ( 'classification_model' );
		
		if ($projects = $this->project_model->get_Project ()) {
			$data ['all_p'] = $projects;
		}
		if ($authors = $this->author_model->get_Author ()) {
			$data ['all_a'] = $authors;
		}
		if ($classification = $this->classification_model->get_Classification ()) {
			$data ['all_c'] = $classification;
		}
		return $data;
	}
	
	// insert file
	function insert_file() {
		$data = $this->insert_file_helper ();
		
		$data ['jQuery'] = TRUE;
		$data ['view'] = 'insert/insert_file_view';
		$this->load->view ( 'template/content', $data );
	}
	
	// insert file helper
	function insert_file_helper() {
		$this->load->model ( 'document_model' );
		if ($documents = $this->document_model->get_all_Document ()) {
			$data ['all_d'] = $documents;
		}
		return $data;
	}
	
	// validierung des geinserteten authors
	function validate_i_author() {
		// Author muss name und email haben, alle felder pflicht
		$this->form_validation->set_rules ( 'i_author_name', 'Author name', 'trim|required|' );
		$this->form_validation->set_rules ( 'i_author_mail', 'Email', 'trim|required' );
		// wenn nicht dann noch mal eingeben
		if ($this->form_validation->run () == FALSE) {
			$this->insert_author ();
		} else {
			// input abgreifen
			$name = $this->input->post ( 'i_author_name' );
			$email = $this->input->post ( 'i_author_mail' );
			
			// author_model laden
			$this->load->model ( 'author_model' );
			// query durchführen
			$query = $this->author_model->create_Author ( $name, $email );
			
			// wenn query true ist beduetet erfolg
			if ($query) {
				$data ['view'] = 'insert/successful_insert_view';
				$this->load->view ( 'template/content', $data );
			} else {
				// otherwise wird den hinweis ausgegeben und ein neuer try
				$data ['error'] = 'Author or Email already exists!';
				$data ['view'] = 'insert/insert_author_view';
				$this->load->view ( 'template/content', $data );
			}
		}
	}
	
	// validierung der geinserteten classification
	function validate_i_class() {
		// es muss doch einen name dafür geben
		$this->form_validation->set_rules ( 'i_class_name', 'Classification name', 'trim|required|' );
		if ($this->form_validation->run () == FALSE) {
			$this->insert_class ();
		} else {
			
			$name = $this->input->post ( 'i_class_name' );
			$this->load->model ( 'classification_model' );
			$query = $this->classification_model->create_Classification ( $name );
			
			if ($query) {
				$data ['view'] = 'insert/successful_insert_view';
				$this->load->view ( 'template/content', $data );
			} else {
				$data ['error'] = 'Classification exsists!';
				$data ['view'] = 'insert/insert_class_view';
				$this->load->view ( 'template/content', $data );
			}
		}
	}
	
	//
	function validate_i_project() {
		// project nr muss ausserdem numerisch sein
		$this->form_validation->set_rules ( 'i_project_name', 'Project Name', 'trim|required|' );
		$this->form_validation->set_rules ( 'i_project_number', 'Project Number', 'trim|required|numeric' );
		
		if ($this->form_validation->run () == FALSE) {
			$this->insert_project ();
		} else {
			
			$name = $this->input->post ( 'i_project_name' );
			$number = $this->input->post ( 'i_project_number' );
			$this->load->model ( 'project_model' );
			$query = $this->project_model->create_Project ( $name, $number );
			
			// Wenn die Eingaben in der DB nicht vorhanden sind ist $query == false
			if ($query) {
				$data ['view'] = 'insert/successful_insert_view';
				$this->load->view ( 'template/content', $data );
			} else {
				$data ['error'] = 'Project exsists or Project Number already used!';
				$data ['view'] = 'insert/insert_project_view';
				$this->load->view ( 'template/content', $data );
			}
		}
	}
	function validate_i_document() {
		$this->form_validation->set_rules ( 'i_document_title', 'Title', 'trim|required|' );
		$this->form_validation->set_rules ( 'projects', 'Project', 'trim|greater_than[0]|' );
		$this->form_validation->set_rules ( 'classification', 'Classification', 'trim|greater_than[0]|' );
		// ausgewälte id muss größer als 1 sein, damit ist gesichert dass diese felder belegt ist
		// darum fehlermeldung muss neu definiert werden
		$this->form_validation->set_message ( 'greater_than', "The %s field must be chooesed!" );
		
		if ($this->form_validation->run () == FALSE) {
			$this->insert_document ();
		} else {
			
			$title = $this->input->post ( 'i_document_title' );
			$abstract = $this->input->post ( 'i_document_abstract' );
			$class = $this->input->post ( 'classifications' );
			$project = $this->input->post ( 'projects' );
			$keyword = $this->input->post ( 'i_document_keywords' );
			//authors greifen wir aus der tabelle, genauer gesagt aus der hiddenbereich, weil es multichoice auf sich hat
			$array_authors = $this->input->post ( 'hiddenid' );
			
			$this->load->model ( 'document_model' );
			$query = $this->document_model->create_Document ( $title, $abstract, $class, $project, $keyword, $array_authors );
			
			if ($query) {
				$data ['view'] = 'insert/successful_insert_view';
				$this->load->view ( 'template/content', $data );
			} else {
				$data = $this->insert_document_helper ();
				$data ['error'] = 'Document exsists!';
				$data ['view'] = 'insert/insert_document_view';
				
				$this->load->view ( 'template/content', $data );
			}
		}
	}
	function validate_i_file() {
		$this->form_validation->set_rules ( 'documents', 'Document', 'trim|greater_than[0]|' );
		// ausgewälte id muss größer als 1 sein, damit ist gesichert dass diese felder belegt ist
		// darum fehlermeldung muss neu definiert werden
		$this->form_validation->set_message ( 'greater_than', "The %s field must be chooesed!" );
		
		if ($this->form_validation->run () == FALSE) {
			$this->insert_file ();
		} else {
			// document_id abgreifen
			$document_id = $this->input->post ( 'documents' );
			
			$this->load->model ( 'file_model' );
			$success = $this->file_model->create_File ( $document_id );
			
			if ($success==true) {
				$data ['view'] = 'insert/successful_insert_view';
				$this->load->view ( 'template/content', $data );
			} else {
				$data = $this->insert_file_helper ();
				$data ['error'] = $success; // $success ist gerade die errorstack aus model
				$data ['view'] = 'insert/insert_file_view';
				$this->load->view ( 'template/content', $data );
			}
		}
	}
	
	/**
	 * ajax backend function welche vom js script gecalled wird
	 *
	 *
	 */
	function show_Hint() {
   	  //getten
   	  $model = $this->input->get('model');
      $entered = $this->input->get('entered');
      
      //entsprechenden model laden
      $this->load->model($model);
      
      // alle möglichen einträge nach dem model laden die mit dem übergebenen buchstaben beginnen
      switch ($model) {
      	case "project_model": 
      		$hints = $this->project_model->getHints($entered);
     		break;
      	case "author_model":
      		$hints = $this->author_model->getHints($entered);
      		break;
      	case "classification_model":
      		$hints = $this->classification_model->getHints($entered);
      		break;
      	case "document_model":
      		$hints = $this->document_model->getHints($entered);
      		break;
      }
      

      // den response string formatieren so das in der view ein dropdown damit gefüllt werden kann
      $response = NULL;
      foreach ($hints->result() as $hint) {
      	  $response = $response . '<option value=' . $hint->id . '>' . $hint->name . '</option>';
      }

      echo $response;
   }
}