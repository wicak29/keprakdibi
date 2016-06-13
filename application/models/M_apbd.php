<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_apbd extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getUraian($id)
    {
        // $this->db->select('URAIAN');
        // $result = $this->db->get('apbd')->result_array();   
        // return $result;

        $data = $this->db->query('SELECT URAIAN FROM apbd WHERE ID_APBD ="'.$id.'" LIMIT 1');
        $row = $data->row_array();
        return $row['URAIAN'];
    }

    public function getNilai($tahun, $id)
    {
        $this->db->select('NILAI');
        $result = $this->db->get_where('data_apbd', array('TAHUN'=>$tahun, 'ID_APBD'=>$id))->result_array();
        // $listNilai = array();
        // foreach ($result as $listApbd) 
        // {
        //     # code...
        //     array_push($listNilai, $listApbd);
        // }
        // print_r($result);
        // return;
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

    public function tambahKontak($nama_instansi,$no_telp,$email,$alamat,$pic,$prefer)
    {
        
        $data = array(

                //'dump'=>$dataarray[$i][5],
                
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
        $data = $this->db->query('SELECT ID_APBD FROM apbd WHERE URAIAN ="'.$namaAPBD.'" LIMIT 1');
        // $data = $this->db->query('SELECT URAIAN FROM apbd WHERE ID_APBD ="'.$namaAPBD.'"');
        // foreach ($data->result() as $row)
        // {
        //     $row->ID_APBD;
        // }

        $row = $data->row_array();
        //echo $row['ID_APBD'];
        return $row['ID_APBD'];

        // //echo 'Total Results: ' . $data->num_rows();
        // echo $row->ID_APBD;
        // //$this->db->insert('data_apbd', $data);
        // return $row->ID_APBD;
        //$query = $this->db->get('apbd');
        //$limit = 10;
        //$offset = 0;
        //$tanda = 'Pendapatan'
        //$query = $this->db->get_where('apbd', array('URAIAN' => $namaAPBD), $limit, $offset);
        //echo $query;
        //var_dump($query);
        // foreach ($query->result() as $row)
        // {
        //     echo $row->ID_APBD;
        // }
        // $query = $this->db->query('SELECT ID_APBD FROM apbd WHERE URAIAN ="Pendapatan"');

        // foreach ($query->result_array() as $row)
        // {
        //    echo $row['ID_APBD'];
        //    $this->db->insert('data_apbd', $data);
        // }
    }

    public function tambahNilaiProvinsi($dataarray, $tahun, $periode, $dataAPBD, $pic)
    {
        for($i=0;$i<count($dataarray);$i++)
        {   
            $data = array(
                //'dump'=>$dataarray[$i][5],
                'ID_APBD'=>$dataAPBD,
                'ID_DAERAH'=>1,
                'ID_KONTAK'=>$pic,
                'NILAI'=>$dataarray[$i][1],
                'TAHUN'=>$tahun,
                'PERIODE'=>$periode
            );
            $query = $this->db->insert('data_apbd', $data);
        }        
        return $query;
        //echo $data['dump'];
    }
    public function tambahNilaiKabKota($dataarray,$tahun,$triwulan,$dataAPBD, $pic)
    {
        $periode = $triwulan;
        for($i=0;$i<count($dataarray);$i++)
        {   
            for($j=1;$j<=9;$j++)
            {
                echo $dataAPBD;
                //echo $tahun;
                $data = array(
                    //'dump'=>$dataarray[$i][5],
                    'ID_APBD'=>$dataAPBD,
                    'ID_DAERAH'=>$j+1,
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