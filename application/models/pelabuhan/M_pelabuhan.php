<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelabuhan extends CI_Model 
{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function tambahUraian($dataarray){
        for($i=0;$i<count($dataarray);$i++){   
            $data = array(
                
                'JENIS_DATA'=>$dataarray[$i][1],
                'SATUAN'=>$dataarray[$i][2]
            );
            $query = $this->db->insert('jenis_bongkar_muat', $data); //JANGAN LUPA GANTI NAMA TABEL
        }        
        return $query;
        //echo $data['dump'];
    }

    public function getListPelabuhan()
    {
        $query = $this->db->query('SELECT ID_PELABUHAN, PELABUHAN FROM `pelabuhan`');
        return $query->result_array();
    }

    public function getListPICPelabuhan()
    {
        $query = $this->db->query('SELECT kontak.ID_KONTAK as ID_KONTAK, kontak.PIC as PIC, kontak.NAMA_INSTANSI as NAMA_INSTANSI FROM `kontak_indikator`, `kontak`
                    WHERE kontak.ID_KONTAK = kontak_indikator.ID_KONTAK AND kontak_indikator.ID_INDIKATOR=2');
        return $query->result_array();
    }

    public function getPelabuhanDataError($pelabuhan, $tahun, $periode){
        $query = $this->db->query('SELECT NILAI FROM `data_pelabuhan`
                    WHERE ID_PELABUHAN = '.$pelabuhan.' AND BULAN ="'.$periode.'" AND TAHUN ="'.$tahun.'" ');
        return $query->result_array();
    }

    public function tambahDataPelabuhan($dataarray, $periode, $tahun, $pic, $id_jenisdata, $pelabuhan){
        for($i=0;$i<count($dataarray);$i++){   
            $data = array(
                'NILAI'=>$dataarray[$i][3],
                'BULAN'=>$periode,
                'TAHUN'=>$tahun,
                'ID_KONTAK'=>$pic,
                'ID_JENIS_DATA'=>$id_jenisdata,
                'ID_PELABUHAN'=>$pelabuhan
            );
            $query = $this->db->insert('data_pelabuhan', $data); //JANGAN LUPA GANTI NAMA TABEL
        }        
        return $query;
    }

    public function getListDataPelabuhan(){
        $query = $this->db->query('SELECT DISTINCT pelabuhan.PELABUHAN as PELABUHAN, data_pelabuhan.BULAN as PERIODE, data_pelabuhan.TAHUN as TAHUN, 
                                kontak.NAMA_INSTANSI as NAMA_INSTANSI, kontak.PIC as PIC 
                                FROM `data_pelabuhan`, `pelabuhan`, `kontak`
                                WHERE data_pelabuhan.ID_KONTAK = kontak.ID_KONTAK AND data_pelabuhan.ID_PELABUHAN = pelabuhan.ID_PELABUHAN');
        return $query->result_array();
    }

}