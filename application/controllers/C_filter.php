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
  
    public function viewDataProvinsi()
    {
        // $data['list_daerah'] = $this->M_filter->getFilter();
        // $data['list_tahun'] = $this->M_filter->getTahun();
        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDProvinsi');
        $this->load->view('V_footer');
    }
    public function viewDataKab()
    {
        //$data['list_daerah'] = $this->M_filter->getFilter();
        //$data['list_tahun'] = $this->M_filter->getTahun();
        $data['kabkota'] = "nama_daerah";
        $data['data_apbd'] = array();
        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDKab', $data);
        $this->load->view('V_footer_table');
    }

    public function pindahKeFilter()
    {
        
        //$daerah= $this->input->post('daerah');
        //$tahun= $this->input->post('tahun');
        $kategori= $this->input->post('kategori');

        //$result = $this->M_filter->cariFilter($daerah,$tahun);
        if ($kategori== 'Provinsi'){
            redirect('C_filter/lihatFilterProvinsi');
        }
        else{
            redirect('C_filter/viewDataKab');
        }
      
    }

    public function lihatFilterProvinsi()
    {
        
        $bulan= $this->input->post('bulan');        
        $tahun= $this->input->post('tahun');

        if (!$bulan) $bulan = "Bulan";


        $data['uraian'] = $this->M_filter->getDatabyProvTahunPeriode($bulan,$tahun);
        $data['bulan'] = $bulan;
        if(!$data['uraian']) $data['uraian'] = array();
        //var_dump($data['uraian']);

        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDProvinsi', $data);
        $this->load->view('V_footer_table');
            
    }

    public function filterKab()
    {
        //$this->load->model('M_filter');
        $kabkota = $this->input->post('kabkota');
        $data['periode'] = $this->input->post('periode');
        $data['tahun'] = $this->input->post('tahun');
        $data['kabkota'] = $this->M_filter->getDaerah($kabkota);
        
        $data['data_apbd'] = $this->M_filter->getDatabyKabTahunPeriode($kabkota, $data['periode'], $data['tahun']);

        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDKab', $data);
        $this->load->view('V_footer_table');
    }

    public function statistik()
    {
        //$this->load->model('M_filter');
        $kabkota = $this->input->post('kabkota');
        $periode = $this->input->post('periode');
        //data['periode'] = $this->input->post('periode');
        //$data['tahun'] = $this->input->post('tahun');
        $data['kabkota'] = $this->M_filter->getDaerah($kabkota);

        
        //$tahun = substr(implode(', ', $this->input->post('tahun')), 0);
        $tahun = array();
        $tahun = $this->input->post('tahun');
        $tahun = $this->input->post('tahun');
        $tahun = $this->input->post('tahun');
        $tahun = $this->input->post('tahun');
        $tahun = $this->input->post('tahun');
        $ukuran_checkbox = sizeof($tahun);
        //var_dump($tahun);
        //echo $tahun;
        //$tahun = $this->input->post('kabkota');
        $data['compare'] = $this->M_filter->getCompareDaerah($tahun,$kabkota,$periode);
        //print_r($data['compare']);


        //$data['data_apbd'] = $this->M_filter->getDatabyKabTahunPeriode($kabkota, $data['periode'], $data['tahun']);

        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_statistik', $data);
        $this->load->view('V_footer_table');
    }
}
