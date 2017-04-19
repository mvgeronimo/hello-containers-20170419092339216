<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Home_model');
		
	}

	public function index()
	{	
		//$data['content']= 'login';

		
			if($this->session->userdata('is_logged') == 1) {
				redirect('home');
				
			} else {
				if(isset($_GET['id'])) {
					$agenda_id = $_GET['id'];
					$get_agenda = $this->Home_model->get_agenda($agenda_id);
					$psr_id = $get_agenda[0]->psr_id;
					$this->load->view('login');

				} else {
					$this->load->view('login');
				}
				


			}
		

		
		
	}

	public function verifyUser() {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = $this->Login_model->verifyUser($username, $password);
		if(count($result) > 0) {
			echo json_encode(array('result' => '1', 'data' => $result));
		} else {
			echo json_encode(array('result' => '0'));
		}

		// $agenda_id = $_POST['agenda_id'];
		// $empid = $this->session->userdata('empid');
		// if($agenda_id != '') {
		// 	$query = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
		// 	$res = $query->result();

		// 	if($res[0]->empid != $empid) {
		// 		$this->logout();
		// 	}
		// }
		
	}

	public function check_if_psr() {
		$agenda_id = $_POST['agenda_id'];
		$empid = $this->session->userdata('emp_id');
		$query = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
		$res = $query->result();

		if($res[0]->psr_id != $empid) {
			echo 'not';
		} else {
			echo 'yes';
		}

	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('home');
	}
}
