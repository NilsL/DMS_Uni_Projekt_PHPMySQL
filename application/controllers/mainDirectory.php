<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class MainDirectory
 */
class MainDirectory extends CI_Controller {

   /**
    * default index function
    */
   function index() {
      $this->load->model('document_model');
      $documents = $this->document_model->get_Documents(FALSE, FALSE, FALSE);
      if ($documents) {
         $data['documents'] = $documents;
      }
      $data['view'] = 'mainDirectory_view';
      $this->load->view('template/content', $data);
   }
}
/* End of file mainDirectory.php */
/* Location: ./application/controllers/mainDirectory.php */