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


    public function getListPIC()
    {
        $query = $this->db->query('SELECT kontak.ID_KONTAK as ID_KONTAK, kontak.PIC as PIC, kontak.NAMA_INSTANSI as NAMA_INSTANSI FROM `kontak_indikator`, `kontak`
                    WHERE kontak.ID_KONTAK = kontak_indikator.ID_KONTAK AND kontak_indikator.ID_INDIKATOR=3');
        return $query->result_array();
    }

    public function getKelistrikanDataError($tahun, $periode)
    {
        $query = $this->db->query('SELECT NILAI FROM `data_kelistrikan`
                    WHERE BULAN ="'.$periode.'" AND TAHUN ="'.$tahun.'" ');
        return $query->result_array();
    }

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

    public function getNilaiPerBulan($kategori, $tahun, $bulan, $aspek)
    {
        $this->db->select('NILAI');
        $result = $this->db->get_where('data_kelistrikan', array('ID_KATEGORI'=>$kategori, 'ID_ASPEK'=>$aspek, 'TAHUN'=>$tahun, 'BULAN'=>$bulan));
        return $result->result_array();
    }

    public function getDetailKontak()
    {
        $result = $this->db->query('SELECT * FROM `kontak`, indikator, kontak_indikator WHERE indikator.ID_INDIKATOR = 3 AND kontak_indikator.ID_INDIKATOR = indikator.ID_INDIKATOR AND kontak_indikator.ID_KONTAK = kontak.ID_KONTAK');
        return $result->result_array();
    }

    public function getKontakNotKelistrikan()
    {
        $result = $this->db->query('SELECT * FROM kontak WHERE kontak.ID_KONTAK NOT IN (SELECT kontak_indikator.ID_KONTAK FROM kontak, indikator, kontak_indikator WHERE indikator.ID_INDIKATOR =3 AND indikator.ID_INDIKATOR = kontak_indikator.ID_INDIKATOR AND kontak_indikator.ID_KONTAK = kontak_indikator.ID_KONTAK)');
        return $result->result_array();
    }

    public function deleteKontak($id)
    {
        $this->db->where('ID_KONTAK', $id);
        $this->db->where('ID_INDIKATOR', 3);
        $this->db->delete('kontak_indikator'); 
    }

    public function updateDataKontak($id_kontak)
    {
        $query = $this->db->query('UPDATE data_kelistrikan SET id_kontak=1 WHERE id_kontak="'.$id_kontak.'"');
        return $query;
    }

    public function addKontak($id)
    {
        $data = array(
                'ID_KONTAK'=>$id,
                'ID_INDIKATOR'=>3
            );
        $query = $this->db->insert('kontak_indikator', $data);
        return $query;
    }

}