<?php

class C_importExcel extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->model('M_user');
    }
    
    public function index()
    {
        $this->load->view('V_importExcel');
    }

    public function do_upload()
    {
        $config['upload_path'] = './temp_upload/';
        $config['allowed_types'] = 'xls|xlsx|csv';
                
        $this->load->library('upload', $config);
                

        if ( ! $this->upload->do_upload())
        {
            $data = array('error' => $this->upload->display_errors());
            print_r("haha");
        }
        else
        {
            print_r("hehe");
            $data = array('error' => false);
            $upload_data = $this->upload->data();

            $this->load->library('excel_reader');
            $this->excel_reader->setOutputEncoding('CP1251');

            $file =  $upload_data['full_path'];
            $this->excel_reader->read($file);
            error_reporting(E_ALL ^ E_NOTICE);

            // Sheet 1
            print_r("hehe");
            $data = $this->excel_reader->sheets[0] ;
                        $dataexcel = Array();
            for ($i = 1; $i <= $data['numRows']; $i++) 
            {

                            if($data['cells'][$i][1] == '') break;
                            $dataexcel[$i-1]['nama'] = $data['cells'][$i][1];
                            $dataexcel[$i-1]['alamat'] = $data['cells'][$i][2];

            }
                        
            delete_files($upload_data['file_path']);
            print_r("Yay");
            $this->M_user->tambahuser($dataexcel);
            $data['user'] = $this->M_user->getuser();
        }
        $this->load->view('V_hasil', $data);
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */