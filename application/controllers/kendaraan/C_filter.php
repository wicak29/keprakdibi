<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_filter extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('kendaraan/M_filter');

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
        $data['kendaraan'] = array();
        $data['uraian'] = array();
        //$data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_cariData');
        $this->load->view('V_footer');
    }

    public function filterDataKendaraan()
    {
        $data['title'] = "Cari Data Kendaraan";

        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $data['uraian'] = $this->M_filter->getUraianKendaraan();

        $data['kendaraan'] = $this->M_filter->getListKendaraan($tahun, $bulan);

        if(!$data['kendaraan']){
            $data['kendaraan'] = array();
            $data['uraian'] = array();
        }

        $sepedaMotor1 = array();
        $sepedaMotor2 = array();
        $growthMotor = array();
        $growthMobil = array();
        if($tahun!=2007){
            //ambil data motor
            $sepedaMotor1 = $this->M_filter->getNilaiKendaraanbyPeriode('Sepeda', $tahun, $bulan);
            $sepedaMotor2 = $this->M_filter->getNilaiKendaraanbyPeriode('Sepeda', $tahun-1, $bulan);
            if($sepedaMotor2 && $sepedaMotor1){
                for($i=0; $i<9; $i++){
                    $dataGrowth = ($sepedaMotor1[$i]['NILAI']-$sepedaMotor2[$i]['NILAI'])/$sepedaMotor2[$i]['NILAI']*100;
                    array_push($growthMotor, $dataGrowth);
                }   
            }
            for($i=0; $i<9; $i++){
                array_push($growthMotor, "***");
            }  

            //ambil data mobil
            $Mobil1 = $this->M_filter->getNilaiKendaraanbyPeriode('Mobil', $tahun, $bulan);
            $Mobil2 = $this->M_filter->getNilaiKendaraanbyPeriode('Mobil', $tahun-1, $bulan);
            if($Mobil2 && $Mobil1){
                for($i=0; $i<9; $i++){
                    $dataGrowth = ($Mobil1[$i]['NILAI']-$Mobil2[$i]['NILAI'])/$Mobil2[$i]['NILAI']*100;
                    array_push($growthMobil, $dataGrowth);
                }   
            }
            for($i=0; $i<9; $i++){
                array_push($growthMobil, "***");
            } 
        }
        else{
            for($i=0; $i<9; $i++){
                array_push($growthMotor, 0);
                array_push($growthMobil, 0);
            }   
        }

        $data['data_pic'] = $this->M_filter->getDataSpesifikPIC($tahun, $bulan);
        //print_r($data['data_pic']);
        if(!$data['data_pic']){
            $data_pic = array(
                'NAMA_INSTANSI' => 'Tidak ada data',
                'NO_TELEPON' => 'Tidak ada data',
                'EMAIL'=> 'Tidak ada data',
                'ALAMAT'=> 'Tidak ada data',
                'PIC'=> 'Tidak ada data',
                'PREFERRED_CONTACT'=> 'Tidak ada data'
            );
            array_push($data['data_pic'], $data_pic);
        }
 
        $data['growthMotor'] = $growthMotor;
        $data['growthMobil'] = $growthMobil; 
    
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_cariData');
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
