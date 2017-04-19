<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		// $this->load->library('doctrine');
		// $em = $this->doctrine->em;
		$this->load->view('welcome_message');
	}

	public function send_email(){
		$this->load->library('email');

	/*	$config['protocol'] = 'sendmail';
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
		    'charset'   => 'iso-8859-1',
		    'crlf'		=> '\r\n',
		    'newline'	=> '\r\n',

		);

/*		$config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "sendmail";
        $config['smtp_host']           = "localhost";
        $config['smtp_port']           = "25";
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;
*/
        $this->email->initialize($config);

		$this->email->from('OJLAdmin@unilab.com.ph', 'OJL Admin');

		$this->email->to('phpdev.unilab@gmail.com');


		$newline = "<br>"; 

		$this->email->subject('Your OJL schedule');

		$message = "<html><head><title></title></head><body style='font-family:Arial'><p>";

		$message .= "Hi, ";
		$message .= $newline.$newline;
		$message .= 'You are scheduled for an OJL on For questions or concerns, kindly contact your district manager.';

		$message .= $newline.$newline;

		//$message .= 'Click this link to view the agenda: <u>'.base_url().'Generate_agenda/via_pdf/'.$agenda_id.'</u>';

		$message .= 'This is a system-generated email. Please do not reply.';
		$message .= "</body></html>";
		$this->email->message($message);
		if($this->email->send()){
			echo "aaaa";
		}
		else{
			show_error($this->email->print_debugger());
		}
	}
}
