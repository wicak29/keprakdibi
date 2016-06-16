<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pic extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getPic()
    {
        $result = $this->db->get('kontak');
        return $result;
    }

    public function addKontak($nama_instansi,$no_telp,$email,$alamat,$pic,$prefer)
    {
        $data = array(
            //'dump'=>$dataarray[$i][5],
            'NAMA_INSTANSI'=>$nama_instansi,
            'NO_TELEPON'=>$no_telp,
            'EMAIL'=>$email,
            'ALAMAT'=>$alamat,
            'PIC'=>$pic,
            'PREFERRED_CONTACT'=>$prefer,
        );
        $query = $this->db->insert('kontak', $data);
        return $query;
    }
}