<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ojl_schedule extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Home_model');
		$this->load->model('Agenda_model');
		$this->Login_model->checkAccess();
		
	}

	public function index() {
		$data['content'] = 'ojl_schedule';
		$this->load->view('template/layout', $data);
	}

	public function get_Events() {
		$data = $this->Home_model->getEvents();	
		$arr1 = array();

		foreach ($data as $key => $value) {
			$start = $value->start;
			$end = $value->end;
			$start2s = $start;
			$end2s = $end;

			$start = new DateTime($start);
				$end = new DateTime($end);
				$end->modify("+1 day");
				$interval = DateInterval::createFromDateString('1 day');
				$period = new DatePeriod($start, $interval, $end);

				foreach ( $period as $dt ):
					$start2 = $dt->format("Y-m-d");
					$end2 = $dt->format("Y-m-d");

					$arr2 = array(
								'agenda_id' => $value->agenda_id, 
								'start' => $start2, 'end' => $end2, 
								'title' => $value->title, 
								'status' => $value->status,
								'type' => $value->type,
								'step' => $value->step
								);

					array_push($arr1, $arr2);
				endforeach;

		}

		echo json_encode($arr1);
	}

	public function get_lastid() {
		$last_agenda_id = $this->Home_model->get_last_id('ojl_agenda');

		if(count($last_agenda_id) == 0) {
			$generated_id = 1;
		} else {
			foreach($last_agenda_id as $key => $c) {
				$generated_id = $c->agenda_id + 1;
			}
		}
		

		echo $generated_id;
	}

	public function create_new() {
		$data['content'] = 'schedule/create_new';
		$data['psr'] = $this->Home_model->get_data("ojl_psr");
		$data['territory'] = $this->Home_model->get_data("ojl_territory");
		$dropdown = $this->Home_model->get_data("ojl_agenda_name");
		$data['doctor'] = $this->Home_model->get_data("ojl_doctors","isActive = 1"); 
		$data['dropdown'] = $dropdown;

		$data['AgendaType'] = 1;

		$this->session->set_userdata('agenda_id', '');
		$this->session->set_userdata('agenda_psr', '');
		$this->session->set_userdata('step', 1);

		$this->load->view('template/layout', $data);
	}

	// public function new_version($agenda_id) {
		// $data['content'] = 'schedule/create_new';
		// $data['psr'] = $this->Home_model->get_data("ojl_psr");
		// print_r($this->Home_model->get_data("ojl_psr"));
		// die();
		// $data['territory'] = $this->Home_model->get_data("ojl_territory");
		// $dropdown = $this->Home_model->get_data("ojl_agenda_name");
		// $data['doctor'] = $this->Home_model->get_data("ojl_doctors","isActive = 1"); 
		// $data['dropdown'] = $dropdown;

		// for agenda details 
		// $data['agenda'] = $this->Agenda_model->getAgenda($agenda_id);
		// $data['action_plan'] = $this->Agenda_model->getActionPlan($agenda_id);
		// $data['itenerary'] = $this->Agenda_model->getItenerary($agenda_id);
		

		// $data['AgendaType'] = 2;

		// $this->load->view('template/layout', $data);
	// }
	
	public function new_version($agenda_id){
		$data['psr'] = $this->Home_model->get_data("ojl_psr");
		$data['agenda'] = $this->Home_model->get_data("ojl_agenda","agenda_id =".$agenda_id);
		$data['action_plan'] = $this->Agenda_model->getActionPlan($agenda_id);
		$data['territory'] = $this->Home_model->get_data("ojl_territory");
		$dropdown = $this->Home_model->get_data("ojl_agenda_name");
		$data['doctor'] = $this->Home_model->get_data("ojl_doctors","isActive = 1"); 
		$data['dropdown'] = $dropdown;

		$data['AgendaType'] = 1;

		$data['content'] = 'schedule/new_version';
		$this->load->view('template/layout', $data);
	}


	public function business_development() {
		$dropdown = $this->Home_model->get_data("ojl_agenda_name");
		// print_r($dropdown);
		// die();
		$data['dropdown'] = $dropdown;
		$data['content'] = 'schedule/business_development';

		$this->load->view('template/layout', $data);
	}

	public function itinerary() {
		$date = $this->Home_model->get_date();
		$date_from = $date[0]->date_from;
		$date_to = $date[0]->date_to;

		$datefrom = date_create($date_from);
		$datefrom = date_format($datefrom, 'F d, Y');
		$dateto = date_create($date_to);
		$dateto = date_format($dateto, 'F d, Y');

		$data['content'] = 'schedule/itenerary';
		$data['doctor'] = $this->Home_model->get_data("ojl_doctors","isActive = 1"); 
		$data['date_from'] = $datefrom;
		$data['date_to'] = $dateto;
		$this->load->view('template/layout', $data);
	}

	public function create_agenda() {
		$dm = $_POST['dm'];
		$psr_id = $_POST['psr_id'];
		$psr = $_POST['psr'];
		$salary = $_POST['salary'];
		$territory = $_POST['territory'];
		$date_from = $_POST['date_from'];
		$date_to = $_POST['date_to'];
		$consistency = $_POST['consistency'];
		$agendaid = $_POST['agendaid'];
		// $type = $_POST['agenda_type'];
		$createType = $_POST['createType'];

		$datefrom = date_create($date_from);
		$datefrom = date_format($datefrom, 'Y-m-d');

		$dateto = date_create($date_to);
		$dateto = date_format($dateto, 'Y-m-d');

		if($createType == 2) {
			$data = array(
				'agenda_id' => $agendaid,
				'dm' => $dm,
				'psr_id' => $psr_id,
				'psr' => $psr,
				'user_id' => $this->session->userdata('emp_id'),
				'salary' => $salary,
				'territory' => $territory,
				'date_from' => $datefrom,
				'date_to' => $dateto,
				'competency_standards' => $consistency,
				'status' => 0,
				'type' => $createType,
				'created_date' => date('Y-m-d H:i:s'),
				'is_active' => 1,
				'progress' => 'new',
				'step' => 2,
				'old_agenda' => $_POST['hid_agenda']
			);
			$this->db->query("UPDATE ojl_agenda SET is_old_agenda = 1 where agenda_id ='".$_POST['hid_agenda']."'");
		} else {
			$data = array(
				'agenda_id' => $agendaid,
				'dm' => $dm,
				'psr_id' => $psr_id,
				'psr' => $psr,
				'user_id' => $this->session->userdata('emp_id'),
				'salary' => $salary,
				'territory' => $territory,
				'date_from' => $datefrom,
				'date_to' => $dateto,
				'competency_standards' => $consistency,
				'status' => 0,
				'type' => $createType,
				'step' => 2,
				'created_date' => date('Y-m-d H:i:s'),
				'is_active' => 1,
				'progress' => 'new'
			);	
		}
		


		$this->Home_model->db_insert($data, 'ojl_agenda');

		$last_id = $this->db->insert_id();
		$this->session->set_userdata('agenda_id', $last_id);
		$this->session->set_userdata('agenda_psr', $psr);
		
		echo json_encode($last_id[0]->agenda_id);

	}

	public function create_emp() {
		$last_id = $this->Home_model->get_last_id('ojl_agenda');

		$this->Home_model->create_emp_comp($last_id[0]->agenda_id);
	}

	public function submit_agenda() {
		$status = $_POST['stat'];
		$result = $this->Home_model->SubmitAgenda($status);
		echo $result;
	}

	public function insert_business_development() {
		 $agenda_id = $this->session->userdata('agenda_id');
		 $type = 1;
		 $count =  count($_POST['agd_business']);
		 // print_r($_POST['agd_business']);
		 // echo $count;
		 // die();
		for($a=0;$a<$count;$a++)
		{
			$agenda_name = $_POST['agd_business'][$a];
			$action_plan =  $_POST['action_business'][$a];
			if($action_plan != ''){
			$data= array(
			'agenda_id' => $agenda_id,
			'agenda_name_id' => $agenda_name,
			'specific_plans' => $action_plan,
			'is_active' => 1,
			'actionPlanType' => $type
			);
			$this->Home_model->db_insert($data, 'ojl_ActionPlan');
		}
		}
				

	
	}
	

	public function insert_people_development() {
		
		 $agenda_id = $this->session->userdata('agenda_id');
		 $type = 2;
		 $count =  count($_POST['agd_ppl']);
		for($a=0;$a<$count;$a++)
		{
			$agenda_name = $_POST['agd_ppl'][$a];
			$action_plan =  $_POST['action_ppl'][$a];
			if($action_plan != ''){
			$data= array(
			'agenda_id' => $agenda_id,
			'agenda_name_id' => $agenda_name,
			'specific_plans' => $action_plan,
			'is_active' => 1,
			'actionPlanType' => $type
			);
			$this->Home_model->db_insert($data, 'ojl_ActionPlan');
			}
		}
		// $agenda_name = $_POST['agenda_name'];
		// $action_plan = $_POST['action_plan'];

		// $last_id = $this->Home_model->get_last_id('ojl_agenda');

		// foreach($last_id as $key => $c) {
			// $lastid = $c->agenda_id;
		// }

		// $data = array(
			// 'agenda_id' => $lastid,
			// 'agenda' => $agenda_name,
			// 'specific_plans' => $action_plan,
			// 'is_active' => 1
			// );

		// $this->Home_model->db_insert($data, 'ojl_people_development');
	}

	public function insert_itenerary() {
		//$last_id = $this->Home_model->get_last_id('ojl_agenda');

		$itenerary_name = $_POST['itenerary_name'];
		$doctor_id = $_POST['doctor_id'];
		$town_id = $_POST['town_id'];
		$hospital_id = $_POST['hospital_id'];
		//$status = $_POST['status'];
		$day = $_POST['day'];
		$agendaid = $this->session->userdata('agenda_id');
	

		// foreach($last_id as $key => $c) {
		// 	$lastid = $c->agenda_id;
		// }

		$data = array(
			'agenda_id' => $agendaid,
			'doctor' => $doctor_id,
			//'status' => $status,
			'user_id' => $this->session->userdata('user_id'),
			'doctor_address' => $town_id,
			'day' => $day
			);
		$this->Home_model->db_insert($data, 'ojl_itenerary');

	}
	
	public function getDataTable()
	{
		$table = $this->input->post('table');
		$where = $this->input->post('where');
		$getTableData = $this->Home_model->get_data($table,$where);
		echo json_encode($getTableData);
	}

	public function get_territory() {
		$psr_id = $_POST['psr_id'];
		$result = $this->Home_model->psr_territory($psr_id);
		echo json_encode($result);
	}

	public function check_existing_agenda() {
		$psr_id = $_POST['psr_id'];
		$res = $this->Home_model->existing_agenda($psr_id);
		echo $res;
	}

	public function check_dates() {
		$date_from = $_POST['date_from'];
		$date_to = $_POST['date_to'];
		$psr = $_POST['psr'];

		$datefrom = date_create($date_from);
		$datefrom = date_format($datefrom, 'Y-m-d');

		$dateto = date_create($date_to);
		$dateto = date_format($dateto, 'Y-m-d');

		$result = $this->Home_model->checkdates($datefrom, $dateto, $psr);
		echo $result;
	}

	public function get_prev() {
		$psr_id = $_POST['psr_id'];
		$result = $this->Home_model->getprev($psr_id);
		echo json_encode($result);
	}

	public function for_completion() {
		$agenda_id = $this->session->userdata('agenda_id');
		$this->Home_model->forCompletion($agenda_id);
	}
	public function step() {
		$step = $_POST['step'];
		$this->Home_model->step_up($step);
	}

	public function get_salary() {
		$psr_id = $_POST['psr_id'];
		$result = $this->Home_model->get_salary_grade($psr_id);
		echo json_encode($result);
	}

	public function checkdate() {
		$date_from = date('Y-m-d', strtotime($_POST['date_from']));
		$date_to = date('Y-m-d', strtotime($_POST['date_to']));


		$result = $this->Home_model->checkdate($date_from, $date_to);
		echo count($result);
	}

	public function get_today_agenda() {
		$date_now = date('Y-m-d');
		$result = $this->Home_model->today_agenda($date_now);
		echo json_encode($result);

		}

	public function get_agenda_by_calendar() {
		$agenda_id = $_POST['agenda_id'];
		$result = $this->Home_model->get_agenda($agenda_id);
		echo json_encode($result);
	}

	function checkAgenda(){
		$date_from = date('Y-m-d', strtotime($_POST['date_from']));
		$date_to = date('Y-m-d', strtotime($_POST['date_to']));
		$hid_agenda = $_POST['hid_agenda'];

		$result = $this->Home_model->checkifexist($date_from, $date_to,$hid_agenda);

		if($result==0){
			$dm = $_POST['dm'];
			$psr_id = $_POST['psr_id'];
			$psr = $_POST['psr'];
			$salary = $_POST['salary'];
			$territory = $_POST['territory'];
			$date_from = $_POST['date_from'];
			$date_to = $_POST['date_to'];
			$consistency = $_POST['consistency'];


			$datefrom = date_create($date_from);
			$datefrom = date_format($datefrom, 'Y-m-d');

			$dateto = date_create($date_to);
			$dateto = date_format($dateto, 'Y-m-d');

			if($hid_agenda != '') {
				$data = array(
					'dm' => $dm,
					'psr_id' => $psr_id,
					'psr' => $psr,
					'user_id' => $this->session->userdata('emp_id'),
					'salary' => $salary,
					'territory' => $territory,
					'date_from' => $datefrom,
					'date_to' => $dateto,
					'competency_standards' => $consistency,
					'status' => 0,
					'type' => 2,
					'created_date' => date('Y-m-d H:i:s'),
					'is_active' => 1,
					'progress' => 'new',
					'step' => 2,
					'old_agenda' => $hid_agenda,
					'is_old_agenda' => 1
				);
			} else {
				$data = array(
					'dm' => $dm,
					'psr_id' => $psr_id,
					'psr' => $psr,
					'user_id' => $this->session->userdata('emp_id'),
					'salary' => $salary,
					'territory' => $territory,
					'date_from' => $datefrom,
					'date_to' => $dateto,
					'competency_standards' => $consistency,
					'status' => 0,
					'type' => 1,
					'step' => 2,
					'created_date' => date('Y-m-d H:i:s'),
					'is_active' => 1,
					'progress' => 'new'
				);	
			}
			


			$this->Home_model->db_insert($data, 'ojl_agenda');

			$last_id = $this->db->insert_id();
			$this->session->set_userdata('agenda_id', $last_id);
			$this->session->set_userdata('agenda_psr', $psr);
			
			echo json_encode($last_id[0]->agenda_id);
		}
		else{
			echo "error";
		}
	}

	public function checktime() {
		$date_now = date('Y-m-d', strtotime($_POST['date_now']));
		$date_to = date('Y-m-d', strtotime($_POST['date_to']));

		if($date_to < $date_now) {
			echo '1';
		} else if($date_to == $date_now) {
			echo '2';
		} else {
			echo '3';
		}
		
		
	}
	

}