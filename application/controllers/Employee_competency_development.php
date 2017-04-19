<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_competency_development extends CI_Controller {

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

			$year_today = date('Y');
			$year_minus2 = $year_today - 2;
			$year_plus1 = $year_today + 1;

			$data['agenda_status'] = $res1[0]->status;


			$query2 = $this->db->query("SELECT * FROM ojl_rating where empid = '".$res1[0]->psr_id."' AND (year >= '".$year_minus2."' AND year <= '".$year_plus1."')  order by year, sem");
        	$res2 = $query2->result();
        	$data_array = array();
        	foreach ($res2 as $key => $value) {
        		$data_array[$value->year][$value->sem] = new stdClass();

        		$data_array[$value->year][$value->sem]->rating = $value->rating;
        	}

        	$data['rating_data'] = $data_array;

		}


		$data['content'] = 'completion/employee_compentency_development';
		$data['abig'] = $this->Home_model->get_abig();

		//$data['cycle'] = $this->Home_model->get_cycle($data['abig'][0]->coverage_id);
		$this->load->view('template/layout', $data);
	}
}