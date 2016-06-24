<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_penerbangan extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("file");
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->model('penerbangan/M_penerbangan');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('C_auth');
        }
    }

	public function index()
    {
        $this->load->model('penerbangan/M_penerbangan');

        $data['title'] = "Penerbangan";

        $data['list_data_penerbangan'] = $this->M_penerbangan->getListDataPenerbangan();
        $data['list_pic'] = $this->M_penerbangan->getListPIC();
        //$data['list_data_kendaraan'] = $this->M_penerbangan->getListDataKendaraan();
        if(!$data['list_data_penerbangan']) $data['list_data_penerbangan'] = array();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_index');
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
        redirect(base_url('/penerbangan/C_penerbangan/'));
    }

    public function insertDataPenerbangan()
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

        // $data_upt = $this->M_kendaraan->getDataUPT();
        //$data_identitas = $this->M_penerbangan->getIdEntitas();
        
        $ErrorHandling = $this->M_penerbangan->getPenerbanganDataError($tahun, $periode);
        //print_r($entitas);
        // $ind = 0;
        // $indHelp = 0;
        if (empty($ErrorHandling)){
            //echo "wow";
            for ($row = 9; $row <= $highestRow; $row++){
                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                
                // if($indHelp == 2){
                //     $indHelp = 0;
                //     $ind++;
                // }
                // $indHelp++;
                //print_r($entitas[$ind]);
                $importFile = $this->M_penerbangan->tambahDataPenerbangan($rowData, $periode, $tahun, $pic);
                

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
        redirect(base_url('penerbangan/C_penerbangan/'));
    }

}
