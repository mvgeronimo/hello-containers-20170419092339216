<?php
if  ( ! defined('BASEPATH'))exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Ojl_completion_calendar extends CI_Controller{

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Home_model');
		$this->Login_model->checkAccess();
		
	}

	public function index() {
		$data['content'] = 'ojl_completion_calendar';
		$this->load->view('template/layout', $data);
	}

	public function change_agenda_session(){
		$agenda_id = $_POST['agenda_id'];
		$this->session->set_userdata('agenda_id', $agenda_id);
		echo $this->session->userdata('agenda_id');
	}
}