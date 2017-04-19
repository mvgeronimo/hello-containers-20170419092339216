<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Cron extends CI_Controller {

    public function __construct() {    
          parent::__construct();

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
    }

    public function index() { //onload call lahat
        $date_today = date('Y-m-d');
        $date_fornotif = date("Y-m-d", strtotime("-7 day", strtotime($date_today)));
        //echo $date_fornotif;
        $query = $this->db->query("SELECT * FROM ojl_user where user_type_id = '1'");
        $res = $query->result();

        foreach ($res as $key => $value) {
            $dm_name = $value->firstname. ' '.$value->lastname;
            $emp_id = $value->empid;
            $email = $value->email;
            
            $q = $this->db->query("SELECT a.*, b.firstname, b.lastname FROM ojl_agenda as a LEFT JOIN ojl_user as b on b.empid = a.psr_id  where a.user_id = '".$emp_id."' and a.status = '1' and a.date_to >= '".$date_fornotif."' AND a.date_to <= '".$date_today."'");
            $result = $q->result();

            if(count($result)>0){
                $t = '';
                foreach ($result as $key => $tval) {
                    if($tval->date_from !=$tval->date_to){
                        $date_to = date('d', strtotime($tval->date_to));
                        $date_ojl = date('F j', strtotime($tval->date_from)).'-'.$date_to.', '.date('Y', strtotime($tval->date_from));
                    }
                    else{
                        $date_ojl = date('F j, Y', strtotime($tval->date_from));
                    }
                    $t .= "<p style='margin-left: 15px;'><tr><td>".$tval->firstname." ".$tval->lastname."</td><td>".$date_ojl."</td><td><a href='".base_url()."ojl_completion?id=".$tval->agenda_id."'>link</a></td></tr></p>";
                }
               
                $this->emailnotif($t,$dm_name,$email);
            }
            

        }
        
        //$this->emailnotif();
    }

    public function emailnotif($t,$dm_name,$email){
        /************** EMAIL *****************/
            $this->email->from('ojl.ecomqa.com', 'OJL');
            $email = 'phpdeveloper9@unilab.com.ph';
            $this->email->to($email);
            $message = "<html><head><title></title></head><body style='font-family:Arial'>";            
            $message .= "<p style='margin-left: 15px;'>Dear <b>".$dm_name."</b>,</p>";
            $message .= "<p style='margin-left: 15px'>Please be reminded that you have OJL Report(s) for completion:</p>";
            $message .= "<p style='margin-left: 15px'>Please click on the link(s) below to complete the OJL Report(s):</p>";

            $message .= "<p style='margin-left: 15px'><table border=0><tr><td width='30%'><b>Name of PSR</b></td><td width='30%'><b>Date of OJL</b></td><td width='30%'><b>OJL Link</b></td></tr></p>";
            $message .= "<p style='margin-left: 15px'>".$t."</table></p><p>&nbsp;</p>";

            $message .= "<p style='margin-left: 15px'>Thank you,</p>";
            $message .= "<p style='margin-left: 15px'><font size='2px'><span style='color:#f00'>Note:</span> This is a system-generated email from OJL System. Please do not reply to this email. </font></p>";
            $message .= "</body></html>";
            $this->email->subject("OJL For Completion");
            $this->email->message($message);  
            /************** EMAIL PART *****************/
            $this->email->send();
    }
}