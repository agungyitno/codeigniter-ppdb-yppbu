<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{

    public function index()
    {
        $data = [];
        if ($this->input->post('prov')) {
            if ($this->input->post('prov') != '') {
                $this->db->where('id_provinsi', $this->input->post('prov'));
                $data = $this->db->get('tbl_mst_kabupaten')->result();
                foreach ($data as $d) {
                    echo "<option value='" . $d->id_kabupaten . "'>" . $d->nama_kabupaten . "</option>";
                }
            }
        } elseif ($this->input->post('kab')) {
            if ($this->input->post('kab') != '') {
                $this->db->where('id_kabupaten', $this->input->post('kab'));
                $data = $this->db->get('tbl_mst_kecamatan')->result();
                foreach ($data as $d) {
                    echo "<option value='" . $d->id_kecamatan . "'>" . $d->nama_kecamatan . "</option>";
                }
            }
        } elseif ($this->input->post('kec')) {
            if ($this->input->post('kec') != '') {
                $this->db->where('id_kecamatan', $this->input->post('kec'));
                $data = $this->db->get('tbl_mst_desa')->result();
                foreach ($data as $d) {
                    echo "<option value='" . $d->id_desa . "'>" . $d->nama_desa . "</option>";
                }
            }
        }
    }
}
