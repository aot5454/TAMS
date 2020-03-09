<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teacher extends CI_Controller
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
        if ($user == "teacher") {
            // redirect("admin", "refresh");
        } else {
            $_SESSION['message'] = "You are MUST login before!!";
            redirect("login");
        }
    }

    public function index()
    {
        $data['title'] = "Deshboard";
        $data['num_post'] = $this->Post_model->record_count_post_id_tc($this->session->userdata('login_id'));
        $data['num_post_online'] = $this->Post_model->record_count_post_id_tc_online($this->session->userdata('login_id'));



        $this->load->view('template/header_view', $data);
        $this->load->view('teacher/index_view', $data);
        $this->load->view('template/footer_view');
    }

    public function posts()
    {
        $data['title'] = "Posts";
        $user = $this->session->userdata('login_id');
        $data['posts'] = $this->Post_model->fetchAll_post_join_idteacher($user);

        $this->load->view('template/header_view', $data);
        $this->load->view('teacher/post_view');
        $this->load->view('template/footer_view');
    }

    public function registeration()
    {
        $data['title'] = "Registeration";

        $id_post = $this->uri->segment(3);
        if ($this->RegTa_model->chack_reg_id($id_post) != true) {
            $_SESSION['message'] = "ID ไม่ถูกต้อง";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts');
        }

        $data['reg_info'] = $this->RegTa_model->fetchAll_reg($id_post);

        // print_r($data['reg_info']);

        $this->load->view('template/header_view', $data);
        $this->load->view('teacher/registeration_view');
        $this->load->view('template/footer_view');
    }

    public function editUserTeacher()
    {
        $id_old = $this->input->post('id-teacher-old-edit');
        $id_new = $this->input->post('id-teacher-edit');

        $pass_old = $this->input->post('password-old-tea-edit');
        $pass_new = $this->input->post('password-tea-edit');
        $name_thai = $this->input->post('name-thai-edit');
        $name_eng = $this->input->post('name-eng-edit');
        $status = $this->input->post('status-tc-edit');


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
            'tc_id' => $id,
            'tc_pwd' => $password,
            'tc_name_thai' => $name_thai,
            'tc_name_eng' => $name_eng
        );
        if ($this->User_model->update_user("tc_id", $id_old, $data_update, "tb_teacher") == "success") {
            $_SESSION['message'] = "Update teacher already!";
            redirect($this->agent->referrer());
        } else {
            $_SESSION['message'] = "Update user not success!!!";
            redirect($this->agent->referrer());
        }
    }

    public function add_post()
    {
        $day_work = $this->input->post('check_list');

        $id_subject = $this->input->post('id_subject');
        $id_teacher = $this->input->post('id_teacher');
        $sec = $this->input->post('sec');
        $term  = $this->input->post('term');
        $years = $this->input->post('years');
        $time_work_start = $this->input->post('time-work-start');
        $time_work_end = $this->input->post('time-work-end');
        $work_start = $this->input->post('work-start');
        $work_end = $this->input->post('work-end');
        $url = $this->input->post('url');
        $num_nisit = $this->input->post('num-nisit');


        $qualification = $this->input->post('qualification');
        $status = $this->input->post('status');

        if ($url == null) {
            $url = "-";
        }

        $data_info = array(
            'sj_id'        => $id_subject,
            'poif_section'           => $sec,
            'poif_term'              => $term,
            'poif_daywork'          => $day_work,
            'poif_timework_start'   => $time_work_start,
            'poif_timework_end'     => $time_work_end,
            'poif_work_start'        => $work_start,
            'poif_work_end'          => $work_end,
            'poif_years'             => $years,
            'poif_url'               => $url,
            'poif_num_st'         => $num_nisit
        );

        $id_subject_info = $this->Post_model->insert_info_post_r_id($data_info);

        if ($id_subject_info == false) {
            $_SESSION['message'] = "ไม่สามารถทำรายการได้";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts?insert=fail');
        }

        $data_post = array(
            'sj_id'    => $id_subject,
            'tc_id'    => $id_teacher,
            'poif_id' => (int) $id_subject_info,
            'post_qualification' => $qualification,
            'post_status'        => $status
        );

        if ($this->Post_model->insert_post($data_post)) {
            $_SESSION['message'] = "เพิ่มรายวิชาเรียบร้อยแล้ว";
            redirect($this->agent->referrer());
        } else {
            $_SESSION['message'] = "ไม่สามารถทำรายการได้";
            redirect($this->agent->referrer());
        }
    }

    public function update_post()
    {
        $id_post = $this->input->post('id_post_update');
        $id_subinfo = $this->input->post('id_subinfo_update');

        $day_work = $this->input->post('check_list_update');
        $id_subject = $this->input->post('id_subject_update');
        $id_teacher = $this->input->post('id_teacher_update');
        $sec = $this->input->post('sec_update');
        $term  = $this->input->post('term_update');
        $years = $this->input->post('years_update');
        $time_work_start = $this->input->post('time-work-start-update');
        $time_work_end = $this->input->post('time-work-end-update');
        $work_start = $this->input->post('work-start-update');
        $work_end = $this->input->post('work-end-update');
        $url = $this->input->post('url-update');
        $num_nisit = $this->input->post('num-nisit-update');

        $qualification = $this->input->post('qualification-update');
        $status = $this->input->post('status-update');

        if ($url == null) {
            $url = "-";
        }

        $data_info = array(
            'sj_id'        => $id_subject,
            'poif_section'           => $sec,
            'poif_term'              => $term,
            'poif_daywork'          => $day_work,
            'poif_timework_start'   => $time_work_start,
            'poif_timework_end'     => $time_work_end,
            'poif_work_start'        => $work_start,
            'poif_work_end'          => $work_end,
            'poif_years'             => $years,
            'poif_url'               => $url,
            'poif_num_st'         => $num_nisit
        );

        $data_post = array(
            'sj_id'    => $id_subject,
            'tc_id'    => $id_teacher,
            'poif_id' => $id_subinfo,
            'post_qualification' => $qualification,
            'post_status'        => $status
        );

        if ($this->Post_model->update_post_info($id_subinfo, $data_info) and $this->Post_model->update_post($id_post, $data_post)) {
            $_SESSION['message'] = "แก้ไขรายวิชาเรียบร้อยแล้ว!";
            redirect($this->agent->referrer());
        } else {
            $_SESSION['message'] = "ไม่สามารถทำรายการได้";
            redirect($this->agent->referrer());
        }
    }

    // Method change status
    public function change_status_reg()
    {
        $id_reg = $this->uri->segment(3);
        $change_status = $this->uri->segment(4);
        $id_post = $this->uri->segment(5);


        if ($this->RegTa_model->change_status($id_reg, $change_status) == true) {
            if ($change_status == "allow") {
                $_SESSION['message'] = "รับนิสิตเป็นนิสิตช่วยสอนเรียบร้อยแล้ว";
            } else {
                $_SESSION['message'] = "ไม่รับนิสิตเป็นนิสิตช่วยสอนเรียบร้อยแล้ว";
            }
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/registeration/' . $id_post);
        } else {
            $_SESSION['message'] = "เปลี่ยนสถานะไม่สำเร็จ";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/registeration/' . $id_post);
        }
    }

    public function change_status_post()
    {
        $id_post = $this->uri->segment(3);
        $change_status = $this->uri->segment(4);
        if ($this->Post_model->change_status($id_post, $change_status) == true) {
            $_SESSION['message'] = "Change status to " . $change_status . "line already";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts');
        } else {
            $_SESSION['message'] = "Change status not success";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts');
        }
    }

    public function remove_post()
    {
        $id_post = $this->uri->segment(3);
        $id_post_info = $this->uri->segment(4);


        if ($this->Post_model->remove_post($id_post, $id_post_info)) {
            $_SESSION['message'] = "ลบรายวิชาเรียบร้อย";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts?remove=success');
        } else {
            $_SESSION['message'] = "ไม่สามารถทำรายการได้ในขณะนี้!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts?remove=fail');
        }
    }

    public function print()
    {
        $reg_post_id = $this->uri->segment(3);

        $data['title'] = "TAMS - Reg TA report";
        $data['post_id'] = $reg_post_id;
        $data['reg'] = $this->RegTa_model->fetch_reg_id($reg_post_id); //fetch all reg_ta in reg_id

        $this->load->library('fpdf_master');
        $this->load->view('nisit/print_nisit', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata(array('login_id', 'username', 'status'));
        $_SESSION['message'] = "~~ See you again ~~";
        redirect('login');
    }
}
