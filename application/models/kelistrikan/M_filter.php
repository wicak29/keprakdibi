<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_filter extends CI_Model 
{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

     public function getUraianKelistrikan(){
        $query = $this->db->query('SELECT KATEGORI_PELANGGAN as KATEGORI 
                                    FROM `kategori_pelanggan`
                                  ');
        return $query->result_array(); 
     }

    public function getListKelistrikan($id_aspek, $tahun, $bulan){
        $query = $this->db->query('SELECT NILAI 
                                    FROM `data_kelistrikan`
                                    WHERE ID_ASPEK = '.$id_aspek.' AND BULAN = "'.$bulan.'" AND TAHUN = "'.$tahun.'"
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

    public function getDataSpesifikPIC($tahun, $bulan)
    {
        $query = $this->db->query('SELECT DISTINCT kontak.*
                                   FROM `data_kelistrikan`, `kontak`
                                    WHERE data_kelistrikan.TAHUN="'.$tahun.'" AND data_kelistrikan.BULAN="'.$bulan.'"
                                    AND data_kelistrikan.ID_KONTAK = kontak.ID_KONTAK
                                    ');
        return $query->result_array();
    }
}