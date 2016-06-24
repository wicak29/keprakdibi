<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_kendaraan extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("file");
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->model('kendaraan/M_kendaraan');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('login');
        }
    }

	public function index()
    {
        $this->load->model('kendaraan/M_kendaraan');

        $data['title'] = "Kendaraan";

        // $data['list_pelabuhan'] = $this->M_pelabuhan->getListPelabuhan();
        $data['list_pic'] = $this->M_kendaraan->getListPIC();
        $data['list_data_kendaraan'] = $this->M_kendaraan->getListDataKendaraan();
        if(!$data['list_data_kendaraan']) $data['list_data_kendaraan'] = array();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_index');
        $this->load->view('V_footer');
    }

    public function insertUraian()
    {
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './temp_upload/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = './temp_upload/'.$media['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $rowData = array();
            for ($row = 4; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                $this->M_kendaraan->tambahUraian($rowData);     
            }
            
        delete_files('./temp_upload/');
        redirect(base_url('/kendaraan/'));
    }

    public function insertDataKendaraan()
    {
        $fileName = time().$_FILES['file']['name'];
    
        $config['upload_path'] = './temp_upload/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 1000000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
        
        $tahun = $this->input->post('tahun');
        $periode = $this->input->post('bulan');
        // $pelabuhan = $this->input->post('id_pelabuhan');
        //$daerah = 1;
        $pic = $this->input->post('id_kontak');
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = './temp_upload/'.$media['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);

            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();      
        $rowData = array();

        $data_upt = $this->M_kendaraan->getDataUPT();

        $ErrorHandling = $this->M_kendaraan->getKendaraanDataError($tahun, $periode);

        $ind = 0;
        $indHelp = 0;
        if (empty($ErrorHandling)){
            //echo "wow";
            for ($row = 7; $row <= $highestRow; $row++){
                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                
                if($indHelp == 2){
                    $indHelp = 0;
                    $ind++;
                }
                $indHelp++;
                $importFile = $this->M_kendaraan->tambahDataKendaraan($rowData, $periode, $tahun, $data_upt[$ind]['KODE_UPT'], $pic);
                //print_r($ind);
            }
            if ($importFile){
                $this->session->set_flashdata('notif', 1);
            }
            else{
                $this->session->set_flashdata('notif', 2);
            }
            
        }
        elseif ($ErrorHandling) {

            $this->session->set_flashdata('notif', 3);
        }
        delete_files('./temp_upload/');
        redirect(base_url('kendaraan/'));
    }

    public function viewRekapKendaraan()
    {
        $this->load->model('kendaraan/M_filter');
        $data['tahun'] = $this->input->post('tahun');
        $data['id_upt'] = $this->input->post('upt');
        $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        
        $jenis = array('Sepeda motor dan sejenisnya', 'Mobil dan sejenisnya');
        $data['nilai_tabel'] = array();
        
        $data['upt'] = $this->M_filter->getUraianKendaraan();
        if ($data['id_upt']) $data['nama_upt'] = $this->M_filter->getUptById($data['id_upt']);
        // print_r($data['upt']);

        foreach ($data['upt'] as $i)
        {
            $listNilaiBulan = array();
            foreach ($bulan as $j)                
            {
                $nilaiJenis = array();
                foreach ($jenis as $k) 
                {
                    $result = $this->M_kendaraan->getNilaiPerBulan($i['KODE_UPT'], $data['tahun'], $j, $k);
                    if (!$result) $result=0;
                    else $result = $result[0]['NILAI'];
                    array_push($nilaiJenis, $result);
                }
                array_push($listNilaiBulan, $nilaiJenis);
            }
            array_push($listNilaiBulan, $i);
            array_push($data['nilai_tabel'], $listNilaiBulan);
        }
        // print_r($data['nilai_tabel']);
        //END LIST DATA PAD TABEL
        
        $data['finalResult'] = array();
        foreach ($jenis as $i)
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            array_push($data['listUraian'], $i);

            $pos = 0;
            foreach ($bulan as $d)
            {
                $nilai = $this->M_kendaraan->getNilaiPerBulan($data['id_upt'], $data['tahun'], $d, $i);
                // print_r($nilai);
                if ($nilai)
                {
                    if ($pos  != 11)
                        $data['list_nilai'] .= $nilai[0]['NILAI'].",";
                    else
                        $data['list_nilai'] .= $nilai[0]['NILAI']."";
                }
                else
                {
                    if ($pos != 11)
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

        $data['title'] = "Rekap Kendaraan";
        $this->load->view('V_headChartTable', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_rekapKendaraan');
        $this->load->view('V_footerChartTable'); 
    }

    public function deleteKontak($id)
    {
        $update = $this->M_kendaraan->updateDataKontak($id);
        $result = $this->M_kendaraan->deleteKontak($id);
        redirect('kendaraan/viewLihatKontak');
    }

    public function viewLihatKontak()
    {
        $data['title'] = "Daftar Kontak Kendaraan";
        $data['list_kontak'] = $this->M_kendaraan->getDetailKontak();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_lihatKontak');
        $this->load->view('V_footer');
    }

    public function addKontakToKendaraan()
    {
        $data['kontak'] = $this->input->post('id_kontak');
        $result = $this->M_kendaraan->addKontak($data['kontak']);
        if ($result)
        {
            $this->session->set_flashdata('notif', 1);
        }
        else $this->session->set_flashdata('notif', 2);
        redirect('kendaraan/viewLihatKontak');
    }

    public function viewTambahKontak()
    {
        $data['title'] = "Tambah Kontak Kendaraan";
        $data['list_kontak'] = $this->M_kendaraan->getKontakNotKendaraan();

        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_tambahKontak');
        $this->load->view('V_footer');
    }

    public function viewHapusKontak()
    {
        $data['title'] = "Hapus Kontak Kendaraan";

        $data['list'] = $this->M_kendaraan->getDetailKontak();
        // print_r($data['list']);
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kendaraan/V_topNavKendaraan');
        $this->load->view('kendaraan/V_hapusKontak');
        $this->load->view('V_footer_table');
    }

    public function hapusKontakBanyak() 
    {
        $data = $this->input->post('data');
        
        for ($i=0; $i<sizeof($data); $i++)
        {
            $piece = explode("#", $data[$i]);
            $id_kontak = $piece[0];
            
            $update = $this->M_kendaraan->updateDataKontak($id_kontak);
            $result = $this->M_kendaraan->deleteKontak($id_kontak);
        }
        redirect('kendaraan/viewLihatKontak');

    }

}
