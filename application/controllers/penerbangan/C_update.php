<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_update extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('penerbangan/M_update');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = "Cari Data";
        $data['tahun'] = "Tahun";
        $data['bulan'] = "Bulan";
        $data['penerbangan'] = array();
        $data['uraian'] = array();

        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_updateData');
        $this->load->view('V_footer');
    }

    public function filterDataPenerbangan()
    {
        $data['title'] = "Cari Data Penerbangan";

        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $data['list_entitas'] = $this->M_update->getEntitas();

        $data['penerbangan'] = $this->M_update->getListPenerbangan($tahun, $bulan);

        print_r($data['penerbangan']);

        $this->load->library('session');
        $this->session->set_flashdata('tahun',$tahun);
        $this->session->set_flashdata('bulan',$bulan);

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_updateData');
        $this->load->view('V_footer_table');
    }

    public function updateDataPenerbangan()
    {
        $data['title'] = "Update Data Kendaraan";

        $nilai = array();
        $nilai1 = $this->input->post('nilai1');
        $nilai2 = $this->input->post('nilai2');
        $nilai3 = $this->input->post('nilai3');
        $nilai4 = $this->input->post('nilai4');
        $nilai5 = $this->input->post('nilai5');
        $nilai6 = $this->input->post('nilai6');

        $bulan = $this->session->flashdata('bulan');
        $tahun = $this->session->flashdata('tahun');
        

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        for ($i=0; $i<15; $i++){

            $rute = "Domestik";
            $update = array(
                'NILAI' => $nilai1[$i],
            );

            $this->M_update->updateNilai($i+1, $rute, $tahun, $bulan, $update);
        }

        for ($i=0; $i<15; $i++){

            $rute = "Internasional";
            $update = array(
                'NILAI' => $nilai2[$i],
            );

            $this->M_update->updateNilai($i+1, $rute, $tahun, $bulan, $update);
        }
 
        redirect(base_url('penerbangan/C_update/'));
    }

}
