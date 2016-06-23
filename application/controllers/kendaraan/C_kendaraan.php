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
            redirect('C_auth');
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

    // public function viewImportExcel()
    // {
    //     $this->load->model('kelistrikan/M_kelistrikan');

    //     $data['title'] = "Kelistrikan";

    //     // $data['list_pelabuhan'] = $this->M_pelabuhan->getListPelabuhan();
    //     $data['list_pic'] = $this->M_kelistrikan->getListPIC();
    //     $data['list_data_kelistrikan'] = $this->M_kelistrikan->getListDataKelistrikan();
    //     $this->load->view('V_head', $data);
    //     $this->load->view('V_sidebar');
    //     $this->load->view('kelistrikan/V_topNavKelistrikan');
    //     $this->load->view('kelistrikan/V_index');
    //     $this->load->view('V_footer');
    // }
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
        redirect(base_url('/kendaraan/C_kendaraan/'));
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
        redirect(base_url('kendaraan/C_kendaraan/'));
    }

}
