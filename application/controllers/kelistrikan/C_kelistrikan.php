<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_kelistrikan extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("file");
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->model('kelistrikan/M_kelistrikan');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('C_auth');
        }
    }

	public function index()
    {
        $this->load->model('kelistrikan/M_kelistrikan');

        $data['title'] = "Kelistrikan";

        // $data['list_pelabuhan'] = $this->M_pelabuhan->getListPelabuhan();
        // $data['list_pic'] = $this->M_pelabuhan->getListPICPelabuhan();
        // $data['list_data_pelabuhan'] = $this->M_pelabuhan->getListDataPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_index');
        $this->load->view('V_footer');
    }

    public function viewImportExcel()
    {
        $this->load->model('kelistrikan/M_kelistrikan');

        $data['title'] = "Kelistrikan";

        // $data['list_pelabuhan'] = $this->M_pelabuhan->getListPelabuhan();
        // $data['list_pic'] = $this->M_pelabuhan->getListPICPelabuhan();
        // $data['list_data_pelabuhan'] = $this->M_pelabuhan->getListDataPelabuhan();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_index');
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

                $this->M_kelistrikan->tambahUraian($rowData);     
            }
            
        delete_files('./temp_upload/');
        redirect(base_url('/kelistrikan/C_kelistrikan/viewImportExcel'));
    }

    // public function insertDataPelabuhan()
    // {
    //     $fileName = time().$_FILES['file']['name'];
         
    //     $config['upload_path'] = './temp_upload/'; //buat folder dengan nama assets di root folder
    //     $config['file_name'] = $fileName;
    //     $config['allowed_types'] = 'xls|xlsx|csv';
    //     $config['max_size'] = 1000000;
         
    //     $this->load->library('upload');
    //     $this->upload->initialize($config);
        
    //     $tahun = $this->input->post('tahun');
    //     $periode = $this->input->post('bulan');
    //     $pelabuhan = $this->input->post('id_pelabuhan');
    //     //$daerah = 1;
    //     $pic = $this->input->post('id_kontak');
         
    //     if(! $this->upload->do_upload('file') )
    //     $this->upload->display_errors();
             
    //     $media = $this->upload->data('file');
    //     $inputFileName = './temp_upload/'.$media['file_name'];
         
    //     try {
    //             $inputFileType = IOFactory::identify($inputFileName);
    //             $objReader = IOFactory::createReader($inputFileType);
    //             $objPHPExcel = $objReader->load($inputFileName);

    //         } catch(Exception $e) {
    //             die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    //         }
 
    //     $sheet = $objPHPExcel->getSheet(0);
    //     $highestRow = $sheet->getHighestRow();
    //     $highestColumn = $sheet->getHighestColumn();      
    //     $rowData = array();

    //     $ErrorHandling = $this->M_pelabuhan->getPelabuhanDataError($pelabuhan, $tahun, $periode);

    //     if (empty($ErrorHandling)){
    //         //echo "wow";
    //         for ($row = 7; $row <= $highestRow; $row++){
    //               //  Read a row of data into an array                 
    //             $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
    //                                             NULL,
    //                                             TRUE,
    //                                             FALSE);

    //             $importFile = $this->M_pelabuhan->tambahDataPelabuhan($rowData, $periode, $tahun, $pic, $row-6, $pelabuhan);
    //         }
    //         if ($importFile){
    //             $this->session->set_flashdata('notif', 1);
    //         }
    //         else{
    //             $this->session->set_flashdata('notif', 2);
    //         }
            
    //     }
    //     elseif ($ErrorHandling) {

    //         $this->session->set_flashdata('notif', 3);
    //     }
    //     delete_files('./temp_upload/');
    //     redirect(base_url('pelabuhan/C_pelabuhan/viewImportExcel'));
    // }

}
