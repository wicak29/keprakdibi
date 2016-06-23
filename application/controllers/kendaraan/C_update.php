<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_update extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('kendaraan/M_update');

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
        $data['kendaraan'] = array();
        $data['uraian'] = array();
        //$data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_updateData');
        $this->load->view('V_footer');
    }

    public function filterDataKendaraan()
    {
        $data['title'] = "Cari Data Kelistrikan";

        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $data['uraian'] = $this->M_update->getUraianKendaraan();
        //array_push($data['data_listrik'], $uraian);
        $data['kendaraan'] = $this->M_update->getListKendaraan($tahun, $bulan);

        $this->load->library('session');
        $this->session->set_flashdata('tahun',$tahun);
        $this->session->set_flashdata('bulan',$bulan);


        if(!$data['kendaraan']){
            $data['kendaraan'] = array();
            $data['uraian'] = array();
        }

        //print_r($uraian);
        //print_r($list);
    
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_updateData');
        $this->load->view('V_footer_table');
    }

    public function updateDataKendaraan()
    {
        $data['title'] = "Update Data Kendaraan";

        $nilai = array();
        $nilai = $this->input->post('nilai');
        
        $bulan = $this->session->flashdata('bulan');
        $tahun = $this->session->flashdata('tahun');
        

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        //print_r($nilai);
        //print_r($jum_pelanggan);
        //print_r($jum_konsumsi);

        // $data['hasil_filter'] = $this->M_update->getHasilFilterPelabuhan($pelabuhan, $tahun, $bulan);
        // //print_r($nilai);
        $data_upt = $this->M_update->getDataUPT();
        //print_r($data_upt);
        $ind = 0;
        $indHelp = 0;
        for ($i=0; $i<sizeof($nilai); $i++){

            if($indHelp == 2){
                    $indHelp = 0;
                    $ind++;
                }
            $indHelp++;

            if(($i%2)==0){
                $jenis="Mobil dan sejenisnya";
            }
            elseif(($i%2)==1){
                $jenis="Sepeda motor dan sejenisnya";
            }

            $update = array(
                'NILAI' => $nilai[$i],
            );
            //print_r($data_upt[$ind]['KODE_UPT']);
            // print_r($jenis);
            // print_r($tahun);
            // print_r($bulan);
            // print_r($update);

            $this->M_update->updateNilai($data_upt[$ind]['KODE_UPT'], $jenis, $tahun, $bulan, $update);
        }

        
       redirect(base_url('kendaraan/C_update/'));
    }

    public function viewLihatGrafikBulan()
    {
        $data['title'] = "Grafik Pelabuhan Berdasarkan Bulan Pertahun";
        $data['periode']= $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');
        $data['uraian'] = $this->input->post('uraian');
        $data['aspek'] = $this->input->post('aspek');
                

        $data['jumlah_tahun'] = sizeof($data['tahun']);
        if ($data['aspek']) 
        {
            $data['nama_aspek'] = $this->M_update->getAspekById($data['aspek']);
        }

        if (!$data['tahun']) $data['tahun'] = array();
        if (!$data['uraian']) $data['uraian'] = array();

        $data['finalResult'] = array();
        foreach ($data['uraian'] as $i)
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            $nama_kategori = $this->M_filter->getNamaKategoriById($i);
            array_push($data['listUraian'], $nama_kategori);

            $pos = 0;
            foreach ($data['tahun'] as $t) 
            {
                $nilai = $this->M_update->getNilaiByKategori($i, $t, $data['periode'], $data['aspek']);
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
