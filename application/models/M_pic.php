<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pic extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function addPic($data)
    {
        $query = $this->db->insert('kontak', $data);
        return $query;
    }

}