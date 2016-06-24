<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_update extends CI_Model 
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

    public function getAspekById($id)
    {
        $this->db->select('ASPEK');
        $result = $this->db->get_where('aspek', array('ID_ASPEK'=>$id))->row_array();
        return $result['ASPEK'];
    }

    public function updateNilai($id_entitas, $rute, $tahun, $bulan, $update)
    {
        $hasil=array();

        $this->db->where('ID_ENTITAS', $id_entitas);
        $this->db->where('RUTE', $rute);
        $this->db->where('TAHUN', $tahun);
        $this->db->where('BULAN', $bulan);
        $this->db->update('data_penerbangan', $update);

    }
    public function getDataUPT()
    {
        $query = $this->db->query('SELECT KODE_UPT FROM `upt`');
        return $query->result_array();
    }
}