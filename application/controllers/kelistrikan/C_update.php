<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_update extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('kelistrikan/M_update');

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
        $data['data_listrik'] = array();
        //$data['pelabuhan'] = $this->M_update->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_UpdateData');
        $this->load->view('V_footer');
    }

    public function filterDataKelistrikan()
    {
        //$this->load->model('pelabuhan/M_pelabuhan');
        $data['title'] = "Update Data Pelabuhan";

        $nilai = array();
        //$nilai = $this->input->post('nilai');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $this->load->library('session');
        $this->session->set_flashdata('tahun',$tahun);
        $this->session->set_flashdata('bulan',$bulan);

        $data['data_listrik'] = array();

        $uraian = $this->M_update->getUraianKelistrikan();
        array_push($data['data_listrik'], $uraian);

        for($i=1; $i<=3; $i++){
            $list = $this->M_update->getListKelistrikan($i, $tahun, $bulan);
            if($list)
                array_push($data['data_listrik'], $list);
        }
        if (sizeof($data['data_listrik'])<4) {
            $data['data_listrik'] = array();
        }
        //$data['hasil_filter'] = $this->M_update->getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan);
        //print_r($nilai);

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_updateData');
        $this->load->view('V_footer_table');
    }

    public function updateDataKelistrikan()
    {
        $data['title'] = "Update Data Pelabuhan";

        $nilai = array();
        //$nilai = $this->input->post('nilai');
        $harga_jual = $this->input->post('harga_jual');
        array_push($nilai, $harga_jual);

        $jum_pelanggan = $this->input->post('jum_pelanggan');
        array_push($nilai, $jum_pelanggan);
        
        $jum_konsumsi = $this->input->post('jum_konsumsi');
        array_push($nilai, $jum_konsumsi);
        
        $bulan = $this->session->flashdata('bulan');
        $tahun = $this->session->flashdata('tahun');
        //$pelabuhan = $this->session->flashdata('pelabuhan');
        //print_r($data['pelabuhan']);
        // $pelabuhan = $this->input->post('pelabuhan');
        // $tahun = $this->input->post('tahun');
        // $bulan = $this->input->post('bulan');
        //$data['pelabuhan'] = $this->M_update->getListPelabuhan();

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        print_r($nilai);
        //print_r($jum_pelanggan);
        //print_r($jum_konsumsi);

        // $data['hasil_filter'] = $this->M_update->getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan);
        // //print_r($nilai);
        for($j=0; $j<3; $j++){
            for ($i=0; $i<5; $i++){
                $update = array(
                    'NILAI' => $nilai[$j][$i]
                );
                
                $this->M_update->updateNilai($j+1, $i+1, $tahun, $bulan, $update);
            }
        }

        
        redirect(base_url('kelistrikan/C_update/'));
    }




}