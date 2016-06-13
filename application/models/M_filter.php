<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_filter extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getPic()
    {
        $this->db->select('ID_KONTAK, PIC');
        $result = $this->db->get('kontak');
        return $result;
    }
    public function getFilter()
    {
        $this->db->select('ID_DAERAH, NAMA_DAERAH');
        $result = $this->db->get('daerah');
        return $result->result_array();
    }
    public function getTahun()
    {

        $this->db->select('TAHUN');
        $this->db->distinct();
        $this->db->group_by('TAHUN');
        $result = $this->db->get('data_apbd');
        return $result->result_array();
    }
    public function cariFilter($daerah,$tahun)
    {
        $query = $this->db->query('SELECT NILAI FROM my_table WHERE ID_DAERAH =.$daerah. AND TAHUN ="'.$tahun.'"' );

        foreach ($query->result() as $row)
        {
            echo $row->NILAI;
        }

        return $query;
    }
}