<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_sekolah_model');
        $this->load->library('datatables');
    }

    public function index()
    {
        $tingkat = [];
        $query = $this->db->get('tbl_tingkat_sekolah')->result_array();
        foreach ($query as $t) {
            $this->db->where('id_tingkat', $t['id_tingkat']);
            $sekolah = $this->db->get('tbl_mst_sekolah')->result_array();
            $kuota = [];
            foreach ($sekolah as $s) {
                $this->db->where('id_sekolah', $s['id_sekolah']);
                $td = $this->db->get('tbl_formulir')->num_rows();
                $s['sisa_kuota'] = $s['kuota'] - $td;
                $kuota[] = $s;
            }
            // $tingkat[] = $kuota;
            array_push($tingkat, [
                'tingkat' => $t['nama_tingkat'],
                'sekolah' => $kuota
            ]);
            // array_push($tingkat, ['sekolah' => $kuota]);
        }

        // echo json_encode($tingkat);
        // die;

        $data['sekolah'] = $tingkat;
        $this->template->load('guest_template', 'home', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Data_sekolah_model->json();
    }

    public function db_check()
    {
        echo $this->db['default']['hostname'];
    }
}
