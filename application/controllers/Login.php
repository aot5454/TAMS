<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');

        $user = $this->session->userdata('status');
        if ($user == "admin") {
            redirect('admin');
        } elseif ($user == "staff") {
            redirect('staff');
        } elseif ($user == "teacher") {
            redirect('teacher');
        } elseif ($user == "nisit") {
            redirect('nisit');
        }
    }

    public function index()
    {
        $this->load->view('login_view');
    }

    public function validlogin()
    {
        $uname = $this->input->post('username');
        $pass = $this->input->post('password');

        if ($this->input->server('REQUEST_METHOD') == TRUE) {
            $cou_student = $this->User_model->record_count__st($uname, $pass);
            $cou_teacher = $this->User_model->record_count__teacher($uname, $pass);
            $cou_staff = $this->User_model->record_count__staff($uname, $pass);
            $cou_admin = $this->User_model->record_count__admin($uname, $pass);

            if ($cou_student == 1 or $cou_teacher == 1 or $cou_staff == 1 or $cou_admin == 1) {
                if ($cou_student == 1) {
                    $result = $this->User_model->fetch_user_login__st($uname, $pass);
                    $this->session->set_userdata(array(
                        'login_id'    => $result->st_id,
                        'username'    => $result->st_name . " " . $result->st_surname,
                        'status' => "nisit"
                    ));
                    $_SESSION['message'] = "~~ สวัสดี " . $result->st_name . " " . $result->st_surname . " ~~";
                }

                if ($cou_teacher == 1) {
                    $result = $this->User_model->fetch_user_login__tc($uname, $pass);
                    $this->session->set_userdata(array(
                        'login_id'    => $result->tc_id,
                        'username'    => $result->tc_name . " " . $result->tc_surname,
                        'status' => "teacher"
                    ));
                    $_SESSION['message'] = "~~ สวัสดี " . $result->tc_name . " " . $result->tc_surname . " ~~";
                }

                if ($cou_staff == 1) {
                    $result = $this->User_model->fetch_user_login__staff($uname, $pass);
                    $this->session->set_userdata(array(
                        'login_id'    => $result->staff_id,
                        'username'    => $result->staff_title . $result->staff_name . " " . $result->staff_surname,
                        'status' => "staff"
                    ));
                    $_SESSION['message'] = "~~ สวัสดี " . $result->staff_title . $result->staff_name . " " . $result->staff_surname . " ~~";
                }

                if ($cou_admin == 1) {
                    $result = $this->User_model->fetch_user_login__admin($uname, $pass);
                    $this->session->set_userdata(array(
                        'login_id'    => $result->admin_id,
                        'username'    => $result->admin_title . $result->admin_name . " " . $result->admin_surname,
                        'status' => "admin"
                    ));
                    $_SESSION['message'] = "~~ สวัสดี " . $result->admin_title . $result->admin_name . " " . $result->admin_surname . " ~~";
                }

                $user_login = $this->session->userdata('status');
                if ($user_login == "admin") {
                    redirect('admin');
                } elseif ($user_login == "staff") {
                    redirect('staff');
                } elseif ($user_login == "teacher") {
                    redirect('teacher');
                } else {
                    redirect('nisit');
                }
            } else {
                $_SESSION['message'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
                redirect('login', 'refresh');
            }
        } // end if
    } //validlogin
}//class
