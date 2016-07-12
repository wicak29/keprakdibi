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
        $this->load->helper(array('url','download'));

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('login');
        }
    }

	public function index()
    {
        $this->load->model('pelabuhan/M_pelabuhan');

        $data['title'] = "Pelabuhan";

        $data['list_pelabuhan'] = $this->M_pelabuhan->getListPelabuhan();
        $data['list_pic'] = $this->M_pelabuhan->getListPICPelabuhan();
        $data['list_data_pelabuhan'] = $this->M_pelabuhan->getListDataPelabuhan();
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_index');
        $this->load->view('V_footer_table');
    }

    public function viewImportExcel()
    {
        $this->load->model('pelabuhan/M_pelabuhan');

        $data['title'] = "Pelabuhan";

        $data['list_pelabuhan'] = $this->M_pelabuhan->getListPelabuhan();
        $data['list_pic'] = $this->M_pelabuhan->getListPICPelabuhan();
        $data['list_data_pelabuhan'] = $this->M_pelabuhan->getListDataPelabuhan();
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_index');
        $this->load->view('V_footer_table');
    }

    public function downloadFormatImport()
    {            
        $data = file_get_contents(base_url('assets/format_input/Format-Input-Data-Arus-Bongkar-Muat-Pelabuhan.xlsx')); 
        force_download('Format-Input-Data-Arus-Bongkar-Muat-Pelabuhan.xlsx',$data);
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
        redirect(base_url('/pelabuhan/viewImportExcel'));
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

        //CEK FORMAT INPUT 
        $cekFormat = $sheet->rangeToArray('B' . 6 . ':' . 'D' . 6, NULL, TRUE, FALSE);
        // print_r($cekFormat);
        // return;
        if ($cekFormat[0][0]!="Jenis Data" AND $cekFormat[0][1]!="Satuan " AND $cekFormat[0][2]!="Realisasi ")
        {
            $this->session->set_flashdata('notif', 5);
            delete_files('./temp_upload/');
            redirect(base_url('pelabuhan/viewImportExcel'));
        }

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
        redirect(base_url('pelabuhan/viewImportExcel'));
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

        $data['title'] = "Rekap Pelabuhan";
        $this->load->view('V_headChartTable', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_rekapPelabuhan');
        $this->load->view('V_footerChartTable'); 
    }

    public function deleteKontak($id)
    {
        $update = $this->M_pelabuhan->updateDataKontak($id);
        $result = $this->M_pelabuhan->deleteKontak($id);
        redirect('pelabuhan/viewLihatKontak');
    }

    public function viewLihatKontak()
    {
        $data['title'] = "Daftar Kontak Pelabuhan";
        $data['list_kontak'] = $this->M_pelabuhan->getDetailKontak();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_lihatKontak');
        $this->load->view('V_footer');
    }

    public function addKontakToPelabuhan()
    {
        $data['kontak'] = $this->input->post('id_kontak');
        $result = $this->M_pelabuhan->addKontak($data['kontak']);
        if ($result)
        {
            $this->session->set_flashdata('notif', 1);
        }
        else $this->session->set_flashdata('notif', 2);
        redirect('pelabuhan/viewLihatKontak');
    }

    public function viewTambahKontak()
    {
        $data['title'] = "Tambah Kontak Pelabuhan";
        $data['list_kontak'] = $this->M_pelabuhan->getKontakNotPelabuhan();

        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_tambahKontak');
        $this->load->view('V_footer');
    }

    public function viewHapusKontak()
    {
        $data['title'] = "Hapus Kontak Pelabuhan";

        $data['list'] = $this->M_pelabuhan->getDetailKontak();
        // print_r($data['list']);
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('pelabuhan/V_topNavPelabuhan');
        $this->load->view('pelabuhan/V_hapusKontak');
        $this->load->view('V_footer_table');
    }

    public function hapusKontakBanyak() 
    {
        $data = $this->input->post('data');
        
        for ($i=0; $i<sizeof($data); $i++)
        {
            $piece = explode("#", $data[$i]);
            $id_kontak = $piece[0];
            
            $update = $this->M_pelabuhan->updateDataKontak($id_kontak);
            $result = $this->M_pelabuhan->deleteKontak($id_kontak);
        }
        redirect('pelabuhan/viewLihatKontak');

    }

}
