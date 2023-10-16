<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_model');
		// $this->load->helper('my_helper');
        // $this->load->library('upload');
        if($this->session->userdata('logged_in')!=true || $this->session->userdata('role') != 'admin') {
            redirect(base_url().'auth');
        }
	}

	public function index()
	{
		$id_admin = $this->session->userdata('id');
		$data['absensi'] = $this->m_model->get_data('absensi')->result();
		$data['user'] = $this->m_model->get_data('user')->num_rows();
		$data['karyawan'] = $this->m_model->get_karyawan_rows();
		$data['absensi_num'] = $this->m_model->get_absensi_count();
		$this->load->view('admin/index', $data);
	}

	public function user()
	{
		$id_admin = $this->session->userdata('id');
		$data['user'] = $this->m_model->get_data('user')->result();
		$this->load->view('admin/karyawan', $data);
	}

	public function absen()
	{
		$id_admin = $this->session->userdata('id');
		$data['absensi'] = $this->m_model->get_data('absensi')->result();
		$this->load->view('admin/absen', $data);
	}

	public function rekapPerHari() {
		$tanggal = $this->input->get('tanggal');
        $data['perhari'] = $this->m_model->getPerHari($tanggal);
        $this->load->view('admin/rekapan/rekap_hari', $data);
    }

	public function rekapPerMinggu() {
		$start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        if ($start_date && $end_date) {
            $data['perminggu'] = $this->m_model->getRekapPerMinggu($start_date, $end_date);
        } else {
            $data['perminggu'] = []; // Atau lakukan sesuai dengan kebutuhan logika Anda jika tanggal tidak ada
        }

		$this->load->view('admin/rekapan/rekap_minggu', $data);
		// $data['absensi'] = $this->m_model->getPerMinggu();        
    }
	
	public function rekapPerBulan() {
        $bulan = $this->input->get('bulan'); // Ambil bulan dari parameter GET
        $data['rekap_bulanan'] = $this->m_model->getRekapPerBulan($bulan);
        $data['rekap_harian'] = $this->m_model->getRekapHarianByBulan($bulan);
        $this->load->view('admin/rekapan/rekap_bulan', $data);
    }

	public function profile()
	{
		$data['akun'] = $this->m_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
		$this->load->view('admin/akun/profile', $data);
	}

	public function edit_profile()
	{
		$password_baru = $this->input->post('password_baru');
		$konfirmasi_password = $this->input->post('konfirmasi_password');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$nama_depan = $this->input->post('nama_depan');
		$nama_belakang = $this->input->post('nama_belakang');

		$data = array(
			'email' => $email,
			'username' => $username,
			'nama_depan' => $nama_depan,
			'nama_belakang' => $nama_belakang,
		);

		if (!empty($password_baru)) {
			if ($password_baru === $konfirmasi_password) {
				$data['password'] = md5($password_baru);
				$this->session->set_flashdata('ubah_password', 'Berhasil mengubah password');
			} else {
				$this->session->set_flashdata('kesalahan_password', 'Password baru dan Konfirmasi password tidak sama');
				redirect(base_url('admin/profile'));
			}
		}

		$this->session->set_userdata($data);
		$update_result = $this->m_model->update_data('user', $data, array('id' => $this->session->userdata('id')));

		if ($update_result) {
			$this->session->set_flashdata('update_user', 'Data berhasil diperbarui');
			redirect(base_url('admin/profile'));
		} else {
			$this->session->set_flashdata('gagal_update', 'Gagal memperbarui data');
			redirect(base_url('admin/profile'));
		}
	}

	public function edit_foto() {
		$config['upload_path'] = './assets/images/user/'; // Lokasi penyimpanan gambar di server
		$config['allowed_types'] = 'jpg|jpeg|png'; // Tipe file yang diizinkan
		$config['max_size'] = 5120; // Maksimum ukuran file (dalam KB)
	
		$this->load->library('upload', $config);
	
		if ($this->upload->do_upload('userfile')) {
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
	
			// Update nama file gambar baru ke dalam database untuk user yang sesuai
			$user_id = $this->session->userdata('id'); // Ganti ini dengan cara Anda menyimpan ID user yang sedang login
			$current_image = $this->m_model->get_current_image($user_id); // Dapatkan nama gambar saat ini
	
			if ($current_image !== 'User.png') {
				// Hapus gambar saat ini jika bukan 'User.png'
				unlink('./assets/images/user/' . $current_image);
			}
	
			$this->m_model->update_image($user_id, $file_name); // Gantilah 'm_model' dengan model Anda
			$this->session->set_flashdata('berhasil_ubah_foto', 'Foto berhasil diperbarui.');

	
			// Redirect atau tampilkan pesan keberhasilan
			redirect('admin/profile'); // Gantilah dengan halaman yang sesuai
		} else {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error_profile', $error['error']);
			redirect('admin/profile');
			// Tangani kesalahan unggah gambar
		}
	}
}