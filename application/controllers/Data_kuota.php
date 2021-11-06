<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_kuota extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Data_kuota_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->title = 'Data Kuota';
        $this->data_uri = 'data_kuota';
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
        header('Content-Type: application/json');
        echo $this->Data_kuota_model->json();
    }

    public function read($id)
    {
        $row = $this->Data_kuota_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => $this->title,
                'data_uri' => $this->data_uri,
                'id_kuota' => $row->id_kuota,
                'id_sekolah' => $row->id_sekolah,
                'kuota' => $row->kuota,
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
            'id_kuota' => set_value('id_kuota'),
            'id_sekolah' => set_value('id_sekolah'),
            'kuota' => set_value('kuota'),
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
                'id_sekolah' => intval($this->input->post('id_sekolah', TRUE)),
                'kuota' => $this->input->post('kuota', TRUE),
            );

            $this->Data_kuota_model->insert($data);
            $this->session->set_flashdata('message', show_alert('success', 'Data berhasil ditambahkan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function update($id)
    {
        $row = $this->Data_kuota_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => $this->title,
                'data_uri' => $this->data_uri,
                'button' => 'Simpan',
                'action' => site_url($this->data_uri . '/update_action'),
                'id_kuota' => set_value('id_kuota', $row->id_kuota),
                'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
                'kuota' => set_value('kuota', $row->kuota),
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
            $this->update($this->input->post('id_kuota', TRUE));
        } else {
            $data = array(
                'id_sekolah' => $this->input->post('id_sekolah'),
                'kuota' => $this->input->post('kuota', TRUE),
            );

            $update = $this->Data_kuota_model->update($this->input->post('id_kuota', TRUE), $data);
            $this->session->set_flashdata('message', show_alert('success', 'Data berhasil diupdate.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_kuota_model->get_by_id($id);

        if ($row) {
            $this->Data_kuota_model->delete($id);
            $this->session->set_flashdata('message', show_alert('success', 'Data berhasil dihapus.'));
            redirect(site_url($this->data_uri));
        } else {
            $this->session->set_flashdata('message', show_alert('danger', 'Data tidak ditemukan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_kuota', 'id_kuota', 'trim');
        $this->form_validation->set_rules('id_sekolah', 'id_sekolah', 'trim|required');
        $this->form_validation->set_rules('kuota', 'kuota', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Tbl_instansi.php */
/* Location: ./application/controllers/Tbl_instansi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-24 17:51:23 */
/* http://harviacode.com */