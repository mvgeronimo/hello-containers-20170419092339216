<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ojl_evaluation extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Agenda_model');
		$this->load->model('Home_model');
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
		$agenda_id = $this->session->userdata('agenda_id');
		if(isset($_GET['id'])){
			$this->session->set_userdata('agenda_id',$_GET['id']);
			$agenda_id = $this->session->userdata('agenda_id');
		}
		$data['content'] = 'evaluation';
		$data['dm'] = $this->Home_model->getDm();
		$data['psr'] = $this->Home_model->getPsr();
		$data['mpi'] = $this->Home_model->Getmpi();
		$data['evaluation'] = $this->Home_model->get_evaluation($agenda_id);
		$data['agenda'] = $this->Home_model->get_agenda($agenda_id);

		$this->session->set_userdata('step',$data['agenda'][0]->step);


		$data['agenda_id'] = $agenda_id;
		$this->load->view('template/layout', $data);
	}

	public function insert_evaluation() {
		$type = $_POST['type'];
		$dm_action = $_POST['dm_action'];
		$issues_concerns = $_POST['issues_concerns'];
		$user_id = $this->session->userdata('user_id');
		$agenda_id = $this->session->userdata('agenda_id');


		$data = array(
				"dm_action_plan" => $dm_action,
				"issues_and_remarks" => $issues_concerns,
				"empid" => $user_id,
				"agenda_id" => $agenda_id,
				"status" => $type,
				"dm_date_from" => date('Y-m-d')
			);

		$this->db->query("UPDATE ojl_agenda set status = 2, step = 11 where agenda_id = '".$agenda_id."'");


		$this->Home_model->update_evaluation($data, $agenda_id);

	}


	public function sendMail() {
		$agenda_id = $_POST['agenda_id'];
		
		$get_agenda = $this->Home_model->get_agenda($agenda_id);

		$query2 = $this->db->query("SELECT * FROM ojl_user where empid = '".$get_agenda[0]->psr_id."'");
		$get_psr = $query2->result();

		$date_now = date('F d, Y');
		$this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');
		//$this->email->to('nicavee.jepollo@gmail.com');
		//$this->email->to('pet_sahagun@yahoo.com');
		$this->email->to($get_psr[0]->email); //the real recepient
		//$this->email->to('c_TFQuitaleg@unilab.com.ph');
		$agenda_id = $_POST['agenda_id'];
		$firstname_dm = $this->session->userdata('firstname');
		$lastname_dm = $this->session->userdata('lastname');
		

		$newline = "<br>"; 

		$this->email->subject('Your OJL agreements and acknowledgement');

		$message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hi,";
		$message .= $newline.$newline;

		$message .= 'Kindly review, write your OJL agreements with your district manager and acknowledge the OJL report submitted by your district manager on ';

		// $message .= $date_now.' by clicking the link. ';
		
		$message .= $date_now.' by clicking the link <a href="'.base_url().'login_controller?id='.$agenda_id.'">'.base_url().'login_controller?id='.$agenda_id.'</a>';
		$message .= ' Login with your UNILAB network email address and computer password. For questions or concerns, kindly contact your district manager.';
		//$message .= $firstname_dm.' '.$lastname_dm.' has submitted an agenda with psr remark';

		$message .= $newline.$newline;

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";
		$this->email->message($message);
		$this->email->send();
   
	}
}
