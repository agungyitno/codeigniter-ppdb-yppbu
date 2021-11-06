<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// is_login();
		$this->load->model('Jadwal_model');
		$this->load->model('Data_sekolah_model');
		$this->load->model('Form_pendaftaran_model');
	}

	public function index()
	{
		if (!$this->session->userdata('id_user')) {
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Silahkan Login untuk melanjutkan.</div>');
			redirect('auth');
		}
		$nama_sekolah = [];
		$formulir = $this->Form_pendaftaran_model->get_by_user($this->session->userdata('id_user'));
		$sekolah = $formulir->id_sekolah;

		$this->db->select('ts.id_sekolah,ts.nama_sekolah,count(tf.id_formulir) as jml,ts.kuota');
		$this->db->from('tbl_mst_sekolah as ts');
		$this->db->join('tbl_formulir as tf', 'ts.id_sekolah = tf.id_sekolah', 'left');
		$this->db->group_by('ts.id_sekolah');
		$g_jumlah = $this->db->get()->result();
		$data = [
			'sekolah' => $sekolah,
			'jadwal' => $this->Jadwal_model->get_by_sekolah($sekolah),
			'g_jumlah' => $g_jumlah
		];
		$this->template->load('template', 'welcome_message', $data);
	}

	public function jadwal_json()
	{
		header('Content-Type: application/json');
		echo $this->Jadwal_model->json();
	}
}
