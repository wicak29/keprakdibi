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
            redirect('login');
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
        $data['pelabuhan'] = $this->M_update->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_UpdateData');
        $this->load->view('V_footer');
    }



    public function filterDataPelabuhan()
    {
        $this->load->model('pelabuhan/M_pelabuhan');
        $data['title'] = "Update Data Pelabuhan";

        $nilai = array();
        $nilai = $this->input->post('nilai');
        //print_r($data['pelabuhan']);
        $pelabuhan = $this->input->post('pelabuhan');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data['pelabuhan'] = $this->M_update->getListPelabuhan();
        $data['nama_pelabuhan'] = $this->M_pelabuhan->getNamaPelabuhanById($pelabuhan);

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $this->load->library('session');
        $this->session->set_flashdata('tahun',$tahun);
        $this->session->set_flashdata('pelabuhan',$pelabuhan);
        $this->session->set_flashdata('bulan',$bulan);


        $data['hasil_filter'] = $this->M_update->getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan);
        print_r($nilai);

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_updateData');
        $this->load->view('V_footer_table');
    }
    public function updateDataPelabuhan()
    {
        $data['title'] = "Update Data Pelabuhan";

        $nilai = array();
        $nilai = $this->input->post('nilai');

        $bulan = $this->session->flashdata('bulan');
        $tahun = $this->session->flashdata('tahun');
        $pelabuhan = $this->session->flashdata('pelabuhan');
        //print_r($data['pelabuhan']);
        // $pelabuhan = $this->input->post('pelabuhan');
        // $tahun = $this->input->post('tahun');
        // $bulan = $this->input->post('bulan');
        $data['pelabuhan'] = $this->M_update->getListPelabuhan();

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;


        $data['hasil_filter'] = $this->M_update->getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan);
        //print_r($nilai);

        for ($i=0; $i<sizeof($nilai); $i++){

            $update = array(
                'NILAI' => $nilai[$i]
            );

            $this->M_update->updateNilai($i+1, $update, $tahun, $bulan, $pelabuhan);
        }
        
        redirect(base_url('pelabuhan/update/'));
    }

}