<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_delete extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getListPelabuhan()
    {
        $query = $this->db->query('SELECT ID_PELABUHAN, PELABUHAN FROM `pelabuhan`');
        return $query->result_array();
    }

    public function getPelabuhan($id)
    {
        $data = $this->db->query('SELECT PELABUHAN FROM pelabuhan WHERE ID_PELABUHAN ="'.$id.'" LIMIT 1')->row_array();
        return $data;        
    } 

    public function getListDeletePelabuhan($id_pelabuhan){
        $query = $this->db->query('SELECT DISTINCT pelabuhan.PELABUHAN as PELABUHAN, data_pelabuhan.ID_PELABUHAN as ID_PELABUHAN, data_pelabuhan.BULAN as PERIODE, data_pelabuhan.TAHUN as TAHUN, 
                                kontak.NAMA_INSTANSI as NAMA_INSTANSI, kontak.PIC as PIC, data_pelabuhan.ID_KONTAK as ID_KONTAK 
                                FROM `data_pelabuhan`, `pelabuhan`, `kontak`
                                WHERE data_pelabuhan.ID_KONTAK = kontak.ID_KONTAK AND data_pelabuhan.ID_PELABUHAN = pelabuhan.ID_PELABUHAN
                                AND data_pelabuhan.ID_PELABUHAN = '.$id_pelabuhan.'
                                ');
        return $query->result_array();
    }   


    public function deleteDataAPBDP($id_daerah,$tahun)
    {
        //print_r($periode);
        //print_r($id_kontak);
        $this->db->where('ID_DAERAH', $id_daerah);
        
        $this->db->where('TAHUN', $tahun);
        
        $this->db->delete('apbd'); 
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
    public function deleteDataKelistrikan($id_kontak,$periode,$tahun)
    {
        
        $this->db->where('BULAN', $periode);
        $this->db->where('TAHUN', $tahun);
        $this->db->where('ID_KONTAK', $id_kontak);
        $this->db->delete('data_kelistrikan'); 
    }

}
