<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_update extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_update');
    }
    public function index(){
        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_pilihUpdateKategori');
        $this->load->view('V_footer');
    }

    public function viewUpdateDataRealisasiKab()
    {
        $data['periode'] = "periode";
        $data['data_apbd'] = array();
        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_updateAPBDKabKota', $data);
        $this->load->view('V_footer_table');
    }

     public function viewUpdateDataAPBDPKab()
    {
        //$data['periode'] = "periode";
        $data['uraian'] = array();
        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_updateAPBDP_KabKota', $data);
        $this->load->view('V_footer_table');
    }

    public function pindahKeFilter(){       
        $kategori= $this->input->post('kategori');
        $daerah= $this->input->post('daerah');
        //print_r($kategori);
        //print_r($daerah);

        if ($kategori == 'realisasi'){
            if ($daerah == 'Provinsi'){
                redirect('C_update/viewUpdateDataRealisasiProv');
            }
            elseif($daerah == 'Kab_Kota'){
                redirect('C_update/viewUpdateDataRealisasiKab');
            }
        }
        elseif ($kategori == 'apbdp'){
            if ($daerah == 'Provinsi'){
                redirect('C_update/viewUpdateDataAPBDPProv');
            }
            elseif($daerah == 'Kab_Kota'){
                redirect('C_update/viewUpdateDataAPBDPKab');
            }
        } 
    }

    public function viewUpdateDataRealisasiProv(){       
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

    public function filterKabRealisasi()
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

    public function filterKabAPBDP()
    {
        $kabkota = $this->input->post('kabkota');

        $data['tahun'] = $this->input->post('tahun');
        //$data['periode'] = $this->input->post('periode');
        
        $data['kabkota'] = $this->M_update->getDaerah($kabkota);
        $this->load->library('session');
        $this->session->set_flashdata('tahun2',$data['tahun']);
        $this->session->set_flashdata('kabkota',$kabkota);
        
        $data['uraian'] = $this->M_update->getNilaiAPBDP($kabkota, $data['tahun']);
        //print_r($data['data_apbd']);

        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_updateAPBDP_KabKota', $data);
        $this->load->view('V_footer_table');
    }

    public function updateDataNilaiRealisasiProv() {

        $nilai = array();
        $nilai = $this->input->post('nilai');
        $bulan = $this->session->flashdata('bulan');
        $tahun = $this->session->flashdata('tahun');

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
        redirect('C_update/viewUpdateDataRealisasiProv');
        //return;
    }

    public function updateDataNilaiRealisasiKab() {
        //$id= $this->input->post('did');
        $nilai = array();
        $nilai = $this->input->post('nilai');
        $bulan = $this->session->flashdata('bulan2');
        $tahun = $this->session->flashdata('tahun2');
        $kabkota = $this->session->flashdata('kabkota');
        //print_r($kabkota);
        //print_r($bulan);
        //print_r($tahun);
        //print_r($nilai);
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
        redirect('C_update/viewUpdateDataRealisasiKab');
        //return;
    }

    public function viewUpdateDataAPBDPProv(){       
        //$bulan= $this->input->post('bulan');        
        $tahun= $this->input->post('tahun');
        $this->load->library('session');
        $this->session->set_flashdata('tahun',$tahun);
        //$this->session->set_flashdata('bulan',$bulan);

        $data['uraian'] = $this->M_update->getNilaiAPBDP(1, $tahun);

        if(!$data['uraian']) $data['uraian'] = array();
        
        $this->load->view('V_head_table');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_updateAPBDP_Provinsi', $data);
        $this->load->view('V_footer_table');       
    }

    public function updateDataNilaiAPBDPProv() {
 
        $nilai = array();
        $nilai = $this->input->post('nilai');
        $tahun = $this->session->flashdata('tahun');
        //print_r($nilai);

        for ($i=0; $i<sizeof($nilai)/2; $i++){
            $data = array(
                'APBD' => $nilai[$i*2],
                'APBD_P' => $nilai[($i*2)+1]
            );
            $this->M_update->updateNilaiAPBDP($data, 1, $i+1, $tahun);
        }

        $apbd = $this->M_update->getNilaiAPBDP(1, $tahun);
        $dataUpdate =  $this->M_update->getDataUpdateRealisasi(1, $tahun);
        //print_r($dataUpdate);
        //print_r(sizeof($dataUpdate));

        for ($i=0; $i<sizeof($dataUpdate); $i++){

            if($apbd[$dataUpdate[$i]['URAIAN']-1]['APBD_P']==NULL){
                $persen = ($dataUpdate[$i]['NILAI']/$apbd[$dataUpdate[$i]['URAIAN']-1]['APBD'])*100;
            }
            else{
                $persen = ($dataUpdate[$i]['NILAI']/$apbd[$dataUpdate[$i]['URAIAN']-1]['APBD_P'])*100;
            }

            $data = array(
                'NILAI_REALISASI' => $dataUpdate[$i]['NILAI'],
                'PERSEN_REALISASI' => $persen
            );
            $this->M_update->updateNilai($dataUpdate[$i]['URAIAN'], $data, $tahun, $dataUpdate[$i]['PERIODE'], 1);
        }
        redirect('C_update/viewUpdateDataAPBDPProv');
    }

    public function updateDataNilaiAPBDPKab() {
 
        $nilai = array();
        $nilai = $this->input->post('nilai');
        $tahun = $this->session->flashdata('tahun2');
        $kabkota = $this->session->flashdata('kabkota');
        //print_r($nilai);

        for ($i=0; $i<sizeof($nilai)/2; $i++){
            $data = array(
                'APBD' => $nilai[$i*2],
                'APBD_P' => $nilai[($i*2)+1]
            );
            $this->M_update->updateNilaiAPBDP($data, $kabkota, $i+1, $tahun);
        }

        $apbd = $this->M_update->getNilaiAPBDP($kabkota, $tahun);
        $dataUpdate =  $this->M_update->getDataUpdateRealisasi($kabkota, $tahun);
        //print_r($dataUpdate);
        //print_r(sizeof($dataUpdate));

        for ($i=0; $i<sizeof($dataUpdate); $i++){

            if($apbd[$dataUpdate[$i]['URAIAN']-1]['APBD_P']==NULL){
                $persen = ($dataUpdate[$i]['NILAI']/$apbd[$dataUpdate[$i]['URAIAN']-1]['APBD'])*100;
            }
            else{
                $persen = ($dataUpdate[$i]['NILAI']/$apbd[$dataUpdate[$i]['URAIAN']-1]['APBD_P'])*100;
            }

            $data = array(
                'NILAI_REALISASI' => $dataUpdate[$i]['NILAI'],
                'PERSEN_REALISASI' => $persen
            );
            $this->M_update->updateNilai($dataUpdate[$i]['URAIAN'], $data, $tahun, $dataUpdate[$i]['PERIODE'], $kabkota);
        }
        redirect('C_update/viewUpdateDataAPBDPKab');
    }

}