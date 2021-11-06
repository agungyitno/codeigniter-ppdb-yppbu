<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_pendaftar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Form_pendaftaran_model');
        $this->load->model('Data_pekerjaan_model');
        $this->load->model('Data_gaji_model');
        $this->load->model('Data_sekolah_model');
        $this->load->model('Data_asrama_model');
        $this->load->model('Berkas_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->title = 'Data Pendaftar';
        $this->data_uri = 'data_pendaftar';
    }

    public function index()
    {
        $data = array(
            'title' => $this->title,
            'data_uri' => $this->data_uri,
        );
        $this->template->load('template', $this->data_uri . '/list', $data);
    }

    public function json()
    {
        $tingkat = null;
        $level = $this->session->userdata('id_user_level');
        if ($level == 5) {
            $tingkat = 5;
        } elseif ($level == 6) {
            $tingkat = 4;
        } elseif ($level == 7) {
            $tingkat = 3;
        } elseif ($level == 8) {
            $tingkat = 2;
        } elseif ($level == 9) {
            $tingkat = 1;
        }
        header('Content-Type: application/json');
        echo $this->Form_pendaftaran_model->json($tingkat);
    }

    public function read($id)
    {
        $formulir = $this->Form_pendaftaran_model->get_by_id($id);
        $query = $this->Data_pekerjaan_model->get_by_id($formulir->id_pekerjaan_ayah);
        $pekerjaan_ayah = $query->nama_pekerjaan;

        $query = $this->Data_gaji_model->get_by_id($formulir->id_gaji_ayah);
        $gaji_ayah = $query->nominal;

        $query = $this->Data_pekerjaan_model->get_by_id($formulir->id_pekerjaan_ibu);
        $pekerjaan_ibu = $query->nama_pekerjaan;

        $query = $this->Data_gaji_model->get_by_id($formulir->id_gaji_ibu);
        $gaji_ibu = $query->nominal;

        $query = $this->Data_sekolah_model->get_by_id($formulir->id_sekolah);
        $sekolah = $query->nama_sekolah;

        $this->db->where('id_user', $formulir->id_user);
        $berkas = $this->db->get('tbl_berkas')->result();

        if ($formulir->daftar_asrama == 'Y') {
            $asrama = 'YA';
        } else {
            $asrama = 'TIDAK';
        }

        $this->db->where('id_provinsi', $formulir->id_provinsi);
        $query = $this->db->get('tbl_mst_provinsi')->row();
        $provinsi = $query->nama_provinsi;

        $this->db->where('id_kabupaten', $formulir->id_kabupaten);
        $query = $this->db->get('tbl_mst_kabupaten')->row();
        $kabupaten = $query->nama_kabupaten;

        $this->db->where('id_kecamatan', $formulir->id_kecamatan);
        $query = $this->db->get('tbl_mst_kecamatan')->row();
        $kecamatan = $query->nama_kecamatan;

        $this->db->where('id_desa', $formulir->id_desa);
        $query = $this->db->get('tbl_mst_desa')->row();
        $desa = $query->nama_desa;

        $data = array(
            'title' => $this->title,
            'data_uri' => $this->data_uri,
            'button' => 'Submit',
            'action' => site_url($this->data_uri . '/submit'),
            'id_formulir' => $formulir->id_formulir,
            'id_user' => set_value('id_user'),
            'id_sekolah' => $sekolah,
            'nama_siswa' => $formulir->nama_siswa,
            'nik' => $formulir->nik_siswa,
            'jenis_kelamin' => $formulir->jenis_kelamin,
            'tempat_lahir' => $formulir->tmp_lahir,
            'tanggal_lahir' => $formulir->tgl_lahir,
            'nama_ayah' => $formulir->nama_ayah,
            'pekerjaan_ayah' => $pekerjaan_ayah,
            'gaji_ayah' => $gaji_ayah,
            'nama_ibu' => $formulir->nama_ibu,
            'pekerjaan_ibu' => $pekerjaan_ibu,
            'gaji_ibu' => $gaji_ibu,
            'id_negara' => $formulir->negara,
            'id_prov' => $provinsi,
            'id_kab' => $kabupaten,
            'id_kec' => $kecamatan,
            'kelurahan' => $desa,
            'alamat' => $formulir->alamat,
            'no_telp' => $formulir->no_telp,
            'asal_sekolah' => $formulir->asal_sekolah,
            'tahun_lulus' => $formulir->thn_lulus,
            'id_asrama' => $asrama,
            'berkas' => $berkas,
            'tgl_daftar' => $formulir->tanggal_daftar,
        );
        $this->template->load('template', $this->data_uri . '/read', $data);
    }
}
