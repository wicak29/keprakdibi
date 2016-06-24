<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_filter extends CI_Model 
{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function getIDEntitas($entitas){
        $query = $this->db->query('SELECT ID_ENTITAS
                                    FROM `entitas`
                                    WHERE NAMA_ENTITAS = "'.$entitas.'"
                                  ');
        return $query->result_array(); 
    }

    public function getDataPenerangan($id_entitas, $bulan, $tahun){
        $query = $this->db->query('SELECT NILAI, RUTE 
                                    FROM `data_penerbangan`
                                    WHERE BULAN = "'.$bulan.'" AND TAHUN = "'.$tahun.'" AND ID_ENTITAS = "'.$id_entitas.'"
                                    ');
        return $query->result_array(); 
    }

    public function getNilaiByKategori($jenis, $tahun, $bulan, $upt)
    {
        $this->db->select('NILAI');
        $result = $this->db->get_where('data_kendaraan', array('JENIS'=>$jenis, 'TAHUN'=>$tahun, 'BULAN'=>$bulan, 'KODE_UPT'=>$upt));
        return $result->result_array();
    }

    public function getUptById($id)
    {
        $this->db->select('NAMA_UPT');
        $result = $this->db->get_where('upt', array('KODE_UPT'=>$id))->row_array();
        return $result['NAMA_UPT'];
    }
}