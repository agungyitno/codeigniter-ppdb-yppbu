<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form_pendaftaran_model extends CI_Model
{
    public $data_uri = 'form_pendaftaran';
    public $table = 'tbl_formulir';
    public $id = 'id_formulir';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($tingkat = null)
    {
        $this->datatables->select($this->id . ',id_user,nama_siswa,jenis_kelamin,asal_sekolah,nama_sekolah');
        $this->datatables->from($this->table);
        $this->datatables->add_column('jenis_kelamin', '$1', 'rename_lp(jenis_kelamin)');
        //add this line for join
        $this->datatables->join('tbl_mst_sekolah', $this->table . '.id_sekolah = tbl_mst_sekolah.id_sekolah', 'left');

        if ($tingkat != null) {
            $this->datatables->where('tbl_mst_sekolah.id_tingkat', $tingkat);
        }

        $this->datatables->add_column(
            'action',
            anchor(
                site_url('data_pendaftar/read/$1'),
                '<i class="fa fa-eye" aria-hidden="true"></i>',
                array('class' => 'btn btn-danger')
            )
            // ." " . anchor(
            //         site_url('data_pendaftar/update/$1'),
            //         '<i class="fas fa-pencil-alt" aria-hidden="true"></i>',
            //         array('class' => 'btn btn-danger')
            //     )
            ,
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

    function get_by_user($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->get($this->table)->row();
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