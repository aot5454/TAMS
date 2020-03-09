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

        $data['num_csit'] = $this->User_model->record_count_user_csit();
        $data['num_admin'] = $this->User_model->record_count_admin();
        $data['num_staff'] = $this->User_model->record_count_staff();
        $data['num_teacher'] = $this->User_model->record_count_teacher();

        $data['num_post_all'] = $this->Post_model->record_count_post_all();
        $data['num_post_online'] = $this->Post_model->record_count_post_online();

        $data['num_subject'] = $this->Subject_model->record_count_subject();

        $this->load->view('template/header_view', $data);
        $this->load->view('admin/index_view');
        $this->load->view('template/footer_view');
    }

    public function editUserStaff()
    {
        $id_old = $this->input->post('id-staff-old');
        $id_new = $this->input->post('id-staff-edit');

        $pass_old = $this->input->post('password-staff-old');
        $pass_new = $this->input->post('password-staff-edit');
        $title = $this->input->post('title-staff-edit');
        $name = $this->input->post('name-staff-edit');
        $surname = $this->input->post('surname-staff-edit');


        if (strlen($pass_new) == 0 or $pass_new == "") {
            $password = $pass_old;
        } else {
            $password = $pass_new;
        }

        if ($id_old !==  $id_new) {
            $id = $id_new;
        } else {
            $id = $id_old;
        }

        $data_update = array(
            // `tc_id`, `tc_pwd`, `tc_name_thai`, `tc_name_eng`
            'staff_id' => $id,
            'staff_pwd' => $password,
            'staff_title' => $title,
            'staff_name' => $name,
            'staff_surname' => $surname
        );

        if ($this->User_model->update_user("staff_id", $id_old, $data_update, "tb_staff") == "success") {
            $_SESSION['message'] = "Update staff already!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '?update_user=success');
        } else {
            $_SESSION['message'] = "Update user not success!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '?update_user=not_success');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array('login_id', 'username', 'status'));
        $_SESSION['message'] = "~~ See you again ~~";
        redirect('login');
    }
}
