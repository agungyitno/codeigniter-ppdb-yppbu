<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('User_model');
        $this->load->model('User_level_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->title = 'Profile';
        $this->data_uri = 'profile';
    }

    public function index()
    {
        $user = $this->User_model->get_by_id($this->session->userdata('id_user'));
        $level = $this->User_level_model->get_by_id($user->id_user_level);
        $data = array(
            'title' => $this->title,
            'data_uri' => $this->data_uri,
            'action' => site_url($this->data_uri . '/edit'),
            'user' => $user,
            'level' => $level,
        );
        // var_dump($data['user']);
        // var_dump($data['level']);
        // die;
        $this->template->load('template', $this->data_uri . '/profile', $data);
    }


    public function _rules()
    {
        $this->form_validation->set_rules('nama_siswa', 'nama_siswa', 'trim|required');
        $this->form_validation->set_rules('nik', 'nik', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'trim|required');
        $this->form_validation->set_rules('nama_ayah', 'nama_ayah', 'trim|required');
        $this->form_validation->set_rules('pekerjaan_ayah', 'pekerjaan_ayah', 'trim|required');
        $this->form_validation->set_rules('gaji_ayah', 'gaji_ayah', 'trim|required');
        $this->form_validation->set_rules('nama_ibu', 'nama_ibu', 'trim|required');
        $this->form_validation->set_rules('pekerjaan_ibu', 'pekerjaan_ibu', 'trim|required');
        $this->form_validation->set_rules('gaji_ibu', 'gaji_ibu', 'trim|required');
        $this->form_validation->set_rules('id_prov', 'id_prov', 'trim|required');
        $this->form_validation->set_rules('id_kab', 'id_kab', 'trim|required');
        $this->form_validation->set_rules('id_kec', 'id_kec', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'trim|required');
        $this->form_validation->set_rules('asal_sekolah', 'asal_sekolah', 'trim|required');
        $this->form_validation->set_rules('tahun_lulus', 'tahun_lulus', 'trim|required');
        $this->form_validation->set_rules('daftar_asrama', 'daftar_asrama', 'trim|required');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }
}
