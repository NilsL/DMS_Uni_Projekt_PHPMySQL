<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Home extends MY_Controller {

        function __construct() {
            parent::__construct();
        }

        public function index() {
            $query = $this->dokumentmodel->getDokumente();
            if ($query) {
                $data ['dokumente'] = $query;
            }
            $this->load->view('home.php', $data);
        }

        public function addDokument() {
            $query = $this->projektmodel->getProjekte();
            if ($query) {
                $data['projekte'] = $query;
            }

            $query = $this->authormodel->getAuthoren();
            if ($query) {
                $data['authoren'] = $query;
            }

            $this->load->view('addDokument.php', $data);
        }

        public function addProjekt() {
            $this->load->view('addProjekt.php');
        }

        public function addAuthor() {
            $this->load->view('addAuthor.php');
        }

        public function searchDokument() {
            $query = $this->projektmodel->getProjekte();
            if ($query) {
                $data['projekte'] = $query;
            }

            $query = $this->authormodel->getAuthoren();
            if ($query) {
                $data['authoren'] = $query;
            }

            $this->load->view('searchDokument.php', $data);
        }
    }

    /* End of file home.php */
    /* Location: ./application/controllers/home.php */
