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

        $id_entitas = $this->M_filter->getIDEntitas($entitas);
        $dataTemp = array();
        for ($i=0; $i<sizeof($id_entitas); $i++){
            $penerbangan = $this->M_filter->getDataPenerangan($id_entitas[$i]['ID_ENTITAS'], $bulan, $tahun);
            if($penerbangan)
                array_push($dataTemp, $penerbangan);
        }

        //print_r($dataTemp);
        if(!$dataTemp) $dataTemp = array();
        $data['penerbangan'] = $dataTemp;

        //print_r($id_entitas);
        // $data['uraian'] = $this->M_filter->getUraianKendaraan();
        // //array_push($data['data_listrik'], $uraian);
        // $data['kendaraan'] = $this->M_filter->getListKendaraan($tahun, $bulan);

        // if(!$data['kendaraan']){
        //     $data['kendaraan'] = array();
        //     $data['uraian'] = array();
        // }

        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_cariData');
        $this->load->view('V_footer_table');
    }

    public function viewLihatGrafikBulan()
    {
        $data['title'] = "Grafik Kendaraan Berdasarkan Bulan Pertahun";
        $data['periode']= $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');
        $data['upt'] = $this->input->post('upt');
                

        $data['jumlah_tahun'] = sizeof($data['tahun']);
        if ($data['upt']) 
        {
            $data['nama_upt'] = $this->M_filter->getUptById($data['upt']);
        }

        if (!$data['tahun']) $data['tahun'] = array();

        $data['finalResult'] = array();
        for ($i=1; $i<=2; $i++)
        {
            if ($i==1)
            {
                $jenis = "Mobil dan sejenisnya";
            }
            elseif ($i==2) 
            {
                $jenis = "Sepeda motor dan sejenisnya";
            }

            $data['listUraian'] = array();
            $data['list_nilai']="";

            array_push($data['listUraian'], $jenis);

            $pos = 0;
            foreach ($data['tahun'] as $t) 
            {
                $nilai = $this->M_filter->getNilaiByKategori($jenis, $t, $data['periode'], $data['upt']);
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
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_grafikBulan');
        $this->load->view('V_footerChart');
    }
}
