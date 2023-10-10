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
		$this->load->view('admin/index');
	}
}