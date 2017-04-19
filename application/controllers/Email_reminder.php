<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_reminder extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Agenda_model');
		$this->load->model('Home_model');
		$this->load->model('Ojl_completion_model', 'completion');
		//$this->Login_model->checkAccess();
		
	}

	public function index() {
		$date = new DateTime();

		if($date->format('D') == 'Mon' || $date->format('D') == 'Tue' || $date->format('D') == 'Wed') {
			$date->modify('-5 days');
			$expirydate = $date->format('Y-m-d');
		} else if($date->format('D') == 'Thu' || $date->format('D') == 'Fri') {
			$date->modify('-3 days');
			$expirydate = $date->format('Y-m-d');
		}
		


		$query = $this->db->query("SELECT * FROM ojl_evaluation where dm_date_from = '".$expirydate."' AND psr_date_from = '0000-00-00'");
		$result = $query->result();

	
		foreach($result as $key => $c) {
			$this->email_for_psr($c->agenda_id);	
		}

		$query_psr = $this->db->query("SELECT * FROM ojl_evaluation where psr_date_from = '".$expirydate."'");
		$result_psr = $query_psr->result();



		foreach($result_psr as $key => $c) {
			$this->email_for_om($c->agenda_id);
		}



	}

	public function email_for_psr($agenda_id) {

		$query_ = $this->db->query("SELECT * FROM ojl_evaluation where agenda_id = '".$agenda_id."'");
		$evaluation = $query_->result();

		$submitted_dm = date_create($evaluation[0]->dm_date_from);
		$sub_by_dm = date_format($submitted_dm, 'F d, Y');

		$query = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
		$agenda = $query->result();

		$query2 = $this->db->query("SELECT * FROM ojl_user where empid = '".$agenda[0]->psr_id."'");
		$get_psr = $query2->result();

		$query3 = $this->db->query("SELECT * FROM ojl_user where empid = '".$agenda[0]->user_id."'");
		$get_dm = $query3->result();

		$upper_name = $get_psr[0]->firstname." ".$get_psr[0]->lastname;
		$dm_name = $get_dm[0]->firstname." ".$get_dm[0]->lastname;
		$dm_email = $get_dm[0]->email;

		// echo '<pre>';
		// print_r($agenda);
		// exit();

		$this->load->library('email');

		/*$config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';*/
        $config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.sendgrid.net',
		    'smtp_port' => 465,
		    'smtp_user' => 'apikey',
		    'smtp_pass' => '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',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);

        $this->email->initialize($config);

        $this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');

        $this->email->to('c_TFQuitaleg@unilab.com.ph');
        $this->email->cc('phpdeveloper9@unilab.com.ph');
        //$this->email->to($get_psr[0]->email);    
		//$this->email->cc($dm_email);        

        $newline = "<br>";

        $this->email->subject('Reminder! You have OJL to review');

        $message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hello ".$upper_name.",";
		$message .= $newline.$newline;
		$message .= 'This is a reminder that you have a pending OJL report for review and acknowledgment submitted by your DM on '.$sub_by_dm;

		$message .= '. Kindly click this link <u>'.base_url().'login_controller?id='.$agenda_id.'</u> and login using your UNILAB email address and network password.';

		$message .= $newline.$newline;

		//$message .= 'Click this link to view the agenda: <u>'.base_url().'Generate_agenda/via_pdf/'.$agenda_id.'</u>';

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";

		$this->email->message($message);
		$this->email->send();



		//$this->email_for_dm($agenda, $upper_name, $dm_name);

	}

	public function email_for_dm($agenda_id, $upper_name, $dm_name) {
		$date = date_create(date("Y-m-d"));
		$date = date_format($date, 'F d, Y');

		$this->load->library('email');

		/*$config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';*/
        $config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.sendgrid.net',
		    'smtp_port' => 465,
		    'smtp_user' => 'apikey',
		    'smtp_pass' => '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',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);

        $this->email->initialize($config);


        $this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');
        $this->email->to('c_TFQuitaleg@unilab.com.ph');

        $newline = "<br>";

        $this->email->subject('An email reminder has been sent to '.$upper_name);

        $message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hello ".$dm_name.",";
		$message .= $newline.$newline;
		$message .= 'An email reminder has been sent to '.$upper_name.' on '.$date;

		$message .= ' for their review and acknowledment.';

		$message .= 'To view the report, kindly click this link <u>'.base_url().'</u> and login using your UNILAB email address and network password.';

		$message .= $newline.$newline;

		//$message .= 'Click this link to view the agenda: <u>'.base_url().'Generate_agenda/via_pdf/'.$agenda_id.'</u>';

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";

		$this->email->message($message);
		$this->email->send();

	}


	public function email_for_om($agenda_id) {
		$query_ = $this->db->query("SELECT * FROM ojl_evaluation where agenda_id = '".$agenda_id."'");
		$evaluation = $query_->result();

		$submitted_psr = date_create($evaluation[0]->psr_date_from);
		$sub_by_psr = date_format($submitted_psr, 'F d, Y');

		$submitted_dm = date_create($evaluation[0]->dm_date_from);
		$sub_by_dm = date_format($submitted_dm, 'F d, Y');

		$query = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
		$agenda = $query->result();

		$query2 = $this->db->query("SELECT * FROM ojl_user where empid = '".$agenda[0]->psr_id."'");
		$get_psr = $query2->result();

		$query3 = $this->db->query("SELECT * FROM ojl_user where empid = '".$agenda[0]->user_id."'");
		$get_dm = $query3->result();

		$query4 = $this->db->query("SELECT * FROM `ojl_dm_om` as a left join ojl_user as b on a.om = b.empid where dm = '".$agenda[0]->user_id."'");
		$get_om = $query4->result();

		$upper_name = $get_om[0]->firstname." ".$get_om[0]->lastname;
		$psr_name = $get_psr[0]->firstname." ".$get_psr[0]->lastname;
		$dm_name = $get_dm[0]->firstname." ".$get_dm[0]->lastname;
		$dm_email = $get_dm[0]->email;


		$this->load->library('email');

		/*$config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';*/
        $config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.sendgrid.net',
		    'smtp_port' => 465,
		    'smtp_user' => 'apikey',
		    'smtp_pass' => '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',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);

        $this->email->initialize($config);

        $this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');
        $this->email->to('c_TFQuitaleg@unilab.com.ph');

        $this->email->cc('phpdeveloper9@unilab.com.ph');
        //$this->email->to($get_om[0]->email);
        //$this->email->cc($dm_email);

        $newline = "<br>";

        $this->email->subject('Reminder! You have OJL to review');

        $message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hello ".$upper_name.",";
		$message .= $newline.$newline;
		$message .= 'This is a reminder that you have a pending OJL report for review submitted by '.$dm_name.' on '.$sub_by_dm;

		$message .= ' and acknowledged by '.$psr_name.' on '.$sub_by_psr.' ';

		$message .= '. Kindly click this link <u>'.base_url().'login_controller?id='.$agenda_id.'</u> and login using your UNILAB email address and network password.';

		$message .= $newline.$newline;

		//$message .= 'Click this link to view the agenda: <u>'.base_url().'Generate_agenda/via_pdf/'.$agenda_id.'</u>';

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";

		$this->email->message($message);
		$this->email->send();



		//$this->email_for_dm($agenda, $upper_name, $dm_name);

	}



}