<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Dokument extends MY_Controller {

        function __construct() {
            parent::__construct();
        }

        public function save() {
            $titel      = $this->input->post('inputTitel');
            $projekt_id = $this->input->post('inputProjektId');
            $author_id  = $this->input->post('inputAuthorId');
            $keywords   = explode(',', $this->input->post('inputKeywords'));
            $abstrakt   = $this->input->post('inputAbstrakt');

            $this->form_validation->set_rules('inputTitel', 'title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('inputKeywords', 'keywords', 'trim|required|xss_clean');
            $this->form_validation->set_rules('inputAbstrakt', 'abstract', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $query = $this->projektmodel->getProjekte();
                if ($query) {
                    $data['projekte'] = $query;
                }
                $query = $this->authormodel->getAuthoren();
                if ($query) {
                    $data['authoren'] = $query;
                }
                $data['message'] = validation_errors();
                $this->load->view('addDokument.php', $data);
            }
            else {
                /* Datei Upload */
                $config ['upload_path']     = './uploads/';
                $config ['allowed_types']   = 'doc|docx|odt|pdf|txt|png|jpg|jpeg';
                $config ['file_name']       = $titel . '-' . uniqid();
                $config ['max_size']        = '20480';
                $config ['max_filename']    = '100';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('inputDatei')) {

                    $data['error'] = "Datei upload fehlgeschlagen!";
                    $this->load->view('addDokument.php', $data);
                }
                else {
                    $upload_data = $this->upload->data();

                    $datei = array(
                        'name' => $upload_data ['file_name'],
                        'pfad' => $upload_data ['file_path'],
                        'md5'  => md5_file($upload_data['full_path'])
                    );

                    $datei_id = $this->dateimodel->addDatei($datei);

                    if (!$datei_id) {
                        unlink($upload_data ['full_path']);
                        $data['error'] = "Datei upload fehlgeschlagen!";
                        $this->load->view('addDokument.php', $data);
                    }
                }

                $dokument = array(
                    'titel'         => $titel,
                    'projekt_id'    => $projekt_id,
                    'author_id'     => $author_id,
                    'abstrakt'      => $abstrakt,
                    'datei_id'      => $datei_id
                );

                $dok_id = $this->dokumentmodel->addDokument($dokument);

                /* Keyword Insert */
                $insert = TRUE;
                foreach ($keywords as $keyword) {
                    $keyword = trim($keyword);
                    // keyword id holen oder keyword neu einfügen
                    $key_id = $this->keywordmodel->getKeyword($keyword);

                    /* wenn Keyword nicht vorhanden, einfügen und ID entnehmen */
                    if (!$key_id) {
                        $key_id = $this->keywordmodel->addKeyword($keyword);
                    }

                    $binding  = array(
                        'dok_id'  => $dok_id,
                        'key_id'  => $key_id);

                    $binding = $this->keywordmodel->addBinding($binding);
                    if (!$binding) {
                        $insert = FALSE;
                    }
                }

                if (!$insert) {
                    $data['error'] = "Dokument wurde nicht gespeichert!";
                }
                else {
                    $data['message'] = "Dokument erfolgreich gespeichert!";
                }
                $this->load->view('addDokument.php', $data);
            }
        }

        public function delete($dok_id) {
            $datei_id = $this->dateimodel->getDateiId($dok_id);

            $this->keywordmodel->removeBinding($dok_id);
            $this->dokumentmodel->removeDokument($dok_id);
            $this->dateimodel->removeDatei($datei_id);

            $data['message']    = "Dokument erfolgreich gelöscht!";

            $query = $this->dokumentmodel->getDokumente();
            if ($query) {
                $data ['dokumente'] = $query;
            }
            $this->load->view('home.php', $data);
        }

        public function open($dok_id) {
            $data['dokument'] = $this->dokumentmodel->getDokumente($dok_id);

            $this->load->view('modal.php', $data);
        }

        public function find($variant) {
            $titel      = $this->input->post('inputTitel');
            $projekt_id = $this->input->post('inputProjektId');
            $author_id  = $this->input->post('inputAuthorId');
            $keywords   = explode(',', $this->input->post('inputKeywords'));

            switch($variant) {
                case '1':
                    $data['dokumente'] = $this->dokumentmodel->findDokument($titel);
                    break;
                case '2':
                    $data['dokumente'] = $this->dokumentmodel->findDokument(NULL, $projekt_id);
                    break;
                case '3':
                    $data['dokumente'] = $this->dokumentmodel->findDokument(NULL, NULL, $author_id);
                    break;
                case '4':
                    $data['dokumente'] = $this->dokumentmodel->findDokument(NULL, NULL, NULL, $keywords);
                    break;
            }

            $this->load->view('home.php', $data);
        }

        public function download($dok_id) {
            $datei = $this->dateimodel->getDatei($dok_id);

            force_download($datei->name, file_get_contents($datei->pfad.$datei->name));
        }

    }

    /* End of file dokument.php */
    /* Location: ./application/controllers/dokument.php */
