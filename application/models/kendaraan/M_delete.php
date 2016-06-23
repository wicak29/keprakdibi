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

    public function getListDataKendaraan()
    {
        $query = $this->db->query('SELECT DISTINCT data_kendaraan.BULAN AS BULAN, data_kendaraan.TAHUN AS TAHUN, kontak.NAMA_INSTANSI, kontak.PIC, data_kendaraan.ID_KONTAK AS ID_KONTAK FROM `data_kendaraan`, `upt`, `kontak` 
            WHERE data_kendaraan.KODE_UPT=upt.KODE_UPT AND kontak.ID_KONTAK=data_kendaraan.ID_KONTAK');
        return $query->result_array();
    }
    public function deleteDataKendaraan($id_kontak,$periode,$tahun)
    {
        
        $this->db->where('BULAN', $periode);
        $this->db->where('TAHUN', $tahun);
        $this->db->where('ID_KONTAK', $id_kontak);
        $this->db->delete('data_kendaraan'); 
    }

}
