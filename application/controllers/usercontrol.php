<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Usercontrol
 */
class Usercontrol extends CI_Controller {

   /**
    * CI_Controller Konstruktor + check ob user eingelogt ist
    */
   function __construct() {
      parent::__construct();
      $this->is_logged_in();
   }

   /**
    * soll noch ausgelagert werden in einen helper
    */
   function is_logged_in() {
      $is_logged_in = $this->session->userdata('is_logged_in');

      if (!isset($is_logged_in) || $is_logged_in != TRUE) {
         redirect('login');
      }
   }

   /**
    * index function, sollte $message gesetzt sein wird es in der view angezeigt
    */
   function index($message = NULL) {
      $this->load->model('user_model');

      $users         = $this->user_model->get_User();
      $data['users'] = $users;

      if (isset($message)) {
         $data['message'] = $message;
      }

      $data['view'] = 'usercontrol/usercontrol_view';
      $this->load->view('template/content', $data);
   }

   /**
    * einzel user edit view, wenn $success gesetzt ist wird die Meldung mit ausgegeben
    */
   function show_User($success = NULL) {
      $user_id = $this->input->post('user_id');

      $this->load->model('user_model');
      $user = $this->user_model->get_User($user_id);

      // wenn ein User vorhanden ist wird der User angezeigt ansonsten Fehlermeldung
      if ($user) {
         $data['success'] = $success;
         $data['user']    = $user;
         $data['view']    = 'usercontrol/user_view';
         $this->load->view('template/content', $data);
      }
      else {
         die();
      }
   }

   /**
    * user update
    */
   function update_User() {
      $id           = $this->input->post('user_id');
      $updated_data = array(
         'first_name' => $this->input->post('first_name'),
         'last_name'  => $this->input->post('last_name'),
         'username'   => $this->input->post('username'),
         'email'      => $this->input->post('email'),
         'role'       => $this->input->post('role'));

      $this->load->model('user_model');
      if ($this->user_model->update_User($id, $updated_data)) {
         $success = 'User successfully updated!';
         $this->show_User($success);
      }
   }

   /**
    * user deletion
    */
   function delete_User() {
      $id = $this->input->post('user_id');
      $this->load->model('user_model');
      if ($this->user_model->delete_User($id)) {
         $message = 'User successfully deleted!';
         $this->index($message);
      }
   }
}
/* End of file usercontrol.php */
/* Location: ./application/controllers/usercontrol.php */