<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_pic extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pic');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        if (!$login) 
        {
            redirect('C_auth');
        }
    }

    public function viewTambahPic()
    {
        $data['title'] = "Tambah Kontak";
    	$this->load->view('V_head', $data);
    	$this->load->view('V_sidebar');
    	$this->load->view('V_topNav');
        $this->load->view('pic/V_tambahPic');
        $this->load->view('V_footer');
    }

    public function viewLihatPic()
    {
        $data['title'] = "Daftar Kontak";
        $data['list_pic'] = $this->M_pic->getPic()->result_array();

        $this->load->view('V_head', $data);
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('pic/V_lihatPic');
        $this->load->view('V_footer');
    }

    public function uploadKontak()
    {
        
        $nama_instansi= $this->input->post('nama_instansi');
        $no_telp= $this->input->post('no_telp');
        $email= $this->input->post('email');
        $alamat= $this->input->post('alamat');
        $pic= $this->input->post('pic');
        $prefer= $this->input->post('prefer');

        $result = $this->M_pic->addKontak($nama_instansi,$no_telp,$email,$alamat,$pic,$prefer);
        if ($result)
        {
            $this->session->set_flashdata('notif', 1);
        }
        else
        {
            $this->session->set_flashdata('notif', 2);   
        }
        redirect('C_pic/viewLihatPic');
    }

    public function updateKontak()
    {
        $id = $this->session->flashdata('idkontak');
        $nama_instansi= $this->input->post('nama_instansi');
        $no_telp= $this->input->post('no_telp');
        $email= $this->input->post('email');
        $alamat= $this->input->post('alamat');
        $pic= $this->input->post('pic');
        $prefer= $this->input->post('prefer');

        $data = array(
            'NAMA_INSTANSI' => $nama_instansi,
            'NO_TELEPON' => $no_telp,
            'EMAIL' => $email,
            'ALAMAT' => $alamat,
            'PIC' => $pic,
            'PREFERRED_CONTACT' => $prefer
        );

        $result = $this->M_pic->updateKontak($id, $data);

        redirect('C_pic/viewLihatPic');
    }

    public function viewUpdatePic($id)
    {
        // print_r($id);
        $data['kontak'] = $this->M_pic->getKontakByID($id);
        // print_r($data['kontak']);
        $this->session->set_flashdata('idkontak',$data['kontak']['ID_KONTAK']);

        $this->load->view('V_head');
        $this->load->view('V_sidebar');
        $this->load->view('V_topNav');
        $this->load->view('pic/V_updatePic', $data);
        $this->load->view('V_footer');
    }
}
