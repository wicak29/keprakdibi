<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_apbd extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
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

    public function tambahNilai($dataarray,$tahun,$dataAPBD)
    {
        //$dataAPBD = getIDAPBD($dataarray[0][0]);
        //var_dump($dataarray);
        //echo $dataAPBD;
        //echo $tahun;
       
        for($i=0;$i<count($dataarray);$i++)
        {
            echo $dataAPBD;
            //echo $tahun;
            $dataBali = array(

                //'dump'=>$dataarray[$i][5],
                'ID_APBD'=>$dataAPBD,
                'ID_DAERAH'=>1,
                'ID_KONTAK'=>1,
                'NILAI'=>$dataarray[$i][1],
                'TAHUN'=>$tahun

            );

            $this->db->insert('data_apbd', $data);
            $data = array(

                //'dump'=>$dataarray[$i][5],
                'ID_APBD'=>$dataAPBD,
                'ID_DAERAH'=>1,
                'ID_KONTAK'=>1,
                'NILAI'=>$dataarray[$i][1],
                'TAHUN'=>$tahun

            );

            $this->db->insert('data_apbd', $data);

        }        

        //echo $data['dump'];
    }

}