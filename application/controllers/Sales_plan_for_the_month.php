<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_plan_for_the_month extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Home_model');
		$this->load->model('Agenda_model');
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
		$data['content'] = 'ojl_sales_plan';
		$data['agenda_status'] = $res1[0]->status;
		$data['sales_plan'] = $this->Home_model->get_sales_plan($agenda_id);
		//$data['ds_st_iserv'] = $this->Home_model->get_ds_st_iserv($data['sales_plan'][0]->sales_plan_id);
		$data['psr_id'] = $res1[0]->psr_id;
		$this->load->view('template/layout', $data);

	}

	public function update_sales_plan() {
		/*$ds_id = $_POST['ds_id'];*/
		$ds_id = '';
		$remarks = $_POST['sales_remarks'];

		$this->Home_model->update_salesPlan($ds_id, $remarks);
	}

	public function delete_sales() {

		$agenda_id = $_POST['agenda_id'];
		$psr_id = $_POST['psr_id'];
		$query = $this->db->query("DELETE FROM ojl_SalesPlan where agenda_id = '".$agenda_id."' AND psr_id = '".$psr_id."'");
	}


}