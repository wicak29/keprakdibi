<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_filter extends CI_Model 
{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function getEntitas(){
        $query = $this->db->query('SELECT DISTINCT NAMA_ENTITAS 
                                    FROM `entitas`
                                  ');
        return $query->result_array(); 
    }

    public function getListPenerbangan($tahun, $bulan){
        $query = $this->db->query('SELECT NILAI, RUTE 
                                    FROM `data_penerbangan`
                                    WHERE BULAN = "'.$bulan.'" AND TAHUN = "'.$tahun.'"
                                    ');
        return $query->result_array(); 
    }

    public function getNilaiByKategori($entitas, $tahun, $bulan, $rute)
    {
        $this->db->select('NILAI');
        $result = $this->db->get_where('data_penerbangan', array('ID_ENTITAS'=>$entitas, 'TAHUN'=>$tahun, 'BULAN'=>$bulan, 'RUTE'=>$rute));
        return $result->result_array();
    }

    public function getEntitasById($id)
    {
        $this->db->select('NAMA_ENTITAS, AKTIVITAS');
        $result = $this->db->get_where('entitas', array('ID_ENTITAS'=>$id))->row_array();
        return $result;
    }
}