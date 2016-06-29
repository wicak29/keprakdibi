<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_filter extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('kelistrikan/M_filter');

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
        $data['data_listrik'] = array();
        //$data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_cariData');
        $this->load->view('V_footer');
    }

    public function filterDataKelistrikan()
    {
        $data['title'] = "Cari Data Kelistrikan";

        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $data['data_listrik'] = array();

        $uraian = $this->M_filter->getUraianKelistrikan();
        array_push($data['data_listrik'], $uraian);

        for($i=1; $i<=3; $i++){
            $list = $this->M_filter->getListKelistrikan($i, $tahun, $bulan);
            if($list)
                array_push($data['data_listrik'], $list);
        }
        if (sizeof($data['data_listrik'])<4) {
            $data['data_listrik'] = array();
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
 
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_cariData');
        $this->load->view('V_footer_table');
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
            $data['nama_aspek'] = $this->M_filter->getAspekById($data['aspek']);
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
                $nilai = $this->M_filter->getNilaiByKategori($i, $t, $data['periode'], $data['aspek']);
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
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_grafikBulan');
        $this->load->view('V_footerChart');
    }
}
