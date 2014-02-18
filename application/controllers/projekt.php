<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Projekt extends MY_Controller {

        function __construct() {
            parent::__construct();
        }

        public function save() {
            $name   = $this->input->post('inputName');
            $nummer = $this->input->post('inputNummer');
            $art    = $this->input->post('inputArt');

            $this->form_validation->set_rules('inputName', 'name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('inputNummer', 'number', 'trim|required|numeric|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data['message'] = validation_errors();
                $this->load->view('addProjekt.php', $data);
            }
            else {
                $project = array(
                    'name'   => $name,
                    'nummer' => $nummer,
                    'art'    => $art
                );

                $projektId = $this->projektmodel->addProjekt($project);

                $data['message'] = "";
                if ($projektId) {
                    $data['message'] = "Projekt erfolgreich gespeichert!";
                }
                $this->load->view('addProjekt.php', $data);
            }
        }
    }

    /* End of file projekt.php */
    /* Location: ./application/controllers/projekt.php */
