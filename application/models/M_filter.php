<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_filter extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getPic()
    {
        $this->db->select('ID_KONTAK, PIC');
        $result = $this->db->get('kontak');
        return $result;
    }
    public function getFilter()
    {
        $this->db->select('ID_DAERAH, NAMA_DAERAH');
        $result = $this->db->get('daerah');
        return $result->result_array();
    }
    public function getTahun()
    {

        $this->db->select('TAHUN');
        $this->db->distinct();
        $this->db->group_by('TAHUN');
        $result = $this->db->get('data_apbd');
        return $result->result_array();
    }

    public function getAllPeriode($daerah, $tahun){
        $query = $this->db->query('SELECT DISTINCT PERIODE
                                   FROM `data_apbd`
                                    WHERE ID_DAERAH ='.$daerah.' AND TAHUN='.$tahun.'');
        return $query->result_array();

    }

    public function getDataperTriwulan($daerah, $tahun, $periode){
        $query = $this->db->query('SELECT NILAI_REALISASI as NILAI
                                   FROM `data_apbd`
                                    WHERE ID_DAERAH ='.$daerah.' AND TAHUN="'.$tahun.'" AND PERIODE="'.$periode.'"');
        return $query->result_array();
    }
    public function getDataProvinsiNonKumulatif($daerah, $tahun, $periode){
        $query = $this->db->query('SELECT NILAI_REALISASI as NILAI
                                   FROM `data_apbd`
                                    WHERE ID_DAERAH ='.$daerah.' AND TAHUN="'.$tahun.'" AND PERIODE="'.$periode.'"');
        return $query->result_array();
    }

    public function getNilaiByUraian($id, $tahun, $periode, $kabkota)
    {
        $data = $this->db->query('SELECT PERSEN_REALISASI FROM `data_apbd` WHERE ID_URAIAN ="'.$id.'" AND TAHUN ="'.$tahun.'" AND PERIODE="'.$periode.'" AND ID_DAERAH="'.$kabkota.'"');
        return $data->result_array();
    }

    public function getUraian($id)
    {
        $data = $this->db->query('SELECT URAIAN FROM uraian_apbd WHERE ID_URAIAN ="'.$id.'" LIMIT 1');
        $row = $data->row_array();
        return $row['URAIAN'];
    }

    public function getAllUraian()
    {
        $data = $this->db->query('SELECT URAIAN FROM uraian_apbd');
        return $data->result_array();
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

    public function getDatabyProvTahunPeriode($bulan, $tahun)
    {
        $query = $this->db->query('SELECT uraian_apbd.URAIAN as URAIAN, apbd.APBD as APBD, apbd.APBD_P as APBD_P, data_apbd.NILAI_REALISASI as NILAI, data_apbd.PERSEN_REALISASI as PERSENTASE
                                    FROM apbd, data_apbd, uraian_apbd
                                    WHERE apbd.ID_DAERAH = 1 AND apbd.TAHUN = "'.$tahun.'" AND data_apbd.ID_URAIAN = apbd.ID_URAIAN 
                                    AND data_apbd.PERIODE = "'.$bulan.'" AND apbd.TAHUN = data_apbd.TAHUN AND uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN 
                                    AND data_apbd.ID_URAIAN = apbd.ID_URAIAN');

        return $query->result_array();
        
    }
    public function getUraianDatabyProvTahunPeriode($bulan, $tahun)
    {
        $query = $this->db->query('SELECT uraian_apbd.URAIAN as URAIAN, data_apbd.NILAI_REALISASI as NILAI, data_apbd.PERSEN_REALISASI as PERSENTASE
                                    FROM data_apbd, uraian_apbd
                                    WHERE data_apbd.ID_DAERAH = 1 AND data_apbd.TAHUN = "'.$tahun.'" 
                                    AND data_apbd.PERIODE = "'.$bulan.'" AND uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN 
                                    ');

        return $query->result_array();
        
    }
    public function getPlafonDatabyProvTahunPeriode($tahun)
    {
        $query = $this->db->query('SELECT apbd.APBD as APBD, apbd.APBD_P as APBD_P
                                    FROM apbd
                                    WHERE apbd.ID_DAERAH = 1 AND apbd.TAHUN = "'.$tahun.'" ');

        return $query->result_array();
        
    }

    public function getDatabyKabTahunPeriode($daerah, $tahun)
    {

        $query = $this->db->query('SELECT data_apbd.PERIODE as PERIODE, uraian_apbd.URAIAN as URAIAN, apbd.APBD as APBD, apbd.APBD_P as APBD_P, data_apbd.NILAI_REALISASI as NILAI, data_apbd.PERSEN_REALISASI as PERSENTASE
                                    
                                    FROM apbd, data_apbd, uraian_apbd
                                    WHERE data_apbd.ID_DAERAH = '.$daerah.' AND 
                                    data_apbd.ID_DAERAH = apbd.ID_DAERAH AND
                                    apbd.TAHUN = "'.$tahun.'" AND apbd.TAHUN = data_apbd.TAHUN AND

                                    uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN AND
                                    data_apbd.ID_URAIAN = apbd.ID_URAIAN

                                    ');

        return $query->result_array();
    }

    public function getUraianDatabyKabTahunPeriode($daerah, $tahun)
    {

        $query = $this->db->query('SELECT data_apbd.PERIODE as PERIODE, uraian_apbd.URAIAN as URAIAN, data_apbd.NILAI_REALISASI as NILAI, data_apbd.PERSEN_REALISASI as PERSENTASE
                                    
                                    FROM  data_apbd, uraian_apbd
                                    WHERE data_apbd.ID_DAERAH = '.$daerah.' AND
                                    data_apbd.TAHUN = "'.$tahun.'" AND 

                                    uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN 

                                    ');

        return $query->result_array();
    }
    public function getPlafonDatabyKabTahunPeriode($daerah, $tahun)
    {

        $query = $this->db->query('SELECT apbd.APBD as APBD, apbd.APBD_P as APBD_P
                                    
                                    FROM apbd, data_apbd, uraian_apbd
                                    WHERE data_apbd.ID_DAERAH = '.$daerah.' AND 
                                    data_apbd.ID_DAERAH = apbd.ID_DAERAH AND
                                    apbd.TAHUN = "'.$tahun.'" AND apbd.TAHUN = data_apbd.TAHUN AND

                                    uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN AND
                                    data_apbd.ID_URAIAN = apbd.ID_URAIAN

                                    ');

        return $query->result_array();
    }
    public function getCompareDaerah($tahun,$kabkota,$periode)
    {
        $hasil=array();

        for($i=0;$i<sizeof($tahun);$i++)
        {
            $query = $this->db->query('SELECT NILAI_REALISASI FROM `data_apbd` WHERE TAHUN ="'.$tahun[$i].'" AND ID_DAERAH ='.$kabkota.' AND PERIODE="'.$periode.'"
                                 ' );
            array_push($hasil, $query->result_array());
        }
        return $hasil;
    }
    public function getNilaiGrafik($tahun,$daerah,$periode)
    {
        $this->db->select('NILAI_REALISASI, PERSEN_REALISASI');
        $this->db->where('TAHUN', $tahun);
        $this->db->where('ID_DAERAH', $daerah);
        $this->db->where('PERIODE', $periode);
        $result = $this->db->get('data_apbd');
        return $result->result_array();

    }

}
//SELECT * FROM `data_apbd` WHERE TAHUN IN ('2008', '2009')