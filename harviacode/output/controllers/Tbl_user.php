<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_user_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));

        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_user/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_user/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_user_model->total_rows($q);
        $tbl_user = $this->Tbl_user_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_user_data' => $tbl_user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template', 'tbl_user/tbl_user_list', $data);
    }

    public function read($id)
    {
        $row = $this->Tbl_user_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_user' => $row->id_user,
                'nama_lengkap' => $row->nama_lengkap,
                'email' => $row->email,
                'password' => $row->password,
                'images' => $row->images,
                'id_user_level' => $row->id_user_level,
                'code' => $row->code,
                'active' => $row->active,
                'aktive' => $row->aktive,
            );
            $this->template->load('template', 'tbl_user/tbl_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_user'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_user/create_action'),
            'id_user' => set_value('id_user'),
            'nama_lengkap' => set_value('nama_lengkap'),
            'email' => set_value('email'),
            'password' => set_value('password'),
            'images' => set_value('images'),
            'id_user_level' => set_value('id_user_level'),
            'code' => set_value('code'),
            'active' => set_value('active'),
            'aktive' => set_value('aktive'),
        );
        $this->template->load('template', 'tbl_user/tbl_user_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE),
                'images' => $this->input->post('images', TRUE),
                'id_user_level' => $this->input->post('id_user_level', TRUE),
                'code' => $this->input->post('code', TRUE),
                'active' => $this->input->post('active', TRUE),
                'aktive' => $this->input->post('aktive', TRUE),
            );

            $this->Tbl_user_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_user'));
        }
    }

    public function update($id)
    {
        $row = $this->Tbl_user_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_user/update_action'),
                'id_user' => set_value('id_user', $row->id_user),
                'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                'email' => set_value('email', $row->email),
                'password' => set_value('password', $row->password),
                'images' => set_value('images', $row->images),
                'id_user_level' => set_value('id_user_level', $row->id_user_level),
                'code' => set_value('code', $row->code),
                'active' => set_value('active', $row->active),
                'aktive' => set_value('aktive', $row->aktive),
            );
            $this->template->load('template', 'tbl_user/tbl_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_user'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE),
                'images' => $this->input->post('images', TRUE),
                'id_user_level' => $this->input->post('id_user_level', TRUE),
                'code' => $this->input->post('code', TRUE),
                'active' => $this->input->post('active', TRUE),
                'aktive' => $this->input->post('aktive', TRUE),
            );

            $this->Tbl_user_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_user'));
        }
    }

    public function delete($id)
    {
        $row = $this->Tbl_user_model->get_by_id($id);

        if ($row) {
            $this->Tbl_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_user'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_lengkap', 'full name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('images', 'images', 'trim|required');
        $this->form_validation->set_rules('id_user_level', 'id user level', 'trim|required');
        $this->form_validation->set_rules('code', 'code', 'trim|required');
        $this->form_validation->set_rules('active', 'is aktif', 'trim|required');
        $this->form_validation->set_rules('aktive', 'aktive', 'trim|required');

        $this->form_validation->set_rules('id_user', 'id_user', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Tbl_user.php */
/* Location: ./application/controllers/Tbl_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-03 09:15:48 */
/* http://harviacode.com */