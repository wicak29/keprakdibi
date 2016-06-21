<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_filter extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('pelabuhan/M_filter');
        

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
        // $data['list_daerah'] = $this->M_filter->getFilter();
        // $data['list_tahun'] = $this->M_filter->getTahun();
        $data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_cariData');
        $this->load->view('V_footer');
    }



    public function filterDataPelabuhan()
    {
        $data['title'] = "Cari Data Pelabuhan";

        
        //print_r($data['pelabuhan']);
        $pelabuhan = $this->input->post('pelabuhan');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        //return;
        $data['hasil_filter'] = $this->M_filter->getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan); 
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_cariData');
        $this->load->view('V_footer');
    }

 
}
