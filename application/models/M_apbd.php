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
    public function tambahNilai($dataarray)
    {
        //var_dump($dataarray);
        for($i=0;$i<count($dataarray);$i++)
        {
            $data = array(

                //'dump'=>$dataarray[$i][5],
                'uraian'=>$dataarray[$i][0],
                'bali'=>$dataarray[$i][1],
                'badung'=>$dataarray[$i][2],
                'bangli'=>$dataarray[$i][3],
                'buleleng'=>$dataarray[$i][4],
                'jembrana'=>$dataarray[$i][5],
                'karangasem'=>$dataarray[$i][6],
                'klungkung'=>$dataarray[$i][7],
                'tabanan'=>$dataarray[$i][8],
                'denpasar'=>$dataarray[$i][9]

            );

            $this->db->insert('melody', $data);

        }
        //echo $data['dump'];
    }

    public function getuser()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function add($data)
    {
        $query = $this->db->insert('eimport', $data);
    }

}