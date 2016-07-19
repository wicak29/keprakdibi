<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_home extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('C_auth');
        }
    }
	
	public function downloadTutorial()
    {   
		$this->load->helper('download');
        $data = file_get_contents(base_url('assets/format_input/Tutorial-SIDIBI.pdf')); 
        force_download('Tutorial-SIDIBI.pdf',$data);
    }

    public function index()
    {
        $data['title'] = "Home";
                
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNavHome');
        $this->load->view('V_home');
        $this->load->view('V_footer');
    }
}