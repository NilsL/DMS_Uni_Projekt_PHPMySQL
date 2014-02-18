<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Author extends MY_Controller {

        function __construct() {
            parent::__construct();
        }

        public function save() {
            $vorname  = $this->input->post('inputVorname');
            $nachname = $this->input->post('inputNachname');
            $email    = $this->input->post('inputEmail');

            $this->form_validation->set_rules('inputVorname', 'First Name', 'trim|required|alpha|xss_clean');
            $this->form_validation->set_rules('inputNachname', 'Last Name', 'trim|required|alpha|xss_clean');
            $this->form_validation->set_rules('inputEmail', 'E-Mail', 'trim|required|valid_email');

            if ($this->form_validation->run() == FALSE) {
                $data['message'] = validation_errors();
                $this->load->view('addAuthor.php', $data);
            }
            else {
                $author = array('vorname' => $vorname, 'nachname' => $nachname, 'email' => $email);

                $authorId = $this->authormodel->addAuthor($author);

                $data['message'] = "";
                if ($authorId) {
                    $data['message'] = "Author erfolgreich gespeichert!";
                }
                $this->load->view('addAuthor.php', $data);
            }
        }
    }

    /* End of file author.php */
    /* Location: ./application/controllers/author.php */
