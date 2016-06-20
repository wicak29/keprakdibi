<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function login($username,$password)
	{
		$query = $this->db->get_where('user',array('username'=>$username,'password'=>sha1($password)));	
		return $query->result_array();
	}

}