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
                    WHERE kontak.ID_KONTAK = kontak_indikator.ID_KONTAK AND kontak_indikator.ID_INDIKATOR=5');
        return $query->result_array();
    }

    public function getKendaraanDataError($tahun, $periode)
    {
        $query = $this->db->query('SELECT NILAI FROM `data_kendaraan`
                    WHERE BULAN ="'.$periode.'" AND TAHUN ="'.$tahun.'" ');
        return $query->result_array();
    }
    public function getPenerbanganDataError($tahun, $periode)
    {
        $query = $this->db->query('SELECT NILAI FROM `data_penerbangan`
                    WHERE BULAN ="'.$periode.'" AND TAHUN ="'.$tahun.'" ');
        return $query->result_array();
    }

    public function getDataUPT(){
        $query = $this->db->query('SELECT KODE_UPT FROM `upt`');
        return $query->result_array();
    }
    public function getIdEntitas()
    {
        $query = $this->db->query('SELECT ID_ENTITAS FROM `entitas`');
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

    public function tambahDataPenerbangan($dataarray, $bulan, $tahun, $pic)
    {
        $entitas=array(1, 2, 3, 1, 2, 3, 4, 5, 6, 4, 5, 6, 7, 8, 9, 7, 8, 9, 10, 11, 12, 10, 11, 12, 13, 14, 15, 13, 14, 15);
        $rute=array(1, 1, 1, 2, 2, 2, 1, 1, 1, 2, 2, 2, 1, 1, 1, 2, 2, 2, 1, 1, 1, 2, 2, 2, 1, 1, 1, 2, 2, 2);
        for($i=0;$i<count($dataarray);$i++){

            for ($j=1; $j <=30 ; $j++) {
                $ruteawal = $rute[$j-1];
                if($ruteawal==1){
                    $rutedipakai = "Domestik";
                }
                elseif ($ruteawal==2) {
                     $rutedipakai = "Internasional";
                 } 
                
                $data = array(

                    'NILAI'=>$dataarray[$i][2+$j],
                    'RUTE'=>$rutedipakai,
                    'BULAN'=>$bulan,
                    'TAHUN'=>$tahun,
                    'ID_ENTITAS'=>$entitas[$j-1],
                    'ID_KONTAK'=>$pic
                );
            $query = $this->db->insert('data_penerbangan', $data); //JANGAN LUPA GANTI NAMA TABEL
                //print_r($data);
            }
        }        
        return $query;
    }

    public function getListDataKendaraan(){
        $query = $this->db->query('SELECT DISTINCT data_kendaraan.BULAN as BULAN, data_kendaraan.TAHUN as TAHUN, kontak.NAMA_INSTANSI as NAMA_INSTANSI, kontak.PIC as PIC FROM `data_kendaraan`,`kontak` 
            WHERE data_kendaraan.ID_KONTAK=kontak.ID_KONTAK');
        return $query->result_array();
    }
    public function getListDataPenerbangan(){
        $query = $this->db->query('SELECT DISTINCT data_penerbangan.BULAN as BULAN, data_penerbangan.TAHUN as TAHUN, kontak.NAMA_INSTANSI as NAMA_INSTANSI, kontak.PIC as PIC FROM `data_penerbangan`,`kontak` 
            WHERE data_penerbangan.ID_KONTAK=kontak.ID_KONTAK');
        return $query->result_array();
    }

    public function getDetailKontak()
    {
        $result = $this->db->query('SELECT * FROM `kontak`, indikator, kontak_indikator WHERE indikator.ID_INDIKATOR = 5 AND kontak_indikator.ID_INDIKATOR = indikator.ID_INDIKATOR AND kontak_indikator.ID_KONTAK = kontak.ID_KONTAK');
        return $result->result_array();
    }

    public function getKontakNotPenerbangan()
    {
        $result = $this->db->query('SELECT * FROM kontak WHERE kontak.ID_KONTAK NOT IN (SELECT kontak_indikator.ID_KONTAK FROM kontak, indikator, kontak_indikator WHERE indikator.ID_INDIKATOR =5 AND indikator.ID_INDIKATOR = kontak_indikator.ID_INDIKATOR AND kontak_indikator.ID_KONTAK = kontak_indikator.ID_KONTAK)');
        return $result->result_array();
    }

    public function deleteKontak($id)
    {
        $this->db->where('ID_KONTAK', $id);
        $this->db->where('ID_INDIKATOR', 5);
        $this->db->delete('kontak_indikator'); 
    }

    public function updateDataKontak($id_kontak)
    {
        $query = $this->db->query('UPDATE data_penerbangan SET id_kontak=1 WHERE id_kontak="'.$id_kontak.'"');
        return $query;
    }

    public function addKontak($id)
    {
        $data = array(
                'ID_KONTAK'=>$id,
                'ID_INDIKATOR'=>5
            );
        $query = $this->db->insert('kontak_indikator', $data);
        return $query;
    }


}