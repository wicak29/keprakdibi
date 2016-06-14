<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_apbd extends CI_Model 
{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function getUraian($id){
        $data = $this->db->query('SELECT URAIAN FROM apbd WHERE ID_URAIAN ="'.$id.'" LIMIT 1');
        $row = $data->row_array();
        return $row['URAIAN'];
    }

    public function getNilai($tahun, $id)
    {
        $this->db->select('NILAI');
        $result = $this->db->get_where('data_apbd', array('TAHUN'=>$tahun, 'ID_URAIAN'=>$id))->result_array();

        return $result;
    }

    public function tambahUraian($dataarray)
    {
        for($i=0;$i<count($dataarray);$i++)
        {
            $data = array(
                'uraian'=>$dataarray[$i][0]
            );
            $this->db->insert('apbd', $data);
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
        $row = $data->row_array();
        //echo $row['ID_APBD'];
        return $row['ID_URAIAN'];

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

    public function tambahNilaiDaerah($dataarray, $tahun, $periode, $dataAPBD, $pic)
    {

        $data['list_apbdp']

        for($i=0;$i<count($dataarray);$i++)
        {   
            // if($dataarray[$i][2]==NULL){
            //     $data_persen = ($dataarray[$i][3]/$dataarray[$i][1])*100;
            // }
            // else{
            //     $data_persen = ($dataarray[$i][3]/$dataarray[$i][2])*100;
            // }

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
                $this->db->insert('data_apbd', $data);
            }
        }        
        //echo $data['dump'];
    }
}