<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_filter extends CI_Model 
{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

     public function getUraianKendaraan(){
        $query = $this->db->query('SELECT KODE_UPT, NAMA_UPT 
                                    FROM `upt`
                                  ');
        return $query->result_array(); 
     }

    public function getListKendaraan($tahun, $bulan){
        $query = $this->db->query('SELECT JENIS, NILAI 
                                    FROM `data_kendaraan`
                                    WHERE BULAN = "'.$bulan.'" AND TAHUN = "'.$tahun.'"
                                    ');
        return $query->result_array(); 
    }

    public function getNilaiKendaraanbyPeriode($jenis, $tahun, $bulan){
        $query = $this->db->query('SELECT NILAI 
                                    FROM `data_kendaraan`
                                    WHERE BULAN = "'.$bulan.'" AND TAHUN = "'.$tahun.'" AND JENIS LIKE "'.$jenis.'%"
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

    public function getDataSpesifikPIC($tahun, $bulan){
        $query = $this->db->query('SELECT DISTINCT kontak.*
                                   FROM `data_kendaraan`, `kontak`
                                    WHERE data_kendaraan.TAHUN="'.$tahun.'" AND data_kendaraan.BULAN="'.$bulan.'"
                                    AND data_kendaraan.ID_KONTAK = kontak.ID_KONTAK
                                    ');
        return $query->result_array();
    }
}