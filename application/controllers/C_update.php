<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_update extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_update');
    }
    public function index()
    {
        //$data['list_daerah'] = $this->M_filter->getFilter();
        //$data['list_tahun'] = $this->M_filter->getTahun();
        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_pilihUpdateKategori');
        $this->load->view('V_footer');
    }

    public function viewUpdateDataKab()
    {
        $data['periode'] = "periode";
        $data['data_apbd'] = array();
        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_updateAPBDKabKota', $data);
        $this->load->view('V_footer_table');
    }

    public function pindahKeFilter(){
        
        $kategori= $this->input->post('kategori');
        //print_r($kategori);
        //$result = $this->M_filter->cariFilter($daerah,$tahun);
        if ($kategori == 'Provinsi'){
            redirect('C_update/viewUpdateDataProv');
        }
        elseif($kategori == 'Kab_Kota'){
            redirect('C_update/viewUpdateDataKab');
        }
      
    }

    public function viewUpdateDataProv(){
        
        $bulan= $this->input->post('bulan');        
        $tahun= $this->input->post('tahun');
        $this->load->library('session');
        $this->session->set_flashdata('tahun',$tahun);
        $this->session->set_flashdata('bulan',$bulan);

        if (!$bulan) $bulan = "Bulan";

        $data['uraian'] = $this->M_update->getDatabyProvTahunPeriode($bulan,$tahun,1);
        $data['bulan'] = $bulan;
        if(!$data['uraian']) $data['uraian'] = array();
        
        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_updateAPBDProvinsi', $data);
        $this->load->view('V_footer_table');
            
    }

    public function filterKab()
    {
        $kabkota = $this->input->post('kabkota');

        $data['tahun'] = $this->input->post('tahun');
        $data['periode'] = $this->input->post('periode');
        
        $data['kabkota'] = $this->M_update->getDaerah($kabkota);
        $this->load->library('session');
        $this->session->set_flashdata('tahun2',$data['tahun']);
        $this->session->set_flashdata('bulan2',$data['periode']);
        $this->session->set_flashdata('kabkota',$kabkota);
        
        $data['data_apbd'] = $this->M_update->getDatabyKabTahunPeriode($kabkota, $data['tahun'], $data['periode']);
        //print_r($data['data_apbd']);

        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_updateAPBDKabKota', $data);
        $this->load->view('V_footer_table');
    }

    public function updateDataNilaiProv() {
        //$id= $this->input->post('did');
        $nilai = array();
        $nilai = $this->input->post('nilai');
        $bulan = $this->session->flashdata('bulan');
        $tahun = $this->session->flashdata('tahun');
        //print_r($nilai);
        //print_r($bulan);
        //print_r($tahun);
        $apbd = $this->M_update->getNilaiAPBDP(1, $tahun);
        //print_r($apbd);
        for ($i=0; $i<sizeof($nilai); $i++){
            if($apbd[$i]['APBD_P']==NULL){
                $persen = ($nilai[$i]/$apbd[$i]['APBD'])*100;
            }
            else{
                $persen = ($nilai[$i]/$apbd[$i]['APBD_P'])*100;
            }

            $data = array(
                'NILAI_REALISASI' => $nilai[$i],
                'PERSEN_REALISASI' => $persen
            );

            $this->M_update->updateNilai($i+1, $data, $tahun, $bulan, 1);

        }
        
        //$this->M_update->updateNilai($data);
        redirect('C_update/viewUpdateDataProv');
        //return;
    }
        public function updateDataNilaiKab() {
        //$id= $this->input->post('did');
        $nilai = array();
        $nilai = $this->input->post('nilai');
        $bulan = $this->session->flashdata('bulan2');
        $tahun = $this->session->flashdata('tahun2');
        $kabkota = $this->session->flashdata('kabkota');
        print_r($kabkota);
        print_r($bulan);
        print_r($tahun);
        print_r($nilai);
        $apbd = $this->M_update->getNilaiAPBDP($kabkota, $tahun);
        //print_r($apbd);
        for ($i=0; $i<sizeof($nilai); $i++){
            if($apbd[$i]['APBD_P']==NULL){
                $persen = ($nilai[$i]/$apbd[$i]['APBD'])*100;
            }
            else{
                $persen = ($nilai[$i]/$apbd[$i]['APBD_P'])*100;
            }

            $data = array(
                'NILAI_REALISASI' => $nilai[$i],
                'PERSEN_REALISASI' => $persen
            );

            $this->M_update->updateNilai($i+1, $data, $tahun, $bulan, $kabkota);

        }
        
        //$this->M_update->updateNilai($data);
        redirect('C_update/viewUpdateDataKab');
        //return;
    }

}