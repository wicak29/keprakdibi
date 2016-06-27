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
            redirect('login');
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
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_index');
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
            for ($row = 4; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);

                $this->M_kendaraan->tambahUraian($rowData);     
            }
            
        delete_files('./temp_upload/');
        redirect(base_url('/penerbangan/'));
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
        redirect(base_url('penerbangan/'));
    }

    public function deleteKontak($id)
    {
        $update = $this->M_penerbangan->updateDataKontak($id);
        $result = $this->M_penerbangan->deleteKontak($id);
        redirect('penerbangan/viewLihatKontak');
    }

    public function viewLihatKontak()
    {
        $data['title'] = "Daftar Kontak Kelistrikan";
        $data['list_kontak'] = $this->M_penerbangan->getDetailKontak();
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_lihatKontak');
        $this->load->view('V_footer');
    }

    public function addKontakToPenerbangan()
    {
        $data['kontak'] = $this->input->post('id_kontak');
        $result = $this->M_penerbangan->addKontak($data['kontak']);
        if ($result)
        {
            $this->session->set_flashdata('notif', 1);
        }
        else $this->session->set_flashdata('notif', 2);
        redirect('penerbangan/viewLihatKontak');
    }

    public function viewTambahKontak()
    {
        $data['title'] = "Tambah Kontak Penerbangan";
        $data['list_kontak'] = $this->M_penerbangan->getKontakNotPenerbangan();

        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_tambahKontak');
        $this->load->view('V_footer');
    }

    public function viewHapusKontak()
    {
        $data['title'] = "Hapus Kontak Penerbangan";

        $data['list'] = $this->M_penerbangan->getDetailKontak();
        // print_r($data['list']);
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_hapusKontak');
        $this->load->view('V_footer_table');
    }

    public function hapusKontakBanyak() 
    {
        $data = $this->input->post('data');
        
        for ($i=0; $i<sizeof($data); $i++)
        {
            $piece = explode("#", $data[$i]);
            $id_kontak = $piece[0];
            
            $update = $this->M_penerbangan->updateDataKontak($id_kontak);
            $result = $this->M_penerbangan->deleteKontak($id_kontak);
        }
        redirect('penerbangan/viewLihatKontak');

    }

    public function viewRekapPenerbangan()
    {
        $this->load->model('penerbangan/M_filter');
        $data['list_entitas'] = $this->M_filter->getEntitas();
        $data['rute'] = $this->input->post('rute');
        $data['kategori'] = $this->input->post('kategori');
        $data['tahun'] = $this->input->post('tahun');
        $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        
        if (!$data['kategori']) $entitas = array();
        // print_r($data['kategori']);

        if ($data['kategori']=="Pesawat")
        {
            $entitas = array('1', '2', '3');
        }
        elseif ($data['kategori']=="Penumpang") 
        {
            $entitas = array('4', '5', '6');
        }
        elseif ($data['kategori']=="Bagasi") 
        {
            $entitas = array('7', '8', '9');
        }
        elseif ($data['kategori']=="Cargo")
        {
            $entitas = array('10', '11', '12');
        }
        elseif ($data['kategori']=="Pos")
        {
            $entitas = array('13', '14', '15');
        }
        
        // LIST DATA PADA TABEL
        $data['nilai_tabel'] = array();
        // print_r(sizeof($entitas));
        if ($data['kategori'])
        {
            for ($i = 1; $i <= 3; $i++) 
            {
                if ($i==1) $akt = "Datang";
                elseif ($i==2) $akt = "Berangkat";
                elseif ($i==3) $akt = "Transit";

                $listNilaiBulan = array();
                foreach ($bulan as $j)                
                {
                    $result = $this->M_penerbangan->getNilaiPerBulan($entitas[$i-1], $data['tahun'], $j, $data['rute']);
                    if (!$result) $result=0;
                    else $result = $result[0]['NILAI'];
                    array_push($listNilaiBulan, $result);
                }
                array_push($listNilaiBulan, $akt);
                array_push($data['nilai_tabel'], $listNilaiBulan);
            }
            // print_r($data['nilai_tabel']);
        }   
        // return;
        //END LIST DATA PAD TABEL
        
        $data['finalResult'] = array();
        for ($i=1; $i<=3; $i++)
        {
            $data['listUraian'] = array();
            $data['list_nilai']="";
            if ($i==1) $akt = "Datang";
            elseif ($i==2) $akt = "Berangkat";
            elseif ($i==3) $akt = "Transit";
            array_push($data['listUraian'], $akt);

            $pos = 0;
            if ($data['kategori'])
            {
                foreach ($bulan as $d)
                {
                    $nilai = $this->M_penerbangan->getNilaiPerBulan($entitas[$i-1], $data['tahun'], $d, $data['rute']);
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
        }        
        // print_r($data['finalResult']);

        $data['title'] = "Rekap Kelistrikan";
        $this->load->view('V_headChartTable', $data);
        $this->load->view('V_sidebar');
        $this->load->view('penerbangan/V_topNavPenerbangan');
        $this->load->view('penerbangan/V_rekapPenerbangan');
        $this->load->view('V_footerChartTable'); 
    }

}
