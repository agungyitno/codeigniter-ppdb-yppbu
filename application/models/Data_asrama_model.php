<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_asrama_model extends CI_Model
{
    public $data_uri = 'data_asrama';
    public $table = 'tbl_mst_asrama';
    public $id = 'id_asrama';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select($this->id . ',nama_asrama,tb1.nama_pengasuh as p1,tb2.nama_pengasuh as p2');
        $this->datatables->from($this->table);
        //add this line for join
        $this->datatables->join('tbl_pengasuh as tb1', 'tb1.id_pengasuh =' . $this->table . '.id_pengasuh1', 'left');
        $this->datatables->join('tbl_pengasuh as tb2', 'tb2.id_pengasuh =' . $this->table . '.id_pengasuh2', 'left');
        $this->datatables->add_column(
            'action',
            // anchor(
            //     site_url($this->data_uri .'/read/$1'),
            //     '<i class="fa fa-eye" aria-hidden="true"></i>',
            //     array('class' => 'btn btn-danger')
            // ) . 
            "" . anchor(
                site_url($this->data_uri . '/update/$1'),
                '<i class="fas fa-pencil-alt" aria-hidden="true"></i>',
                array('class' => 'btn btn-danger')
            ) . " 
                " . anchor(
                site_url($this->data_uri . '/delete/$1'),
                '<i class="fa fa-trash" aria-hidden="true"></i>',
                'class="btn btn-danger " onclick="javasciprt: return confirm(\'Are You Sure ?\')"'
            ),
            $this->id
        );
        return $this->datatables->generate();
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
        $this->db->like($this->id, $q);
        $this->db->or_like('nama_asrama', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like($this->id, $q);
        $this->db->or_like('nama_asrama', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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

/* End of file Tbl_instansi_model.php */
/* Location: ./application/models/Tbl_instansi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-24 17:51:23 */
/* http://harviacode.com */