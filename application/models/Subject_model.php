<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function record_count()
    {
        return $this->db->from("tb_subject")->count_all_results();
    }

    public function fetchAll_subject_arr()
    {
        $query = $this->db->query('SELECT * FROM `tb_subject` ORDER BY `tb_subject`.`sj_id` ASC');
        return $query->result_array();
    }

    // CRUD
    public function insert_subject($data)
    {
        if ($this->db->insert('tb_subject', $data)) {
            return "success";
        } else {
            return "not_success";
        }
    }

    public function update_subject($id, $data)
    {
        $this->db->where('sj_id', $id);
        if ($this->db->update('tb_subject', $data)) {
            return "success";
        } else {
            return "not_success";
        }
    }

    public function remove_subject($id)
    {
        $this->db->where('sj_id', $id);

        if ($this->db->delete('tb_subject')) {
            return "success";
        } else {
            return "not_success";
        }
    }

    public function fetchAll_subject_subjectInfo($id_post)
    {
        $this->db->select('subject.*,subject_info.*');
        $this->db->from('subject');
        $this->db->join('post', 'subject.id = post.id_subject');
        $this->db->join('subject_info', 'subject_info.id = post.id_subject_info');
        $this->db->where('post.id', $id_post);

        $query = $this->db->get();
        return $query->result_array();
    }
}
