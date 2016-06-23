<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_update extends CI_Model 
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

    public function updateNilai($kode_upt, $jenis, $tahun, $bulan, $data)
    {
        $hasil=array();

        $this->db->where('KODE_UPT', $kode_upt);
        $this->db->where('JENIS', $jenis);
        $this->db->where('TAHUN', $tahun);
        $this->db->where('BULAN', $bulan);
        $this->db->update('data_kendaraan', $data);
            //array_push($hasil, $query->result_array());
        
        //return $hasil;
    }
    public function getDataUPT()
    {
        $query = $this->db->query('SELECT KODE_UPT FROM `upt`');
        return $query->result_array();
    }
}