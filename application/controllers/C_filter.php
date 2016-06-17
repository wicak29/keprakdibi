<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_filter extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_filter');
        $this->load->model('M_apbd');
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
        $data['periode'] = array();
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

    public function viewEditData()
    {
        $data['list_uraian'] = $this->M_apbd->getAllUraian();

        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_editData', $data);
        $this->load->view('V_footer');
    }

    public function lihatFilterProvinsi()
    {
        
        $bulan= $this->input->post('bulan');        
        $tahun= $this->input->post('tahun');

        if (!$bulan) $bulan = "Bulan";

        $data['uraian'] = $this->M_filter->getDatabyProvTahunPeriode($bulan,$tahun);
        $data['bulan'] = $bulan;
        if(!$data['uraian']) $data['uraian'] = array();
        
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
        //$data['periode'] = $this->input->post('periode');
        $data['tahun'] = $this->input->post('tahun');
        $data['kabkota'] = $this->M_filter->getDaerah($kabkota);

        $data['periode'] = $this->M_filter->getAllPeriode($kabkota, $data['tahun']);
        //print_r( $data['periode']);
        //print_r( sizeof($data['periode']));
        $data['data_apbd'] = $this->M_filter->getDatabyKabTahunPeriode($kabkota, $data['tahun']);
        //print_r(sizeof($data['data_apbd']));

        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDKab', $data);
        $this->load->view('V_footer_table');
    }

    public function viewLihatStatistik()
    {
        //$this->load->model('M_filter');
        $kabkota = $this->input->post('kabkota');
        $periode = $this->input->post('periode');
        $data['uraian'] = $this->input->post('uraian');
        $data['tahun'] = $this->input->post('tahun');
        
        $data['kabkota'] = $this->M_filter->getDaerah($kabkota);
        $data['jumlah_uraian'] = sizeof($data['uraian']);
        $data['jumlah_tahun'] = sizeof($data['tahun']);

        // print_r($data['kabkota']['NAMA_DAERAH']);

        if (!$data['tahun']) $data['tahun'] = array();
        if (!$data['uraian']) $data['uraian'] = array();

        
        $data['finalResult'] = array();
        foreach ($data['uraian'] as $i) 
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            $nama_uraian = $this->M_filter->getUraian($i);
            // $uraian = $this->M_filter->getNilaiByUraian($key, $data['tahun']);
            // print_r($uraian);
            array_push($data['listUraian'], $nama_uraian);

            $pos = 0;
            foreach ($data['tahun'] as $t) 
            {
                $nilai = $this->M_filter->getNilaiByUraian($i, $t, $periode, $kabkota);
                if ($pos != $data['jumlah_tahun']-1)
                    $data['list_nilai'] .= $nilai.",";
                else
                    $data['list_nilai'] .= $nilai."";
                $pos++;
            }
            array_push($data['listUraian'], $data['list_nilai']);
            array_push($data['finalResult'], $data['listUraian']);
        }        
        // print_r($data['finalResult']);

        $data['compare'] = $this->M_filter->getCompareDaerah($data['tahun'],$kabkota,$periode);

        if (!$data['uraian']) $data['uraian'] = array();        

        $this->load->view('V_headChart');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_statistik', $data);
        $this->load->view('V_footerChart');
    }

    public function viewLihatStatistikProv()
    {
        $periode = $this->input->post('bulan');
        $data['uraian'] = $this->input->post('uraian');
        $data['tahun'] = $this->input->post('tahun');
                
        $data['jumlah_uraian'] = sizeof($data['uraian']);
        $data['jumlah_tahun'] = sizeof($data['tahun']);

        if (!$data['tahun']) $data['tahun'] = array();
        if (!$data['uraian']) $data['uraian'] = array();
        
        $data['finalResult'] = array();
        foreach ($data['uraian'] as $i) 
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            $nama_uraian = $this->M_filter->getUraian($i);
            array_push($data['listUraian'], $nama_uraian);

            $pos = 0;
            foreach ($data['tahun'] as $t) 
            {
                $nilai = $this->M_filter->getNilaiByUraian($i, $t, $periode, 1);
                if ($pos != $data['jumlah_tahun']-1)
                    $data['list_nilai'] .= $nilai.",";
                else
                    $data['list_nilai'] .= $nilai."";
                $pos++;
            }
            array_push($data['listUraian'], $data['list_nilai']);
            array_push($data['finalResult'], $data['listUraian']);
        }        
        // print_r($data['finalResult']);

        $data['compare'] = $this->M_filter->getCompareDaerah($data['tahun'],1,$periode);

        if (!$data['uraian']) $data['uraian'] = array();        

        $this->load->view('V_headChart');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_statistikProv', $data);
        $this->load->view('V_footerChart');
    }
}
