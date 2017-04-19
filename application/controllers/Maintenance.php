<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('maintenance/Maintenance_model');

	}
	public function index()
	{		

		$this->user();

	}

/* Start of user maintenance */

	public function maintenance_user(){
		$this->Maintenance_model->get_user();
	}

	public function get_user() {
		$user_id = $_POST['user_id'];
		$result = $this->Maintenance_model->get_user_details($user_id);
		echo json_encode($result);
	}


	public function user()
	{		

		$data['content']= 'maintenance/home';
		$data['title']= 'User';
		$data['file'] = 'maintenance_user.php';
		$data['action'] = 'list';
		$dropdown = $this->Maintenance_model->get_data("ojl_job_names");
		$data['dropdown'] = $dropdown;
		$territory = $this->Maintenance_model->get_data("ojl_territory");
		$data['territory'] = $territory;
		$role = $this->Maintenance_model->get_data("ojl_role");
		$data['role'] = $role;
		$this->load->view('template/layout',$data);

	}

    public function load_data() {

    	$filter = $_POST['filter'];

        if($_POST['loadme']=='load1'){
            $data['data'] = $this->Maintenance_model->load_data('notcount',$filter);
            $data['limit'] = 5;
            $this->load->view('maintenance/data_user',$data);
        } else {
            $data['pages'] = $this->Maintenance_model->load_data('count',$filter);
            $data['limit'] = 5;
            $this->load->view('maintenance/pagination',$data);
        }

    }


	public function insert_user() {
		
		$role = $_POST['role'];
		$empID = $_POST['empID'];
		$unilabemail = $_POST['unilabemail'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$jobname = $_POST['jobname'];
		$lpd = date('Y-m-d', strtotime($_POST['lpd']));
		$territory = $_POST['territory'];
		$username = $_POST['username'];

			$data = array(
				'username' => $username,
				'firstname' => $firstname,
				'middlename' => $middlename,
				'lastname' => $lastname,
				'email' => $unilabemail,
				'empid' => $empID,
				'jobname' => $jobname,
				'last_promotion_date' => $lpd,
				'territory' => $territory,
				'role' => $role,
				'is_active' => 1
			);


		

		$check = $this->Maintenance_model->if_exist($empID);
		
		if($check == 0){
			$result = $this->Maintenance_model->db_insert($data, 'ojl_user_maintenance');
		} else {
			$result = 'Error: Employee ID already exist!';
		}

		
		echo json_encode($result);

	}

	public function update_user() {
		
		$userid = $_POST['id'];
		$role = $_POST['role'];
		$empID = $_POST['empID'];
		$empIDold = $_POST['empIDold'];
		$unilabemail = $_POST['unilabemail'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$jobname = $_POST['jobname'];
		$lpd = date('Y-m-d', strtotime($_POST['lpd']));
		$territory = $_POST['territory'];
		$username = $_POST['username'];
		$isactive = $_POST['isactive'];
		$field = 'user_id';

			$data = array(
				'username' => $username,
				'firstname' => $firstname,
				'middlename' => $middlename,
				'lastname' => $lastname,
				'email' => $unilabemail,
				'empid' => $empID,
				'jobname' => $jobname,
				'last_promotion_date' => $lpd,
				'territory' => $territory,
				'role' => $role,
				'is_active' => $isactive
			);

		if($empID != $empIDold) {
		$check = $this->Maintenance_model->if_exist_emp($empID);
				if($check == 0){
					$result = $this->Maintenance_model->db_update($data, 'ojl_user_maintenance',$userid,$field);
				} else {
					$result = 'Error: Employee ID already taken!';
				}
		} else {
				$result = $this->Maintenance_model->db_update($data, 'ojl_user_maintenance',$userid,$field);
		}
		echo json_encode($result);

	}

/* End of user maintenance */

/* Start of Job */

	public function job()
	{		


		$data['content']= 'maintenance/home';
		$data['title']= 'Job';
		$data['file'] = 'maintenence_job.php';
		$data['action'] = 'list';
		$dropdown = $this->Maintenance_model->get_data("ojl_job_names");
		$data['dropdown'] = $dropdown;
		$this->load->view('template/layout',$data);

	}


    public function load_job() {

    	$filter = $_POST['filter'];
    	$table = $_POST['table'];
        if($_POST['loadme']=='load1'){
            $data['data'] = $this->Maintenance_model->load_job('notcount',$filter,$table);
            $data['limit'] = 5;
            $this->load->view('maintenance/data_job',$data);
        } else {
            $data['pages'] = $this->Maintenance_model->load_job('count',$filter,$table);
            $data['limit'] = 5;
            $this->load->view('maintenance/pagination',$data);
        }

    }

/* End of Job */
	


/* Start of Agenda */

	public function agenda(){		

        $data['content']= 'maintenance/home';
 		$data['title']= 'Agenda';
		$data['file'] = 'maintenance_agenda.php';
		$data['action'] = 'list';
		$data['results'] = $this->Maintenance_model->get_agenda_maintenance();
		$data['cat_results'] = $this->Maintenance_model->get_cat_maintenance();
		$this->load->view('template/layout',$data);

	}


	public function insert_agenda() {

		$agenda = $_POST['agenda'];
		$category = $_POST['category'];
			$data = array(
				'agenda_maintenance_name' => $agenda,
				'cat_maintenance_id' => $category,
				'is_active' => 1
			);
		$result = $this->Maintenance_model->db_insert($data, 'ojl_agenda_maintenance');
		echo json_encode($result);
	}


	 public function load_agenda() {

	 	$agend_filter = $_POST['agend_filter'];
        if($_POST['loadme']=='load1'){
            $data['results'] = $this->Maintenance_model->load_agenda('notcount',$agend_filter);
            $data['limit'] = 5;
            $this->load->view('maintenance/data_agenda',$data);
        } else {
            $data['pages'] = $this->Maintenance_model->load_agenda('count',$agend_filter);
            $data['limit'] = 5;
            $this->load->view('maintenance/pagination',$data);
        }
    }

    public function get_agenda() {

		$agenda_id = $_POST['agenda_id'];
		$result = $this->Maintenance_model->get_agenda_details($agenda_id);
		echo json_encode($result);

	}

	public function update_agenda() {

		$agend_id = $_POST['id'];
		$agenda_name = $_POST['agenda_name'];
		$update_cat = $_POST['update_cat'];
		$isactive = $_POST['isactive'];
		$field = 'agenda_maintenance_id';
			$data = array(
				'agenda_maintenance_name' => $agenda_name,
				'cat_maintenance_id' => $update_cat,
				'is_active' => $isactive
			);

		$result = $this->Maintenance_model->db_update($data, 'ojl_agenda_maintenance',$agend_id,$field);
		echo json_encode($result);
	}

/* End of Agenda */

}

?>
