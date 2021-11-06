<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_sekolah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Data_sekolah_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->title = 'Data Sekolah';
        $this->data_uri = 'data_sekolah';
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
        // $this->db->where('id_user_level', $level);
        // $q = $this->db->get('tbl_user_level');
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
        echo $this->Data_sekolah_model->json($tingkat);
    }

    public function read($id)
    {
        $row = $this->Data_sekolah_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => $this->title,
                'data_uri' => $this->data_uri,
                'id_sekolah' => $row->id_sekolah,
                'nama_sekolah' => $row->nama_sekolah,
            );
            $this->template->load('template', $this->data_uri . '/read', $data);
        } else {
            $this->session->set_flashdata('message', show_alert('danger', 'Data tidak ditemukan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function create()
    {
        $tingkat = null;
        $dis = null;
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
        if ($tingkat != null) {
            $dis = 'disabled';
        }
        $data = array(
            'title' => $this->title,
            'data_uri' => $this->data_uri,
            'button' => 'Simpan',
            'action' => site_url($this->data_uri . '/create_action'),
            'id_sekolah' => set_value('id_sekolah'),
            'nama_sekolah' => set_value('nama_sekolah'),
            'kuota' => set_value('kuota'),
            'id_tingkat' => set_value('id_tingkat', $tingkat),
            'id_kepsek' => set_value('id_kepsek'),
            'disabled' => $dis
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
                'nama_sekolah' => $this->input->post('nama_sekolah', TRUE),
                'kuota' => $this->input->post('kuota', TRUE),
                'id_tingkat' => $this->input->post('id_tingkat', TRUE),
                'id_kepsek' => $this->input->post('id_kepsek', TRUE),
            );

            $this->Data_sekolah_model->insert($data);
            $this->session->set_flashdata('message', show_alert('success', 'Data berhasil ditambahkan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function update($id)
    {
        $tingkat = null;
        $dis = null;
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
        if ($tingkat != null) {
            $dis = 'disabled';
        }
        $row = $this->Data_sekolah_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => $this->title,
                'data_uri' => $this->data_uri,
                'button' => 'Simpan',
                'action' => site_url($this->data_uri . '/update_action'),
                'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
                'id_tingkat' => set_value('id_tingkat', $row->id_tingkat),
                'nama_sekolah' => set_value('nama_sekolah', $row->nama_sekolah),
                'kuota' => set_value('kuota', $row->kuota),
                'id_kepsek' => set_value('id_kepsek', $row->id_kepsek),
                'disabled' => $dis
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
            $this->update($this->input->post('id_sekolah', TRUE));
        } else {
            $data = array(
                'nama_sekolah' => $this->input->post('nama_sekolah', TRUE),
                'kuota' => $this->input->post('kuota', TRUE),
                'id_tingkat' => $this->input->post('id_tingkat', TRUE),
                'id_kepsek' => $this->input->post('id_kepsek', TRUE),
            );

            $this->Data_sekolah_model->update($this->input->post('id_sekolah', TRUE), $data);
            $this->session->set_flashdata('message', show_alert('success', 'Data berhasil diupdate.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_sekolah_model->get_by_id($id);

        if ($row) {
            $this->Data_sekolah_model->delete($id);
            $this->session->set_flashdata('message', show_alert('success', 'Data berhasil dihapus.'));
            redirect(site_url($this->data_uri));
        } else {
            $this->session->set_flashdata('message', show_alert('danger', 'Data tidak ditemukan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_sekolah', 'nama sekolah', 'trim|required');
        $this->form_validation->set_rules('kuota', 'kuota sekolah', 'trim|required');
        $this->form_validation->set_rules('id_tingkat', 'tingkat sekolah', 'trim|required');
        $this->form_validation->set_rules('id_sekolah', 'id_sekolah', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Tbl_instansi.php */
/* Location: ./application/controllers/Tbl_instansi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-24 17:51:23 */
/* http://harviacode.com */