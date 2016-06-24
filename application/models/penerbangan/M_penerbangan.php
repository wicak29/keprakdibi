<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penerbangan extends CI_Model 
{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function tambahUraian($dataarray){
        for($i=0;$i<count($dataarray);$i++){   
            $data = array(
                
                'KODE_UPT'=>$dataarray[$i][0],
                'NAMA_UPT'=>$dataarray[$i][1]
            );
            $query = $this->db->insert('upt', $data); //JANGAN LUPA GANTI NAMA TABEL
        }        
        return $query;
        //echo $data['dump'];
    }

    public function getListPIC()
    {
        $query = $this->db->query('SELECT kontak.ID_KONTAK as ID_KONTAK, kontak.PIC as PIC, kontak.NAMA_INSTANSI as NAMA_INSTANSI FROM `kontak_indikator`, `kontak`
                    WHERE kontak.ID_KONTAK = kontak_indikator.ID_KONTAK AND kontak_indikator.ID_INDIKATOR=4');
        return $query->result_array();
    }

    public function getKendaraanDataError($tahun, $periode)
    {
        $query = $this->db->query('SELECT NILAI FROM `data_kendaraan`
                    WHERE BULAN ="'.$periode.'" AND TAHUN ="'.$tahun.'" ');
        return $query->result_array();
    }

    public function getDataUPT(){
        $query = $this->db->query('SELECT KODE_UPT FROM `upt`');
        return $query->result_array();
    }

    public function tambahDataKendaraan($dataarray, $bulan, $tahun, $kode_upt, $pic){
        for($i=0;$i<count($dataarray);$i++){
            $data = array(
                'NILAI'=>$dataarray[$i][3],
                'JENIS'=>$dataarray[$i][2],
                'BULAN'=>$bulan,
                'TAHUN'=>$tahun,
                'KODE_UPT'=>$kode_upt,
                'ID_KONTAK'=>$pic
            );
            $query = $this->db->insert('data_kendaraan', $data); //JANGAN LUPA GANTI NAMA TABEL
        }        
        return $query;
    }

    public function getListDataKendaraan(){
        $query = $this->db->query('SELECT DISTINCT data_kendaraan.BULAN as BULAN, data_kendaraan.TAHUN as TAHUN, kontak.NAMA_INSTANSI as NAMA_INSTANSI, kontak.PIC as PIC FROM `data_kendaraan`,`kontak` 
            WHERE data_kendaraan.ID_KONTAK=kontak.ID_KONTAK');
        return $query->result_array();
    }

}