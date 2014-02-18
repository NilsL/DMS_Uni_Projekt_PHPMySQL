<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Projektmodel extends CI_Model {

        function getProjekte() {
            $this->db->select('id,name,nummer,art');
            $this->db->order_by('nummer', 'asc');
            $this->db->from('projekt');
            $query = $this->db->get();

            return $query->result();
        }

        function addProjekt($projekt) {
            $this->db->insert('projekt', $projekt);

            return $this->db->insert_id();
        }
    }

    /* End of file projektmodel.php */
    /* Location: ./application/model/projektmodel.php */