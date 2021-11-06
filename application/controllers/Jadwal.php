<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Jadwal_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->title = 'Jadwal';
        $this->data_uri = 'jadwal';
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
        echo $this->Jadwal_model->json($tingkat);
    }

    public function json_by_sekolah($id)
    {
        header('Content-Type: application/json');
        echo $this->Jadwal_model->json_by_sekolah($id);
    }

    public function read($id)
    {
        $row = $this->Jadwal_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => $this->title,
                'data_uri' => $this->data_uri,
                'id_jadwal' => $row->id_jadwal,
                'id_sekolah' => $row->id_sekolah,
                'nama_kegiatan' => $row->nama_kegiatan,
                'pelaksanaan' => $row->pelaksanaan,
            );
            $this->template->load('template', $this->data_uri . '/read', $data);
        } else {
            $this->session->set_flashdata('message', show_alert('danger', 'Data tidak ditemukan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function create()
    {
        $data = array(
            'title' => $this->title,
            'data_uri' => $this->data_uri,
            'button' => 'Simpan',
            'action' => site_url($this->data_uri . '/create_action'),
            'id_jadwal' => set_value('id_jadwal'),
            'id_sekolah' => set_value('id_sekolah'),
            'nama_kegiatan' => set_value('nama_kegiatan'),
            'pelaksanaan' => set_value('pelaksanaan'),
        );
        $this->template->load('template', $this->data_uri . '/form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_sekolah' => $this->input->post('id_sekolah', TRUE),
                'nama_kegiatan' => $this->input->post('nama_kegiatan', TRUE),
                'pelaksanaan' => $this->input->post('pelaksanaan', TRUE),
            );

            $this->Jadwal_model->insert($data);
            $this->session->set_flashdata('message', show_alert('success', 'Data berhasil ditambahkan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function update($id)
    {
        $row = $this->Jadwal_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => $this->title,
                'data_uri' => $this->data_uri,
                'button' => 'Simpan',
                'action' => site_url($this->data_uri . '/update_action'),
                'id_jadwal' => set_value('id_jadwal', $row->id_jadwal),
                'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
                'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
                'pelaksanaan' => set_value('pelaksanaan', $row->pelaksanaan),
            );
            $this->template->load('template', $this->data_uri . '/form', $data);
        } else {
            $this->session->set_flashdata('message', show_alert('danger', 'Data tidak ditemukan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function update_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jadwal', TRUE));
        } else {
            $data = array(
                'id_sekolah' => $this->input->post('id_sekolah'),
                'nama_kegiatan' => $this->input->post('nama_kegiatan', TRUE),
                'pelaksanaan' => $this->input->post('pelaksanaan', TRUE),
            );

            $update = $this->Jadwal_model->update($this->input->post('id_jadwal', TRUE), $data);
            $this->session->set_flashdata('message', show_alert('success', 'Data berhasil diupdate.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function delete($id)
    {
        $row = $this->Jadwal_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_model->delete($id);
            $this->session->set_flashdata('message', show_alert('success', 'Data berhasil dihapus.'));
            redirect(site_url($this->data_uri));
        } else {
            $this->session->set_flashdata('message', show_alert('danger', 'Data tidak ditemukan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_jadwal', 'id_jadwal', 'trim');
        $this->form_validation->set_rules('id_sekolah', 'id_sekolah', 'trim|required');
        $this->form_validation->set_rules('nama_kegiatan', 'nama_kegiatan', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Tbl_instansi.php */
/* Location: ./application/controllers/Tbl_instansi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-24 17:51:23 */
/* http://harviacode.com */