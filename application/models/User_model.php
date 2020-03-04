<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchAll_user_arr_csit()
    {
        $array = "maj_id >='10007' AND maj_id <='10008' OR st_status ='admin'";
        $this->db->select('*');
        $this->db->from('tb_student');
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function fetchAll_user_staff()
    {
        $this->db->select('*');
        $this->db->from('tb_staff');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function fetchAll_user_teacher()
    {
        // $this->db->select('*');
        //$this->db->from('tb_teacher');
        $query = $this->db->get('tb_teacher');
        return $query->result_array();
    }

    public function fetchAll_user_admin()
    {
        $this->db->select('*');
        $this->db->from('tb_admin');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function record_count_user_csit()
    {
        $array = "maj_id >='10007' AND maj_id <='10008' OR st_status ='admin'";
        $this->db->where($array);
        return $this->db->from("tb_student")->count_all_results();
    }

    public function record_count_user_cs()
    {
        $this->db->where('maj_id', '10007');
        return $this->db->from("tb_student")->count_all_results();
    }

    public function record_count_user_it()
    {
        $this->db->where('maj_id', '10008');
        return $this->db->from("tb_student")->count_all_results();
    }

    public function record_count_admin()
    {
        //$this->db->where('tc_status', 'admin');
        return $this->db->from("tb_admin")->count_all_results();
    }

    public function record_count_staff()
    {
        //$this->db->where('tc_status', 'staff');
        return $this->db->from("tb_staff")->count_all_results();
    }

    public function record_count_teacher()
    {
        //$this->db->where('tc_status', 'teacher');
        return $this->db->from("tb_teacher")->count_all_results();
    }

    public function record_count__st($username, $password)
    {
        $this->db->where('st_id', $username);
        $this->db->where('st_pwd', ($password));
        return $this->db->count_all_results('tb_student');
    }

    public function record_count__teacher($username, $password)
    {
        $this->db->where('tc_id', $username);
        $this->db->where('tc_pwd', ($password));
        return $this->db->count_all_results('tb_teacher');
    }

    public function record_count__staff($username, $password)
    {
        $this->db->where('staff_id', $username);
        $this->db->where('staff_pwd', ($password));
        return $this->db->count_all_results('tb_staff');
    }

    public function record_count__admin($username, $password)
    {
        $this->db->where('admin_username', $username);
        $this->db->where('admin_pwd', ($password));
        return $this->db->count_all_results('tb_admin');
    }

    public function fetch_user_login__st($username, $password)
    {
        $this->db->where('st_id', $username);
        $this->db->where('st_pwd', ($password));
        $query = $this->db->get('tb_student');
        return $query->row();
    }

    public function fetch_user_login__tc($username, $password)
    {
        $this->db->where('tc_id', $username);
        $this->db->where('tc_pwd', ($password));
        $query = $this->db->get('tb_teacher');
        return $query->row();
    }

    public function fetch_user_login__staff($username, $password)
    {
        $this->db->where('staff_id', $username);
        $this->db->where('staff_pwd', ($password));
        $query = $this->db->get('tb_staff');
        return $query->row();
    }

    public function fetch_user_login__admin($username, $password)
    {
        $this->db->where('admin_username', $username);
        $this->db->where('admin_pwd', ($password));
        $query = $this->db->get('tb_admin');
        return $query->row();
    }

    public function fetch_user_id_st($id)
    {
        $this->db->select('
        tb_student.st_id,
        tb_student.st_title,
        tb_student.st_name,
        tb_student.st_surname,
        tb_student.maj_id,
        tb_student.st_year,
        tb_student.st_gpax,
        tb_major.maj_name
        ');
        $this->db->from('tb_student');
        $this->db->join('tb_major', 'tb_major.maj_id = tb_student.maj_id');
        $this->db->where('st_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function fetch_user_id_st_print($id)
    {
        $this->db->select('
        tb_student.*,
        tb_major.maj_name
        ');
        $this->db->from('tb_student');
        $this->db->join('tb_major', 'tb_major.maj_id = tb_student.maj_id');
        $this->db->where('st_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_major($id)
    {
        $this->db->select('maj_name');
        $this->db->from('major');
        $this->db->where('maj_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_gpax($id)
    {
        $this->db->select('tb_student.st_gpax');
        $this->db->from('tb_student');
        $this->db->where('st_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    //USE



    // public function read_user($id)
    // {
    //     $this->db->where('id', $id);
    //     $query = $this->db->get('user');
    //     if ($query->num_rows() > 0) {
    //         $data = $query->row();
    //         return $data;
    //     }
    //     return FALSE;
    // }




    // CRUD
    public function insert_user($data, $table)
    {
        if ($this->db->insert($table, $data)) {
            return "success";
        } else {
            return "not_success";
        }
    }

    public function update_user($col, $id, $data, $table)
    {

        $this->db->where($col, $id);
        if ($this->db->update($table, $data)) {
            return "success";
        } else {
            return "not_success";
        }
    }

    public function remove_user($col, $id, $table)
    {
        $this->db->where($col, $id);
        if ($this->db->delete($table)) {
            return "success";
        } else {
            return "not_success";
        }
    }
}
