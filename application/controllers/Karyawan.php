<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_model');
		// $this->load->helper('my_helper');
        // $this->load->library('upload');
        if($this->session->userdata('logged_in')!=true || $this->session->userdata('role') != 'karyawan') {
            redirect(base_url().'auth');
        }
	}

	public function index()
	{
		$data['absensi'] = $this->m_model->get_data('absensi')->num_rows();
		$this->load->view('karyawan/index', $data);
	}

	public function absensi()
	{
		$id_karyawan = $this->session->userdata('id');
		$data['absensi'] = $this->m_model->get_absensi_by_karyawan($id_karyawan);
		$this->load->view('karyawan/absensi', $data);
	}

	public function tambah_absen()
	{
		$this->load->view('karyawan/tambah_absen');
	}

	public function aksi_tambah_absen() {
		$id_karyawan = $this->session->userdata('id');
        $data = [
			'id_karyawan' => $id_karyawan,
			'kegiatan' => $this->input->post('kegiatan'),
			'status' => 'false',
			'keterangan_izin' => 'false',
			'jam_pulang' => '00:00:00', // Mengosongkan jam_pulang
		];
		$this->m_model->tambah_data('absensi', $data);
        $this->session->set_flashdata('berhasil_absen', 'Berhasil Absen.');
		redirect(base_url('karyawan/absensi'));
    }
	
	public function update_absen($id)
	{
		$data['absensi']=$this->m_model->get_by_id('absensi', 'id', $id)->result();
		$this->load->view('karyawan/update_absen', $data);
	}

	public function aksi_update_absen()
    {
        $id_karyawan = $this->session->userdata('id');
		$data = [
			'kegiatan' => $this->input->post('kegiatan'),
		];
		$eksekusi=$this->m_model->update_data
        ('absensi', $data, array('id'=>$this->input->post('id')));
        if($eksekusi)
        {
            $this->session->set_flashdata('berhasil_update', 'Berhasil mengubah kegiatan');
            redirect(base_url('karyawan/absensi'));
        }
        else
        {
            redirect(base_url('karyawan/update_absen/'.$this->input->post('id')));
        }
    }

	public function aksi_izin() {
		$id_karyawan = $this->session->userdata('id');
        $data = [
			'id_karyawan' => $id_karyawan,
			'kegiatan' => '-',
			'status' => 'true',
			'keterangan_izin' => 'true',
			'jam_masuk' => '00:00:00', // Mengosongkan jam_masuk
        	'jam_pulang' => '00:00:00', // Mengosongkan jam_pulang
		];
		$this->m_model->tambah_data('absensi', $data);
        $this->session->set_flashdata('berhasil_izin', 'Berhasil Izin.');
		redirect(base_url('karyawan/absensi'));
    }

	public function pulang($id) {
        $this->m_model->updateStatusPulang($id);
        redirect('karyawan/absensi');
    }

	public function hapus($id) {
        $this->m_model->delete('absensi', 'id', $id);
		redirect(base_url('karyawan/absensi'));
    }
}