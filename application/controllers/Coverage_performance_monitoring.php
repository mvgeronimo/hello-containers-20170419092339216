<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coverage_performance_monitoring extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Agenda_model');
		$this->load->model('Home_model');
		$this->Login_model->checkAccess();
		
	}

	public function index() {

		if(isset($_GET['id'])) {
			$agenda_id = $_GET['id'];
			$query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
        	$res1 = $query1->result();
        	$this->session->set_userdata('agenda_psr', $res1[0]->psr_id);
        	$this->session->set_userdata('step', $res1[0]->step);
			$this->session->set_userdata('agenda_id', $agenda_id);
		}

		
		$data['content'] = 'ojl_cp_monitoring';
		$data['abig'] = $this->Home_model->get_abig();

		//$data['cycle'] = $this->Home_model->get_cycle($data['abig'][0]->coverage_id);
		$this->load->view('template/layout', $data);
	}
}