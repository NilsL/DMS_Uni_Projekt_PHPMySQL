<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Insert
 */
class Insert extends CI_Controller {

   /**
    * Constructor
    */
   function __construct() {
      parent::__construct();
      $is_logged_in = $this->session->userdata('is_logged_in');

      if (!isset ($is_logged_in) || $is_logged_in != TRUE) {
         redirect('login');
      }
   }

   /**
    * insert hauptview, darunter liegen weiter vier weiteren
    */
   function index() {
      $data ['jQuery'] = TRUE;

      switch ($this->input->get('v')) {
         case 'author':
            $data ['view'] = 'insert/insert_author_view';
            break;

         case 'class':
            $data ['view'] = 'insert/insert_class_view';
            break;

         case 'project':
            $data ['view'] = 'insert/insert_project_view';
            break;

         case 'document':
            $this->load->model('project_model');
            $this->load->model('author_model');
            $this->load->model('classification_model');

            if ($projects = $this->project_model->get_Project()) {
               $data ['projects'] = $projects;
            }
            if ($authors = $this->author_model->get_Authors(TRUE)) {
               $data ['authors'] = $authors;
            }
            if ($classification = $this->classification_model->get_Classification()) {
               $data ['classifications'] = $classification;
            }
            $data ['view'] = 'insert/insert_document_view';
            break;

         case 'file':
            $this->load->model('document_model');

            if ($documents = $this->document_model->get_Documents(FALSE, FALSE, FALSE, FALSE, TRUE)) {
               $data ['documents'] = $documents;
            }
            $data ['view'] = 'insert/insert_file_view';
            break;

         default:
            $data ['view'] = 'insert/insert_view';
            break;
      }
      $this->load->view('template/content', $data);
   }

   /**
    * neuen Author anlegen
    */
   function insert_author() {
      // Author muss name und email haben, alle felder pflicht
      $this->form_validation->set_rules('author_name', 'Author name', 'trim|required');
      $this->form_validation->set_rules('author_mail', 'Email', 'trim|required|valid_email');
      // wenn nicht dann noch mal eingeben
      if ($this->form_validation->run() == FALSE) {
         $data ['jQuery'] = TRUE;
         $data ['view'] = 'insert/insert_author_view';
         $this->load->view('template/content', $data);
      }
      else {
         // input abgreifen
         $name  = $this->input->post('author_name');
         $email = $this->input->post('author_mail');

         // author_model laden
         $this->load->model('author_model');
         // query durchführen
         $query = $this->author_model->create_Author($name, $email);

         // wenn query true ist beduetet erfolg
         if ($query) {
            $data ['view'] = 'insert/successful_insert_view';
            $this->load->view('template/content', $data);
         }
         else {
            // otherwise wird den hinweis ausgegeben und ein neuer try
            $data ['error'] = 'Author or Email already exists!';
            $data ['view']  = 'insert/insert_author_view';
            $this->load->view('template/content', $data);
         }
      }
   }

   /**
    * neue Klassifikation anlegen
    */
   function insert_class() {
      // es muss doch einen name dafür geben
      $this->form_validation->set_rules('classification_name', 'Classification name', 'trim|required|');
      if ($this->form_validation->run() == FALSE) {
          $data ['jQuery'] = TRUE;
          $data ['view'] = 'insert/insert_class_view';
          $this->load->view('template/content', $data);
      }
      else {

         $name = $this->input->post('classification_name');
         $this->load->model('classification_model');
         $query = $this->classification_model->create_Classification($name);

         if ($query) {
            $data ['view'] = 'insert/successful_insert_view';
            $this->load->view('template/content', $data);
         }
         else {
            $data ['error'] = 'Classification exsists!';
            $data ['view']  = 'insert/insert_class_view';
            $this->load->view('template/content', $data);
         }
      }
   }

   /**
    * neues Projekt anlegen
    */
   function insert_project() {
      // project nr muss ausserdem numerisch sein
      $this->form_validation->set_rules('project_name', 'Project Name', 'trim|required|');
      $this->form_validation->set_rules('project_number', 'Project Number', 'trim|required|numeric');

      if ($this->form_validation->run() == FALSE) {
          $data ['jQuery'] = TRUE;
          $data ['view'] = 'insert/insert_project_view';
          $this->load->view('template/content', $data);
      }
      else {

         $name   = $this->input->post('project_name');
         $number = $this->input->post('project_number');
         $this->load->model('project_model');
         $query = $this->project_model->create_Project($name, $number);

         // Wenn die Eingaben in der DB nicht vorhanden sind ist $query == false
         if ($query) {
            $data ['view'] = 'insert/successful_insert_view';
            $this->load->view('template/content', $data);
         }
         else {
            $data ['error'] = 'Project exsists or Project Number already used!';
            $data ['view']  = 'insert/insert_project_view';
            $this->load->view('template/content', $data);
         }
      }
   }

   /**
    * neues Dokument anlegen
    */
   function insert_document() {
           $this->form_validation->set_rules('title', 'Title', 'trim|required|');
           $this->form_validation->set_rules('projects', 'Project', 'trim|greater_than[0]|');
           $this->form_validation->set_rules('classifications', 'Classification', 'trim|greater_than[0]|');
           $this->form_validation->set_rules('authors', 'Author', 'trim|greater_than[0]');
           $this->form_validation->set_rules('keywords', 'Keywords', 'trim|required|');
           $this->form_validation->set_rules('abstract', 'Abstract', 'trim|required|');
           $this->form_validation->set_message('greater_than', "The %s field must be choosen!");

           if ($this->form_validation->run() == FALSE) {
               $data ['jQuery'] = TRUE;
               $data ['view'] = 'insert/insert_document_view';
               $this->load->view('template/content', $data);
           }
           else {
               $title       = $this->input->post('title');
               $abstract    = $this->input->post('abstract');
               $class       = $this->input->post('classifications');
               $project     = $this->input->post('projects');
               $keywords     = $this->input->post('keywords');
               $author      = $this->input->post('authors');
               //zuletzt noch einmal das File einfuegen
               $this->load->model('file_model');
               $file_id = $this->file_model->create_File($project, $title);
               if(!$file_id) {
                   $data ['error'] = 'Upload failed, please try again!';
                   $data ['view'] = 'insert/insert_document_view';
                   $this->load->view('template/content', $data);
               }

               $this->load->model('document_model');
               $query = $this->document_model->create_Document($title, $abstract, $class, $project, $keywords, $author, $file_id);

               if ($query) {
                   $data ['view'] = 'insert/successful_insert_view';
                   $this->load->view('template/content', $data);
               } else {
                   $this->load->model('project_model');
                   $this->load->model('author_model');
                   $this->load->model('classification_model');

                   if ($projects = $this->project_model->get_Project()) {
                       $data ['projects'] = $projects;
                   }
                   if ($authors = $this->author_model->get_Authors(TRUE)) {
                       $data ['authors'] = $authors;
                   }
                   if ($classification = $this->classification_model->get_Classification()) {
                       $data ['classifications'] = $classification;
                   }

                   $data ['error'] = 'Document even exsists!';
                   $data ['view'] = 'insert/insert_document_view';

                   $this->load->view('template/content', $data);
               }
           }
       }


   /**
    * ajax backend funktion
    */
   function show_Hint() {
      //getten
      $model   = $this->input->get('model');
      $entered = $this->input->get('entered');

      //entsprechenden model laden
      $this->load->model($model);

      // alle moeglichen eintraege nach dem model laden die mit dem uebergebenen buchstaben beginnen
      switch ($model) {
         case "project_model":
            $hints = $this->project_model->getHints($entered);
            break;
         case "author_model":
            $hints = $this->author_model->getHints($entered);
            break;
         case "document_model":
            $hints = $this->document_model->getHints($entered);
            break;
      }

      // den response string formatieren so das in der view ein dropdown damit gefüllt werden kann
      //$response = '<option value ="' . '">--- view all ---</option>';
      foreach ($hints->result() as $hint) {
         $response = '<option value=' . $hint->id . '>' . $hint->name . '</option>';
      }

      echo $response;
   }

    /**
     * ajax backend function fuer email und username ueberpruefung
     */
    function check_input() {
        $inputed = $this->input->get('inputed');
        $id      = $this->input->get('id');
        switch ($id) {
            case 'author_name':
            case 'author_mail':
                $this->load->model('author_model');
                $check_result = $this->author_model->checking($inputed, $id);
                break;
            case 'classification_name':
                $this->load->model('classification_model');
                $check_result = $this->classification_model->checking($inputed, $id);
                break;
            case 'project_number':
            case 'project_name':
                $this->load->model('project_model');
                $check_result = $this->project_model->checking($inputed, $id);
                break;
            case 'title':
                $this->load->model('document_model');
                $check_result = $this->document_model->checking($inputed, $id);
                break;
        }

        $response = NULL;
        if ($check_result) {
            $response = $check_result;
        }
        echo $response;
    }
}

/* End of file insert.php */
/* Location: ./application/controllers/insert.php */