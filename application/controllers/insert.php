<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller {

   function __construct() {
      parent::__construct();
      $this->is_logged_in();
   }

   // login check über session variable
   function is_logged_in() {
      $is_logged_in = $this->session->userdata('is_logged_in');

      // ist $is_logged_in nicht gesetzt oder FALSE
      // gibts ne warnmeldung mit link zur login view
      if (!isset ($is_logged_in) || $is_logged_in != TRUE) {
         echo 'You don\'t have permission to access this page. Please Login. ';
         echo anchor('login', 'Login');
         die ();
      }
   }

   //
   function index() {
      $data ['view'] = 'insert/insert_view';
      $this->load->view('template/content', $data);
   }

   //
   function insert_author() {
      $data ['view'] = 'insert/insert_author_view';
      $this->load->view('template/content', $data);
   }

   //
   function insert_class() {
      $data ['view'] = 'insert/insert_class_view';
      $this->load->view('template/content', $data);
   }

   //
   function insert_project() {
      $data ['view'] = 'insert/insert_project_view';
      $data ['dropdown']     = 'true';
      $this->load->view('template/content', $data);
   }

   //
   function validate_i_author() {
      $this->form_validation->set_rules('i_author_name', 'Author name', 'trim|required|');
      $this->form_validation->set_rules('i_author_mail', 'Email', 'trim|required');

      if ($this->form_validation->run() == FALSE) {
         $this->insert_author();
      }

      $this->load->model('insert_model');
      $query = $this->insert_model->validate_author();

      if (!$query) {
         $this->insert_model->insert_author();
         $data ['view'] = 'insert/successful_insert_view';
         $this->load->view('template/content', $data);
      }
      else {
         $data ['error']        = 'Author exsists or Email already used!';
         $data ['view'] = 'insert/insert_author_view';
         $this->load->view('template/content', $data);
      }
   }

   //
   function validate_i_class() {
      $this->form_validation->set_rules('i_class_name', 'Classification name', 'trim|required|');

      if ($this->form_validation->run() == FALSE) {
         $this->insert_class();
      }
      $this->load->model('insert_model');
      $query = $this->insert_model->validate_class();

      if (!$query) {
         $this->insert_model->insert_class();
         $data ['view'] = 'insert/successful_insert_view';
         $this->load->view('template/content', $data);
      }
      else {
         $data ['error']        = 'Classification exsists!';
         $data ['view'] = 'insert/insert_class_view';
         $this->load->view('template/content', $data);
      }
   }

   //
   function validate_i_project() {
      $this->form_validation->set_rules('i_project_name', 'Project Name', 'trim|required|');
      $this->form_validation->set_rules('i_project_number', 'Project Number', 'trim|required|numeric');

      if ($this->form_validation->run() == FALSE) {
         $this->insert_project();
      }

      $this->load->model('insert_model');
      $query = $this->insert_model->validate_project();

      // Wenn die Eingaben in der DB nicht vorhanden sind ist $query == false
      if (!$query) {
         $this->insert_model->insert_project();
         $data ['view'] = 'insert/successful_insert_view';
         $this->load->view('template/content', $data);
      }
      else {
         $data ['error']        = 'Project exsists or Project Number already used!';
         $data ['view'] = 'insert/insert_project_view';
         $this->load->view('template/content', $data);
      }
   }

   function insert_document() {
      $this->load->model('project_model');
      $this->load->model('author_model');
      $this->load->model('classification_model');

      $data ['view'] = 'insert/insert_document_view';

      if ($projects = $this->project_model->getProject()) {
         $data ['projects'] = $projects;
      }
      if ($authors = $this->author_model->getAuthors()) {
         $data ['authors'] = $authors;
      }
      if ($classifications = $this->classification_model->get_all_Classification()) {
         $data ['classifications'] = $classifications;
      }

      $this->load->view('template/content', $data);
   }

   function validate_i_document() {
      $this->form_validation->set_rules('i_document_title', 'Title', 'trim|required|');
      $this->form_validation->set_rules('projects', 'Project', 'trim|greater_than[1]|');
      $this->form_validation->set_rules('classification', 'Classification', 'trim|greater_than[1]|');
      $this->form_validation->set_message('greater_than', "The %s field must be chooesed");

      if ($this->form_validation->run() == FALSE) {
         $this->insert_document();
      }

      $this->load->model('insert_model');
      $query = $this->insert_model->validate_document();

      if (!$query) {
         $success = $this->insert_model->insert_document();
         if ($success) {
            $data ['view'] = 'insert/successful_insert_view';
            $this->load->view('template/content', $data);
         }
         else {
            $data ['error']        = 'Sorry! System error! Please try again. Thanks for your unterstand!';
            $data ['view'] = 'insert/insert_document_view';
            $this->load->model('search_model');
            if ($projects = $this->search_model->get_all_Projects()) {
               $data ['all_p'] = $projects;
            }
            if ($authors = $this->search_model->get_all_Author()) {
               $data ['all_a'] = $authors;
            }
            if ($classification = $this->search_model->get_all_Classification()) {
               $data ['all_c'] = $classification;
            }
            $this->load->view('template/content', $data);
         }
      }
      else {
         $data ['error']        = 'Document exsists!';
         $data ['view'] = 'insert/insert_document_view';
         $this->load->model('search_model');
         if ($projects = $this->search_model->get_all_Projects()) {
            $data ['all_p'] = $projects;
         }
         if ($authors = $this->search_model->get_all_Author()) {
            $data ['all_a'] = $authors;
         }
         if ($classification = $this->search_model->get_all_Classification()) {
            $data ['all_c'] = $classification;
         }
         $this->load->view('template/content', $data);
      }
   }

   function insert_file() {
      $this->load->model('document_model');

      $data ['view'] = 'insert/insert_file_view';

      if ($documents = $this->document_model->get_Documents()) {
         $data ['documents'] = $documents;
      }

      $this->load->view('template/content', $data);
   }

   function validate_i_file() {
      $config ['allowed_types'] = 'gif|jpg|png|doc|docx|ppt|pptx|pdf';
      $config ['upload_path']   = './uploads/';
      $config ['max_size']      = '20480';
      $config ['max_filename']  = '100';
      // $config['max_width'] = '1024';
      // $config['max_height'] = '768';
      $this->load->library('upload', $config);

      $this->load->model('insert_model');

      if ($this->upload->do_upload('i_file')) {
         $data = array(
            'upload_data' => $this->upload->data()
         );

         $fileName = $data ['upload_data'] ['orig_name'];
         $tmpName  = $data ['upload_data'] ['full_path'];
         var_dump($fileName);
         var_dump($tmpName);

         $fp      = fopen($tmpName, 'r');
         $content = fread($fp, filesize($tmpName));
         $content = addslashes($content);
         fclose($fp);

         $sussess = $this->insert_model->insert_file($content, $fileName, $tmpName);
         unlink($tmpName);

         if ($sussess) {
            $this->insert_model->insert_document_has_file();

            $data ['view'] = 'insert/successful_insert_view';
            $this->load->view('template/content', $data);
         }
         else {
            $this->load->model('search_model');

            $data['error'] = "Upload failed, please try it again";

            $data ['view'] = 'insert/insert_file_view';

            if ($documents = $this->search_model->get_all_Documents()) {
               $data ['all_d'] = $documents;
            }

            $this->load->view('template/content', $data);
         }
      }
      else {
         $data ['error'] = array(
            'error' => $this->upload->display_errors()
         );
         $this->load->model('search_model');

         $data ['view'] = 'insert/insert_file_view';

         if ($documents = $this->search_model->get_all_Documents()) {
            $data ['all_d'] = $documents;
         }

         $this->load->view('template/content', $data);
      }
   }
}