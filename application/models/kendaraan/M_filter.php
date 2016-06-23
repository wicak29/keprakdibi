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

    public function getNamaKategoriById($id)
    {
        $this->db->select('KATEGORI_PELANGGAN');
        $result = $this->db->get_where('kategori_pelanggan',array('ID_KATEGORI'=>$id))->row_array();
        return $result['KATEGORI_PELANGGAN'];
    }

    public function getNilaiByKategori($id, $tahun, $bulan, $aspek)
    {
        $this->db->select('NILAI');
        $result = $this->db->get_where('data_kelistrikan', array('ID_KATEGORI'=>$id, 'TAHUN'=>$tahun, 'BULAN'=>$bulan, 'ID_ASPEK'=>$aspek));
        return $result->result_array();
    }

    public function getAspekById($id)
    {
        $this->db->select('ASPEK');
        $result = $this->db->get_where('aspek', array('ID_ASPEK'=>$id))->row_array();
        return $result['ASPEK'];
    }
}