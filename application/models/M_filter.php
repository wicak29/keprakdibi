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
    public function getDaerah($id)
    {

        $data = $this->db->query('SELECT NAMA_DAERAH FROM daerah WHERE ID_DAERAH ="'.$id.'" LIMIT 1');
        $row = $data->row_array();
        return $row['NAMA_DAERAH'];
    }

    public function getDatabyProvTahunPeriode($bulan, $tahun)
    {
        $query = $this->db->query('SELECT apbd.URAIAN as URAIAN, data_apbd.NILAI as NILAI 
                                    FROM apbd, data_apbd 
                                    WHERE data_apbd.ID_DAERAH =1 AND data_apbd.PERIODE ="'.$bulan.'" AND data_apbd.TAHUN ="'.$tahun.'" AND apbd.ID_APBD = data_apbd.ID_APBD
                                    GROUP BY data_apbd.ID_APBD');

        return $query->result_array();
        
    }

    public function getDatabyKabTahunPeriode($kab, $periode, $tahun)
    {

        //$query = $this->db->query('SELECT NILAI FROM data_apbd WHERE ID_DAERAH ='.$kab.' AND PERIODE ="'.$periode.'" AND TAHUN ="'.$tahun.'"' );
        $query = $this->db->query('SELECT apbd.URAIAN as URAIAN, data_apbd.NILAI as NILAI 
                                    FROM apbd, data_apbd 
                                    WHERE data_apbd.ID_DAERAH ='.$kab.' AND data_apbd.PERIODE ="'.$periode.'" AND data_apbd.TAHUN ="'.$tahun.'" AND apbd.ID_APBD = data_apbd.ID_APBD
                                    GROUP BY data_apbd.ID_APBD
                                 ' );
        return $query->result_array();
    }
}
