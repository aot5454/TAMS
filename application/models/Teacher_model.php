<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teacher_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchAll_teacher_arr()
    {
        $query = $this->db->query('SELECT * FROM tb_teacher ORDER BY `tc_id` ASC');
        return $query->result_array();
    }

    public function fetch_teacher($id)
    {
        $this->db->select('*');
        $this->db->from('teacher');
        $this->db->where('id', $id);

        $query = $this->db->get();

        return $query->result_array();
    }
}
