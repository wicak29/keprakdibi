<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_filter extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_filter');
    }
    public function index()
    {
        $data['list_daerah'] = $this->M_filter->getFilter();
        $data['list_tahun'] = $this->M_filter->getTahun();
        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_pilihKategori', $data);
        $this->load->view('V_footer');
    }
    public function viewTambahFilter($daerah="", $tahun="")
    {  
        $data['list_daerah'] = $this->M_filter->getFilter();
        $data['list_tahun'] = $this->M_filter->getTahun();

    	$this->load->view('V_head');
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDProvinsi', $data);
        $this->load->view('V_footer');
    }
    public function viewDataProvinsi()
    {
        $data['list_daerah'] = $this->M_filter->getFilter();
        $data['list_tahun'] = $this->M_filter->getTahun();
        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDKab', $data);
        $this->load->view('V_footer');
    }
    public function viewDataKab()
    {
        $data['list_daerah'] = $this->M_filter->getFilter();
        $data['list_tahun'] = $this->M_filter->getTahun();
        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_pilihKategori', $data);
        $this->load->view('V_footer');
    }

    public function pindahKeFilter()
    {
        
        //$daerah= $this->input->post('daerah');
        //$tahun= $this->input->post('tahun');
        $kategori= $this->input->post('kategori');

        //$result = $this->M_filter->cariFilter($daerah,$tahun);
        if ($kategori== 'Provinsi'){
            redirect('C_filter/viewDataProvinsi');
        }
        else{
            redirect('C_filter/viewDataKab');
        }

            
    }
}
