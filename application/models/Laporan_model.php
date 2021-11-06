<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json_kuota($tingkat = null)
    {
        $this->datatables->select('tbl_mst_sekolah.id_sekolah as id,tbl_mst_sekolah.nama_sekolah,tbl_mst_sekolah.kuota');
        $this->datatables->join('tbl_formulir', 'tbl_mst_sekolah.id_sekolah = tbl_formulir.id_sekolah', 'left');
        $this->datatables->select('tbl_formulir.id_formulir as jumlah');
        $this->datatables->group_by('tbl_mst_sekolah.id_sekolah');
        $this->datatables->add_column('jumlah', '$1', 'get_jumlah("tbl_formulir","id_sekolah",id)');
        $this->datatables->from('tbl_mst_sekolah');
        if ($tingkat != null) {
            $this->datatables->where('tbl_mst_sekolah.id_tingkat', 5);
        }
        return $this->datatables->generate();
    }
    // datatables
    function json_asal_kota($tingkat = null)
    {
        $this->datatables->select('tbl_mst_sekolah.id_sekolah as id,tbl_mst_sekolah.nama_sekolah');
        $this->datatables->join('tbl_formulir', 'tbl_mst_sekolah.id_sekolah = tbl_formulir.id_sekolah');
        $this->datatables->select('tbl_formulir.id_formulir as jumlah');
        $this->datatables->group_by('tbl_mst_sekolah.id_sekolah');
        $this->datatables->join('tbl_mst_kabupaten', 'tbl_mst_kabupaten.id_kabupaten = tbl_formulir.id_kabupaten');
        $this->datatables->select('tbl_mst_kabupaten.nama_kabupaten,tbl_mst_kabupaten.id_kabupaten as kab');
        $this->datatables->group_by('tbl_formulir.id_kabupaten');
        $this->datatables->add_column('jumlah', '$1', 'get_jumlah("tbl_formulir","id_kabupaten",kab)');
        $this->datatables->from('tbl_mst_sekolah');
        if ($tingkat != null) {
            $this->datatables->where('tbl_mst_sekolah.id_tingkat', 5);
        }
        return $this->datatables->generate();
    }
    // datatables
    function json_asal_sekolah($tingkat = null)
    {
        $this->datatables->select('tbl_mst_sekolah.id_sekolah as id,tbl_mst_sekolah.nama_sekolah');
        $this->datatables->join('tbl_formulir', 'tbl_mst_sekolah.id_sekolah = tbl_formulir.id_sekolah');
        $this->datatables->select('tbl_formulir.id_formulir as jumlah,tbl_formulir.asal_sekolah as asal');
        $this->datatables->group_by('tbl_mst_sekolah.id_sekolah');
        $this->datatables->group_by('tbl_formulir.asal_sekolah');
        $this->datatables->add_column('jumlah', '$1', 'get_jumlah("tbl_formulir","asal_sekolah",asal)');
        $this->datatables->from('tbl_mst_sekolah');
        if ($tingkat != null) {
            $this->datatables->where('tbl_mst_sekolah.id_tingkat', 5);
        }
        return $this->datatables->generate();
    }
}
