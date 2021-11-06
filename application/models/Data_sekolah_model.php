<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_sekolah_model extends CI_Model
{
    public $data_uri = 'data_sekolah';
    public $table = 'tbl_mst_sekolah';
    public $id = 'id_sekolah';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($tingkat = null)
    {
        $this->datatables->select('ts.id_sekolah as id,ts.nama_sekolah,tts.nama_tingkat,tks.nama_kepsek,ts.kuota');
        $this->datatables->from('tbl_mst_sekolah as ts');
        //add this line for join
        $this->datatables->join('tbl_kepala_sekolah as tks', 'ts.id_kepsek = tks.id_kepsek', 'left');
        $this->datatables->join('tbl_tingkat_sekolah as tts', 'ts.id_tingkat = tts.id_tingkat', 'left');
        if ($tingkat != null) {
            $this->datatables->where('ts.id_tingkat', $tingkat);
        }
        $this->datatables->add_column(
            'action',
            // anchor(
            //     site_url('data_sekolah/read/$1'),
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
            'id'
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
        $this->db->or_like('nama_sekolah', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like($this->id, $q);
        $this->db->or_like('nama_sekolah', $q);
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