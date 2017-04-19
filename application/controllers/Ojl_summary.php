<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ojl_summary extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Home_model');
		$this->load->model('Agenda_model');
		$this->Login_model->checkAccess();
		
	}

	public function index() {
		$data['content'] = 'ojl_summary';
		$data['summary'] = $this->Agenda_model->get_summary();
		$this->load->view('template/layout', $data);
	}



}