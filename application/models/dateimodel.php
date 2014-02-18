<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Dateimodel extends CI_Model {

        function getDateiId($dok_id) {
            $this->db->select('datei_id');
            $this->db->where('id', $dok_id);
            $query = $this->db->get('dokument');
            $row = $query->row();

            return $row ? $row->datei_id : FALSE;
        }

        function getDatei($dok_id) {
            $this->db->select('datei.name, datei.pfad, md5');
            $this->db->join('dokument', 'dokument.datei_id = datei.id');
            $this->db->where('dokument.id', $dok_id);
            $datei = $this->db->get('datei');

            return $datei ? $datei->row() : FALSE;
        }

        function addDatei($datei) {
            $query = $this->db->insert('datei', $datei);

            return $query ? $this->db->insert_id() : FALSE;
        }

        function removeDatei($datei_id) {
            $this->db->where('id', $datei_id);
            $this->db->delete('datei');
        }
    }

    /* End of file dateimodel.php */
    /* Location: ./application/model/dateimodel.php */