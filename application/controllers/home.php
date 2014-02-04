<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Home
 */
class Home extends CI_Controller {

   function index() {
       $this->load->model('document_model');
       $documents = $this->document_model->get_Documents(FALSE, FALSE, FALSE);
       if ($documents) {
           $data['documents'] = $documents;
       }
      $data['view'] = 'home_view';
      $this->load->view('template/content', $data);
   }

}
/* End of file home.php */
/* Location: ./application/controllers/home.php */