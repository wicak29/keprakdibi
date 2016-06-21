<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_update extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('pelabuhan/M_update');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('C_auth');
        }
    }

    public function index()
    {
        $data['title'] = "Update Data";
        // $data['list_daerah'] = $this->M_filter->getFilter();
        // $data['list_tahun'] = $this->M_filter->getTahun();
        $data['tahun'] = "Tahun";
        $data['bulan'] = "Bulan";
        $data['hasil_filter'] = array();
        $data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_UpdateData');
        $this->load->view('V_footer');
    }



    public function filterDataPelabuhan()
    {
        $data['title'] = "Cari Data Pelabuhan";

        
        //print_r($data['pelabuhan']);
        $pelabuhan = $this->input->post('pelabuhan');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        // if($pelabuhan = 1){
        //     $data['pelabuhan'] = 'Benoa';
        // }
        // else{
        //     $data['pelabuhan'] = 'Celukan Bawang';
        // }
        //return;
        $data['hasil_filter'] = $this->M_filter->getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan); 
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_cariData');
        $this->load->view('V_footer_table');
    }

    public function filterKabRealisasi()
    {
        $data['title'] = "Update Data Realisasi Kab./Kota";
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

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('update/V_updateAPBDKabKota');
        $this->load->view('V_footer_table');
    }

    public function updateDataNilaiRealisasiKab() 
    {
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


}