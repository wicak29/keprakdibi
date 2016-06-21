<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelabuhan extends CI_Model 
{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function getAllUraian()
    {
        $this->db->select('URAIAN');
        $query = $this->db->get('uraian_apbd')->result_array();
        return $query;
    }

    public function getUraian($id)
    {
        $data = $this->db->query('SELECT URAIAN FROM uraian_apbd WHERE ID_URAIAN ="'.$id.'" LIMIT 1');
        $row = $data->row_array();
        return $row['URAIAN'];
    }

    public function getNilaiTotalProv($tahun, $id)
    {
        $this->db->select_sum('NILAI_REALISASI');
        $result = $this->db->get_where('data_apbd', array('TAHUN'=>$tahun, 'ID_URAIAN'=>$id, 'ID_DAERAH'=>"1"))->row_array();
        return $result['NILAI_REALISASI'];   
    }

    public function getNilaiTotalKK($tahun, $id, $daerah)
    {
        $this->db->select_sum('NILAI_REALISASI');
        $result = $this->db->get_where('data_apbd', array('TAHUN'=>$tahun, 'ID_URAIAN'=>$id, 'ID_DAERAH'=>$daerah))->row_array();
        return $result['NILAI_REALISASI'];
    }

    public function getListDataProv()
    {
        $query = $this->db->query('SELECT DISTINCT data_apbd.ID_DAERAH AS ID_DAERAH, data_apbd.TAHUN AS TAHUN, data_apbd.PERIODE AS PERIODE, kontak.NAMA_INSTANSI AS INSTANSI, kontak.PIC AS PIC, data_apbd.ID_KONTAK AS ID_KONTAK 
                                    FROM `data_apbd`, `kontak` 
                                    WHERE ID_DAERAH =1 AND data_apbd.ID_KONTAK=kontak.ID_KONTAK');
        return $query->result_array();
    }

    public function getListDataKab()
    {
        $query = $this->db->query('SELECT DISTINCT data_apbd.ID_DAERAH AS ID_DAERAH, daerah.NAMA_DAERAH AS NAMA_DAERAH, data_apbd.TAHUN AS TAHUN, data_apbd.PERIODE AS PERIODE, kontak.NAMA_INSTANSI AS INSTANSI, kontak.PIC AS PIC, data_apbd.ID_KONTAK AS ID_KONTAK 
            FROM `data_apbd`, `kontak` , `daerah` 
            WHERE data_apbd.ID_KONTAK=kontak.ID_KONTAK AND data_apbd.ID_DAERAH=daerah.ID_DAERAH AND data_apbd.ID_DAERAH!="1"');
        return $query->result_array();
    }

    public function getListDataAPBDP()
    {
        $query = $this->db->query('SELECT DISTINCT apbd.ID_DAERAH AS ID_DAERAH, daerah.NAMA_DAERAH AS DAERAH, apbd.TAHUN AS TAHUN FROM `apbd`, `daerah` WHERE apbd.ID_DAERAH=daerah.ID_DAERAH');
        return $query->result_array();
    }

    public function tambahUraian($dataarray)
    {
        for($i=0;$i<count($dataarray);$i++)
        {
            $data = array(
                'URAIAN'=>$dataarray[$i][0]
            );
            $this->db->insert('uraian_apbd', $data);
        }
    }
    public function tambahDaerah($dataarray)
    {
        //var_dump($dataarray);
        for($i=0;$i<count($dataarray);$i++)
        {
            $data = array(

                //'nama'=>$dataarray[$i]['nama'],
                'NAMA_DAERAH'=>$dataarray[$i][0]
            );
            $this->db->insert('daerah', $data);

        }
    }

    public function tambahKontak($nama_instansi,$no_telp,$email,$alamat,$pic,$prefer){
        $data = array(
                'NAMA_INSTANSI'=>$nama_instansi,
                'NO_TELEPON'=>$no_telp,
                'EMAIL'=>$email,
                'ALAMAT'=>$alamat,
                'PIC'=>$pic,
                'PREFERRED_CONTACT'=>$no_telp,
        );
        $this->db->insert('kontak', $data);
    }

    public function getIDAPBD($namaAPBD){
        $data = $this->db->query('SELECT ID_URAIAN FROM uraian_apbd WHERE URAIAN ="'.$namaAPBD.'" LIMIT 1');
        return $data;

    }

    public function tambahNilaiProvinsi($dataarray, $tahun, $periode, $dataAPBD, $pic)
    {
        for($i=0;$i<count($dataarray);$i++)
        {   
            if($dataarray[$i][2]==NULL){
                $data_persen = ($dataarray[$i][3]/$dataarray[$i][1])*100;
            }
            else{
                $data_persen = ($dataarray[$i][3]/$dataarray[$i][2])*100;
            }

            //$data_persen = $dataarray[$i][]
            $data = array(
                //'dump'=>$dataarray[$i][5],
                'ID_URAIAN'=>$dataAPBD,
                'ID_DAERAH'=>1,
                'ID_KONTAK'=>$pic,
                'PLAFON_ANGGARAN'=>$dataarray[$i][1],
                'PLAFON_ANGGARAN_P'=>$dataarray[$i][2],
                'NILAI_REALISASI'=>$dataarray[$i][3],
                'PERSEN_REALISASI'=>$data_persen,
                'TAHUN'=>$tahun,
                'PERIODE'=>$periode
            );
            $query = $this->db->insert('data_apbd', $data);
        }        
        return $query;
        //echo $data['dump'];
    }
    public function getAPBDP($tahun,$daerah)
    {
        $this->db->select('APBD, APBD_P');
        $this->db->where('TAHUN', $tahun);
        $this->db->where('ID_DAERAH', $daerah);
        $result = $this->db->get('apbd');
        return $result->result_array();

    }
    public function getAPBDPError($daerah, $tahun)
    {

        $this->db->select('ID_DAERAH, TAHUN');
        $this->db->where('TAHUN', $tahun);
        $this->db->where('ID_DAERAH', $daerah);
        $result = $this->db->get('apbd');
        return $result->result_array();
        //echo $data['dump'];
    }

    public function getAPBDDataError($daerah, $tahun, $periode)
    {

        $this->db->select('ID_DAERAH, TAHUN');
        $this->db->where('TAHUN', $tahun);
        $this->db->where('ID_DAERAH', $daerah);
        $this->db->where('PERIODE', $periode);
        $result = $this->db->get('data_apbd');
        return $result->result_array();
        //echo $data['dump'];
    }

    public function tambahNilaiDaerah($dataarray, $tahun, $daerah, $periode, $dataAPBD, $pic, $dataPlafon){
        //echo $daerah;
        //echo $dataPlafon[$dataAPBD]['APBD'];

        for($i=0;$i<count($dataarray);$i++)
        {   
            //echo $dataPlafon[$dataAPBD]['APBD_P'];
            //echo $dataPlafon[$dataAPBD]['APBD'];
            //print_r($dataarray[$i][1]);
            if($dataPlafon[$i]['APBD_P']==NULL){
                $data_persen = ($dataarray[$i][1]/$dataPlafon[$dataAPBD-1]['APBD'])*100;
            }
            else{
                $data_persen = ($dataarray[$i][1]/$dataPlafon[$dataAPBD-1]['APBD_P'])*100;
            }

            $data = array(
                //'dump'=>$dataarray[$i][5],
                'ID_URAIAN'=>$dataAPBD,
                'ID_DAERAH'=>$daerah,
                'ID_KONTAK'=>$pic,
                'NILAI_REALISASI'=>$dataarray[$i][1],
                'PERSEN_REALISASI'=>$data_persen,
                'TAHUN'=>$tahun,
                'PERIODE'=>$periode
            );
            $query = $this->db->insert('data_apbd', $data);
        }        
        return $query;
        //echo $data['dump'];
    }


    public function tambahNilaiAPBDPbyTahun($dataarray, $tahun, $dataAPBD, $daerah){
        for($i=0;$i<count($dataarray);$i++){   
            $data = array(
                //'dump'=>$dataarray[$i][5],
                'ID_DAERAH'=>$daerah,
                'ID_URAIAN'=>$dataAPBD,
                'APBD'=>$dataarray[$i][1],
                'APBD_P'=>$dataarray[$i][2],
                'TAHUN'=>$tahun
            );
            $query = $this->db->insert('apbd', $data); //JANGAN LUPA GANTI NAMA TABEL
        }        
        return $query;
        //echo $data['dump'];
    }

    public function tambahNilaiKabKota($dataarray,$tahun,$triwulan,$dataAPBD, $pic)
    {
        $periode = $triwulan;
        for($i=0;$i<count($dataarray);$i++){   
            for($j=2;$j<=10;$j++){
                $data = array(
                    //'dump'=>$dataarray[$i][5],
                    'ID_URAIAN'=>$dataAPBD,
                    'ID_DAERAH'=>$j,
                    'ID_KONTAK'=>$pic,
                    'NILAI'=>$dataarray[$i][$j],
                    'TAHUN'=>$tahun,
                    'PERIODE'=>$periode
                );
                $query = $this->db->insert('data_apbd', $data);
            }
        }      
        return $query;  
        //echo $data['dump'];
    }
}