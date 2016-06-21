<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_filter extends CI_Model 
{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function getListPelabuhan()
    {
        $this->db->select('ID_PELABUHAN, PELABUHAN');
        $result = $this->db->get('pelabuhan');
        
        return $result->result_array();
    }
    public function getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan)
    {
        $this->db->select('ID_PELABUHAN, PELABUHAN');
        $result = $this->db->get('pelabuhan');
        
        return $result->result_array();
    }


}