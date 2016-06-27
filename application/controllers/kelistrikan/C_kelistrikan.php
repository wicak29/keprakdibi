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
            redirect('login');
        }
    }

	public function index()
    {
        $this->load->model('kelistrikan/M_kelistrikan');

        $data['title'] = "Kelistrikan";

        $data['list_pic'] = $this->M_kelistrikan->getListPIC();
        $data['list_data_kelistrikan'] = $this->M_kelistrikan->getListDataKelistrikan();
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_index');
        $this->load->view('V_footer_table');
    }

    public function viewImportExcel()
    {
        $this->load->model('kelistrikan/M_kelistrikan');

        $data['title'] = "Kelistrikan";

        $data['list_pic'] = $this->M_kelistrikan->getListPIC();
        $data['list_data_kelistrikan'] = $this->M_kelistrikan->getListDataKelistrikan();
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_index');
        $this->load->view('V_footer_table');
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
        redirect(base_url('/kelistrikan/viewImportExcel'));
    }

    public function insertDataKelistrikan()
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

        $ErrorHandling = $this->M_kelistrikan->getKelistrikanDataError($tahun, $periode);

        if (empty($ErrorHandling)){
            //echo "wow";
            for ($row = 7; $row <= $highestRow; $row++){
                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                $importFile = $this->M_kelistrikan->tambahDataKelistrikan($rowData, $periode, $tahun, $pic, $row-6);
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
        redirect(base_url('kelistrikan/viewImportExcel'));
    }

    public function viewRekapKelistrikan()
    {
        $this->load->model('kelistrikan/M_filter');
        $data['tahun'] = $this->input->post('tahun');
        $data['aspek'] = $this->input->post('aspek');
        $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        
        if ($data['aspek']) 
        {
            $data['nama_aspek'] = $this->M_filter->getAspekById($data['aspek']);
        }
        // LIST DATA PADA TABEL
        $data['nilai_tabel'] = array();
        for ($i = 1; $i <= 5; $i++) 
        {
            $nama_kategori = $this->M_filter->getNamaKategoriById($i);
            
            $listNilaiBulan = array();
            foreach ($bulan as $j)                
            {
                $result = $this->M_kelistrikan->getNilaiPerBulan($i, $data['tahun'], $j, $data['aspek']);
                if (!$result) $result=0;
                else $result = $result[0]['NILAI'];
                array_push($listNilaiBulan, $result);
            }
            array_push($listNilaiBulan, $nama_kategori);
            array_push($data['nilai_tabel'], $listNilaiBulan);
        }
        // print_r($data['nilai_tabel']);
        // return;
        //END LIST DATA PAD TABEL
        
        $data['finalResult'] = array();
        for ($i=1; $i<=5; $i++)
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            $nama_kategori = $this->M_filter->getNamaKategoriById($i);
            array_push($data['listUraian'], $nama_kategori);

            $pos = 0;
            foreach ($bulan as $d)
            {
                $nilai = $this->M_kelistrikan->getNilaiPerBulan($i, $data['tahun'], $d, $data['aspek']);
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

        $data['title'] = "Rekap Kelistrikan";
        $this->load->view('V_headChartTable', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_rekapKelistrikan');
        $this->load->view('V_footerChartTable'); 
    }

    public function deleteKontak($id)
    {
        $update = $this->M_kelistrikan->updateDataKontak($id);
        $result = $this->M_kelistrikan->deleteKontak($id);
        redirect('kelistrikan/viewLihatKontak');
    }

    public function viewLihatKontak()
    {
        $data['title'] = "Daftar Kontak Kelistrikan";
        $data['list_kontak'] = $this->M_kelistrikan->getDetailKontak();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_lihatKontak');
        $this->load->view('V_footer');
    }

    public function addKontakToKelistrikan()
    {
        $data['kontak'] = $this->input->post('id_kontak');
        $result = $this->M_kelistrikan->addKontak($data['kontak']);
        if ($result)
        {
            $this->session->set_flashdata('notif', 1);
        }
        else $this->session->set_flashdata('notif', 2);
        redirect('kelistrikan/viewLihatKontak');
    }

    public function viewTambahKontak()
    {
        $data['title'] = "Tambah Kontak Kelistrikan";
        $data['list_kontak'] = $this->M_kelistrikan->getKontakNotKelistrikan();

        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_tambahKontak');
        $this->load->view('V_footer');
    }

    public function viewHapusKontak()
    {
        $data['title'] = "Hapus Kontak Kelistrikan";

        $data['list'] = $this->M_kelistrikan->getDetailKontak();
        // print_r($data['list']);
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('kelistrikan/V_topNavKelistrikan');
        $this->load->view('kelistrikan/V_hapusKontak');
        $this->load->view('V_footer_table');
    }

    public function hapusKontakBanyak() 
    {
        $data = $this->input->post('data');
        
        for ($i=0; $i<sizeof($data); $i++)
        {
            $piece = explode("#", $data[$i]);
            $id_kontak = $piece[0];
            
            $update = $this->M_kelistrikan->updateDataKontak($id_kontak);
            $result = $this->M_kelistrikan->deleteKontak($id_kontak);
        }
        redirect('kelistrikan/viewLihatKontak');

    }

}
