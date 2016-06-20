<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
session_start(); //we need to start session in order to access it through CI

class C_auth extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
    }


    public function index()
    {
        $data['title'] = "Login";

        $valid = $this->isLogin();
        if ($valid)
        {
            redirect('C_apbd/');
        }

        $this->load->view('V_head', $data);
        $this->load->view('user/V_login');
    }

    public function isLogin()
    {
        $res = $this->session->userdata('username');
        return $res;
    }

    public function login()
    {
        if (isset($_SESSION['username'])) 
        {
            redirect('C_apbd');
        }
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
            $username=$this->input->post('username'); 
            $password=$this->input->post('password');

            $res=$this->M_auth->login($username,$password);
            // print_r($res);
            print_r(sizeof($res));
            
            if(sizeof($res)>0)
            {
                // print_r($res);
                $session_data=array(
                    'username' => $res[0]['USERNAME'], 
                    'user_id' => $res[0]['ID_USER'],
                    'level' => $res[0]['LEVEL']
                    );

                $this->session->set_userdata($session_data);
                redirect('C_apbd');
            }   
            else 
            {
                $this->session->set_flashdata('notif', 1);
                redirect('C_auth');
            }
        }
        else 
        {
            $this->session->set_flashdata('notif', 1);
            redirect('C_auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata('username');
        redirect('C_auth');
    }
}
