<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
session_start(); //we need to start session in order to access it through CI

class C_admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');

        //AUTENTIKASI
        $login = $this->session->userdata('username');
        $var = $this->session->userdata;
        if (!$login) 
        {
            redirect('C_auth');
        }
        elseif ($var['level']!="admin") 
        {
            redirect('home');
        }
    }

    public function index()
    {
        $data['title'] = "Admin";
        $data['user'] = $this->M_admin->getUser()->result_array();
        // print_r($data['user']);
        
        $this->load->view('V_head_table', $data);
        $this->load->view('V_sidebarAdmin');
        $this->load->view('V_topNavAdmin');
        $this->load->view('admin/V_index');
        $this->load->view('V_footer_table');
    }

    public function addUser()
    {
        
        $username= $this->input->post('username');
        $pass= $this->input->post('pass');
        $level= $this->input->post('level');

        $result = $this->M_admin->addUser($username, $pass, $level);
        if ($result)
        {
            $this->session->set_flashdata('notif', 1);
        }
        else
        {
            $this->session->set_flashdata('notif', 2);   
        }
        redirect('C_admin/');
    }

    public function viewTambahUser()
    {
        $data['title'] = "Tambah User";
        $this->load->view('V_head', $data);
        $this->load->view('V_sidebarAdmin');
        $this->load->view('V_topNavAdmin');
        $this->load->view('admin/V_tambahAdmin');
        $this->load->view('V_footer');
    }

    public function updateKontak()
    {
        $id = $this->session->flashdata('idkontak');
        $username= $this->input->post('username');
        $pass= $this->input->post('pass');
        $level= $this->input->post('level');

        $data = array(
            'USERNAME' => $username,
            'PASSWORD' => sha1($pass),
            'LEVEL' => $level
        );

        $result = $this->M_admin->updateKontak($id, $data);
        redirect('C_admin/');
    }

    public function viewUpdateAdmin($id)
    {
        $data['title'] = "Update User";
        $data['user'] = $this->M_admin->getUserByID($id);
        // print_r($data['kontak']);
        $this->session->set_flashdata('idkontak',$data['user']['ID_USER']);

        $this->load->view('V_head', $data);
        $this->load->view('V_sidebarAdmin');
        $this->load->view('V_topNavAdmin');
        $this->load->view('admin/V_updateAdmin');
        $this->load->view('V_footer');
    }

    public function deleteUser($id)
    {
        $result = $this->M_admin->deleteKontak($id);
        redirect('C_admin');
    }

}
