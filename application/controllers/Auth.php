<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
	}

	// login
	public function index()
	{
		$this->load->view('auth/login');
	}

	public function aksi_login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $data = ['email' => $email];
        $query = $this->m_model->getwhere('user', $data);
        $result = $query->row_array();

        if (!empty($result) && md5($password) === $result['password']) {
            $data = [
                'logged_in' => true,
                'email' => $result['email'],
                'username' => $result['username'],
                'role' => $result['role'],
                'id' => $result['id'],
            ];
            $this->session->set_userdata($data);
            if ($this->session->userdata('role') == 'karyawan') {
                $this->session->set_flashdata('berhasil_login', 'Selamat datang diaplikasi absensi.');
                redirect(base_url() . 'karyawan');
            } elseif ($this->session->userdata('role') == 'admin') {
				redirect(base_url() . "admin");
			} else {
                $this->session->set_flashdata('gagal_login', 'Silahkan periksa email dan password anda.');
                redirect(base_url() . 'auth');
            }
        } else {
            $this->session->set_flashdata('gagal_login_i', 'Akun atau Password anda kosong!');
            redirect(base_url() . 'auth');
        }
    }

	// register
	public function register()
	{
		$this->load->view('auth/register');
	}

	public function aksi_register() 
    { 
        $this->load->library('form_validation'); 
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
        $this->form_validation->set_rules('username', 'username');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
        $this->form_validation->set_rules('role', 'role');
        $this->form_validation->set_rules('nama_depan', 'nama_depan');
        $this->form_validation->set_rules('nama_belakang', 'nama_belakang');
        $this->form_validation->set_rules('image', 'image');

        $email = $this->input->post('email', true);
        $username = $this->input->post('username', true);
        $password = md5($this->input->post('password', true));
        $role = $this->input->post('role', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $image = $this->input->post('image', true);

        // Membuat array data
        $data = [
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'role' => 'karyawan',
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'image' => 'User.png'
        ];

        $this->db->insert('user', $data);

        redirect('auth');
    }

    // register admin
    public function register_admin()
	{
		$this->load->view('auth/register');
	}

    public function aksi_register_admin() 
    { 
        $this->load->library('form_validation'); 
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
        $this->form_validation->set_rules('username', 'username');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
        $this->form_validation->set_rules('role', 'role');
        $this->form_validation->set_rules('nama_depan', 'nama_depan');
        $this->form_validation->set_rules('nama_belakang', 'nama_belakang');
        $this->form_validation->set_rules('image', 'image');

        $email = $this->input->post('email', true);
        $username = $this->input->post('username', true);
        $password = md5($this->input->post('password', true));
        $role = $this->input->post('role', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $image = $this->input->post('image', true);

        // Membuat array data
        $data = [
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'role' => 'admin',
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'image' => 'User.png'
        ];

        $this->db->insert('user', $data);

        redirect('auth');
    }

	// logout
	function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}