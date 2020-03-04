<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nisit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Post_model');
        $this->load->model('Subject_model');
        $this->load->model('Teacher_model');

        $user = $this->session->userdata('status');
        if ($user == "nisit") {
            // redirect("nisit", "refresh");
        } else {
            $_SESSION['message'] = "You are MUST login before!!";
            redirect("login");
        }
    }

    public function index()
    {
        $data['title'] = "Home";
        $data['posts'] = $this->Post_model->fetchAll_post_online();

        $this->load->view('template/header_view', $data);
        $this->load->view('nisit/dashboard_nisit');
        $this->load->view('template/footer_view');
    }

    public function subject()
    {
        $data['title'] = "Subject Info";

        $id = $this->uri->segment(3); //id from url
        $val = $this->Post_model->chack_post($id); //chack id

        if ($val != true) {
            $_SESSION['message'] = "ID ไม่ถูกต้อง";
            redirect("nisit");
        }

        $data['post'] = $this->Post_model->fetch_post_join_print($id);

        $this->load->view('template/header_view', $data);
        $this->load->view('nisit/subject_info_nisit');
        $this->load->view('template/footer_view');
    }

    public function reg_ta()
    {
        $this->load->model('RegTa_model');

        $id_post = $this->input->post('post_id');
        $id_nisit = $this->input->post('user_id');
        $grade = strtoupper($this->input->post('gradeSubject'));

        if ($this->RegTa_model->chack_reg_already($id_post, $id_nisit) == true) {
            $_SESSION['message'] = "คุณลงทะเบียนในรายวิชานี้แล้ว";
            redirect("nisit/status");
        }

        if ($this->RegTa_model->insert_reg($id_post, $id_nisit, $grade)) {
            $_SESSION['message'] = "ลงทะเบียนสำเร็จ รอการดำเนินการ";
            redirect("nisit/status");
        } else {
            $_SESSION['message'] = "ลงทะเบียนไม่สำเร็จ";
            redirect("nisit/status");
        }
    }

    public function status()
    {
        $data['title'] = "Status";

        $this->load->model('RegTa_model');
        $id_user = $this->session->userdata('login_id');
        $data['reg_info'] = $this->RegTa_model->fetch_reg($id_user); //fetch all reg_ta in id_user

        $this->load->view('template/header_view', $data);
        $this->load->view('nisit/status_nisit');
        $this->load->view('template/footer_view');
    }

    public function print()
    {
        $this->load->model('RegTa_model');

        $reg_post_id = $this->uri->segment(3);
        // $user_id = $this->session->userdata('login_id');
        // $data_reg =  $this->RegTa_model->chack_reg_number($reg_id, $user_id);

        // if ($data_reg[0]['status'] != "allow") {
        //     $_SESSION['message'] = "ID ไม่ถูกต้อง";
        //     redirect("nisit/status");
        // }

        $data['title'] = "TAMS - Reg TA report";
        $data['post_id'] = $reg_post_id;
        $data['reg'] = $this->RegTa_model->fetch_reg_id($reg_post_id); //fetch all reg_ta in reg_id

        //print_r($data['reg']);

        $this->load->library('fpdf_master');
        $this->load->view('nisit/print_nisit', $data);
        // $this->load->view('nisit/test', $data);
    }

    public function makefont()
    {
        $this->load->library('MakeFontFpdf');

        MakeFont(APPPATH . 'third_party/fpdf/font/THSarabunNew.ttf', 'cp874');
    }

    public function logout()
    {
        $this->session->unset_userdata(array('login_id', 'username', 'status'));
        $_SESSION['message'] = "~~ See you again ~~";
        redirect('login');
    }

    public function editUserNisit()
    {
        $id = $this->input->post('id-edit');
        $pass_old = $this->input->post('password-old');
        $pass_new = $this->input->post('password-edit');
        $title = $this->input->post('title-edit');
        $name = $this->input->post('name-edit');
        $surname = $this->input->post('surname-edit');
        $sex = $this->input->post('sex-edit');
        $nickname = $this->input->post('nickname-edit');
        $major = $this->input->post('major-edit');
        $tel = ($this->input->post('tel-edit'));
        $gpax = ($this->input->post('gpax-edit'));
        $email = $this->input->post('email-edit');
        $status = $this->input->post('status-edit');

        if (strlen($pass_new) == 0 or $pass_new == "") {
            $password = $pass_old;
        } else {
            $password = $pass_new;
        }

        $data_update = array(
            'st_pwd' => $password,
            'st_title' => $title,
            'st_name' => $name,
            'st_surname' => $surname,
            'st_nickname' => $nickname,
            'st_sex' => (int) $sex,
            'maj_id' => (int) $major,
            'st_tel' => $tel,
            'st_email' => $email,
            'st_gpax' => $gpax,
            'st_status' => $status,
        );

        if ($this->User_model->update_user("st_id", $id, $data_update, "tb_student") == "success") {
            $_SESSION['message'] = "Update already!";
            redirect('nisit?update_user=success');
        } else {
            $_SESSION['message'] = "Update not success!!!";
            redirect('nisit?update_user=not_success');
        }
    }

    public function editGPAX()
    {
        $id = $this->input->post('id-gpaxx');
        $gpax = ($this->input->post('gpaxx'));

        $data_update = array(
            'st_gpax' => $gpax
        );

        if ($this->User_model->update_user("st_id", $id, $data_update, "tb_student") == "success") {
            $_SESSION['message'] = "Save already!";
            redirect('nisit?update_user=success');
        } else {
            $_SESSION['message'] = "Save not success!!!";
            redirect('nisit?update_user=not_success');
        }
    }
}
