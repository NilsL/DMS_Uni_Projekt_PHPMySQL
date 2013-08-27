<?php
class MainDirectory extends CI_Controller {

	function index() {
		$this->load->model('document_model');
		$query = $this->document_model->get_Document();
		if($query) {
			$data['all_documents'] = $query;
		}
		$data['view'] = 'mainDirectory_view';
		$this->load->view('template/content', $data);
	}

}