<?php
defined('BASEPATH') or exit('No direct script access allowed');
ob_start();
class Admin extends CI_Controller
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
        if ($user == "admin" or $user == "staff") {
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

    public function users()
    {
        $data = array();
        $data['title'] = "Users";

        //Fetch
        $data['users'] = $this->User_model->fetchAll_user_arr_csit();
        $data['users_staff_arr'] = $this->User_model->fetchAll_user_staff();
        $data['users_teacher_arr'] = $this->User_model->fetchAll_user_teacher();
        $data['users_admin_arr'] = $this->User_model->fetchAll_user_admin();


        //Count
        $data['users_count'] = $this->User_model->record_count_user_csit();
        $data['users_cs'] = $this->User_model->record_count_user_cs();
        $data['users_it'] = $this->User_model->record_count_user_it();
        $data['users_admin'] = $this->User_model->record_count_admin();
        $data['users_staff'] = $this->User_model->record_count_staff();
        $data['users_teacher'] = $this->User_model->record_count_teacher();

        $this->load->view('template/header_view', $data);
        $this->load->view('admin/users_view');
        $this->load->view('template/footer_view');
    }

    public function posts()
    {
        $data['title'] = "Posts";
        // $data['regs'] = $this->RegTa_model->fetchAll_reg_arr();
        //$data['subjects'] = $this->Subject_model->fetchAll_subject_arr();

        $this->load->view('template/header_view', $data);
        $this->load->view('admin/post_view');
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
        $this->load->view('admin/registeration_view');
        $this->load->view('template/footer_view');
    }

    public function subject()
    {
        $data['title'] = "Subject";
        $data['subjects'] = $this->Subject_model->fetchAll_subject_arr();
        $data['count_subject'] = $this->Subject_model->record_count();

        $this->load->view('template/header_view', $data);
        $this->load->view('admin/subject_view');
        $this->load->view('template/footer_view');
    }

    public function test()
    {
        //$data['posts'] = $this->Post_model->fetchAll_post_arr();
        // $data['tests'] = $this->Post_model->fetchAll_subject_subjectInfo(8);

        $this->load->view('template/header_view');
        //$this->load->view('admin/subject_view');
        $this->load->view('template/footer_view');
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
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts?insert=success');
        } else {
            $_SESSION['message'] = "ไม่สามารถทำรายการได้";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts?insert=fail');
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
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts?update=success');
        } else {
            $_SESSION['message'] = "ไม่สามารถทำรายการได้";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/posts?update=fail');
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

    // METHOD CRUD User Nisit
    public function addUserNisit()
    {
        $id = $this->input->post('id');
        $pass = $this->input->post('password');
        $title = $this->input->post('title');
        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $sex = $this->input->post('sex');
        $nickname = $this->input->post('nickname');
        $level = $this->input->post('lv');
        $fac = $this->input->post('fac');
        $major = $this->input->post('major');
        $tel = ($this->input->post('tel'));
        $email = $this->input->post('email');
        $status = $this->input->post('status');

        // st_id`, `st_pwd`, `st_title`, `st_name`, `st_surname`, `st_nickname`, 
        // `st_sex`, `maj_id`, `st_address`, `st_tel`, `st_email`, `st_pic`, `st_year`, `st_status`
        $data_insert = array(
            'st_id' => $id,
            'st_pwd' => $pass,
            'st_title' => $title,
            'st_name' => $name,
            'st_surname' => $surname,
            'st_nickname' => $nickname,
            'st_sex' => (int) $sex,
            'maj_id' => (int) $major,
            'st_tel' => $tel,
            'st_email' => $email,
            'st_year' => (int) "25" . substr($id, 0, 2),
            'st_status' => $status,
        );

        if ($this->User_model->insert_user($data_insert, 'tb_student') == "success") {
            $_SESSION['message'] = "Add user " . $name . " already!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?insert=success');
        } else {
            $_SESSION['message'] = "Can't add user!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?insert=not_success');
        }
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
        $level = $this->input->post('lv-edit');
        $fac = $this->input->post('fac-edit');
        $major = $this->input->post('major-edit');
        $tel = ($this->input->post('tel-edit'));
        $email = $this->input->post('email-edit');
        $status = $this->input->post('status');

        // st_id`, `st_pwd`, `st_title`, `st_name`, `st_surname`, `st_nickname`, 
        // `st_sex`, `maj_id`, `st_address`, `st_tel`, `st_email`, `st_pic`, `st_year`, `st_status`
        $pass = ($pass_new == "" or $pass_new == null) ? $pass_old : $pass_new;
        $data_update = array(
            'st_pwd' => $pass,
            'st_title' => $title,
            'st_name' => $name,
            'st_surname' => $surname,
            'st_nickname' => $nickname,
            'st_sex' => (int) $sex,
            'maj_id' => (int) $major,
            'st_tel' => $tel,
            'st_email' => $email,
            'st_year' => (int) "25" . substr($id, 0, 2),
            'st_status' => $status,
        );

        if ($this->User_model->update_user('st_id', $id, $data_update, 'tb_student') == "success") {
            $_SESSION['message'] = "Update user " . $name . " already!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?update=success');
        } else {
            $_SESSION['message'] = "Can't update user!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?update=not_success');
        }
    }

    public function removeUserNisit()
    {
        $id = $this->uri->segment(3);

        if ($this->User_model->remove_user("st_id", $id, "tb_student") == "success") {
            $_SESSION['message'] = "Remove user already!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?remove_user=success');
        } else {
            $_SESSION['message'] = "Can't remove user!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?remove_user=not_success');
        }
    }
    // End CRUD User Nisit

    //---------------------------------------------------------------------------------//

    // METHOD CRUD User Teacher
    public function addUserTeacher()
    {
        // `tc_id`, `tc_pwd`, `tc_name_thai`, `tc_name_eng`
        $data_insert = array(
            'tc_id' =>  $this->input->post('id-teacher'),
            'tc_pwd' => $this->input->post('password-tea'),
            'tc_name_thai' => $this->input->post('name-thai'),
            'tc_name_eng' => $this->input->post('name-eng'),
        );

        if ($this->User_model->insert_user($data_insert, 'tb_teacher') == "success") {
            $_SESSION['message'] = "Add user " . $this->input->post('name-eng') . " already!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?insert=success');
        } else {
            $_SESSION['message'] = "Can't add user!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?insert=not_success');
        }
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
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?update_user=success');
        } else {
            $_SESSION['message'] = "Update user not success!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?update_user=not_success');
        }
    }

    public function removeUserTeacher()
    {
        $id = $this->uri->segment(3);

        if ($this->User_model->remove_user("tc_id", $id, "tb_teacher") == "success") {
            $_SESSION['message'] = "Remove user already!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?remove_user=success');
        } else {
            $_SESSION['message'] = "Can't remove user!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?remove_user=not_success');
        }
    }
    // End CRUD User Teacher

    //---------------------------------------------------------------------------------//

    // METHOD CRUD User Staff
    public function addUserStaff()
    {
        // `tc_id`, `tc_pwd`, `tc_name_thai`, `tc_name_eng`
        $data_insert = array(
            'staff_id' =>  $this->input->post('id-staff'),
            'staff_pwd' => $this->input->post('password-staff'),
            'staff_title' => $this->input->post('title-staff'),
            'staff_name' => $this->input->post('name-staff'),
            'staff_surname' => $this->input->post('surname-staff'),
        );

        if ($this->User_model->insert_user($data_insert, 'tb_staff') == "success") {
            $_SESSION['message'] = "Add user " . $this->input->post('name-staff') . " already!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?insert=success');
        } else {
            $_SESSION['message'] = "Can't add user!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?insert=not_success');
        }
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
            redirect($user_status . '/users?update_user=success');
        } else {
            $_SESSION['message'] = "Update user not success!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?update_user=not_success');
        }
    }

    public function removeUserStaff()
    {
        $id = $this->uri->segment(3);

        if ($this->User_model->remove_user("staff_id", $id, "tb_staff") == "success") {
            $_SESSION['message'] = "Remove user already!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?remove_user=success');
        } else {
            $_SESSION['message'] = "Can't remove user!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/users?remove_user=not_success');
        }
    }
    // End CRUD User Staff

    //---------------------------------------------------------------------------------//

    // METHOD CRUD Subject
    public function add_subject()
    {
        $id_subject = $this->input->post('id_subject');
        $credit = $this->input->post('credit');
        $name_subject_thai = $this->input->post('name_subject_thai');
        $name_subject_eng = $this->input->post('name_subject_eng');
        $description_thai = $this->input->post('description_thai');
        $description_eng = $this->input->post('description_eng');

        $data = array(
            'sj_id'    => $id_subject,
            'sj_name_thai'     => $name_subject_thai,
            'sj_name_eng'      => $name_subject_eng,
            'sj_des_thai'      => $description_thai,
            'sj_des_eng'       => $description_eng,
            'sj_credit'        => $credit
        );

        if ($this->Subject_model->insert_subject($data) == "success") {
            $_SESSION['message'] = "เพิ่มรายวิชา " . $name_subject_thai . " เรียบร้อย!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/subject?insert=success');
        } else {
            $_SESSION['message'] = "ไม่สามารถเพิ่มรายวิชาได้ในตอนนี้!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/subject?insert=not_success');
        }
    }

    public function update_subject()
    {
        $id = $this->input->post('id_edit');
        $id_subject = $this->input->post('id_subject_edit');
        $credit = $this->input->post('credit_edit');
        $name_subject_thai = $this->input->post('name_subject_thai_edit');
        $name_subject_eng = $this->input->post('name_subject_eng_edit');
        $description_thai = $this->input->post('description_thai_edit');
        $description_eng = $this->input->post('description_eng_edit');

        $data = array(
            'sj_id'    => $id_subject,
            'sj_name_thai'     => $name_subject_thai,
            'sj_name_eng'      => $name_subject_eng,
            'sj_des_thai'      => $description_thai,
            'sj_des_eng'       => $description_eng,
            'sj_credit'        => $credit
        );

        if ($this->Subject_model->update_subject($id, $data) == "success") {
            $_SESSION['message'] = "แก้ไขข้อมูลรายวิชาเรียบร้อย!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/subject?update=success');
        } else {
            $_SESSION['message'] = "ไม่สามารถทำรายการได้!!!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/subject?update=not_success');
        }
    }

    public function removeSubject()
    {
        $id = $this->uri->segment(3);

        if ($this->Subject_model->remove_subject($id) == "success") {
            $_SESSION['message'] = "ลบรายวิชาเรียบร้อยแล้ว!";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/subject?remove=success');
        } else {
            $_SESSION['message'] = "ไม่สามารถทำรายการได้";
            $user_status = $this->session->userdata('status');
            redirect($user_status . '/subject?remove=not_success');
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
