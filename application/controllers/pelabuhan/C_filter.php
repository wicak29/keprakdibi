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
        $data['tahun'] = "Tahun";
        $data['bulan'] = "Bulan";
        $data['hasil_filter'] = array();
        $data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_cariData');
        $this->load->view('V_footer');
    }

    public function filterDataPelabuhan()
    {
        $this->load->model('pelabuhan/M_pelabuhan');
        $data['title'] = "Cari Data Pelabuhan";

        //print_r($data['pelabuhan']);
        $pelabuhan = $this->input->post('pelabuhan');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $data['pelabuhan'] = $this->M_filter->getListPelabuhan();

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $data['tabel_title'] = $this->M_pelabuhan->getNamaPelabuhanById($pelabuhan);
        $data['hasil_filter'] = $this->M_filter->getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan); 

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_cariData');
        $this->load->view('V_footer_table');
    }

    public function viewLihatGrafikBulan()
    {
        $data['title'] = "Grafik Pelabuhan Berdasarkan Bulan Pertahun";
        $data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $data['periode'] = $this->input->post('bulan');
        $pelabuhan = $this->input->post('pelabuhan');
        $data['uraian'] = $this->input->post('uraian');
        $data['tahun'] = $this->input->post('tahun');
                
        $data['jumlah_uraian'] = sizeof($data['uraian']);
        $data['jumlah_tahun'] = sizeof($data['tahun']);
        $data['nama_pelabuhan'] = $this->M_filter->getNamaPelabuhanById($pelabuhan);

        if (!$data['tahun']) $data['tahun'] = array();
        if (!$data['uraian']) $data['uraian'] = array();

        $data['finalResult'] = array();
        foreach ($data['uraian'] as $i) 
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            $nama_uraian = $this->M_filter->getNamaUraianById($i);
            $uraian_satuan = $nama_uraian['JENIS_DATA']." (".$nama_uraian['SATUAN'].")";
            // print_r($uraian_satuan);
            array_push($data['listUraian'], $uraian_satuan);

            $pos = 0;

            foreach ($data['tahun'] as $t) 
            {
                $nilai = $this->M_filter->getNilaiByUraian($i, $t, $data['periode'], $pelabuhan);
                // print_r($nilai);
                if ($nilai)
                {
                    if ($pos != $data['jumlah_tahun']-1)
                        //$data['list_nilai'] .= $nilai[0]['NILAI_REALISASI'].",";
                        $data['list_nilai'] .= $nilai[0]['NILAI'].",";
                    else
                        //$data['list_nilai'] .= $nilai[0]['NILAI_REALISASI']."";
                        $data['list_nilai'] .= $nilai[0]['NILAI']."";
                }
                else
                {

                    if ($pos != $data['jumlah_tahun']-1)
                        $data['list_nilai'] .= "0,";
                    else
                        $data['list_nilai'] .= "0";
                }
                $pos++;
            }
            array_push($data['listUraian'], $data['list_nilai']);
            array_push($data['finalResult'], $data['listUraian']);
        }        
        // print_r($data['finalResult']);

        $this->load->view('V_headChart', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_grafikPerbulan');
        $this->load->view('V_footerChart');
    }
 
}
