<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_delete extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('pelabuhan/M_delete');

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
        //$data['list_daerah'] = $this->M_filter->getFilter();
        //$data['list_tahun'] = $this->M_filter->getTahun();
        $data['list_pelabuhan'] = $this->M_delete->getListPelabuhan();
        $data['list'] = array();
        //print_r($data['list_pelabuhan']);

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_deleteDataPelabuhan');
        $this->load->view('V_footer_table');
    }

    public function filterHapusDataPelabuhan()
    {
        $data['title'] = "Hapus Data Pelabuhan";
        $data['list_pelabuhan'] = $this->M_delete->getListPelabuhan();
        $id_pelabuhan = $this->input->post('id_pelabuhan');

        $data['pelabuhan'] = $this->M_delete->getPelabuhan($id_pelabuhan);
        //$data['kabkota'] = $this->M_delete->getDaerah($kabkota);
        
        $data['list'] = $this->M_delete->getListDeletePelabuhan($id_pelabuhan);

        //print_r($data['list']);

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_deleteDataPelabuhan');
        $this->load->view('V_footer_table');
    }

    public function deleteDataPelabuhan(){
        $data = $this->input->post('data');
        print_r($data);
        //print_r($data[0]);
        //print_r($data[1]);
        for ($i=0; $i<sizeof($data); $i++){
            $piece = explode("#", $data[$i]);
            $id_pelabuhan = $piece[0];
            //print_r($daerah);
            $periode = $piece[1];
            $tahun = $piece[2];
            $nama_instansi = $piece[3];
            $pic = $piece[4];
            $id_kontak = $piece[5];
            $this->M_delete->deleteDataPelabuhan($id_pelabuhan,$periode,$tahun,$id_kontak);

        }
        //print_r($data);
        redirect('pelabuhan/hapus/');

    }
}