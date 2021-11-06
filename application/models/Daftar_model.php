<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllUsers()
    {
        $query = $this->db->get('tbl_user');
        return $query->result();
    }

    public function insert($user)
    {
        $this->db->insert('tbl_user', $user);
        return $this->db->insert_id();
    }

    public function getUser($id)
    {
        $query = $this->db->get_where('tbl_user', array('id_user' => $id));
        return $query->row_array();
    }

    public function getUseremail($email)
    {
        $query = $this->db->get_where('tbl_user', array('email' => $email));
        return $query->row_array();
    }

    public function activate($data, $id)
    {
        $this->db->where('tbl_user.id_user', $id);
        return $this->db->update('tbl_user', $data);
    }
}
