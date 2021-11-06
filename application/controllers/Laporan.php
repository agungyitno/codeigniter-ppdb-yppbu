<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Laporan_model');
        $this->load->model('Data_kuota_model');
        $this->load->model('Form_pendaftaran_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->title = 'Laporan';
        $this->data_uri = 'laporan';
    }

    public function index()
    {
        $data = array(
            'title' => $this->title,
            'data_uri' => $this->data_uri,
        );
        $this->template->load('template', $this->data_uri . '/list', $data);
    }

    public function kuota()
    {
        $data = array(
            'title' => 'Laporan Jumlah Calon Siswa',
            'data_uri' => $this->data_uri,
        );
        $this->template->load('template', $this->data_uri . '/kuota', $data);
    }

    public function asal_kota()
    {
        $data = array(
            'title' => 'Laporan Asal Kota Calon Siswa',
            'data_uri' => 'laporan',
        );
        $this->template->load('template', $this->data_uri . '/asal_kota', $data);
    }

    public function asal_sekolah()
    {
        $data = array(
            'title' => 'Laporan Asal Sekolah Calon Siswa',
            'data_uri' => 'laporan',
        );
        $this->template->load('template', $this->data_uri . '/asal_sekolah', $data);
    }

    public function json_kuota()
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
        echo $this->Laporan_model->json_kuota($tingkat);
    }
    public function json_asal_kota()
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
        echo $this->Laporan_model->json_asal_kota($tingkat);
    }
    public function json_asal_sekolah()
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
        echo $this->Laporan_model->json_asal_sekolah($tingkat);
    }
}

/* End of file Tbl_instansi.php */
/* Location: ./application/controllers/Tbl_instansi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-24 17:51:23 */
/* http://harviacode.com */