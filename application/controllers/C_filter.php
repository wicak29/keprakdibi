<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_filter extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_filter');
        $this->load->model('M_apbd');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('C_auth');
        }
    }
    public function index()
    {
        $data['title'] = "Cari Data";
        $data['list_daerah'] = $this->M_filter->getFilter();
        $data['list_tahun'] = $this->M_filter->getTahun();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_pilihKategori');
        $this->load->view('V_footer');
    }
  
    public function viewDataProvinsi()
    {

        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDProvinsi');
        $this->load->view('V_footer');
    }
    public function viewDataKab()
    {
        $data['title'] = "Cari Data Kabupaten/Kota";
        $data['kabkota'] = "nama_daerah";
        $data['tahun'] = "Tahun";
        $data['periode'] = array();
        $data['data_apbd'] = array();
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDKab');
        $this->load->view('V_footer_table');
    }

    public function pindahKeFilter()
    {
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
        $data['title'] = "Cari Data Provinsi";
        $bulan= $this->input->post('bulan');        
        $tahun= $this->input->post('tahun');

        if (!$bulan) $bulan = "Bulan";
        if (!$tahun) $tahun = "Tahun";

        $data['uraian'] = $this->M_filter->getDatabyProvTahunPeriode($bulan,$tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        if(!$data['uraian']) $data['uraian'] = array();
        
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDProvinsi');
        $this->load->view('V_footer_table');
            
    }

    public function filterKab()
    {
        $data['title'] = "Cari Data Kabupaten/Kota";
        $kabkota = $this->input->post('kabkota');
        $data['tahun'] = $this->input->post('tahun');
        $data['kabkota'] = $this->M_filter->getDaerah($kabkota);

        $data['periode'] = $this->M_filter->getAllPeriode($kabkota, $data['tahun']);

        $data['data_apbd'] = $this->M_filter->getDatabyKabTahunPeriode($kabkota, $data['tahun']);

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBDKab');
        $this->load->view('V_footer_table');
    }

    public function viewLihatStatistik()
    {
        $data['title'] = "Grafik APBD Kab./Kota";
        //$this->load->model('M_filter');
        $kabkota = $this->input->post('kabkota');
        $periode = $this->input->post('periode');
        $data['uraian'] = $this->input->post('uraian');
        $data['tahun'] = $this->input->post('tahun');
        
        $data['kabkota'] = $this->M_filter->getDaerah($kabkota);
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
                $nilai = $this->M_filter->getNilaiByUraian($i, $t, $periode, $kabkota);
                $HandlingTengah = $this->M_filter->getNilaiGrafik($data['tahun'][$pos], $kabkota,$periode);
                if ($nilai && $HandlingTengah){
                    if ($pos != $data['jumlah_tahun']-1)
                        //$data['list_nilai'] .= $nilai[0]['NILAI_REALISASI'].",";
                        $data['list_nilai'] .= $nilai[0]['PERSEN_REALISASI'].",";
                    else
                        //$data['list_nilai'] .= $nilai[0]['NILAI_REALISASI']."";
                        $data['list_nilai'] .= $nilai[0]['PERSEN_REALISASI'].",";
                }
                else{

                    if ($pos != $data['jumlah_tahun']-1)
                        $data['list_nilai'] .= "0,";
                    else
                        $data['list_nilai'] .= "0.";                
                }
            }
            array_push($data['listUraian'], $data['list_nilai']);
            array_push($data['finalResult'], $data['listUraian']);
        }        
        // print_r($data['finalResult']);

        $data['compare'] = $this->M_filter->getCompareDaerah($data['tahun'],$kabkota,$periode);

        if (!$data['uraian']) $data['uraian'] = array();        

        $this->load->view('V_headChart', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_statistik');
        $this->load->view('V_footerChart');
    }

    public function viewLihatStatistikProv()
    {
        $data['title'] = "Grafik APBD Provinsi";
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
                $HandlingTengah = $this->M_filter->getNilaiGrafik($data['tahun'][$pos],1,$periode);
                //print_r($HandlingTengah);
                if ($nilai && $HandlingTengah){
                    if ($pos != $data['jumlah_tahun']-1)
                        //$data['list_nilai'] .= $nilai[0]['NILAI_REALISASI'].",";
                        $data['list_nilai'] .= $nilai[0]['PERSEN_REALISASI'].",";
                    else
                        //$data['list_nilai'] .= $nilai[0]['NILAI_REALISASI']."";
                        $data['list_nilai'] .= $nilai[0]['PERSEN_REALISASI']."";
                }
                else{

                    if ($pos != $data['jumlah_tahun']-1)
                        $data['list_nilai'] .= "0,";
                    else
                        $data['list_nilai'] .= "0.";
                }
                $pos++;
            }
            array_push($data['listUraian'], $data['list_nilai']);
            array_push($data['finalResult'], $data['listUraian']);
        }        
        // print_r($data['finalResult']);

        $data['compare'] = $this->M_filter->getCompareDaerah($data['tahun'],1,$periode);

        if (!$data['uraian']) $data['uraian'] = array();        

        $this->load->view('V_headChart', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_statistikProv');
        $this->load->view('V_footerChart');
    }
}
