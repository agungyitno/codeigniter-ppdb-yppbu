<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{

    public $table = 'tbl_user';
    public $id = 'id_user';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $query = $this->db->get('tbl_user');
        return $query->result();
    }

    // datatables
    function json()
    {
        $this->datatables->select('id_user,nama_lengkap,email,nama_user_level,active');
        $this->datatables->from('tbl_user');
        $this->datatables->add_column('active', '$1', 'rename_active(active)');
        //add this line for join
        $this->datatables->join('tbl_user_level', 'tbl_user.id_user_level = tbl_user_level.id_user_level');
        $this->datatables->add_column('action', anchor(site_url('user/update/$1'), '<i class="fas fa-pencil-alt" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . " 
                " . anchor(site_url('user/delete/$1'), '<i class="fa fa-trash" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_user');
        return $this->datatables->generate();
    }

    public function activate($data, $id)
    {
        $this->db->where('tbl_user.id_user', $id);
        return $this->db->update('tbl_user', $data);
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id_user', $q);
        $this->db->or_like('nama_lengkap', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('images', $q);
        $this->db->or_like('id_user_level', $q);
        $this->db->or_like('code', $q);
        $this->db->or_like('active', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_user', $q);
        $this->db->or_like('nama_lengkap', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('images', $q);
        $this->db->or_like('id_user_level', $q);
        $this->db->or_like('code', $q);
        $this->db->or_like('active', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // insert data daftar
    public function insert1($user)
    {
        $this->db->insert('tbl_user', $user);
        //return $this->db->insert_id(); 
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-04 06:32:22 */
/* http://harviacode.com */