<?php
function cmb_dinamis($name, $table, $field, $pk, $kosong, $selected = null, $disabled = null, $order = null)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control' " . $disabled . ">";
    $cmb .= "<option value=''>$kosong</option>";
    if ($order) {
        $ci->db->order_by($field, $order);
    }
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" .  strtoupper($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function select2_dinamis($name, $table, $field, $placeholder)
{
    $ci = get_instance();
    $select2 = '<select name="' . $name . '" class="form-control select2 select2-hidden-accessible" multiple="" 
               data-placeholder="' . $placeholder . '" style="width: 100%;" tabindex="-1" aria-hidden="true">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row) {
        $select2 .= ' <option>' . $row->$field . '</option>';
    }
    $select2 .= '</select>';
    return $select2;
}

function datalist_dinamis($name, $table, $field, $value = null)
{
    $ci = get_instance();
    $string = '<input value="' . $value . '" name="' . $name . '" list="' . $name . '" class="form-control">
    <datalist id="' . $name . '">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row) {
        $string .= '<option value="' . $row->$field . '">';
    }
    $string .= '</datalist>';
    return $string;
}

function rename_string_is_aktif($string)
{
    return $string == 'Y' || $string == 'y' ? 'Aktif' : 'Tidak Aktif';
}

function rename_lp($string)
{
    return $string == 'L' ? 'Laki-laki' : 'Perempuan';
}

function rename_active($val)
{
    return $val == 1 ? 'Aktif' : 'Tidak Aktif';
}

function is_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('id_user')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Silahkan Login untuk melanjutkan.</div>');
        redirect('auth');
    } else {
        $modul = $ci->uri->segment(1);

        $id_user_level = $ci->session->userdata('id_user_level');
        //dapatkan nama level user
        //dapatkan setting hak akses
        // dapatkan id menu berdasarkan nama controller
        $menu = $ci->db->get_where('tbl_menu', array('url' => $modul))->row_array();
        $id_menu = $menu['id_menu'];
        // chek apakah user ini boleh mengakses modul ini
        $hak_akses = $ci->db->get_where('tbl_hak_akses', array('id_menu' => $id_menu, 'id_user_level' => $id_user_level));
        if ($hak_akses->num_rows() < 1) {
            redirect('blokir');
            exit;
        }
    }
}

function alert($class, $title, $description)
{
    return '<div class="alert ' . $class . ' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> ' . $title . '</h4>
                ' . $description . '
              </div>';
}

function show_alert($class, $msg)
{
    return '<div class="alert alert-' . $class . ' alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                ' . $msg . '
              </div>';
}

// untuk chek akses level pada modul peberian akses
function checked_akses($id_user_level, $id_menu)
{
    $ci = get_instance();
    $ci->db->where('id_user_level', $id_user_level);
    $ci->db->where('id_menu', $id_menu);
    $data = $ci->db->get('tbl_hak_akses');
    if ($data->num_rows() > 0) {
        return "checked='checked'";
    }
}


function autocomplate_json($table, $field)
{
    $ci = get_instance();
    $ci->db->like($field, $_GET['term']);
    $ci->db->select($field);
    $collections = $ci->db->get($table)->result();
    foreach ($collections as $collection) {
        $return_arr[] = $collection->$field;
    }
    echo json_encode($return_arr);
}

function to_pdf($html_file, $nama, $data = [])
{
    $ci = get_instance();
    // $stylesheet = file_get_contents(BASEPATH . '/assets/css/sb-admin-2.min.css');
    // $stylesheet = base_url() . 'assets/css/sb-admin-2.min.css';
    // $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [100, 200]]);
    $html = $ci->load->view($html_file, [], true);
    // $mpdf->WriteHTML($stylesheet, 1);
    // $mpdf->WriteHTML($html);
    $mpdf->SetHeader('Kartu Pendaftaran');
    $mpdf->WriteHTML($html, 2);
    // $mpdf->Output($nama . '.pdf', 'D');
    $mpdf->Output();
}

function get_jumlah($table, $column, $id = null)
{
    $ci = get_instance();
    if ($id != null) {
        $ci->db->where($column, $id);
    }
    return $ci->db->get($table)->num_rows();
}
