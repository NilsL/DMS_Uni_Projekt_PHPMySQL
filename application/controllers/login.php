<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Login
 */
class Login extends CI_Controller {

   /**
    * default index function
    */
   function index() {
      $data['jQuery'] = TRUE;
      $data['view']   = 'login/login_view';
      $this->load->view('template/content', $data);
   }

   /**
    * validates the login data
    */
   function validate_login() {
      $this->load->model('user_model');
      $user_id = $this->user_model->validate();

      // Wenn die Eingaben in der DB vorhanden sind ist $query == TRUE
      if ($user_id) {

         // $user_data wird an den Session Cookie angehangen und in der DB gespeichert
         $session_data = array(
            'username'     => $this->input->post('login'),
            'role'         => $this->user_model->get_Role($user_id),
            'is_logged_in' => TRUE
         );
         $this->session->set_userdata($session_data);

         // weiterleitung in den geschützten Bereich
         redirect('search');

         // wenn die Eingaben nich in der DB sind, also der User nicht vorhanden ist
         // zurück zur Login Page inkl. Error Ausgabe
      }
      else {
         $data['error']  = 'Invalid Login or Password!';
         $data['jQuery'] = TRUE;
         $data['view']   = 'login/login_view';
         $this->load->view('template/content', $data);
      }
   }

   /**
    * loads the signup view
    */
   function signup() {
      $data['jQuery'] = TRUE;
      $data['view']   = 'login/signup_view';
      $this->load->view('template/content', $data);
   }

   /**
    * prüft den userinput zur registration
    */
   function validate_signup() {
      // field name, error message, validation rules
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
      $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

      $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
      $this->form_validation->set_rules('password_confirm', 'Confirmation', 'trim|required|matches[password]');

      // wenn ein wert nicht korrekt validiert wurde alles auf anfang
      if ($this->form_validation->run() == FALSE) {
         $this->signup();
      }
      // ansonsten wird ein user in der db angelegt und die bestätigungs view angezeigt
      else {
         $first_name = $this->input->post('first_name');
         $last_name = $this->input->post('last_name');
         $email = $this->input->post('email');
         $username = $this->input->post('username');
         $password = $this->input->post('password');
         $this->load->model('user_model');
         if ($query = $this->user_model->create_User($first_name, $last_name, $email, $username, $password)) {
            $data['view'] = 'login/signup_successful';
            $this->load->view('template/content', $data);
         }
         // geht der db insert schief weil zb db verbindung abbricht etc pp
         // wird umgeleitet auf die signup view
         else {
            $data['error'] = 'Username or Email already existed!';
            $data['jQuery'] = TRUE;
            $data['view']   = 'login/signup_view';
            $this->load->view('template/content', $data);
         }
      }
   }

   /**
    * logout function
    */
   function logout() {
      $this->session->sess_destroy();
      redirect('home');
   }

   /**
    * ajax backend function fuer email und username ueberpruefung
    */
   function check_input() {
      //getten
      $inputed = $this->input->get('inputed');
      $id      = $this->input->get('id');
      //user_model loaden
      $this->load->model('user_model');

      $check_result = $this->user_model->checking($inputed, $id);

      $response = NULL;
      //Sollte $check_result nicht FALSE sein heisst das dass irgendwelche Konflikt existiert
      if ($check_result) {
         $response = $check_result;
      }
      echo $response;
   }
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */