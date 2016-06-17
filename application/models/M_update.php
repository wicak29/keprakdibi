<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_update extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getNilaiByUraian($id, $tahun)
    {
        $data = $this->db->query('SELECT NILAI_REALISASI FROM `data_apbd` WHERE ID_URAIAN ="'.$id.'"');
        $row = $data->row_array();
        return $row['NILAI_REALISASI'];
    }

    public function getUraian($id)
    {
        $data = $this->db->query('SELECT URAIAN FROM uraian_apbd WHERE ID_URAIAN ="'.$id.'" LIMIT 1');
        $row = $data->row_array();
        return $row['URAIAN'];
    }

    public function cariFilter($daerah,$tahun)
    {
        $query = $this->db->query('SELECT NILAI FROM my_table WHERE ID_DAERAH =.$daerah. AND TAHUN ="'.$tahun.'"' );

        foreach ($query->result() as $row)
        {
            echo $row->NILAI;
        }

        return $query;
    }

    public function getDaerah($id)
    {
        $data = $this->db->query('SELECT NAMA_DAERAH FROM daerah WHERE ID_DAERAH ="'.$id.'" LIMIT 1')->row_array();
        return $data;        
    }

    public function getDatabyProvTahunPeriode($bulan, $tahun, $daerah)
    {
        $query = $this->db->query('SELECT uraian_apbd.URAIAN as URAIAN, apbd.APBD as APBD, apbd.APBD_P as APBD_P, data_apbd.NILAI_REALISASI as NILAI, data_apbd.PERSEN_REALISASI as PERSENTASE
                                    FROM apbd, data_apbd, uraian_apbd
                                    WHERE apbd.ID_DAERAH = '.$daerah.' AND apbd.TAHUN = "'.$tahun.'" AND data_apbd.ID_URAIAN = apbd.ID_URAIAN 
                                    AND data_apbd.PERIODE = "'.$bulan.'" AND apbd.TAHUN = data_apbd.TAHUN AND uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN 
                                    AND data_apbd.ID_URAIAN = apbd.ID_URAIAN');

        return $query->result_array();
        
    }

    public function getDatabyKabTahunPeriode($daerah, $tahun, $periode)
    {

        $query = $this->db->query('SELECT uraian_apbd.URAIAN as URAIAN, apbd.APBD as APBD, apbd.APBD_P as APBD_P, data_apbd.NILAI_REALISASI as NILAI, data_apbd.PERSEN_REALISASI as PERSENTASE
                                    FROM apbd, data_apbd, uraian_apbd
                                    WHERE apbd.ID_DAERAH = '.$daerah.' AND apbd.TAHUN = "'.$tahun.'" AND data_apbd.ID_URAIAN = apbd.ID_URAIAN 
                                    AND data_apbd.PERIODE = "'.$periode.'" AND apbd.TAHUN = data_apbd.TAHUN AND uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN 
                                    AND data_apbd.ID_URAIAN = apbd.ID_URAIAN');

        return $query->result_array();
    }
    public function getCompareDaerah($tahun,$kabkota,$periode)
    {
        $hasil=array();

        // $data = $this->db->query('SELECT URAIAN FROM uraian_apbd WHERE ID_URAIAN ="'.$id.'" LIMIT 1');
        // $row = $data->row_array();

        for($i=0;$i<sizeof($tahun);$i++)
        {
            $query = $this->db->query('SELECT NILAI_REALISASI FROM `data_apbd` WHERE TAHUN ="'.$tahun[$i].'" AND ID_DAERAH ='.$kabkota.' AND PERIODE="'.$periode.'"
                                 ' );
            array_push($hasil, $query->result_array());
        }
        return $hasil;
    }

    public function getNilaiAPBDP($daerah, $tahun){
        $query = $this->db->query('SELECT uraian_apbd.URAIAN as URAIAN, apbd.APBD as APBD, apbd.APBD_P as APBD_P
                                    FROM `apbd`, `uraian_apbd` 
                                    WHERE TAHUN ="'.$tahun.'" AND ID_DAERAH ='.$daerah.' AND apbd.ID_URAIAN = uraian_apbd.ID_URAIAN');
        return $query->result_array();
    }

    public function updateNilai($uraian, $data, $tahun, $bulan, $daerah)
    {
        $hasil=array();

        $this->db->where('ID_URAIAN', $uraian);
        $this->db->where('ID_DAERAH', $daerah);
        $this->db->where('TAHUN', $tahun);
        $this->db->where('PERIODE', $bulan);
        $this->db->update('data_apbd', $data);
            //array_push($hasil, $query->result_array());
        
        //return $hasil;
    }
    public function updateNilaiAPBDP($data, $daerah, $uraian, $tahun){
        $this->db->where('ID_URAIAN', $uraian);
        $this->db->where('ID_DAERAH', $daerah);
        $this->db->where('TAHUN', $tahun);
        $this->db->update('apbd', $data);
    }

    public function getDataUpdateRealisasi($daerah, $tahun){
        $query = $this->db->query('SELECT uraian_apbd.ID_URAIAN as URAIAN, data_apbd.NILAI_REALISASI as NILAI, data_apbd.PERSEN_REALISASI as PERSENTASE, data_apbd.PERIODE as PERIODE 
                                     FROM uraian_apbd, data_apbd
                                     WHERE data_apbd.ID_DAERAH = '.$daerah.' AND data_apbd.TAHUN ="'.$tahun.'" AND uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN');
        return $query->result_array();
    }

}
