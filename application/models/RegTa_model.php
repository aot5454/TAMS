<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegTa_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchAll_reg_arr()
    {
        $this->db->select('*');
        $this->db->from('tb_reg_ta');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function fetchAll_reg($id_post)
    {
        $this->db->select('*');
        $this->db->from('tb_reg_ta');
        $this->db->where('post_id', $id_post);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetch_reg($id_nisit)
    {
        $this->db->select('*');
        $this->db->from('tb_reg_ta');
        $this->db->where('st_id', $id_nisit);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetch_reg_id($id_post)
    {
        $this->db->select('*');
        $this->db->from('tb_reg_ta');
        $this->db->where('post_id', $id_post);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetch_reg_in_id($id)
    {
        $this->db->select('*');
        $this->db->from('reg_ta');
        $this->db->where('id', $id);

        $query = $this->db->get();

        return $query->result_array();
    }
    // Insert reg ta
    public function insert_reg($id_post, $id_nisit, $grade)
    {
        $data = array(
            'post_id'  => $id_post,
            'st_id'  => $id_nisit,
            'reg_grade'  => $grade,
            'reg_status'    => 'wait'
        );

        if ($this->db->insert('tb_reg_ta', $data)) {
            return "success";
        } else {
            return "not_success";
        }
    }

    public function chack_reg_already($id_post, $id_nisit)
    {
        $this->db->select('post_id, st_id');
        $this->db->from('tb_reg_ta');
        $this->db->where('post_id', $id_post);
        $this->db->where('st_id', $id_nisit);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $data = $query->row();
            return true;
        }
        return false;
    }
    public function chack_reg_count($id_post)
    {
        $this->db->select('post_id, st_id');
        $this->db->from('tb_reg_ta');
        $this->db->where('post_id', $id_post);

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            $data = $query->row();
            return true;
        }
        return false;
    }

    public function fatch_idNisit($id_post)
    {
        $this->db->select('st_id');
        $this->db->from('tb_reg_ta');
        $this->db->where('post_id', $id_post);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function fatch_idNisit_allow($id_post)
    {
        $this->db->select('st_id');
        $this->db->from('tb_reg_ta');
        $this->db->where('post_id', $id_post);
        $this->db->where('reg_status', 'allow');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function chack_reg_number($id_reg, $id_nisit)
    {
        $this->db->select('status');
        $this->db->from('reg_ta');
        $this->db->where('id', $id_reg);
        $this->db->where('id_nisit', $id_nisit);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function chack_reg_id($id_post)
    {
        $this->db->select('reg_id');
        $this->db->from('tb_reg_ta');
        $this->db->where('post_id', $id_post);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function change_status($id_reg, $status_change)
    {
        $data['reg_status'] = $status_change;

        $this->db->set($data);
        $this->db->where("reg_id", $id_reg);

        if ($this->db->update("tb_reg_ta", $data)) {
            return true;
        }
        return false;
    }
}
