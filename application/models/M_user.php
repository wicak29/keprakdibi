<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function tambahuser($dataarray)
    {
        for($i=0;$i<count($dataarray);$i++)
        {
            $data = array(
                'nama'=>$dataarray[$i]['nama'],
                'alamat'=>$dataarray[$i]['alamat']
            );
            $this->db->insert('user', $data);
        }
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