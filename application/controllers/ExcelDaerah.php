<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Excel extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    public function index()
    {
        $this->load->view('excel');
    }
    public function upload()
    {
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './assets/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = './assets/'.$media['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(4);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $rowData = array();
            for ($row = 3; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
               
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                //  $data = array(
                //     //"idapbd"=> $rowData[0][0],
                //     "URAIAN"=> $rowData[0][0]
                // );
                 
                //sesuaikan nama dengan nama tabel

                //$insert = $this->db->insert('apbd',$data);
                //$insert = $this->db->insert('eimport',$data);
                // delete_files($media['file_path']);     
            }
            $this->load->model("M_user.php");
            $this->M_user->tambahUraian($rowData);
        redirect('excel/');
    }
}