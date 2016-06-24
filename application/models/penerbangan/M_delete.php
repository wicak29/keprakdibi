<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_delete extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }



    public function deleteDataKontak($id_kontak)
    {
        //print_r($periode);
        //print_r($id_kontak);
        $this->db->where('ID_KONTAK', $id_kontak);
        //$this->db->update('kontak', $data);
        
        $this->db->delete('kontak'); 
    }
    public function updateDataKontak($id_kontak,$data)
    {
        $query = $this->db->query('UPDATE data_apbd SET id_kontak=1 WHERE id_kontak="'.$id_kontak.'"');
        return $query;
        // $this->db->where('ID_KONTAK', $id_kontak);
        // $this->db->update('data_apbd', $data);
        
        //$this->db->delete('kontak'); 
    }
    public function getListDataKelistrikan()
    {
        $query = $this->db->query('SELECT DISTINCT data_kelistrikan.BULAN as BULAN, data_kelistrikan.TAHUN as TAHUN, kontak.NAMA_INSTANSI as NAMA_INSTANSI, kontak.PIC as PIC, data_kelistrikan.ID_KONTAK as ID_KONTAK FROM `data_kelistrikan`,`kontak` 
            WHERE data_kelistrikan.ID_KONTAK=kontak.ID_KONTAK');
        return $query->result_array();
    }
    public function getListDataPenerbangan()
    {
        $query = $this->db->query('SELECT DISTINCT data_penerbangan.BULAN as BULAN, data_penerbangan.TAHUN as TAHUN, kontak.NAMA_INSTANSI as NAMA_INSTANSI, kontak.PIC as PIC, data_penerbangan.ID_KONTAK as ID_KONTAK FROM `data_penerbangan`,`kontak` 
            WHERE data_penerbangan.ID_KONTAK=kontak.ID_KONTAK');
        return $query->result_array();
    }
    public function deleteDataKelistrikan($id_kontak,$periode,$tahun)
    {
        
        $this->db->where('BULAN', $periode);
        $this->db->where('TAHUN', $tahun);
        $this->db->where('ID_KONTAK', $id_kontak);
        $this->db->delete('data_penerbangan'); 
    }

}
