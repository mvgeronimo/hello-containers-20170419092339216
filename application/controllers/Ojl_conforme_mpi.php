<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ojl_conformer_mpi extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Agenda_model');
		$this->load->model('Home_model');
		$this->Login_model->checkAccess();
		
	}

	public function index() {
		$data['content'] = 'ojl_conforme_mpi';
		$data['mpi'] = $this->Home_model->Getmpi();
		$this->load->view('template/layout', $data);
	}
}