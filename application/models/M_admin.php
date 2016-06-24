<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model 
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getUser()
    {
        $result = $this->db->get('user');
        return $result;
    }

    public function getUserByID($id)
    {
        $result = $this->db->get_where('user', array('ID_USER'=>$id));
        return $result->row_array();
    }

    public function addUser($username,$pass,$level)
    {
        $data = array(
            //'dump'=>$dataarray[$i][5],
            'USERNAME'=>$username,
            'PASSWORD'=>sha1($pass),
            'LEVEL'=>$level
        );
        $query = $this->db->insert('user', $data);
        return $query;
    }

    public function updateKontak($id, $data)
    {
        $this->db->where('ID_USER', $id);
        $this->db->update('user', $data);
    }

    public function deleteKontak($id)
    {
        $this->db->where('ID_USER', $id);
        $this->db->delete('user'); 
    }
}