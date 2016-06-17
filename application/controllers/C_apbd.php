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

        $data['list_provinsi'] = $this->M_apbd->getListDataProv();
        $data['list_apbdp'] = $this->M_apbd->getListDataApbdp();
        $data['list_kab'] = $this->M_apbd->getListDataKab();
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
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
               
                //print_r($rowData);

                $this->M_apbd->tambahUraian($rowData);     
            }
            
        delete_files('./temp_upload/');
        redirect(base_url('C_apbd/viewImportExcel'));
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

    public function insertDataAPBDbyProvinsi()
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
        $daerah = 1;
        $pic = $this->input->post('id_kontak');
        $data['list_apbdp'] = $this->M_apbd->getAPBDP($tahun,$daerah);
         
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
            //$sheet->getStyle('B3:J33')->getNumberFormat()->setFormatCode('text');
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            print_r($highestRow);
            //echo $highestColumn;
            $rowData = array();
            for ($row = 6; $row <= $highestRow; $row++)
            {                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                //$IDAPBD = $this->M_apbd->getIDAPBD($rowData[0][0]);
                //echo 'INI ID APBD = '. $IDAPBD;
                //print_r($rowData);
                $importFile = $this->M_apbd->tambahNilaiDaerah($rowData, $tahun, $daerah, $periode, $row-5, $pic, $data['list_apbdp']);
            }
            if ($importFile)
            {
                $this->session->set_flashdata('notif', 1);
            }
            delete_files('./temp_upload/');
            redirect(base_url('C_apbd/viewImportExcel'));
    }
    public function insertDataAPBDbyKabKota()
    {
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './temp_upload/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 1000000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
        
        $tahun = $this->input->post('tahun');
        $periode = $this->input->post('periode');
        $daerah = $this->input->post('daerah');
        $pic = $this->input->post('id_kontak');
        $data['list_apbdp'] = $this->M_apbd->getAPBDP($tahun,$daerah);
         
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
            //$sheet->getStyle('B3:J')->getNumberFormat()->setFormatCode('text');
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            //echo $highestRow;
            //echo $highestColumn;
            $rowData = array();
            for ($row = 6; $row <= $highestRow; $row++)
            {                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                //$IDAPBD = $this->M_apbd->getIDAPBD($rowData[0][0]);
                //echo 'INI ID APBD = '. $IDAPBD;
                $importFile = $this->M_apbd->tambahNilaiDaerah($rowData, $tahun, $daerah, $periode, $row-5, $pic, $data['list_apbdp']);
            }
            if ($importFile)
            {
                $this->session->set_flashdata('notif', 1);
            }
            delete_files('./temp_upload/');
            redirect(base_url('C_apbd/viewImportExcel'));
    }

    public function getUraian($id)
    {
        $result = $this->M_apbd->getUraian($id);
        print_r($result);
    }

    public function getNilaiByTahun($tahun)
    {
        $listNilai = array();
        for ($i = 1; $i <= 61; $i++) 
        {
            $uraian = $this->M_apbd->getUraian($i);
            $result = $this->M_apbd->getNilai($tahun, $i);
            array_push($result, $uraian);
            array_push($listNilai, $result);
        }
        // print_r($listNilai);
        // return;
        // $result = $this->M_apbd->getNilai($tahun);
        header('Content-Type: application/json');
        echo json_encode($listNilai);
    }

    public function insertDataAPBDP()
    {
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './temp_upload/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 1000000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
        
        $tahun = $this->input->post('tahun');
        $daerah = $this->input->post('daerah');
       
         
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
            //$sheet->getStyle('B3:J63')->getNumberFormat()->setFormatCode('text');
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            //echo $highestRow;
            //echo $highestColumn;
            $rowData = array();
            for ($row = 6; $row <= $highestRow; $row++)
            {                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                //$IDAPBD = $this->M_apbd->getIDAPBD($rowData[0][0]);
                //echo 'INI ID APBD = '. $IDAPBD;
                $importFile = $this->M_apbd->tambahNilaiAPBDPbyTahun($rowData, $tahun, $row-5, $daerah);
            }
            if ($importFile)
            {
                $this->session->set_flashdata('notif', 1);
            }
            delete_files('./temp_upload/');
            redirect(base_url('C_apbd/viewImportExcel'));
    }
    public function insertDataAPBDbyDaerah()
    {
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './temp_upload/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 1000000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
        
        $tahun = $this->input->post('tahun');
        $periode = $this->input->post('periode');
        $daerah = $this->input->post('daerah');
        $pic = $this->input->post('id_kontak');
        $data['list_apbdp'] = $this->M_apbd->getAPBDP($tahun,$daerah);
         
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
            //$sheet->getStyle('B3:J63')->getNumberFormat()->setFormatCode('text');
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            //echo $highestRow;
            //echo $highestColumn;
            $rowData = array();
            for ($row = 6; $row <= $highestRow; $row++)
            {                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                $IDAPBD = $this->M_apbd->getIDAPBD($rowData[0][0]);
                //echo 'INI ID APBD = '. $IDAPBD;
                $importFile = $this->M_apbd->tambahNilaiDaerah($rowData, $tahun, $periode, $row-5, $pic);
            }
            if ($importFile)
            {
                $this->session->set_flashdata('notif', 1);
            }
            delete_files('./temp_upload/');
            redirect(base_url('C_apbd/viewImportExcel'));
    }
}
