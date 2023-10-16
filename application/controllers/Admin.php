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
		
		$this->load->view('admin/index', $data);
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
}