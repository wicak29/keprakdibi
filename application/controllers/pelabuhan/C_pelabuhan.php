<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_pelabuhan extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("file");
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->model('pelabuhan/M_pelabuhan');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('C_auth');
        }
    }

	public function index()
    {
        $this->load->model('pelabuhan/M_pelabuhan');

        $data['title'] = "Pelabuhan";

        $data['list_pelabuhan'] = $this->M_pelabuhan->getListPelabuhan();
        $data['list_pic'] = $this->M_pelabuhan->getListPICPelabuhan();
        $data['list_data_pelabuhan'] = $this->M_pelabuhan->getListDataPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_index');
        $this->load->view('V_footer');
    }

    public function viewImportExcel()
    {
        $this->load->model('pelabuhan/M_pelabuhan');

        $data['title'] = "Pelabuhan";

        $data['list_pelabuhan'] = $this->M_pelabuhan->getListPelabuhan();
        $data['list_pic'] = $this->M_pelabuhan->getListPICPelabuhan();
        $data['list_data_pelabuhan'] = $this->M_pelabuhan->getListDataPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_index');
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
            for ($row = 7; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
               
                //print_r($rowData);

                $this->M_pelabuhan->tambahUraian($rowData);     
            }
            
        delete_files('./temp_upload/');
        redirect(base_url('/pelabuhan/C_pelabuhan/viewImportExcel'));
    }

    public function insertDataPelabuhan()
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
        $pelabuhan = $this->input->post('id_pelabuhan');
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

        $ErrorHandling = $this->M_pelabuhan->getPelabuhanDataError($pelabuhan, $tahun, $periode);

        if (empty($ErrorHandling)){
            //echo "wow";
            for ($row = 7; $row <= $highestRow; $row++){
                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                $importFile = $this->M_pelabuhan->tambahDataPelabuhan($rowData, $periode, $tahun, $pic, $row-6, $pelabuhan);
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
        redirect(base_url('pelabuhan/C_pelabuhan/viewImportExcel'));
    }

    public function viewRekapPelabuhan()
    {
        $this->load->model('pelabuhan/M_filter');
        $data['pelabuhan'] = $this->M_filter->getListPelabuhan();
        $id_pelabuhan = $this->input->post('pelabuhan');
        $data['tahun'] = $this->input->post('tahun');
        $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $data['nama_pelabuhan'] = $this->M_pelabuhan->getNamaPelabuhanById($id_pelabuhan);
        
        // LIST DATA PADA TABEL
        $data['nilai_tabel'] = array();
        for ($i = 1; $i <= 10; $i++) 
        {
            $uraian_satuan = $this->M_filter->getNamaUraianById($i);
            // $uraian_satuan = $nama_uraian['JENIS_DATA']." (".$nama_uraian['SATUAN'].")";
            $listNilaiBulan = array();
            foreach ($bulan as $j)                
            {
                $result = $this->M_pelabuhan->getNilaiPerBulan($i, $data['tahun'], $j, $id_pelabuhan);
                if (!$result) $result=0;
                else $result = $result[0]['NILAI'];
                array_push($listNilaiBulan, $result);
            }
            array_push($listNilaiBulan, $uraian_satuan);
            array_push($data['nilai_tabel'], $listNilaiBulan);
        }
        // print_r($data['nilai_tabel']);
        // return;
        //END LIST DATA PAD TABEL
        
        $data['finalResult'] = array();
        for ($i=1; $i<=10; $i++)
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            $nama_uraian = $this->M_filter->getNamaUraianById($i);
            $uraian_satuan = $nama_uraian['JENIS_DATA']." (".$nama_uraian['SATUAN'].")";
            array_push($data['listUraian'], $uraian_satuan);

            $pos = 0;
            foreach ($bulan as $d)
            {
                $nilai = $this->M_pelabuhan->getNilaiPerBulan($i, $data['tahun'], $d, $id_pelabuhan);
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

        $data['title'] = "Rekap APBD";
        $this->load->view('V_headChartTable', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_rekapPelabuhan');
        $this->load->view('V_footerChartTable'); 
    }

}
