<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Berkas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Berkas_model');
        $this->load->model('Form_pendaftaran_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->title = 'Berkas Pendaftaran';
        $this->data_uri = 'berkas';
    }

    public function index()
    {
        $cek = $this->Berkas_model->get_by_user($this->session->userdata('id_user'));
        $cek_formulir = $this->Form_pendaftaran_model->get_by_user($this->session->userdata('id_user'));
        $data = array(
            'title' => $this->title,
            'data_uri' => $this->data_uri,
            'button' => 'Submit',
            'action' => site_url($this->data_uri . '/submit'),
            'id_user' => set_value('id_user', $this->session->userdata('id_user')),
        );

        if (empty($cek_formulir)) {
            $data['pesan'] = 'Anda belum mengisi formulir.<br> Silahkan mengisi formulir pada menu Form Pendaftaran.';
            $this->template->load('template', $this->data_uri . '/formulir_kosong', $data);
        } else {
            if (empty($cek)) {
                $this->template->load('template', $this->data_uri . '/form', $data);
            } else {
                $this->db->where('id_user', $this->session->userdata('id_user'));
                $berkas = $this->db->get('tbl_berkas')->result();
                $data['pesan'] = 'Berkas pendaftaran berhail disubmit.<br> Silahkan mencetak kartu.';
                $data['berkas'] = $berkas;
                $this->template->load('template', $this->data_uri . '/success', $data);
            }
        }
    }

    public function upload()
    {
        $id_user = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $config['upload_path']          = './assets/berkas/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 2048;
        $config['file_name']           = $id_user . $nama;
        $config['overwrite'] = TRUE;
        // $config['max_width']            = 3000;
        // $config['max_height']           = 3000;
        $this->load->library('upload', $config);
        $this->load->initialize($config);
        if ($this->upload->do_upload('berkas')) {
            $berkas = $this->upload->data();
            $data = [
                'id_user' => $id_user,
                'nama_file' => $berkas['file_name'],
            ];
            $this->Berkas_model->insert($data);
            $status = 'success';
            $pesan = $berkas['file_name'] . ' Berhasil diupload!';
        } else {
            $status = 'error';
            $pesan = $this->upload->display_errors();
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'pesan' => $pesan)));
    }

    public function cetak()
    {
        to_pdf('form_pendaftaran/kartu', 'coba', []);
    }
}
