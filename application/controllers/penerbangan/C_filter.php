<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_filter extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('penerbangan/M_filter');

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
        //$data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_cariData');
        $this->load->view('V_footer');
    }

    public function filterDataPenerbangan()
    {
        $data['title'] = "Cari Data Kelistrikan";

        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $entitas = $this->input->post('entitas');

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['entitas'] = $entitas;

        $data['list_entitas'] = $this->M_filter->getEntitas();

        $data['penerbangan'] = $this->M_filter->getListPenerbangan($tahun, $bulan);

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_cariData');
        $this->load->view('V_footer_table');
    }

    public function viewLihatGrafikBulan()
    {
        $data['title'] = "Grafik Penerbangan Berdasarkan Bulan Pertahun";
        $data['rute'] = $this->input->post('rute');
        $data['periode']= $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');
        $data['kategori'] = $this->input->post('entitas');

        $data['jumlah_tahun'] = sizeof($data['tahun']);

        if (!$data['tahun']) $data['tahun'] = array();
        if (!$data['kategori']) $data['kategori'] = array();

        $data['finalResult'] = array();
        foreach ($data['kategori'] as $i)
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            $nama_entitas = $this->M_filter->getEntitasById($i);
            $entitas_aktivitas = $nama_entitas['NAMA_ENTITAS']." (".$nama_entitas['AKTIVITAS'].")";
            array_push($data['listUraian'], $entitas_aktivitas);

            $pos = 0;
            foreach ($data['tahun'] as $t) 
            {
                $nilai = $this->M_filter->getNilaiByKategori($i, $t, $data['periode'], $data['rute']);
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
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_grafikPerbulan');
        $this->load->view('V_footerChart');
    }
}
