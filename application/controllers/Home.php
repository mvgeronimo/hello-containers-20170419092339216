<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Home_model');
		$this->load->model('Agenda_model');
		$this->Login_model->checkAccess();
		
	}

	public function index()
	{	


		// echo '<pre>';
		// print_r($this->session->all_userdata()); exit();
		
		if($this->session->userdata('user_type') == 1) {
			$data['content']= 'home';
		} else if($this->session->userdata('user_type') == 3) {
			$data['evaluation'] = $this->Agenda_model->agenda_for_om();

		
			$data['content']= 'om_home';
		}

		 else {

			/*$agenda_id = $this->Agenda_model->Agenda_for_psr();
			$agendaID = $agenda_id[0]->agenda_id;
			$data['agenda'] = $this->Agenda_model->getAgenda($agendaID);
			$data['action_plan'] = $this->Agenda_model->getActionPlan($agendaID);
			$data['itenerary'] = $this->Agenda_model->getItenerary($agendaID);
			$data['evaluation'] = $this->Agenda_model->get_evaluation($agendaID);*/
			$data['content']= 'psr_home';
			// $data['mpi'] = $this->Home_model->Getmpi();
			// $data['planned'] = $this->Home_model->GetPlanned($data['mpi'][0]->record_id);
			// $data['functional_expertise'] = $this->Home_model->GetFunction_expertise($data['mpi'][0]->record_id, 'ojl_competency_functional_expertise');
			// $data['thinks_customer'] = $this->Home_model->GetFunction_expertise($data['mpi'][0]->record_id, 'ojl_competency_thinks_customer');
		}
		
		
		$this->load->view('template/layout',$data);
	}

	public function conforme_mp() {
		$mp_id = $_POST['mp_id'];

		$this->Home_model->mp_conforme($mp_id);
		
	}

	public function ojl_conforme() {
		$data['content']= 'psr/conforme';
		$data['mpi'] = $this->Home_model->Getmpi();
			
		$this->load->view('template/layout',$data);
	}

	public function ojl_conforme_details($mpi) {
		$data['mpi'] = $this->Home_model->Getmpi_where($mpi);
		$data['planned'] = $this->Home_model->GetPlanned($mpi);
		$data['functional_expertise'] = $this->Home_model->GetFunction_expertise($mpi, 'ojl_competency_functional_expertise');
		$data['thinks_customer'] = $this->Home_model->GetFunction_expertise($mpi, 'ojl_competency_thinks_customer');
		$data['content']= 'psr/ojl_conforme_mpi';
		$this->load->view('template/layout',$data);
	}

	public function remarks() {
		$data['content'] = 'psr/remarks';
		$data['remarks'] = $this->Home_model->getremarks();
		$this->load->view('template/layout', $data);
	}

	public function remarks_details($id) {
		$data['content'] = 'psr/remarks_details';
		$data['remarks'] = $this->Home_model->getRemarksDetails($id);
		$this->load->view('template/layout', $data);
	}

	public function update_remarks() {
		$record_id = $_POST['record_id'];
		$action_plan = $_POST['action_plan'];
		$role = $_POST['role'];

		//if($role == 'psr') {
			$data = array(
			'psr_action_plan' => $action_plan,
			
			);
		// /}
			$table = 'ojl_evaluation';
			$field = 'record_id';

		$this->Home_model->remarks_update($action_plan,$table,$record_id,$field);	
		


	}

	public function psr_conforme() {
		$agenda_id = $_POST['agenda_id'];
		$psr_remarks = $_POST['psr_action_plan'];
		$this->Agenda_model->psrConforme($agenda_id, $psr_remarks);

		$this->db->query("UPDATE ojl_agenda set status = 3 where agenda_id = '".$agenda_id."'");
	}

	public function om_aknowledge() {
		$agenda_id = $_POST['agenda_id'];
		$om_remarks = $_POST['om_remarks'];
		$this->Agenda_model->omConforme($agenda_id, $om_remarks);
		$this->db->query("UPDATE ojl_agenda set status = 4 where agenda_id = '".$agenda_id."'");
	}

	public function finish_ojl() {
		$agenda_id = $_POST['agenda_id'];
		$this->Agenda_model->finishOjl($agenda_id);	
	}

	
}
