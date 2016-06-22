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


}