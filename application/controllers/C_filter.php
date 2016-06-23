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
        $data['title'] = "Cari Data Provinsi";
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
        $data['all_uraian'] = array();
        $data['nonkumulatif'] = array();
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
        
        $data['all_uraian'] = $this->M_filter->getAllUraian();


        $januari = array();
        $februari = array();
        $maret = array();
        $april = array();
        $mei = array();
        $juni = array();
        $juli = array();
        $agustus = array();
        $september = array();
        $oktober = array();
        $november = array();
        $desember = array();

        //$nonkumulatif = $this->M_filter->getDataProvinsiNonKumulatif(1, $tahun, $periode);

        // $januari = $this->M_filter->getDataProvinsiNonKumulatif(1, $tahun, "J");
        $bulan_januari= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "Januari");
        //print_r($bulan_januari);
        //IF JANUARI TIDAK ADA
        if(!$bulan_januari){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($bulan_januari, $default);
            }
        }

        $bulan_februari= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "Februari");
       // print_r($bulan_februari);
        //IF FEBRUARI TIDAK ADA
        if(!$bulan_februari){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($februari, $default);
                array_push($bulan_februari, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $februari = $bulan_februari;
            for($i=0; $i<41; $i++){
                $februari[$i]['NILAI'] = $bulan_februari[$i]['NILAI']-$bulan_januari[$i]['NILAI'];
            }
        }

        $bulan_maret= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "Maret");
        //IF MARET TIDAK ADA
        if(!$bulan_maret){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($maret, $default);
                array_push($bulan_maret, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $maret = $bulan_maret;
            for($i=0; $i<41; $i++){
                $maret[$i]['NILAI'] = $bulan_maret[$i]['NILAI']-$bulan_februari[$i]['NILAI'];
            }
        }

        $bulan_april= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "April");
        //IF MARET TIDAK ADA
        if(!$bulan_april){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($april, $default);
                array_push($bulan_april, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $april = $bulan_april;
            for($i=0; $i<41; $i++){
                $april[$i]['NILAI'] = $bulan_april[$i]['NILAI']-$bulan_maret[$i]['NILAI'];
            }
        }
        $bulan_mei= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "Mei");
        //IF MARET TIDAK ADA
        if(!$bulan_mei){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($mei, $default);
                array_push($bulan_mei, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $mei = $bulan_mei;
            for($i=0; $i<41; $i++){
                $mei[$i]['NILAI'] = $bulan_mei[$i]['NILAI']-$bulan_april[$i]['NILAI'];
            }
        }

        $bulan_juni= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "Juni");
        //IF MARET TIDAK ADA
        if(!$bulan_juni){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($juni, $default);
                array_push($bulan_juni, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $juni = $bulan_juni;
            for($i=0; $i<41; $i++){
                $juni[$i]['NILAI'] = $bulan_juni[$i]['NILAI']-$bulan_mei[$i]['NILAI'];
            }
        }


        $bulan_juli= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "Juli");
        //IF MARET TIDAK ADA
        if(!$bulan_juli){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($juli, $default);
                array_push($bulan_juli, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $juli = $bulan_juli;
            for($i=0; $i<41; $i++){
                $juli[$i]['NILAI'] = $bulan_juli[$i]['NILAI']-$bulan_juni[$i]['NILAI'];
            }
        }

        $bulan_agustus= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "Agustus");
        //IF MARET TIDAK ADA
        if(!$bulan_agustus){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($agustus, $default);
                array_push($bulan_agustus, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $agustus = $bulan_agustus;
            for($i=0; $i<41; $i++){
                $agustus[$i]['NILAI'] = $bulan_agustus[$i]['NILAI']-$bulan_juli[$i]['NILAI'];
            }
        }

        $bulan_september= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "September");
        //IF MARET TIDAK ADA
        if(!$bulan_september){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($september, $default);
                array_push($bulan_september, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $september = $bulan_september;
            for($i=0; $i<41; $i++){
                $september[$i]['NILAI'] = $bulan_september[$i]['NILAI']-$bulan_agustus[$i]['NILAI'];
            }
        }

        $bulan_oktober= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "Oktober");
        //IF MARET TIDAK ADA
        if(!$bulan_oktober){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($oktober, $default);
                array_push($bulan_oktober, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $oktober = $bulan_oktober;
            for($i=0; $i<41; $i++){
                $oktober[$i]['NILAI'] = $bulan_oktober[$i]['NILAI']-$bulan_september[$i]['NILAI'];
            }
        }

        $bulan_november= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "November");
        //IF MARET TIDAK ADA
        if(!$bulan_november){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($november, $default);
                array_push($bulan_november, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $november = $bulan_november;
            for($i=0; $i<41; $i++){
                $november[$i]['NILAI'] = $bulan_november[$i]['NILAI']-$bulan_oktober[$i]['NILAI'];
            }
        }

        $bulan_desember= $this->M_filter->getDataProvinsiNonKumulatif(1, $data['tahun'], "Desember");
        //IF MARET TIDAK ADA
        if(!$bulan_desember){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($desember, $default);
                array_push($bulan_desember, $default);
            }
        }
        else{
            // $temp2 = $triwulan2;
            $desember = $bulan_desember;
            for($i=0; $i<41; $i++){
                $desember[$i]['NILAI'] = $bulan_desember[$i]['NILAI']-$bulan_november[$i]['NILAI'];
            }
        }

        $data['nonkumulatif'] = array();

        if($bulan=="Januari"){
            array_push($data['nonkumulatif'], $bulan_januari);
        }
        elseif ($bulan=="Februari") {
            array_push($data['nonkumulatif'], $februari);
        }
        elseif ($bulan=="Maret") {
            array_push($data['nonkumulatif'], $maret);
        }
        elseif ($bulan=="April") {
            array_push($data['nonkumulatif'], $april);
        }
        elseif ($bulan=="Mei") {
            array_push($data['nonkumulatif'], $mei);
        }
        elseif ($bulan=="Juni") {
            array_push($data['nonkumulatif'], $juni);
        }
        elseif ($bulan=="Juli") {
            array_push($data['nonkumulatif'], $juli);
        }
        elseif ($bulan=="Agustus") {
            array_push($data['nonkumulatif'], $agustus);
        }
        elseif ($bulan=="September") {
            array_push($data['nonkumulatif'], $september);
        }
        elseif ($bulan=="Oktober") {
            array_push($data['nonkumulatif'], $oktober);
        }
        elseif ($bulan=="November") {
            array_push($data['nonkumulatif'], $november);
        }
        elseif ($bulan=="Desember") {
            array_push($data['nonkumulatif'], $desember);
        }
        
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
        $data['all_uraian'] = $this->M_filter->getAllUraian();

        $temp2 = array();
        $temp3 = array();
        $temp4 = array();

        $triwulan1 = $this->M_filter->getDataperTriwulan($kabkota, $data['tahun'], "Triwulan_1");
        //IF TRIWULAN I TIDAK ADA
        if(!$triwulan1){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($triwulan1, $default);
            }
        }

        $triwulan2 = $this->M_filter->getDataperTriwulan($kabkota, $data['tahun'], "Triwulan_2");
        //IF TRIWULAN II TIDAK ADA
        if(!$triwulan2){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($temp2, $default);
                array_push($triwulan2, $default);
            }
        }
        else{
            $temp2 = $triwulan2;
            for($i=0; $i<41; $i++){
                $temp2[$i]['NILAI'] = $triwulan2[$i]['NILAI']-$triwulan1[$i]['NILAI'];
            }
        }
   
        $triwulan3 = $this->M_filter->getDataperTriwulan($kabkota, $data['tahun'], "Triwulan_3");
        //IF TRIWULAN III TIDAK ADA
        if(!$triwulan3){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($triwulan3, $default);
                array_push($temp3, $default);
            }
        }
        else{
            $temp3 = $triwulan3;
            for($i=0; $i<41; $i++){
                $temp3[$i]['NILAI'] = $triwulan3[$i]['NILAI']-$triwulan2[$i]['NILAI'];
            }
        }

        $triwulan4 = $this->M_filter->getDataperTriwulan($kabkota, $data['tahun'], "Triwulan_4");
        //IF TRIWULAN IV TIDAK ADA
        if(!$triwulan4){
            for($i=0; $i<41; $i++){
                $default = array('NILAI' => 0);
                array_push($temp4, $default);
            }
        }
        else{
            for($i=0; $i<41; $i++){
                $temp4[$i]['NILAI'] = $triwulan4[$i]['NILAI']-$triwulan3[$i]['NILAI'];
            }
        }

        $data['nonkumulatif'] = array();
        array_push($data['nonkumulatif'], $triwulan1);
        array_push($data['nonkumulatif'], $temp2);
        array_push($data['nonkumulatif'], $temp3);
        array_push($data['nonkumulatif'], $temp4);
        //print_r($data['nonkumulatif']);

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
                        $data['list_nilai'] .= "0";                
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
                        $data['list_nilai'] .= "0";
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
