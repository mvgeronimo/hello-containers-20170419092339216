<?php 


class Email_controller extends CI_Controller {

    public function __construct() {    
          parent::__construct();
          $this->load->library('email');
          $this->load->model('Home_model');
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

    }


    public function sendMail() {
        

        $agenda_id = $_POST['agenda_id'];
        
        $get_agenda = $this->Home_model->get_agenda($agenda_id);
        $date_now = date('F d, Y');

        $this->email->from('ojl.ecomqa.com', 'OJL Admin');
        $email = 'phpdeveloper9@unilab.com.ph';
        $this->email->to($email);

        $agenda_id = $_POST['agenda_id'];
        //$firstname_dm = $this->session->userdata('firstname');
        //$lastname_dm = $this->session->userdata('lastname');
        

        $newline = "<br>"; 

        
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
        $this->email->subject('Your OJL agreements and acknowledgement');
        $this->email->message($message);
        $r = $this->email->send();
        if (!$r){
            $this->email->print_debugger();
        }
        else{
            echo "aaa";
        }
   
    }
}