<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Maintenance_agenda extends CI_Controller {



	public function __construct(){

		parent::__construct();

		$this->load->library('session');

		$this->load->helper('url');

		$this->load->model('maintenance/Agenda_model');

	}

	public function index() {		

		$data['content']= 'maintenance/home';

		$data['results'] = $this->Agenda_model->get_agenda_maintenance();

		$data['cat_results'] = $this->Agenda_model->get_cat_maintenance();

		$this->load->view('template/layout',$data);


	}

	public function maintenance_agenda(){		

        $this->load->view('maintenance/maintenance_agenda', $data);

	}

		public function insert_agenda() {

		$agenda = $_POST['agenda'];

		$category = $_POST['category'];

			$data = array(

				'agenda_maintenance_name' => $agenda,

				'cat_maintenance_id' => $category,

				'is_active' => 1

			);

		$result = $this->Agenda_model->db_insert($data, 'ojl_agenda_maintenance');

		//$last_id = $this->db->insert_id();

		echo json_encode($result);

	}

	 public function load_data() {

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

		$result = $this->Agenda_model->get_agenda_details($agenda_id);

		echo json_encode($result);

	}

	public function update_agenda() {

		$agend_id = $_POST['id'];

		$agenda_name = $_POST['agenda_name'];

		$update_cat = $_POST['update_cat'];

		$isactive = $_POST['isactive'];



			$data = array(

				'agenda_maintenance_name' => $agenda_name,

				'cat_maintenance_id' => $update_cat,

				'is_active' => $isactive

			);

		$result = $this->Agenda_model->db_update($data, 'ojl_agenda_maintenance',$agend_id);

		echo json_encode($result);

	}
	

}



?>

