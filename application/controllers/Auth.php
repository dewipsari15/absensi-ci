<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
	}

	// Menampilkan halaman login
	public function index()
	{
		$this->load->view('auth/login');
	}

    // Aksi untuk login
	public function aksi_login()
    {
        // Mengambil data email dan password yang dikirimkan melalui form login.
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        // Membuat array $data untuk mencari pengguna berdasarkan alamat email.
        $data = [
            'email' => $email,
        ];
        // Mencari data pengguna dengan alamat email yang sesuai dalam database.
        $query = $this->m_model->getwhere('user', $data);
        // Mengambil hasil pencarian dalam bentuk array asosiatif.
        $result = $query->row_array();
 
        // Memeriksa apakah hasil pencarian tidak kosong dan kata sandi cocok.
        if (!empty($result) && md5($password) === $result['password']) {
            // Jika berhasil login:
 
            // Membuat array $data_sess untuk sesi pengguna.
            $data = [
                'logged_in' => TRUE, // Menandakan bahwa pengguna sudah login.
                'email' => $result['email'],
                'username' => $result['username'],
                'role' => $result['role'], // Menyimpan peran pengguna (admin/karyawan).
                'id' => $result['id'],
            ];
            // Mengatur data sesi pengguna dengan informasi di atas.
            $this->session->set_userdata($data);
            // Mengarahkan pengguna ke halaman berdasarkan peran mereka.
            if ($this->session->userdata('role') == 'karyawan') {
               $this->session->set_flashdata('berhasil_login', 'Selamat datang diaplikasi absensi.');
               redirect(base_url() . 'karyawan');
           } elseif ($this->session->userdata('role') == 'admin') {
               $this->session->set_flashdata('berhasil_login', 'Selamat datang diaplikasi absensi.');
    		    redirect(base_url() . "admin");
           } else {
               redirect(base_url()."auth");
           }
        } else {
            // Jika login gagal, menampilkan pesan kesalahan kepada pengguna.
           $this->session->set_flashdata('gagal_login', 'Gagal Login!!, Silahkan coba kembali.');
           redirect(base_url().'auth'); // Mengarahkan pengguna kembali ke halaman login.
        }
    }

	// Menampilkan halaman register karyawan
	public function register()
	{
		$this->load->view('auth/register');
	}

    // Aksi register untuk registrasi karyawan
    public function aksi_register()
    { 
        $username = $this->input->post('username', true);
        $email = $this->input->post('email', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $password = $this->input->post('password', true);

        // Validasi input
        if (empty($username) || empty($nama_depan) || empty($password)) {
            // Tampilkan pesan error jika ada input yang kosong
            $this->session->set_flashdata('error', 'Semua field harus diisi.');
            redirect(base_url().'auth/register'); // sesuaikan dengan URL halaman registrasi .
        } elseif (strlen($password) < 8) {
            $this->session->set_flashdata('register_gagal' , 'Password minimal 8 huruf.');
            redirect(base_url('auth/register'));
        } else {
            // dengan menggunakan model untuk menyimpan data pengguna
            $data = array(
                'username' => $username,
                'email' => $email,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'image' => 'User.png',
                'password' => md5($password), // Simpan kata sandi yang telah di-MD5
                'role' => 'karyawan' // Atur peran menjadi admin
            );
        
            // memanggil model untuk menyimpan data pengguna
            $this->m_model->tambah_data('user', $data);
            $this->session->set_flashdata('register_success', 'Registrasi berhasil. Silakan login.');
        
            // Setelah data pengguna berhasil disimpan, dapat mengarahkan pengguna
            // ke halaman login atau halaman lain yang sesuai.
            redirect(base_url().'auth'); // sesuaikan dengan URL halaman login
        }
    }
    
    // Menampilkan halaman register admin
    public function register_admin()
	{
        $this->load->view('auth/register_admin');
	}
    
    // Aksi register untuk registrasi admin
    public function aksi_register_admin()
    { 
        $username = $this->input->post('username', true);
        $email = $this->input->post('email', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $password = $this->input->post('password', true);

        // Validasi input
        if (empty($username) || empty($nama_depan) || empty($password)) {
            // Tampilkan pesan error jika ada input yang kosong
            $this->session->set_flashdata('error', 'Semua field harus diisi.');
            redirect(base_url().'auth/register_admin'); // sesuaikan dengan URL halaman registrasi .
        } elseif (strlen($password) < 8) {
            $this->session->set_flashdata('register_gagal' , 'Password minimal 8 huruf.');
            redirect(base_url('auth/register_admin'));
        } else {
            // dengan menggunakan model untuk menyimpan data pengguna
            $data = array(
                'username' => $username,
                'email' => $email,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'image' => 'User.png',
                'password' => md5($password), // Simpan kata sandi yang telah di-MD5
                'role' => 'admin' // Atur peran menjadi admin
            );
        
            // memanggil model untuk menyimpan data pengguna
            $this->m_model->tambah_data('user', $data);
            $this->session->set_flashdata('register_success', 'Registrasi berhasil. Silakan login.');
        
            // Setelah data pengguna berhasil disimpan, dapat mengarahkan pengguna
            // ke halaman login atau halaman lain yang sesuai.
            redirect(base_url().'auth'); // sesuaikan dengan URL halaman login
        }
    }
    
	// Aksi logout
	function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}