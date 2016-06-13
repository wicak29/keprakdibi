<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_filter extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_filter');
    }

    public function viewTambahFilter($daerah="", $tahun="")
    {  
        $data['list_daerah'] = $this->M_filter->getFilter();
        $data['list_tahun'] = $this->M_filter->getTahun();

    	$this->load->view('V_head');
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('filter/V_filter', $data);
        $this->load->view('V_footer');
    }

    public function uploadFilter()
    {
        
        $daerah= $this->input->post('daerah');
        $tahun= $this->input->post('tahun');


        $result = $this->M_filter->cariFilter($daerah,$tahun);

        redirect('C_filter/viewTambahFilter');
    }
}
