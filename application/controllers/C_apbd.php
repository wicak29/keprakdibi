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

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('C_auth');
        }
    }

	public function index()
    {
        $this->load->model('M_pic');

        $data['title'] = "APBD";
        $data['list_provinsi'] = $this->M_apbd->getListDataProv();
        $data['list_apbdp'] = $this->M_apbd->getListDataApbdp();
        $data['list_kab'] = $this->M_apbd->getListDataKab();
        $data['list_pic'] = $this->M_apbd->getListPICApbd();
        // print_r($data['list_pic']);
        // return;
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_index');
        $this->load->view('V_footer_table');
    }

    public function viewImportExcel()
    {
        $this->load->model('M_pic');

        $data['title'] = "Import File";
        $data['list_provinsi'] = $this->M_apbd->getListDataProv();
        $data['list_apbdp'] = $this->M_apbd->getListDataApbdp();
        $data['list_kab'] = $this->M_apbd->getListDataKab();
        $data['list_pic'] = $this->M_apbd->getListPICApbd();
        // print_r($data['list_pic']);
        // return;
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_index');
        $this->load->view('V_footer_table');
    }

    public function downloadFormatImportPlafon()
    {     
        $this->load->helper('download');
        $data = file_get_contents(base_url('assets/format_input/Format-Input-Plafon-Anggaran.xlsx')); 
        force_download('Format-Input-Plafon-Anggaran.xlsx',$data);
    }

    public function downloadFormatImportRealisasi()
    {            
        $this->load->helper('download');
        $data = file_get_contents(base_url('assets/format_input/Format-Input-Nilai-Realisasi-APBD.xlsx')); 
        force_download('Format-Input-Nilai Realisasi-APBD.xlsx',$data);
    } 

    public function viewRekapAPBD()
    {
        $data['uraian'] = $this->input->post('uraian');
        $data['tahun'] = $this->input->post('tahun');

        $data['jumlah_uraian'] = sizeof($data['uraian']);
        
        // LIST DATA PAD TABEL
        $data['nilai_tabel'] = array();
        for ($i = 1; $i <= 41; $i++) 
        {
            $uraian = $this->M_apbd->getUraian($i);
            $resultProv = $this->M_apbd->getNilaiTotalProv($data['tahun'], $i);   
            if (!$resultProv) $resultProv=0;
            $listNilaiKK = array();
            for ($j = 2; $j<=10; $j++)
            {
                $resultKK = $this->M_apbd->getNilaiTotalKK($data['tahun'], $i, $j);
                if (!$resultKK) $resultKK=0;
                array_push($listNilaiKK, $resultKK);
            }
            array_push($listNilaiKK, $resultProv);
            array_push($listNilaiKK, $uraian);
            array_push($data['nilai_tabel'], $listNilaiKK);
        }
        // print_r($data['nilai_tabel']);
        // return;
        // END LIST DATA PAD TABEL
        if (!$data['uraian']) $data['uraian'] = array(); 
        
        
        $data['finalResult'] = array();
        foreach ($data['uraian'] as $i) 
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            $nama_uraian = $this->M_apbd->getUraian($i);
            array_push($data['listUraian'], $nama_uraian);

            $pos = 0;

            for ($d=1; $d<=10; $d++) 
            {
                $nilai = $this->M_apbd->getNilaiByUraian($i, $data['tahun'], $d);
                // print_r($nilai);
                
                if ($nilai)
                {
                    if ($pos  != 9)
                        $data['list_nilai'] .= $nilai[0]['PERSEN_REALISASI'].",";
                    else
                        $data['list_nilai'] .= $nilai[0]['PERSEN_REALISASI']."";
                }
                else
                {

                    if ($pos != 9)
                        $data['list_nilai'] .= "0,";
                    else
                        $data['list_nilai'] .= "0";
                }
                $pos++;
            }
            array_push($data['listUraian'], $data['list_nilai']);
            array_push($data['finalResult'], $data['listUraian']);
        }        

        $data['title'] = "Rekap APBD";
        $this->load->view('V_headChartTable', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatAPBD');
        $this->load->view('V_footerChartTable'); 
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
           
            $rowData = array();
            $ErrorHandling = array();
            $ErrorHandling = $this->M_apbd->getAPBDDataError($daerah, $tahun, $periode);
            $ErrorHandlingAPBDP = $this->M_apbd->getAPBDPError($daerah, $tahun);
            //print_r($ErrorHandling);
            if (empty($ErrorHandling)){
                //echo "wow";
                //$this->session->set_flashdata('notif', 1);
                if($ErrorHandlingAPBDP){
                    for ($row = 6; $row <= $highestRow; $row++)
                    {                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                        $importFile = $this->M_apbd->tambahNilaiDaerah($rowData, $tahun, $daerah, $periode, $row-5, $pic, $data['list_apbdp']);
                    }
                    if ($importFile){
                        $this->session->set_flashdata('notif', 1);
                    }
                    else{
                        $this->session->set_flashdata('notif', 2);
                    }
                }
                else{
                $this->session->set_flashdata('notif', 4);
                }
            }
            elseif ($ErrorHandling) {

                $this->session->set_flashdata('notif', 3);
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
            
            $ErrorHandling = array();
            $ErrorHandling = $this->M_apbd->getAPBDDataError($daerah, $tahun, $periode);
            $ErrorHandlingAPBDP = $this->M_apbd->getAPBDPError($daerah, $tahun);
            $rowData = array();
            //print_r($ErrorHandling);
            if (empty($ErrorHandling)){
                //echo "wow";
                //$this->session->set_flashdata('notif', 1);
                if($ErrorHandlingAPBDP){
                    for ($row = 6; $row <= $highestRow; $row++)
                    {                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                        $importFile = $this->M_apbd->tambahNilaiDaerah($rowData, $tahun, $daerah, $periode, $row-5, $pic, $data['list_apbdp']);
                    }
                    if ($importFile){
                        $this->session->set_flashdata('notif', 1);
                    }
                    else{
                        $this->session->set_flashdata('notif', 2);
                    }
                }
                else{
                $this->session->set_flashdata('notif', 4);
                }

            }
            elseif ($ErrorHandling) {
                $this->session->set_flashdata('notif', 3);

            }
            // for ($row = 6; $row <= $highestRow; $row++)
            // {                  //  Read a row of data into an array                 
            //     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
            //                                     NULL,
            //                                     TRUE,
            //                                     FALSE);

            //     //$IDAPBD = $this->M_apbd->getIDAPBD($rowData[0][0]);
            //     //echo 'INI ID APBD = '. $IDAPBD;
            //     $importFile = $this->M_apbd->tambahNilaiDaerah($rowData, $tahun, $daerah, $periode, $row-5, $pic, $data['list_apbdp']);
            // }
            // if ($importFile)
            // {
            //     $this->session->set_flashdata('notif', 1);
            // }
            delete_files('./temp_upload/');
            redirect(base_url('C_apbd/viewImportExcel'));
    }

    public function getUraian($id)
    {
        $result = $this->M_apbd->getUraian($id);
        print_r($result);
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
            $ErrorHandling = array();
            $ErrorHandling = $this->M_apbd->getAPBDPError($daerah, $tahun);
            $rowData = array();
            //print_r($ErrorHandling);
            if (empty($ErrorHandling)){
                //echo "wow";
                //$this->session->set_flashdata('notif', 1);
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

    public function deleteKontak($id)
    {
        $update = $this->M_apbd->updateDataKontak($id);
        $result = $this->M_apbd->deleteKontak($id);
        redirect('apbd/viewLihatKontak');
    }

    public function viewLihatKontak()
    {
        $data['title'] = "Daftar Kontak APBD";
        $data['list_kontak'] = $this->M_apbd->getDetailKontak();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_lihatKontak');
        $this->load->view('V_footer');
    }

    public function addKontakToApbd()
    {
        $data['kontak'] = $this->input->post('id_kontak');
        $result = $this->M_apbd->addKontak($data['kontak']);
        if ($result)
        {
            $this->session->set_flashdata('notif', 1);
        }
        else $this->session->set_flashdata('notif', 2);
        redirect('apbd/viewLihatKontak');
    }

    public function viewTambahKontak()
    {
        $data['title'] = "Tambah Kontak APBD";
        $data['list_kontak'] = $this->M_apbd->getKontakNotApbd();

        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_tambahKontak');
        $this->load->view('V_footer');
    }

    public function viewHapusKontak()
    {
        $data['title'] = "Hapus Kontak APBD";

        $data['list'] = $this->M_apbd->getDetailKontak();
        // print_r($data['list']);
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('apbd/V_hapusKontak');
        $this->load->view('V_footer_table');
    }

    public function hapusKontakBanyak() 
    {
        $data = $this->input->post('data');
        
        for ($i=0; $i<sizeof($data); $i++)
        {
            $piece = explode("#", $data[$i]);
            $id_kontak = $piece[0];
            
            $update = $this->M_apbd->updateDataKontak($id_kontak);
            $result = $this->M_apbd->deleteKontak($id_kontak);
        }
        redirect('apbd/viewLihatKontak');

    }
}
