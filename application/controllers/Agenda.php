<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Agenda_model');
		$this->load->model('Home_model');
		$this->load->model('Ojl_completion_model', 'completion');
		$this->Login_model->checkAccess();
		
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		
	}

	public function index() {
		// $data['content'] = 'ojl_schedule';
		// $this->load->view('template/layout', $data);
	}

	public function truncate_tables() {
		$this->db->query("
				TRUNCATE TABLE ojl_ActionPlan
			");
		/*$this->db->query("
				TRUNCATE TABLE ojl_ActionPlan;
				TRUNCATE TABLE ojl_agenda;
				TRUNCATE TABLE ojl_client_engagement;
				TRUNCATE TABLE ojl_competency_functional_expertise;
				TRUNCATE TABLE ojl_competitors_activity;
				TRUNCATE TABLE ojl_employee_competency;
				TRUNCATE TABLE ojl_evaluation;
				TRUNCATE TABLE ojl_idp;
				TRUNCATE TABLE ojl_itenerary;
				TRUNCATE TABLE ojl_marketing_programs;
				TRUNCATE TABLE ojl_plan;
				TRUNCATE TABLE ojl_product_communication;
				TRUNCATE TABLE ojl_SalesPlan;
				TRUNCATE TABLE ojl_survey;
				TRUNCATE TABLE ojl_ulearn;

			");*/
	}

	public function agenda_details($agenda_id) {
		
		$data['agenda'] = $this->Agenda_model->getAgenda($agenda_id);
		//$this->session->set_userdata($data['agenda_id']->agenda_id, 'agenda_id');
		$data['evaluation'] = $this->Agenda_model->get_evaluation($agenda_id, 'ojl_evaluation');
		$data['action_plan'] = $this->Home_model->get_action_plan($agenda_id);
		$data['itenerary'] = $this->Agenda_model->getItenerary($agenda_id);
		$data['sales_plan'] = $this->Home_model->get_sales_plan($agenda_id);
\\Pf0lggn1-ulma-l\shared\Neurogen-e

		$data['dm'] = $data['agenda'][0]->user_id;
		$data['psr'] = $data['agenda'][0]->psr_id;

		
		$data['employee_competency'] = $this->Home_model->ojl_competency($agenda_id);

		$comp_id = $data['employee_competency'][0]->competency_id;

		$data['idp'] = $this->Home_model->get_idp($comp_id);
		$data['ulearn'] = $this->Home_model->get_ulearn($comp_id);

		$data['client_engagement'] = $this->Home_model->getcompletion('ojl_client_engagement', $agenda_id);
		$data['product_communication'] = $this->Home_model->getcompletion('ojl_product_communication', $agenda_id);
		$data['survey'] = $this->Home_model->getcompletion('ojl_survey', $agenda_id);
		$data['competitors_activity'] = $this->Home_model->getcompletion('ojl_competitors_activity', $agenda_id);

		$data['mp'] = $this->completion->getMP2($data['agenda'][0]->agenda_id);
		$data['mp_status'] = $data['mp'][0]->status;
		$data['agenda_status'] = $data['agenda'][0]->status;
		
        $data['planned'] = $this->completion->get_planned('ojl_plan',$data['mp'][0]->record_id);
        $data['thinks_customer'] = $this->completion->get_planned('ojl_competency_thinks_customer', $data['mp'][0]->record_id);
        $data['functional_expertise'] = $this->completion->get_planned('ojl_competency_functional_expertise', $data['mp'][0]->record_id);
		// echo '<pre>';
		// print_r($data['agenda'][0]->user_id);
		// exit();

		$date_from = date_create($data['agenda'][0]->date_from);
        $datefrom_ = date_format($date_from, 'd-M-Y');

        $date_to = date_create($data['agenda'][0]->date_to);
        $dateto_ = date_format($date_to, 'd-M-Y');

        $data['datefrom_'] = $datefrom_;
        $data['dateto_'] = $dateto_;

			$year_today = date('Y');
			$year_minus2 = $year_today - 2;
			$year_plus1 = $year_today + 1;

        $query2 = $this->db->query("SELECT * FROM ojl_rating where empid = '".$data['agenda'][0]->psr_id."' AND (year >= '".$year_minus2."' AND year <= '".$year_plus1."')  order by year, sem");
        	$res2 = $query2->result();
        	$data_array = array();
        	foreach ($res2 as $key => $value) {
        		$data_array[$value->year][$value->sem] = new stdClass();
        		$data_array[$value->year][$value->sem]->rating = $value->rating;
        	}

        	$data['rating_data'] = $data_array;
		// echo '<pre>';
		// print_r($data['client_engagement']);
		// exit();

		$date_from = date_create($data['agenda'][0]->date_from);
        $datefrom_ = date_format($date_from, 'd-M-Y');

        $date_to = date_create($data['agenda'][0]->date_to);
        $dateto_ = date_format($date_to, 'd-M-Y');

        $data['datefrom_'] = $datefrom_;
        $data['dateto_'] = $dateto_;

		
        $data['content'] = 'agenda/agenda_details';
		$this->session->set_userdata('agenda_id', $agenda_id);
		$this->load->view('template/layout', $data);
	}

	public function edit_agenda($agenda_id) {
		
		if(isset($_GET['id'])) {

			$agenda_id = $_GET['id'];
			$query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
        	$res1 = $query1->result();
        	$this->session->set_userdata('agenda_psr', $res1[0]->psr_id);
        	$this->session->set_userdata('step', $res1[0]->step);
			$this->session->set_userdata('agenda_id', $agenda_id);
		}

		$data['content'] = 'agenda/edit_agenda';
		$data['agenda'] = $this->Agenda_model->getAgenda($agenda_id);
		$data['action_plan'] = $this->Agenda_model->getActionPlan($agenda_id);

		$data['psr_'] = $this->Home_model->get_data("ojl_psr");
		$data['territory_'] = $this->Home_model->get_data("ojl_territory");
		$dropdown = $this->Home_model->get_data("ojl_agenda_name");
		$data['doctor'] = $this->Home_model->get_data("ojl_doctors","isActive = 1"); 
		$data['dropdown'] = $dropdown;

		//$this->session->set_userdata('agenda_id', $agenda_id);
		$this->Agenda_model->get_psr($agenda_id);

		$this->session->set_userdata("agenda_id", $agenda_id);

		// echo '<pre>';
		// print_r($this->session->all_userdata());
		$this->load->view('template/layout', $data);

		
	}

	public function update_agenda() {
		$dm = $_POST['dm'];
		$psr_id = $_POST['psr_id'];
		$salary = $_POST['salary'];
		$territory_id = $_POST['territory_id'];
		$date_from = $_POST['date_from'];
		$date_to = $_POST['date_to'];
		$consistency = $_POST['consistency'];
		$id = $_POST['agenda_id'];

		$datefrom = date_create($date_from);
		$dateto = date_create($date_to);

		if($date_from == $date_to) {

			$day1 = date_format($datefrom, "F d, Y");
			$this->db->query("DELETE FROM ojl_itenerary where day = '2' AND agenda_id = '".$id."'");
			$this->db->query("UPDATE ojl_employee_competency set date_of_ojl = '".$day1."' where agenda_id = '".$id."'");
		} else {

			$dayfr = date_format($datefrom, 'F d -');
			$dayto = date_format($dateto, ' d, Y');

			
			$day1 = $dayfr.$dayto;
			$this->db->query("UPDATE ojl_employee_competency set date_of_ojl = '".$day1."' where agenda_id = '".$id."'");
			
		}


		$datefrom = date_format($datefrom, "Y-m-d");
		$dateto = date_format($dateto, "Y-m-d");

		$this->db->query("UPDATE ojl_marketing_programs set date_from = '".$datefrom."', date_to = '".$dateto."' where agenda_id = '".$id."'");
		
		$data = array(
			'dm' => $dm,
			'psr_id' => $psr_id,
			'salary' => $salary,
			'territory_id' => $territory_id,
			'date_from' => $datefrom,
			'date_to' => $dateto,
			'competency_standards' => $consistency
			);
		

		$this->Agenda_model->UpdateAgenda($data, $id, 'ojl_agenda');


		

		$this->session->set_userdata('agenda_id', $id);
		$this->session->set_userdata('agenda_psr', $psr_id);
		echo json_encode($this->session->all_userdata());

	}

	public function delete_action_plan() {
		$agenda_id = $this->session->userdata('agenda_id');
		$table = $_POST['table'];

		$this->Agenda_model->delete_action_plan($agenda_id, $table);
	}

	public function delete_itinerary() {
	
		$table = 'ojl_itenerary';
		$id = $_POST['itenerary_id'];

		$this->Agenda_model->delete_itenerary($table, $id);
	}

	public function insert_ite() {
		$doctor = $_POST['docs'];
		$address = $_POST['address'];
		$day = $_POST['day'];
		$agendaid = $this->session->userdata('agenda_id');

		$data = array(
			'agenda_id' => $agendaid,
			'doctor' => $doctor,
			//'status' => $status,
			'user_id' => $this->session->userdata('user_id'),
			'doctor_address' => $address,
			'day' => $day
			);

		$this->Home_model->db_insert($data, 'ojl_itenerary');
	}

	public function update_business() {
		$agenda_name_id = $_POST['agenda_name_id'];
		$specific_plans = $_POST['specific_plans'];
		$type = $_POST['type'];

		$agenda_id = $this->session->userdata('agenda_id');

			$data = array(
					'agenda_id' => $agenda_id,
					'agenda_name_id' => $agenda_name_id,
					'specific_plans' => $specific_plans,
					'is_active' => 1,
					'actionPlanType' => $type
				);

			$test = $this->Agenda_model->insertBusiness($data, 'ojl_ActionPlan');

			if($test) {
				echo 'success';

			} else {
				
			}
			
		
	}

	public function edit_itinerary() {
		

		if(isset($_GET['id'])) {
			$agenda_id = $_GET['id'];
			$query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
        	$res1 = $query1->result();
        	$this->session->set_userdata('agenda_psr', $res1[0]->psr_id);
        	$this->session->set_userdata('step', $res1[0]->step);
			$this->session->set_userdata('agenda_id', $agenda_id);
		}
		$agenda_id = $this->session->userdata('agenda_id');
		$status = $this->Agenda_model->check_agenda_stat($agenda_id);
		$data['status'] = $status[0]->status;
		$data['content'] = 'agenda/edit_itenerary';
		$data['doctor'] = $this->Home_model->get_data("ojl_doctors","isActive = 1"); 
		$data['itenerary'] = $this->Agenda_model->getItenerary($agenda_id);
		$data['dfrom'] = $res1[0]->date_from;
		$data['dto'] = $res1[0]->date_to;
		// $data['date_from'] = $data['itenerary'][0]->date_from;
		// $data['date_to'] = $data['itenerary'][0]->date_to;

		$date_from = $data['itenerary'][0]->date_from;
		$date_to = $data['itenerary'][0]->date_to;

		$datefrom = date_create($date_from);
		$data['date_from'] = date_format($datefrom, 'F d, Y');
		$dateto = date_create($date_to);
		$data['date_to'] = date_format($dateto, 'F d, Y');


		//echo $agenda_id;
		
		// echo '<pre>';
		// print_r($this->session->all_userdata());
		$this->load->view('template/layout', $data);
		
	}

	public function submit_agenda(){ 
		$agenda_id = $this->session->userdata('agenda_id');
		$type = $_POST['type'];

		$data = array('status' => $type);
		$this->Agenda_model->UpdateAgenda($data, $agenda_id, 'ojl_agenda');

	}

	public function sendMail() {

		$agenda_id = $_POST['agenda_id'];
		$get_agenda = $this->Home_model->get_agenda($agenda_id);

		$query2 = $this->db->query("SELECT * FROM ojl_user where empid = '".$get_agenda[0]->psr_id."'");
		$get_psr = $query2->result();

		$date_from = date_create($get_agenda[0]->date_from);
		$datefrom = date_format($date_from, 'F d ');

		$date_to = date_create($get_agenda[0]->date_to);
		$dateto = date_format($date_to, 'd, Y');

		if($date_from == $date_to) {
			$date_of_ojl = date_format($date_from, 'F d, Y');
			
		} else {
			$date_of_ojl = $datefrom.' - '.$dateto;
		}
		$this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');
		// $this->email->to('nicavee.jepollo@gmail.com');
		//$this->email->to('pet_sahagun@yahoo.com');
		$this->email->to($get_psr[0]->email); //the real receipient
		//$this->email->to('c_TFQuitaleg@unilab.com.ph');
		$agenda_id = $_POST['agenda_id'];
		$firstname_dm = $this->session->userdata('firstname');
		$lastname_dm = $this->session->userdata('lastname');
		

		$newline = "<br>"; 

		$this->email->subject('Your OJL schedule ');

		$message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hi, ";
		$message .= $newline.$newline;
		$message .= 'You are scheduled for an OJL on '.$date_of_ojl.'. For questions or concerns, kindly contact your district manager.';

		$message .= $newline.$newline;

		//$message .= 'Click this link to view the agenda: <u>'.base_url().'Generate_agenda/via_pdf/'.$agenda_id.'</u>';

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";
		$this->email->message($message);
		$this->email->send();
		// if() {
		// 	echo 'sent';
		// } else {
		// 	echo 'not sent';

		// }
		

		
		// the message
		// $msg = "asdasdadasdasda First line of text\nSecond line of text";

		// // use wordwrap() if lines are longer than 70 characters
		// $msg = wordwrap($msg,70);

		// // send email
		// mail("phpdeveloper6@unilab.com.ph","My subject",$msg);

		

		// $psrFirstname = "Juan";
		// $psrMiddlename = "Q.";
		// $psrLastname = "Dela Cruz";

  //       $email = 'admin@unilab.com.ph';
  //       $firstname = 'Admin';
  //       $middlename = '';
  //       $lastname = 'Admin';

  //       $emailto = 'c_TFQuitaleg@unilab.com.ph';

  //       $newline = "<br>";        
  //        /************** EMAIL PART TO CDS*****************/
  //       // $this->email->from($email, ucwords(strtolower($firstname))." ".ucwords(strtolower($middlename)).". ".ucwords(strtolower($lastname)));
  //         $this->email->from('admin@unilab.com.ph');
  //       $this->email->to('phpdeveloper6@unilab.com.ph');
  //       $message = "<html><head><title></title></head><body style='font-family:Arial'><p>";
  //       $message .= "Dear <b>".ucwords(strtolower($psrFirstname))." ".ucwords(strtolower($psrMiddlename)).". ".ucwords(strtolower($psrLastname))."</b>,";
  //       $message .= $newline.$newline;
  //       $message .= $firstname.' '.$lastname.' has submitted an agenda';
  //       $message .= $newline.$newline;
  //       $message .= "Thank you";
  //       $message .= $newline.$newline;
  //       $message .= "<font size='2px'>Note: This is a system-generated email from Marketing PRO. </font></p>";
  //       $message .= "</body></html>";
  //       $this->email->subject("[Agenda]");
  //       $this->email->message($message);  
  //       /************** EMAIL PART *****************/
  //       $this->email->send();

   
	}

	public function sendMail_dm_by_psr() {
		$agenda_id = $_POST['agenda_id'];
		
		$get_agenda = $this->Home_model->get_agenda($agenda_id);

		$query3 = $this->db->query("SELECT * FROM ojl_user where empid = '".$get_agenda[0]->user_id."'");
		$get_dm = $query3->result();

		$date_now = date('F d, Y');
		$this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');
		// $this->email->to('nicavee.jepollo@gmail.com');
		//$this->email->to('pet_sahagun@yahoo.com');
		$this->email->to($get_dm[0]->email); //the real receipient
		//$this->email->to('c_TFQuitaleg@unilab.com.ph');
		$agenda_id = $_POST['agenda_id'];
		$firstname_dm = $this->session->userdata('firstname');
		$lastname_dm = $this->session->userdata('lastname');
		

		$newline = "<br>"; 

		$this->email->subject('PSR OJL acknowledgment');

		$message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hi Disctrict Manager,";
		$message .= $newline.$newline;

		// $message .= 'The OJL has been acknowledged by '.ucfirst($firstname_dm).' '.ucfirst($lastname_dm);
		$message .= 'The OJL has been acknowledged by '.$get_agenda[0]->dm_name;
		$message .= ' on '.$date_now;
		
		$message .= $newline.$newline;

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";
		$this->email->message($message);
		$this->email->send();

	}


	public function sendMail_dm_by_om() {
		$agenda_id = $_POST['agenda_id'];
		
		$get_agenda = $this->Home_model->get_agenda($agenda_id);
		$query3 = $this->db->query("SELECT * FROM ojl_user where empid = '".$get_agenda[0]->user_id."'");
		$get_dm = $query3->result();

		$date_now = date('F d, Y');
		$this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');
		// $this->email->to('nicavee.jepollo@gmail.com');
		//$this->email->to('pet_sahagun@yahoo.com');
		$this->email->to($get_dm[0]->email); //the real receipient
		//$this->email->to('c_TFQuitaleg@unilab.com.ph');
		$agenda_id = $_POST['agenda_id'];
		$firstname_dm = $this->session->userdata('firstname');
		$lastname_dm = $this->session->userdata('lastname');
		

		$newline = "<br>"; 

		$this->email->subject('OM OJL acknowledgment');

		$message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hi Disctrict Manager,";
		$message .= $newline.$newline;

		$message .= 'The OJL has been acknowledged by '.$get_agenda[0]->dm_name;
		// $message .= 'The OJL has been acknowledged by '.ucfirst($firstname_dm).' '.ucfirst($lastname_dm);
		$message .= ' on '.$date_now;
		
		$message .= $newline.$newline;

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";
		$this->email->message($message);
		$this->email->send();

	}

	public function sendMail_psr() {
		$agenda_id = $_POST['agenda_id'];
		
		$get_agenda = $this->Home_model->get_agenda($agenda_id);
		$query4 = $this->db->query("SELECT * FROM `ojl_dm_om` as a left join ojl_user as b on a.om = b.empid where dm = '".$get_agenda[0]->user_id."'");
		$get_om = $query4->result();
		$date_now = date('F d, Y');
		$this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');
		// $this->email->to('nicavee.jepollo@gmail.com');
		//$this->email->to('pet_sahagun@yahoo.com');
		$this->email->to($get_om[0]->email);  //the real receipient
		//$this->email->to('c_TFQuitaleg@unilab.com.ph');
		$agenda_id = $_POST['agenda_id'];
		$firstname_dm = $this->session->userdata('firstname');
		$lastname_dm = $this->session->userdata('lastname');
		$newline = "<br>"; 

		$this->email->subject('OJL report Operations Manager review');

		$message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hi Operations Manager,";
		$message .= $newline.$newline;

		$message .= 'Please review the OJL report submitted by '.$get_agenda[0]->dm_name;

		// $message .= 'Please review the OJL report submitted by '.ucfirst($firstname_dm).' '.ucfirst($lastname_dm);
		$message .= ' for '.ucfirst($get_agenda[0]->psr).' on '.$date_now;
		$message .= ' by clicking the link <u>'.base_url().'login_controller?id='.$agenda_id.'</u>';

		$message .= ' Login with your UNILAB network email address and computer password. For questions or concerns, kindly contact your district manager.';
		
		//$message .= $firstname_dm.' '.$lastname_dm.' has submitted an agenda with psr remark';

		$message .= $newline.$newline;

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";
		$this->email->message($message);
		$this->email->send();

	}

	public function sendMail_om() {
		$agenda_id = $_POST['agenda_id'];

		$get_agenda = $this->Home_model->get_agenda($agenda_id);

		$get_om = $this->db->query("SELECT a.*, b.email FROM `ojl_dm_om` as a left join ojl_user as b on a.om = b.empid where dm = '".$get_agenda[0]->user_id."'");
		$cc_om = $get_om->result();

		$get_psr = $this->db->query("SELECT * FROM ojl_user where empid = '".$get_agenda[0]->psr_id."'");
		$cc_psr = $get_psr->result();

		$get_dm = $this->db->query("SELECT * FROM ojl_user where empid = '".$get_agenda[0]->user_id."'");
		$cc_dm = $get_dm->result();

		$date_now = date('F d, Y');
		$this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');
		 $this->email->to('c_TFQuitaleg@unilab.com.ph');
		//$this->email->cc('nicavee.jepollo@gmail.com');
		//$this->email->cc('nicavee.jepollo@gmail.com');
		//$this->email->to('ejayopiniano@gmail.com');
		$this->email->cc($cc_om[0]->email);
		$this->email->cc($cc_dm[0]->email);
		$this->email->cc($cc_psr[0]->email);
		//$this->email->to('c_TFQuitaleg@unilab.com.ph');
		$agenda_id = $_POST['agenda_id'];
		$firstname_dm = ucfirst($this->session->userdata('firstname'));
		$lastname_dm = ucfirst($this->session->userdata('lastname'));
		

		$newline = "<br>"; 

		$this->email->subject('Final OJL report submitted by '.$firstname_dm.' '.$lastname_dm);

		$message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hi Training Department,";
		$message .= $newline.$newline;

		// $message .= 'Please refer to the OJL report submitted by '.$firstname_dm.' '.$lastname_dm;
		$message .= 'Please refer to the OJL report submitted by '.$get_agenda[0]->dm_name;
		$message .= ' for '.ucfirst($get_agenda[0]->psr).' on '.$date_now;
		$message .= ' by clicking the link <a href="'.base_url().'Generate_agenda/training_dept_via_pdf/'.$agenda_id.'">'.base_url().'Generate_agenda/training_dept_via_pdf/'.$agenda_id.'</a>';

		$message .= ' Login with your UNILAB network email address and computer password. For questions or concerns, kindly contact your district manager.';
		
		//$message .= $firstname_dm.' '.$lastname_dm.' has submitted an agenda with psr remark';

		$message .= $newline.$newline;

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";
		$this->email->message($message);
		$this->email->send();
	}




	public function update_itenerary() {
		$agenda_id = $this->session->userdata('agenda_id');
		$user_id = $this->session->userdata('user_id');
		$doctor_id = $_POST['doctor_id'];
		$doctor_address = $_POST['doctor_address'];
		$day = $_POST['day'];

		$data = array(
				'user_id' => $user_id,
				'agenda_id' => $agenda_id,
				'doctor' => $doctor_id,
				'doctor_address' => $doctor_address,
				'day' => $day
			);

		$test = $this->Agenda_model->insertBusiness($data, 'ojl_itenerary');

		//$this->sendMail();
	}

	public function check_stat() {
		$agenda_id = $_POST['agenda_id'];

		$query = $this->Agenda_model->check_agenda_stat($agenda_id);
		echo json_encode($query);

	}

	public function change_agenda_session() {
		$agenda_id = $_POST['agenda_id'];
		$this->session->set_userdata('agenda_id', $agenda_id);
	}

	public function psr_comment($agenda_id) {

		$data['agenda'] = $this->Agenda_model->getAgenda($agenda_id);
		$data['evaluation'] = $this->Agenda_model->get_evaluation($agenda_id, 'ojl_evaluation');
		$data['action_plan'] = $this->Home_model->get_action_plan($agenda_id);
		$data['itenerary'] = $this->Agenda_model->getItenerary($agenda_id);
		$data['sales_plan'] = $this->Home_model->get_sales_plan($agenda_id);


		$data['dm'] = $data['agenda'][0]->user_id;
		$data['psr'] = $data['agenda'][0]->psr_id;

		
		$data['employee_competency'] = $this->Home_model->ojl_competency($agenda_id);

		$comp_id = $data['employee_competency'][0]->competency_id;

		$data['idp'] = $this->Home_model->get_idp($comp_id);
		$data['ulearn'] = $this->Home_model->get_ulearn($comp_id);

		$data['client_engagement'] = $this->Home_model->getcompletion('ojl_client_engagement', $agenda_id);
		$data['product_communication'] = $this->Home_model->getcompletion('ojl_product_communication', $agenda_id);
		$data['survey'] = $this->Home_model->getcompletion('ojl_survey', $agenda_id);
		$data['competitors_activity'] = $this->Home_model->getcompletion('ojl_competitors_activity', $agenda_id);

		$data['mp'] = $this->completion->getMP2($data['agenda'][0]->agenda_id);
		$data['mp_status'] = $data['mp'][0]->status;
        $data['planned'] = $this->completion->get_planned('ojl_plan',$data['mp'][0]->record_id);
        $data['thinks_customer'] = $this->completion->get_planned('ojl_competency_thinks_customer', $data['mp'][0]->record_id);
        $data['functional_expertise'] = $this->completion->get_planned('ojl_competency_functional_expertise', $data['mp'][0]->record_id);
		// echo '<pre>';
		// print_r($data['client_engagement']);
		// exit();

		$date_from = date_create($data['agenda'][0]->date_from);
        $datefrom_ = date_format($date_from, 'd-M-Y');

        $date_to = date_create($data['agenda'][0]->date_to);
        $dateto_ = date_format($date_to, 'd-M-Y');

        $data['datefrom_'] = $datefrom_;
        $data['dateto_'] = $dateto_;

			$year_today = date('Y');
			$year_minus2 = $year_today - 2;
			$year_plus1 = $year_today + 1;

        $query2 = $this->db->query("SELECT * FROM ojl_rating where empid = '".$data['agenda'][0]->psr_id."' AND (year >= '".$year_minus2."' AND year <= '".$year_plus1."')  order by year, sem");
        	$res2 = $query2->result();
        	$data_array = array();
        	foreach ($res2 as $key => $value) {
        		$data_array[$value->year][$value->sem] = new stdClass();
        		$data_array[$value->year][$value->sem]->rating = $value->rating;
        	}

        	$data['rating_data'] = $data_array;


		$data['user'] = 'psr';
		$data['content'] = 'psr_home';
		$data['home_link'] = 'Agenda/psr_comment/'.$agenda_id;
		$this->load->view('template/layout', $data);

	}

	public function om_comment($agenda_id) {

		$data['agenda'] = $this->Agenda_model->getAgenda($agenda_id);
		$data['evaluation'] = $this->Agenda_model->get_evaluation($agenda_id, 'ojl_evaluation');
		$data['action_plan'] = $this->Home_model->get_action_plan($agenda_id);
		$data['itenerary'] = $this->Agenda_model->getItenerary($agenda_id);
		$data['sales_plan'] = $this->Home_model->get_sales_plan($agenda_id);


		$data['dm'] = $data['agenda'][0]->user_id;
		$data['psr'] = $data['agenda'][0]->psr_id;

		
		$data['employee_competency'] = $this->Home_model->ojl_competency($agenda_id);

		$comp_id = $data['employee_competency'][0]->competency_id;

		$data['idp'] = $this->Home_model->get_idp($comp_id);
		$data['ulearn'] = $this->Home_model->get_ulearn($comp_id);

		$data['client_engagement'] = $this->Home_model->getcompletion('ojl_client_engagement', $agenda_id);
		$data['product_communication'] = $this->Home_model->getcompletion('ojl_product_communication', $agenda_id);
		$data['survey'] = $this->Home_model->getcompletion('ojl_survey', $agenda_id);
		$data['competitors_activity'] = $this->Home_model->getcompletion('ojl_competitors_activity', $agenda_id);

		$data['mp'] = $this->completion->getMP2($data['agenda'][0]->agenda_id);
		$data['mp_status'] = $data['mp'][0]->status;

        $data['planned'] = $this->completion->get_planned('ojl_plan',$data['mp'][0]->record_id);
        $data['thinks_customer'] = $this->completion->get_planned('ojl_competency_thinks_customer', $data['mp'][0]->record_id);
        $data['functional_expertise'] = $this->completion->get_planned('ojl_competency_functional_expertise', $data['mp'][0]->record_id);
		// echo '<pre>';
		// print_r($data['client_engagement']);
		// exit();

		$date_from = date_create($data['agenda'][0]->date_from);
        $datefrom_ = date_format($date_from, 'd-M-Y');

        $date_to = date_create($data['agenda'][0]->date_to);
        $dateto_ = date_format($date_to, 'd-M-Y');

        $data['datefrom_'] = $datefrom_;
        $data['dateto_'] = $dateto_;

        $year_today = date('Y');
		$year_minus2 = $year_today - 2;
		$year_plus1 = $year_today + 1;

        $query2 = $this->db->query("SELECT * FROM ojl_rating where empid = '".$data['agenda'][0]->psr_id."' AND (year >= '".$year_minus2."' AND year <= '".$year_plus1."')  order by year, sem");
        	$res2 = $query2->result();
        	$data_array = array();
        	foreach ($res2 as $key => $value) {
        		$data_array[$value->year][$value->sem] = new stdClass();
        		$data_array[$value->year][$value->sem]->rating = $value->rating;
        	}

        	$data['rating_data'] = $data_array;


        


		$data['user'] = 'om';
		$data['content'] = 'psr_home';
		$data['home_link'] = 'Agenda/om_comment/'.$agenda_id;
		$this->load->view('template/layout', $data);
	}

}
