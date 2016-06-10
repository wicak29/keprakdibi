<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_apbd extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("file");
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->model('M_apbd');
    }

	public function index()
    {
        $this->load->model('M_pic');
        $data['list_pic'] = $this->M_pic->getPic()->result_array();
    	$this->load->view('V_head');
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('apbd/V_index', $data);
        $this->load->view('V_footer');
    }

    public function viewImportExcel()
    {
        $this->load->model('M_pic');
        $data['list_pic'] = $this->M_pic->getPic()->result_array();
        // print_r($data['list_pic']);
        // return;
        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_index', $data);
        $this->load->view('V_footer');
    }

    public function viewRekapAPBD()
    {
    	$this->load->view('V_head_table');
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBD');
        $this->load->view('V_footer_table');	
    }

    public function viewCariTable()
    {
    	$this->load->view('V_head');
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('apbd/V_cariTable');
        $this->load->view('V_footer');	
    }

    public function viewLihatStatistik()
    {
        $this->load->view('V_headCHart');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_statistik');
        $this->load->view('V_footerChart');  
    }

    public function importExcel()
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
            //echo $highestRow;
            //echo $highestColumn;
            $rowData = array();
            for ($row = 3; $row <= $highestRow; $row++)
            {                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                $this->M_apbd->tambahNilai($rowData);
            }
        delete_files('./temp_upload/');
        redirect(base_url('C_apbd/viewImportExcel'));
    }

    public function insertIntoAPBD()
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
            //echo $highestRow;
            //echo $highestColumn;
            $rowData = array();
            for ($row = 3; $row <= $highestRow; $row++)
            {                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . 'A' . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                $this->M_apbd->tambahUraian($rowData);
            }
        delete_files('./temp_upload/');
        redirect(base_url('C_apbd/viewImportExcel'));
    }

    public function insertDataAPBD()
    {
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './temp_upload/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 1000000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
        //tahun
        $tahun = $this->input->post('tahun');
         
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
            $sheet->getStyle('B3:J63')->getNumberFormat()->setFormatCode('text');
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            //echo $highestRow;
            //echo $highestColumn;
            $rowData = array();
            for ($row = 3; $row <= $highestRow; $row++)
            {                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

               //echo $row;
               //var_dump($rowData);
                //$this->load->model('M_apbd');
                $IDAPBD = $this->M_apbd->getIDAPBD($rowData[0][0]);
                //echo 'INI ID APBD = '. $IDAPBD;
                $this->M_apbd->tambahNilai($rowData,$tahun,$row-2);
            }
            delete_files('./temp_upload/');
            redirect(base_url('C_apbd/viewImportExcel'));
            // $this->load->model("M_APBD.php");
            //var_dump($rowData);
    }

    public function getUraian()
    {
        $result = $this->M_apbd->getUraian();
        print_r($result);
    }

    public function getNilaiByTahun($tahun)
    {
        $result = $this->M_apbd->getNilai($tahun);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
