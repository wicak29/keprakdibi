<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelabuhan extends CI_Model 
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
}