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

    public function getDataSpesifikPIC($tahun, $bulan){
        $query = $this->db->query('SELECT DISTINCT kontak.*
                                   FROM `data_pelabuhan`, `kontak`
                                    WHERE data_pelabuhan.TAHUN="'.$tahun.'" AND data_pelabuhan.BULAN="'.$bulan.'"
                                    AND data_pelabuhan.ID_KONTAK = kontak.ID_KONTAK
                                    ');
        return $query->result_array();
    }

    public function getNamaPelabuhanById($id)
    {
        $this->db->select('PELABUHAN');
        $result = $this->db->get_where('pelabuhan',array('ID_PELABUHAN'=>$id))->row_array();
        return $result['PELABUHAN'];
    }

    public function getNamaUraianById($id)
    {
        $this->db->select('JENIS_DATA, SATUAN');
        $result = $this->db->get_where('jenis_bongkar_muat',array('ID_JENIS_DATA'=>$id))->row_array();
        return $result;
    }

    public function getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan)
    {
        //$this->db->select('ID_PELABUHAN, PELABUHAN');
        //$this->db->where('ID_PELABUHAN', $pelabuhan);
        //$result = $this->db->get('data_pelabuhan');
        $result = $this->db->query('SELECT pelabuhan.PELABUHAN AS NAMA,jenis_bongkar_muat.JENIS_DATA AS JENIS_DATA, jenis_bongkar_muat.SATUAN AS SATUAN, data_pelabuhan.NILAI AS REALISASI FROM `data_pelabuhan`, `pelabuhan`, `jenis_bongkar_muat` 
            WHERE data_pelabuhan.ID_PELABUHAN = '.$pelabuhan.' AND data_pelabuhan.TAHUN ="'.$tahun.'" AND data_pelabuhan.BULAN ="'.$bulan.'" AND data_pelabuhan.ID_JENIS_DATA=jenis_bongkar_muat.ID_JENIS_DATA 
            AND pelabuhan.ID_PELABUHAN=data_pelabuhan.ID_PELABUHAN');
        
        return $result->result_array();
    }

    public function getNilaiByUraian($id, $tahun, $periode, $pelabuhan)
    {
        $this->db->select('NILAI');
        $result = $this->db->get_where('data_pelabuhan', array('ID_JENIS_DATA'=>$id, 'TAHUN'=>$tahun, 'BULAN'=>$periode, 'ID_PELABUHAN'=>$pelabuhan));
        return $result->result_array();
    }


}