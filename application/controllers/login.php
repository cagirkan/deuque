<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

    public function index()
    {
        $this->loginPage();
    }

    public function loginPage()
    {
        $this->load->view('login2');
    }

    public function signin()
    {
        $this->load->view('signin');
    }

    public function data()
    {
        if ($this->session->userdata('currently_logged_in'))
        {
            $a = $this->session->userdata('user_id');
            $this->load->view('index', $a);
        } else {
            redirect('login/invalid');
        }
    }

    public function invalid()
    {
        $this->load->view('invalid');
    }

    public function login_action()
    {
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->load->model('login_model');

        $this->form_validation->set_rules('username', 'Username:', 'required|trim|xss_clean|callback_validation');
        $this->form_validation->set_rules('password', 'Password:', 'required|trim');

        if ($this->form_validation->run())
        {
            $userInfo = $this->login_model->getUserInfo($this->input->post('username'),$this->input->post('password'));
            $this->load->view('test', ['userInfo' => $userInfo]);
            $userInfo['currently_logged_in'] = 1;
            $data = array(
                'username' => $this->input->post('username'),
                'currently_logged_in' => 1,
                'user_id' => $userInfo[0]->user_id
            );
            $this->session->set_userdata($data);
           redirect('login/data');
        }
        else {
            $this->load->view('login2');
        }
    }

    public function signin_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|is_unique[signup.username]');

        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

        $this->form_validation->set_message('is_unique', 'username already exists');

        if ($this->form_validation->run())
        {
            echo "Welcome, you are logged in.";
        }
        else {

            $this->load->view('signin');
        }
    }

    public function validation()
    {
        $this->load->model('login_model');

        if ($this->login_model->log_in_correctly())
        {

            return true;
        } else {
            $this->form_validation->set_message('validation', 'Incorrect username/password.');
            return false;
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
    }

}
?>