<?php
class MainDirectory extends CI_Controller {

   function index() {
      $this->load->model('document_model');
      $documents = $this->document_model->get_Documents();
      if ($documents) {
         $data['documents'] = $documents;
      }
      $data['view'] = 'mainDirectory_view';
      $this->load->view('template/content', $data);
   }

}