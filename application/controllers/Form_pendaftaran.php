<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form_pendaftaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Form_pendaftaran_model');
        $this->load->model('Berkas_model');
        $this->load->model('Data_sekolah_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->title = 'Formulir Pendaftaran';
        $this->data_uri = 'form_pendaftaran';
    }

    public function index()
    {
        $data = array(
            'title' => $this->title,
            'data_uri' => $this->data_uri,
            'button' => 'Submit',
            'action' => site_url($this->data_uri . '/submit'),
            'id_formulir' => set_value('id_formulir'),
            'id_user' => set_value('id_user'),
            'id_sekolah' => set_value('id_sekolah'),
            'nama_siswa' => set_value('nama_siswa'),
            'nik' => set_value('nik'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'tempat_lahir' => set_value('tempat_lahir'),
            'tanggal_lahir' => set_value('tanggal_lahir'),
            'nama_ayah' => set_value('nama_ayah'),
            'pekerjaan_ayah' => set_value('pekerjaan_ayah'),
            'gaji_ayah' => set_value('gaji_ayah'),
            'nama_ibu' => set_value('nama_ibu'),
            'pekerjaan_ibu' => set_value('pekerjaan_ibu'),
            'gaji_ibu' => set_value('gaji_ibu'),
            'id_prov' => set_value('id_prov'),
            'id_kab' => set_value('id_kab'),
            'id_kec' => set_value('id_kec'),
            'kelurahan' => set_value('kelurahan'),
            'alamat' => set_value('alamat'),
            'no_telp' => set_value('no_telp'),
            'asal_sekolah' => set_value('asal_sekolah'),
            'tahun_lulus' => set_value('tahun_lulus'),
            'daftar_asrama' => set_value('daftar_asrama'),
        );

        $cek = $this->Form_pendaftaran_model->get_by_user($this->session->userdata('id_user'));
        // $this->template->load('template', $this->data_uri . '/form', $data);
        if (empty($cek)) {
            $this->template->load('template', $this->data_uri . '/form', $data);
        } else {
            $data['pesan'] = 'Formulir pendaftaran berhail disubmit.<br> Silahkan melengkapi berkas pada Menu Berkas.';
            $data['formulir'] = $cek;
            $this->template->load('template', $this->data_uri . '/success', $data);
        }
    }

    public function submit()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'id_user' => $this->input->post('id_user', TRUE),
                'id_sekolah' => $this->input->post('id_sekolah', TRUE),
                'nama_siswa' => $this->input->post('nama_siswa', TRUE),
                'nik_siswa' => $this->input->post('nik', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tmp_lahir' => $this->input->post('tempat_lahir', TRUE),
                'tgl_lahir' => $this->input->post('tanggal_lahir', TRUE),
                'nama_ayah' => $this->input->post('nama_ayah', TRUE),
                'id_pekerjaan_ayah' => $this->input->post('pekerjaan_ayah', TRUE),
                'id_gaji_ayah' => $this->input->post('gaji_ayah', TRUE),
                'nama_ibu' => $this->input->post('nama_ibu', TRUE),
                'id_pekerjaan_ibu' => $this->input->post('pekerjaan_ibu', TRUE),
                'id_gaji_ibu' => $this->input->post('gaji_ibu', TRUE),
                'negara' => 'Indonesia',
                'id_provinsi' => $this->input->post('id_prov', TRUE),
                'id_kabupaten' => $this->input->post('id_kab', TRUE),
                'id_kecamatan' => $this->input->post('id_kec', TRUE),
                'id_desa' => $this->input->post('kelurahan', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_telp' => $this->input->post('no_telp', TRUE),
                'asal_sekolah' => $this->input->post('asal_sekolah', TRUE),
                'thn_lulus' => $this->input->post('tahun_lulus', TRUE),
                'daftar_asrama' => $this->input->post('daftar_asrama', TRUE),
                'tanggal_daftar' => date('Y-m-d', time()),
            ];
            var_dump($data);
            $this->Form_pendaftaran_model->insert($data);
            $this->session->set_flashdata('message', show_alert('success', 'Formulir telah disubmit, Silahkan melengkapi berkas yang dibutuhkan.'));
            redirect(site_url($this->data_uri));
        }
    }

    public function cek_kuota($id)
    {
        $this->db->where('id_sekolah', $id);
        $total_data = $this->db->get('tbl_formulir')->num_rows();
        $this->db->where('id_sekolah', $id);
        $sekolah = $this->db->get('tbl_mst_sekolah')->row();
        if ($total_data >= $sekolah->kuota) {
            $rekomen = [];
            $this->db->where('id_tingkat', $sekolah->id_tingkat);
            $this->db->where('id_sekolah!=', $id);
            $tingkat = $this->db->get('tbl_mst_sekolah')->result_array();
            foreach ($tingkat as $t) {
                $this->db->where('id_sekolah', $t['id_sekolah']);
                $td = $this->db->get('tbl_formulir')->num_rows();
                $this->db->where('id_sekolah', $t['id_sekolah']);
                $tk = $this->db->get('tbl_mst_sekolah')->row();
                if ($td < $tk->kuota) {
                    $t['sisa_kuota'] = $tk->kuota - $td;
                    $rekomen[] = $t;
                }
            }
            echo json_encode($rekomen);
        } else {
            echo 'tersedia';
        }
    }

    public function cetak_kartu()
    {
        // to_pdf($this->data_uri . '/kartu', 'kartu');

        $formulir = $this->Form_pendaftaran_model->get_by_user($this->session->userdata('id_user'));
        if (empty($formulir)) {
            $data['pesan'] = 'Anda belum mengisi formulir.<br> Silahkan mengisi formulir pada menu Form Pendaftaran.';
            $this->template->load('template', $this->data_uri . '/notif', $data);
        } else {
            $berkas = $this->Berkas_model->get_by_user($this->session->userdata('id_user'));
            if (empty($berkas)) {
                $data['pesan'] = 'Anda belum melengkapi berkas.<br> Silahkan upload berkas pada menu Berkas.';
                $this->template->load('template', $this->data_uri . '/notif', $data);
            } else {
                $sekolah = $this->Data_sekolah_model->get_by_id($formulir->id_sekolah);
                $data = [
                    'nomor' => $formulir->id_formulir,
                    'nama' => $formulir->nama_siswa,
                    'sekolah' => $sekolah->nama_sekolah,
                    'jenis_kelamin' => $formulir->jenis_kelamin,
                ];

                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A6',
                    'orientation' => 'L'
                ]);
                $html = $this->load->view($this->data_uri . '/kartu', $data, true);
                $mpdf->WriteHTML($html);
                // $mpdf->Output($nama . '.pdf', 'D');
                $mpdf->Output();
            }
        }
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
