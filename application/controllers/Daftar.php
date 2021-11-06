 <?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Daftar extends CI_Controller
  {

    function __construct()
    {
      parent::__construct();

      $this->load->model('Daftar_model');
      $this->load->model('User_model');
      $this->data['tbl_user'] = $this->Daftar_model->getAllUsers();
    }

    public function index()
    {
      $this->load->view('auth/register', $this->data);
    }

    public function register()
    {
      $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required');
      $this->form_validation->set_rules(
        'email',
        'Email',
        'valid_email|required|is_unique[tbl_user.email]',
        array('is_unique' => 'Email sudah terdaftar. Silahkan login atau gunakan email lain.')
      );
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[30]');
      $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
      $this->form_validation->set_message('required', '{field} wajib diisi.');
      $this->form_validation->set_message('min_length', 'Panjang {field} minimal {param} karakter.');
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('auth/register', $this->data);
      } else {
        //get user inputs
        $nama_lengkap = $this->input->post('nama_lengkap');
        $email = $this->input->post('email');
        $parts = explode('@', $email);
        $username = $parts[0];
        $password = $this->input->post('password');
        $options  = array("cost" => 4);
        // $hashPassword   = password_hash($password, PASSWORD_BCRYPT, $options);
        $hashPassword   = md5($password);

        //generate simple random code
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($set), 0, 12);
        $gambar = "default.png";
        $level = 4;
        // $status ='y';

        //insert user to users table and get id

        $user['username'] = $username;
        $user['nama_lengkap'] = $nama_lengkap;
        $user['email'] = $email;
        $user['password'] = $hashPassword;
        $user['images'] = $gambar;
        $user['id_user_level'] = $level;
        $user['code_email'] = $code;
        $user['active'] = false;
        $id = $this->Daftar_model->insert($user);

        // redirect('auth');
        // die;

        //set up email
        $config = array(
          'protocol' => 'smtp',
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'smtp_host' => 'ssl://smtp.gmail.com', //Ubah sesuai dengan host anda
          'smtp_port' => 465,
          'smtp_user' => 'email', // Ubah sesuai dengan email yang dipakai untuk mengirim konfirmasi
          'smtp_pass' => 'password', // ubah dengan password host anda
          'wordwrap' => TRUE
        );
        $message =  "<html>
                      <head>
                      <title>Kode Verifikasi Pendaftaran PPDB</title>
                      </head>
                      <body>
                      <h2>Terimaksih telah mendaftar.</h2>
                      <p>Akun anda:</p>
                      <p>Email: " . $email . "</p>
                      <p>Password: " . $password . "</p>
                      <p>Silahkan klik link dibawah ini untuk mengaktifkan akun anda.</p>
                      <h4><a href='" . base_url() . "daftar/activate/" . $id . "/" . $code . "'>Aktifkan akun</a></h4>
                      </body>
                      </html>";

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject('Signup Verification Email');
        $this->email->message($message);

        //sending email
        if ($this->email->send()) {
          $this->session->set_flashdata('message', 'Kode verifikasi dikirimkan ke email anda.');
        } else {
          $this->session->set_flashdata('message', $this->email->print_debugger());
        }

        redirect('daftar/register');
      }
    }

    public function activate()
    {
      $id =  $this->uri->segment(3);
      $code = $this->uri->segment(4);

      //fetch user details
      $user = $this->Daftar_model->getUser($id);
      // var_dump($user);
      // die;

      //if code matches
      if ($user['code'] == $code) {
        //update user active status
        $data['active'] = true;
        $query = $this->Daftar_model->activate($data, $id);


        if ($query) {
          $this->session->set_flashdata('message', 'Akun berhasil diaktifkan. Silahkan Login.');
        } else {
          $this->session->set_flashdata('message', 'Terjadi kesalahan saat mengaktifkan akun.');
        }
      } else {
        $this->session->set_flashdata('message', 'Tidak dapat mengaktifkan akun. Kode tidak cocok.');
      }

      redirect('auth');
    }
  }
