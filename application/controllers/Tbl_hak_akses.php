<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_hak_akses extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_hak_akses_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_hak_akses/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_hak_akses/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_hak_akses/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_hak_akses_model->total_rows($q);
        $tbl_hak_akses = $this->Tbl_hak_akses_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_hak_akses_data' => $tbl_hak_akses,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_hak_akses/tbl_hak_akses_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_hak_akses_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_user_level' => $row->id_user_level,
		'id_menu' => $row->id_menu,
		'create' => $row->create,
		'update' => $row->update,
		'delete' => $row->delete,
		'print' => $row->print,
	    );
            $this->template->load('template','tbl_hak_akses/tbl_hak_akses_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_hak_akses'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_hak_akses/create_action'),
	    'id' => set_value('id'),
	    'id_user_level' => set_value('id_user_level'),
	    'id_menu' => set_value('id_menu'),
	    'create' => set_value('create'),
	    'update' => set_value('update'),
	    'delete' => set_value('delete'),
	    'print' => set_value('print'),
	);
        $this->template->load('template','tbl_hak_akses/tbl_hak_akses_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_user_level' => $this->input->post('id_user_level',TRUE),
		'id_menu' => $this->input->post('id_menu',TRUE),
		'create' => $this->input->post('create',TRUE),
		'update' => $this->input->post('update',TRUE),
		'delete' => $this->input->post('delete',TRUE),
		'print' => $this->input->post('print',TRUE),
	    );

            $this->Tbl_hak_akses_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_hak_akses'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_hak_akses_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_hak_akses/update_action'),
		'id' => set_value('id', $row->id),
		'id_user_level' => set_value('id_user_level', $row->id_user_level),
		'id_menu' => set_value('id_menu', $row->id_menu),
		'create' => set_value('create', $row->create),
		'update' => set_value('update', $row->update),
		'delete' => set_value('delete', $row->delete),
		'print' => set_value('print', $row->print),
	    );
            $this->template->load('template','tbl_hak_akses/tbl_hak_akses_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_hak_akses'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_user_level' => $this->input->post('id_user_level',TRUE),
		'id_menu' => $this->input->post('id_menu',TRUE),
		'create' => $this->input->post('create',TRUE),
		'update' => $this->input->post('update',TRUE),
		'delete' => $this->input->post('delete',TRUE),
		'print' => $this->input->post('print',TRUE),
	    );

            $this->Tbl_hak_akses_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_hak_akses'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_hak_akses_model->get_by_id($id);

        if ($row) {
            $this->Tbl_hak_akses_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_hak_akses'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_hak_akses'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_user_level', 'id user level', 'trim|required');
	$this->form_validation->set_rules('id_menu', 'id menu', 'trim|required');
	$this->form_validation->set_rules('create', 'create', 'trim|required');
	$this->form_validation->set_rules('update', 'update', 'trim|required');
	$this->form_validation->set_rules('delete', 'delete', 'trim|required');
	$this->form_validation->set_rules('print', 'print', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_hak_akses.xls";
        $judul = "tbl_hak_akses";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User Level");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Menu");
	xlsWriteLabel($tablehead, $kolomhead++, "Create");
	xlsWriteLabel($tablehead, $kolomhead++, "Update");
	xlsWriteLabel($tablehead, $kolomhead++, "Delete");
	xlsWriteLabel($tablehead, $kolomhead++, "Print");

	foreach ($this->Tbl_hak_akses_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user_level);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_menu);
	    xlsWriteNumber($tablebody, $kolombody++, $data->create);
	    xlsWriteNumber($tablebody, $kolombody++, $data->update);
	    xlsWriteNumber($tablebody, $kolombody++, $data->delete);
	    xlsWriteNumber($tablebody, $kolombody++, $data->print);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_hak_akses.doc");

        $data = array(
            'tbl_hak_akses_data' => $this->Tbl_hak_akses_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_hak_akses/tbl_hak_akses_doc',$data);
    }

}

/* End of file Tbl_hak_akses.php */
/* Location: ./application/controllers/Tbl_hak_akses.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-08 10:22:27 */
/* http://harviacode.com */