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
        $query = $this->db->query('SELECT apbd.APBD as APBD, apbd.APBD_P as APBD_P, uraian_apbd.URAIAN as URAIAN, data_apbd.NILAI_REALISASI as NILAI, data_apbd.PERSEN_REALISASI as PERSENTASE 
                                     FROM uraian_apbd, data_apbd, apbd
                                     WHERE data_apbd.ID_DAERAH = '.$daerah.' AND data_apbd.TAHUN ="'.$tahun.'" AND data_apbd.PERIODE ="'.$bulan.'" AND uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN AND apbd.ID_URAIAN = apbd.ID_URAIAN
                                     GROUP BY data_apbd.ID_URAIAN');

        return $query->result_array();
        
    }

    public function getDatabyKabTahunPeriode($periode, $tahun, $daerah)
    {

        $query = $this->db->query('SELECT apbd.APBD as APBD, apbd.APBD_P as APBD_P, uraian_apbd.URAIAN as URAIAN, data_apbd.NILAI_REALISASI as NILAI, data_apbd.PERSEN_REALISASI as PERSENTASE 
                                     FROM uraian_apbd, data_apbd, apbd
                                     WHERE data_apbd.ID_DAERAH = '.$daerah.' AND data_apbd.TAHUN ="'.$tahun.'" AND data_apbd.PERIODE ="'.$bulan.'" AND uraian_apbd.ID_URAIAN = data_apbd.ID_URAIAN AND apbd.ID_URAIAN = apbd.ID_URAIAN
                                     GROUP BY data_apbd.ID_URAIAN');

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
        $query = $this->db->query('SELECT APBD, APBD_P FROM `apbd` WHERE TAHUN ="'.$tahun.'" AND ID_DAERAH ='.$daerah.'');
        return $query->result_array();
    }

    public function updateNilai($uraian, $data, $tahun, $bulan, $daerah)
    {
        $hasil=array();

        // $data = $this->db->query('SELECT URAIAN FROM uraian_apbd WHERE ID_URAIAN ="'.$id.'" LIMIT 1');
        // $row = $data->row_array();
        // function update_student_id1($id,$data){
        // $this->db->where('student_id', $id);
        // $this->db->update('students', $data);
        // }


                     
            $this->db->where('ID_URAIAN', $uraian);
            $this->db->where('ID_DAERAH', $daerah);
            $this->db->where('TAHUN', $tahun);
            $this->db->where('PERIODE', $bulan);
            $this->db->update('data_apbd', $data);
            //array_push($hasil, $query->result_array());
        
        //return $hasil;
    }

}
//SELECT * FROM `data_apbd` WHERE TAHUN IN ('2008', '2009')