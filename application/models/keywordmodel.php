<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Keywordmodel extends CI_Model {

        function getKeyword($keyword) {
            $this->db->where('name', $keyword);
            $query = $this->db->get('keyword');
            $row = $query->row();

            return $row ? $row->id : FALSE;
        }

        function addKeyword($keyword) {
            $query = $this->db->insert('keyword', array('name' => $keyword));

            return $query ? $this->db->insert_id() : FALSE;
        }

        function addBinding($binding) {
            $query = $this->db->insert('dokument_hat_keyword', $binding);

            return $query;
        }

        function removeBinding($dok_id) {
            $this->db->where('dok_id', $dok_id);
            $this->db->delete('dokument_hat_keyword');
        }
    }

    /* End of file keywordmodel.php */
    /* Location: ./application/model/keywordmodel.php */