<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_pic extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        // $this->load->model('M_pic');
    }

    public function viewTambahPic()
    {
    	$this->load->view('V_head');
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('pic/V_tambahPic');
        $this->load->view('V_footer');
    }
}
