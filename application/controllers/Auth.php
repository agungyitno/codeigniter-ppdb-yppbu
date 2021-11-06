<?php
class Auth extends CI_Controller
{

    function index()
    {
        $this->load->view('auth/login');
    }

    function cheklogin()
    {
        $email      = $this->input->post('email');
        //$password   = $this->input->post('password');
        $password = $this->input->post('password', TRUE);
        // query chek users
        $this->db->where('email', $email);
        //$this->db->where('password',  $test);
        $users       = $this->db->get('tbl_user');
        if ($users->num_rows() > 0) {
            $user = $users->row_array();
            if ($user['password'] == md5($password)) {
                if ($user['active'] == 1) {
                    // retrive user data to session
                    $this->session->set_userdata($user);
                    redirect('welcome');
                } else {
                    $this->session->set_flashdata('status_login', 'Akun belum aktif. Silahkan cek email anda!');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('status_login', 'Password yang anda input salah!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('status_login', 'Email tidak terdaftar!');
            redirect('auth');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('status_login', 'Anda sudah berhasil keluar dari aplikasi');
        redirect(base_url());
    }
}
