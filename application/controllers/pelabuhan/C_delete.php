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
            redirect('C_auth');
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

        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_deleteDataPelabuhan');
        $this->load->view('V_footer');
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
        redirect('pelabuhan/C_delete/');

    }
    // public function viewDeleteDataKab()
    // {
    //     $data['title'] = "Hapus Data Kabupaten/Kota";
    //     $data['periode'] = "periode";
    //     $data['list'] = array();
    //     $this->load->view('V_head_table', $data);
    //     $this->load->view('V_sidebar');
    //     $this->load->view('V_topNav');
    //     $this->load->view('delete/V_deleteAPBDKabKota');
    //     $this->load->view('V_footer_table');
    // }
    // public function viewDeleteDataAPBDP()
    // {
    //     $data['title'] = "Hapus Data APBD P";
    //     //$data['periode'] = "periode";
    //     //$data['list'] = array();
    //     $data['list'] = $this->M_delete->getListDeleteAPBDP();
    //     $this->load->view('V_head_table', $data);
    //     $this->load->view('V_sidebar');
    //     $this->load->view('V_topNav');
    //     $this->load->view('delete/V_deleteAPBDP');
    //     $this->load->view('V_footer_table');
    // }
    // public function viewDeleteDataKontak()
    // {
    //     $data['title'] = "Hapus Kontak";
    //     //$data['periode'] = "periode";
    //     //$data['list'] = array();
    //     $data['list'] = $this->M_delete->getListDeleteKontak();
    //     $this->load->view('V_head_table', $data);
    //     $this->load->view('V_sidebar');
    //     $this->load->view('V_topNav');
    //     $this->load->view('delete/V_deleteKontak');
    //     $this->load->view('V_footer_table');
    // }

    // public function pindahKeFilter(){
        
    //     $kategori= $this->input->post('kategori');
    //     if ($kategori == 'Provinsi'){
    //         redirect('C_delete/viewDeleteDataProv');
    //     }
    //     elseif($kategori == 'Kab_Kota'){
    //         redirect('C_delete/viewDeleteDataKab');
    //     }
    //     elseif($kategori == 'kontak'){
    //         redirect('C_delete/viewDeleteDataKontak');
    //     }
    //     else{
    //         redirect('C_delete/viewDeleteDataAPBDP');
    //     }
      
    // }

    // public function viewDeleteDataProv(){
        
    //     //$bulan= $this->input->post('bulan');        
    //     //$tahun= $this->input->post('tahun');
    //     //$this->load->library('session');
    //     // $this->session->set_flashdata('tahun',$tahun);
    //     // $this->session->set_flashdata('bulan',$bulan);

    //     // if (!$bulan) $bulan = "Bulan";

    //     // $data['uraian'] = $this->M_update->getDatabyProvTahunPeriode($bulan,$tahun,1);
    //     // $data['bulan'] = $bulan;
    //     // if(!$data['uraian']) $data['uraian'] = array();
    //     $data['title'] = "Hapus Data Provinsi";
    //     $data['list'] = $this->M_delete->getListDeleteProv();

    //     $this->load->view('V_head_table', $data);
    //     $this->load->view('V_sidebar');
    //     $this->load->view('V_topNav');
    //     $this->load->view('delete/V_deleteAPBDProvinsi');
    //     $this->load->view('V_footer_table');
            
    // }

    // public function deleteDataProv() {
       
    //     $data = $this->input->post('data');
    //     //print_r($data);
    //     //print_r($data[0]);
    //     //print_r($data[1]);
    //     for ($i=0; $i<sizeof($data); $i++){

    //         $piece = explode("#", $data[$i]);
    //         $daerah = $piece[0];
    //         //print_r($daerah);
    //         $periode = $piece[1];
    //         $tahun = $piece[2];
    //         $nama_instansi = $piece[3];
    //         $pic = $piece[4];
    //         $id_kontak = $piece[5];
    //         $this->M_delete->deleteData($daerah,$periode,$tahun,$id_kontak);

    //     }
    //     //print_r($data);
    //     redirect('C_delete/viewDeleteDataProv');

    // }

    // public function deleteDataAPBDP() {
       
    //     $data = $this->input->post('data');
    //     //print_r($data);
    //     //print_r($data[0]);
    //     //print_r($data[1]);
    //     for ($i=0; $i<sizeof($data); $i++){

    //         $piece = explode("#", $data[$i]);
    //         $id_daerah = $piece[0];
    //         //print_r($daerah);
    //         $nama_daerah = $piece[1];
    //         $tahun = $piece[2];
            
    //         $this->M_delete->deleteDataAPBDP($id_daerah,$tahun);

    //     }
    //     //print_r($data);
    //     redirect('C_delete/viewDeleteDataAPBDP');

    // }
    // public function deleteDataKontak() 
    // {
       
    //     $data = $this->input->post('data');
        
    //     for ($i=0; $i<sizeof($data); $i++){

    //         $piece = explode("#", $data[$i]);
    //         $id_kontak = $piece[0];
    //         $id_unknown = 1;
    //         print_r($id_kontak);

    //         $data = array(
    //             'ID_KONTAK' => $id_unknown
    //         );
    //         print_r($data);
    //         // return;
    //         $this->M_delete->updateDataKontak($id_kontak, $data);
            
    //         $this->M_delete->deleteDataKontak($id_kontak);

    //     }
    //     //print_r($data);
    //     redirect('C_delete/viewDeleteDataKontak');

    // }


    // public function filterKab()
    // {
    //     $data['title'] = "Hapus Data Kab./Kota";
    //     $kabkota = $this->input->post('kabkota');

    //     $data['tahun'] = $this->input->post('tahun');
    //     $data['periode'] = $this->input->post('periode');
        
    //     $data['kabkota'] = $this->M_delete->getDaerah($kabkota);
        
    //     $data['list'] = $this->M_delete->getListDeleteKab($kabkota);

    //     //print_r($data['list']);

    //     $this->load->view('V_head_table', $data);
    //     $this->load->view('V_sidebar');
    //     $this->load->view('V_topNav');
    //     $this->load->view('delete/V_deleteAPBDKabKota');
    //     $this->load->view('V_footer_table');
    // }

    // public function deleteDataKab() {
       
    //     $data = $this->input->post('data');
    //     print_r($data);
    //     //print_r($data[0]);
    //     //print_r($data[1]);
    //     for ($i=0; $i<sizeof($data); $i++){

    //         $piece = explode("#", $data[$i]);
    //         $daerah = $piece[0];
    //         //print_r($daerah);
    //         $periode = $piece[1];
    //         $tahun = $piece[2];
    //         $nama_instansi = $piece[3];
    //         $pic = $piece[4];
    //         $id_kontak = $piece[5];
    //         $this->M_delete->deleteData($daerah,$periode,$tahun,$id_kontak);

    //     }
    //     //print_r($data);
    //     //$data['kabkota'] = $this->M_delete->getDaerah($kabkota);

    //     redirect('C_delete/viewDeleteDataKab');

    // }
}