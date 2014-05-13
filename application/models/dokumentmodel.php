<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Dokumentmodel extends CI_Model {

        function getDokumente($dok_id = NULL) {
            $this->db->select('dokument.id AS id, titel, projekt.name AS projekt, projekt.art AS art');
            $this->db->join('projekt', 'projekt.id = projekt_id');

            if($dok_id) {
                $this->db->select('author.vorname AS author_vorname, author.nachname AS author_nachname, abstrakt, datei.name AS dateiname, pfad AS dateipfad, md5');
                $this->db->join('author', 'author.id = author_id');
                $this->db->join('datei', 'datei.id = datei_id');
                $this->db->where('dokument.id', $dok_id);
            }

            $this->db->order_by('titel', 'asc');
            $query = $this->db->get('dokument');

            return $dok_id ? $query->row() : $query->result();
        }

        function addDokument($dokument) {
            $this->db->insert('dokument', $dokument);

            return $this->db->insert_id();
        }

        function updateDokument($dok_id, $dokument) {
            $this->db->where('id', $dok_id);
            $this->db->update('dokument', $dokument);

            return $dok_id;
        }

        function removeDokument($dok_id) {
            $this->db->where('id', $dok_id);
            $this->db->delete('dokument');
        }

        function findDokument($titel = NULL, $projekt_id = NULL, $author_id = NULL, $keywords = NULL) {
            $this->db->select('dokument.id AS id, titel, projekt.name AS projekt, projekt.art AS art');
            $this->db->join('projekt', 'projekt.id = projekt_id');
            $this->db->order_by('titel', 'asc');

            if($titel) {
                $this->db->like('titel', $titel);
            }
            if($projekt_id) {
                $this->db->where('projekt_id', $projekt_id);
            }
            if($author_id) {
                $this->db->where('author_id', $author_id);
            }
            if($keywords) {
                $this->db->distinct();
                $this->db->join('dokument_hat_keyword', 'dokument_hat_keyword.dok_id = dokument.id');
                $this->db->join('keyword', 'dokument_hat_keyword.key_id = keyword.id');
                $this->db->where_in('keyword.name', $keywords);
            }
            $query = $this->db->get('dokument');

            return $query ? $query->result() : FALSE;

        }
    }

    /* End of file dokumentmodel.php */
    /* Location: ./application/model/dokumentmodel.php */