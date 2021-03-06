<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_delete extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('penerbangan/M_delete');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = "Hapus Data";
        $data['list_data_penerbangan'] = $this->M_delete->getListDataPenerbangan();
        //$data['list_daerah'] = $this->M_filter->getFilter();
        //$data['list_tahun'] = $this->M_filter->getTahun();
        // $data['list_pelabuhan'] = $this->M_delete->getListPelabuhan();
        
        
        //print_r($data['list_pelabuhan']);

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_deleteDataPenerbangan');
        $this->load->view('V_footer_table');
    }

    public function filterHapusDataKelistrikan()
    {
        $data['title'] = "Hapus Data Penerbangan";
        $data['list_data_penerbangan'] = $this->M_delete->getListDataPenerbangan();
        // $data['list_pelabuhan'] = $this->M_delete->getListPelabuhan();
        // $id_pelabuhan = $this->input->post('id_pelabuhan');

        // $data['pelabuhan'] = $this->M_delete->getPelabuhan($id_pelabuhan);
        //$data['kabkota'] = $this->M_delete->getDaerah($kabkota);
        
        // $data['list'] = $this->M_delete->getListDeletePelabuhan($id_pelabuhan);

        //print_r($data['list']);

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_deleteDataPenerbangan');
        $this->load->view('V_footer_table');
    }


    public function deleteDataPenerbangan(){
        $data = $this->input->post('data');
        //print_r($data);
        //print_r($data[0]);
        //print_r($data[1]);
        for ($i=0; $i<sizeof($data); $i++){
            $piece = explode("#", $data[$i]);
            $id_kontak = $piece[0];
            //print_r($daerah);
            $periode = $piece[1];
            $tahun = $piece[2];
            
            $this->M_delete->deleteDataKelistrikan($id_kontak,$periode,$tahun);

        }
        //print_r($data);
        redirect('penerbangan/hapus/');

    }

}