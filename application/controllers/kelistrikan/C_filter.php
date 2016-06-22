<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_filter extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('kelistrikan/M_filter');

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
        $data['tahun'] = "Tahun";
        $data['bulan'] = "Bulan";
        $data['data_listrik'] = array();
        //$data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_cariData');
        $this->load->view('V_footer');
    }



    public function filterDataKelistrikan()
    {
        $data['title'] = "Cari Data Kelistrikan";

        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $data['data_listrik'] = array();

        $uraian = $this->M_filter->getUraianKelistrikan();
        array_push($data['data_listrik'], $uraian);

        for($i=1; $i<=3; $i++){
            $list = $this->M_filter->getListKelistrikan($i, $tahun, $bulan);
            if($list)
                array_push($data['data_listrik'], $list);
        }
        if (sizeof($data['data_listrik'])<4) {
            $data['data_listrik'] = array();
        }
 
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_cariData');
        $this->load->view('V_footer_table');
    }
}
