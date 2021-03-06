<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class MY_Controller extends CI_Controller {
        public function __construct() {
            parent::__construct();

            if (!$this->ion_auth->logged_in()) {
                redirect('auth/login');
            }
            else {
                //Store user in $data
                $data['user_info'] = $this->ion_auth->user()->row();
                //Load $the_user in all views
                $this->load->vars($data);
            }
        }
    }
