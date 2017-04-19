<?php date_default_timezone_set('Asia/Taipei');

class Login_model extends CI_Model {

function __construct()
    {
        parent::__construct();
        $this->load->helper('array');
        $this->load->library('session');

    }

    public function checkAccess()
	{
		$is_logged_in = $this->session->userdata('is_logged');
		if(empty($is_logged_in) && $is_logged_in != 1):
			redirect("login_controller");
		endif;

		
	}

    function verifyUser($username, $password){
    	$query = $this->db->query("SELECT * FROM ojl_user where email = '".$username."'");
    	return $this->verify($query);
    }

    public function verify($query){
    	foreach ($query->result() as $row) {
		 	$user_id = $row->user_id;
		 	$username = $row->username;
		 	$user_type = $row->user_type_id;
		 	$empid = $row->empid;
		 	/*$step = $row->step;*/
		 	$firstname = $row->firstname;
		 	$lastname = $row->lastname;
		 	// $fname = $row->first_name;
		 	// $lname = $row->last_name;
		 	// $mname = $row->middle_name;
		 	//$role_id = $row->role_id;
		 }
		 $data_user = $_POST['data'];
		 $firstname = $data_user['first_name'];
		 $lastname = $data_user['last_name'];
		 $count = $query->num_rows();
		 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		 $charactersLength = strlen($characters);
		 $randomString = '';
		    for ($i = 0; $i < 10; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		   

		 //if($count > 0) {
				$session_data = array(
					// 'session_id' => md5($randomString),
										'ip_address' => $_SERVER['REMOTE_ADDR'],
										'user_agent' => $_SERVER['HTTP_USER_AGENT'],
										'last_activity' => date("Y-m-d h:i:A"),
										'username' => $username,
										'user_id' => $user_id,
										'user_type' => $user_type,
										'firstname' => $firstname,
										'lastname' => $lastname,
										'emp_id' => $empid,
										'step' => '',
										/*'step' => $step,*/
										'agenda_id' => '',
										'agenda_psr' => '',
									   'is_logged' => 1
									  );
				$this->session->set_userdata($session_data);
				
				$msg = $query->result();
		    		//$msg = true;
		    	//}else{
		    	  //  $msg = false;
		    	//}  	
		    	 return $msg;

		    	
    }


}