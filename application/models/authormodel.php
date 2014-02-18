<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Authormodel extends CI_Model {

        function getAuthoren() {
            $this->db->select('id,vorname,nachname,email');
            $this->db->order_by('nachname', 'asc');
            $this->db->from('author');
            $query = $this->db->get();

            return $query->result();
        }

        function addAuthor($author) {
            $this->db->insert('author', $author);

            return $this->db->insert_id();
        }
    }

    /* End of file authormodel.php */
    /* Location: ./application/model/authormodel.php */