<?php
defined('BASEPATH') or exit('No direct script access allowed');
ob_start();
class Staff extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Subject_model');
        $this->load->model('Teacher_model');
        $this->load->model('Post_model');
        $this->load->model('RegTa_model');

        $user = $this->session->userdata('status');
        if ($user == "staff") {
            // redirect("admin", "refresh");
        } else {
            $_SESSION['message'] = "You are MUST login before!!";
            redirect("login");
        }
    }

    public function index()
    {
        $data['title'] = "Deshboard";
        $this->load->view('template/header_view', $data);
        $this->load->view('template/footer_view');
    }

    public function logout()
    {
        $this->session->unset_userdata(array('login_id', 'username', 'status'));
        $_SESSION['message'] = "~~ See you again ~~";
        redirect('login');
    }
}
