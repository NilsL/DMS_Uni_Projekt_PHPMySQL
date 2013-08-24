<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Name: Search Controller
 * Author: Nils Lutz
 * Version: 0.1
 */
class Search extends CI_Controller {

   /**
    * CI_Controller Konstruktor + check ob user eingelogt ist
    *
    *
    */
   function __construct() {
      parent::__construct();
      $this->is_logged_in();
   }

   /**
    * soll noch ausgelagert werden in einen helper
    *
    *
    */
   function is_logged_in() {
      $is_logged_in = $this->session->userdata('is_logged_in');

      if (!isset($is_logged_in) || $is_logged_in != TRUE) {
         redirect('login');
      }
   }

   /**
    *
    *
    *
    */
   function index() {
      $data['view'] = 'search/search_view';
      $this->load->view('template/content', $data);
   }

   /**
    * erweiterte suche
    *
    *
    */
   function search_advanced() {
      $this->load->model('project_model');
      $this->load->model('classification_model');

      // projekte zur view laden
      $projects = $this->project_model->get_Project();
      if ($projects) {
         $data['projects'] = $projects;
      }

      // klassifizierung zur view laden
      $classifications = $this->classification_model->get_Classification();
      if ($classifications) {
         $data['classifications'] = $classifications;
      }

      $data['jQuery'] = TRUE;
      $data['view']   = 'search/search_advanced_view';
      $this->load->view('template/content', $data);
   }

   /**
    * anzeige der suchergebnisse
    *
    *
    */
   function show_result() {
      $this->load->model('document_model');

      if ($this->input->post('title') == '' && $this->input->post('keywords') == '') {
         $documents = $this->document_model->get_Documents();
      }
      elseif ($this->input->post('keywords') == '') {
         $title     = $this->input->post('title');
         $documents = $this->document_model->get_Documents($title, NULL);
      }
      elseif ($this->input->post('title') == '') {
         $keywords  = explode(',', str_replace(' ', '', $this->input->post('keywords')));
         $documents = $this->document_model->get_Documents(NULL, $keywords);
      }
      else {
         $title     = $this->input->post('title');
         $keywords  = explode(',', str_replace(' ', '', $this->input->post('keywords')));
         $documents = $this->document_model->get_Documents($title, $keywords);
      }

      // wenn Ergebnisse gefunden wurden
      if ($documents) {
         $data['documents'] = $documents;

         $data['view'] = 'search/result_view';
         $this->load->view('template/content', $data);
      }
      // wenn nichts gefunden wurde
      else {
         $data['error'] = 'No items found, search again with other input';
         $data['view']  = 'search/search_view';
         $this->load->view('template/content', $data);
      }
   }


   /**
    * ajax backend function welche vom js script gecalled wird
    *
    *
    */
   function show_Hint() {
      $this->load->model('project_model');
      $entered = $this->input->get('entered');


      // alle möglichen projekte laden die mit dem übergebenen buchstaben beginnen
      $hints = $this->project_model->getHints($entered);

      // den response string formatieren so das in der view ein dropdown damit gefüllt werden kann
      $response = NULL;
      foreach ($hints->result() as $hint) {
         $response = $response . '<option value=' . $hint->id . '>' . $hint->name . '</option>';
      }

      echo $response;
   }

   /**
    * popup function
    *
    *
    */
   function popup() {
      $this->load->model('document_model');

      $doc_id = $this->input->get('doc_id');

      $data['document'] = $this->document_model->get_Document($doc_id)->row();

      $this->load->view('search/popup_view', $data);
   }
}
/* End of file search.php */
/* Location: ./application/controllers/search.php */