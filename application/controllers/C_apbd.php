<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_apbd extends CI_Controller 
{
	public function index()
    {
    	$this->load->view('V_head');
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('apbd/V_index');
        $this->load->view('V_footer');
    }

    public function importExcel()
    {
        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_index');
        $this->load->view('V_footer');
    }

    public function rekapAPBD()
    {
    	$this->load->view('V_head_table');
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBD');
        $this->load->view('V_footer_table');	
    }

    public function cariTable()
    {
    	$this->load->view('V_head');
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('apbd/V_cariTable');
        $this->load->view('V_footer');	
    }

    public function lihatStatistik()
    {
        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_cariTable');
        $this->load->view('V_footer');  
    }
}
