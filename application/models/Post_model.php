<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchAll_post_arr()
    {
        $this->db->select('*');
        $this->db->from('tb_post');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function fetchAll_post_join()
    {
        $this->db->select('
        tb_post.*,
        tb_post_info.*,
        tb_subject.sj_id,
        tb_subject.sj_name_thai,
        tb_teacher.tc_name_thai,');

        $this->db->from('tb_post');
        $this->db->join('tb_subject', 'tb_subject.sj_id = tb_post.sj_id');
        $this->db->join('tb_teacher', 'tb_teacher.tc_id = tb_post.tc_id');
        $this->db->join('tb_post_info', 'tb_post_info.poif_id = tb_post.poif_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function fetchAll_post_online()
    {
        $this->db->select('
        tb_post.*,
        tb_post_info.*,
        tb_subject.sj_id,
        tb_subject.sj_des_thai,
        tb_subject.sj_name_thai,
        tb_teacher.tc_name_thai,');
        $this->db->from('tb_post');
        $this->db->where('post_status', 'on');
        $this->db->join('tb_subject', 'tb_subject.sj_id = tb_post.sj_id');
        $this->db->join('tb_teacher', 'tb_teacher.tc_id = tb_post.tc_id');
        $this->db->join('tb_post_info', 'tb_post_info.poif_id = tb_post.poif_id');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetch_post_join($id_post)
    {
        $this->db->select('
        tb_post.post_id,
        tb_post.sj_id,
        tb_post.tc_id,
        tb_subject.sj_name_thai,
        tb_subject.sj_name_eng,
        tb_teacher.tc_name_thai');
        $this->db->from('tb_post');
        $this->db->join('tb_subject', 'tb_subject.sj_id = tb_post.sj_id');
        $this->db->join('tb_teacher', 'tb_teacher.tc_id = tb_post.tc_id');

        $this->db->where('post_id', $id_post);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetch_post_join_print($id_post)
    {
        $this->db->select('
        tb_post.*,
        tb_post_info.*,
        tb_subject.*,
        tb_teacher.*');
        $this->db->from('tb_post');
        $this->db->join('tb_subject', 'tb_subject.sj_id = tb_post.sj_id');
        $this->db->join('tb_teacher', 'tb_teacher.tc_id = tb_post.tc_id');
        $this->db->join('tb_post_info', 'tb_post_info.poif_id = tb_post.poif_id');
        $this->db->where('post_id', $id_post);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function chack_post($id)
    {
        $this->db->select('post_id');
        $this->db->from('tb_post');
        $this->db->where('post_id', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = $query->row();
            return true;
        }
        return FALSE;
    }

    public function get_status($id_post)
    {
        $this->db->select('status');
        $this->db->from('post');
        $this->db->where('id', $id_post);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function change_status($id_post, $status_change)
    {
        $data['post_status'] = $status_change;

        $this->db->set($data);
        $this->db->where("post_id", $id_post);

        if ($this->db->update("tb_post", $data)) {
            return true;
        }
        return false;
    }

    public function insert_post($data)
    {
        if ($this->db->insert("tb_post", $data)) {
            return true;
        }
        return false;
    }

    public function update_post($id, $data)
    {
        $this->db->where('post_id', $id);
        if ($this->db->update("tb_post", $data)) {
            return true;
        }
        return false;
    }

    public function insert_info_post_r_id($data)
    {
        if ($this->db->insert("tb_post_info", $data)) {
            $str = $this->db->insert_id();
            return $str;
        }
        return false;
    }

    public function update_post_info($id, $data)
    {
        $this->db->where('poif_id', $id);
        if ($this->db->update("tb_post_info", $data)) {
            return true;
        }
        return false;
    }

    public function remove_post($id_post, $id_post_info)
    {
        if ($this->db->delete('tb_post', array('post_id' => $id_post)) and $this->db->delete('tb_post_info', array('poif_id' => $id_post_info))) {
            return true;
        }
        return false;
    }

    public function post_join_outer_subject()
    {
        $this->db->select('post.*,subject.*,subject_info.*,teacher.*');
        $this->db->from('post');
        $this->db->join('subject', 'subject.id = post.id_subject');
        $this->db->join('subject_info', 'subject_info.id = post.id_subject_info');
        $this->db->join('teacher', 'teacher.id = post.id_teacher');

        $query = $this->db->get();
        return $query->result();
    }
}
