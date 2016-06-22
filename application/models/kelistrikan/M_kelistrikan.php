<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelistrikan extends CI_Model 
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

    // public function getNamaPelabuhanById($id)
    // {
    //     $this->db->select('PELABUHAN');
    //     $result = $this->db->get_where('pelabuhan',array('ID_PELABUHAN'=>$id))->row_array();
    //     return $result;
    // }

    // public function getListPelabuhan()
    // {
    //     $query = $this->db->query('SELECT ID_PELABUHAN, PELABUHAN FROM `pelabuhan`');
    //     return $query->result_array();
    // }

    public function getListPIC()
    {
        $query = $this->db->query('SELECT kontak.ID_KONTAK as ID_KONTAK, kontak.PIC as PIC, kontak.NAMA_INSTANSI as NAMA_INSTANSI FROM `kontak_indikator`, `kontak`
                    WHERE kontak.ID_KONTAK = kontak_indikator.ID_KONTAK AND kontak_indikator.ID_INDIKATOR=3');
        return $query->result_array();
    }

    // public function getPelabuhanDataError($pelabuhan, $tahun, $periode){
    //     $query = $this->db->query('SELECT NILAI FROM `data_pelabuhan`
    //                 WHERE ID_PELABUHAN = '.$pelabuhan.' AND BULAN ="'.$periode.'" AND TAHUN ="'.$tahun.'" ');
    //     return $query->result_array();
    // }

    public function tambahDataKelistrikan($dataarray, $periode, $tahun, $pic, $id_kategori){
        for($i=0;$i<count($dataarray);$i++){
            for($j=1;$j<=3;$j++){
                $data = array(
                    'ID_ASPEK'=>$j,
                    'ID_KATEGORI'=>$id_kategori,
                    'NILAI'=>$dataarray[$i][$j+1],
                    'BULAN'=>$periode,
                    'TAHUN'=>$tahun,
                    'ID_KONTAK'=>$pic
                );
            $query = $this->db->insert('data_kelistrikan', $data); //JANGAN LUPA GANTI NAMA TABEL
            }   
            
        }        
        return $query;
    }

    public function getListDataKelistrikan(){
        $query = $this->db->query('SELECT DISTINCT data_kelistrikan.BULAN as BULAN, data_kelistrikan.TAHUN as TAHUN, kontak.NAMA_INSTANSI as NAMA_INSTANSI, kontak.PIC as PIC FROM `data_kelistrikan`,`kontak` 
            WHERE data_kelistrikan.ID_KONTAK=kontak.ID_KONTAK');
        return $query->result_array();
    }

}