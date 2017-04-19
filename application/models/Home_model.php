<?php

class Home_model extends CI_Model{

	function __construct() {
        parent::__construct();
    }

    function db_insert($data, $table){
    	

		$this->db->insert($table, $data); 
		
    }

    function SubmitAgenda($stat) {


    	$agenda_id = $this->session->userdata('agenda_id');

        $query2 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
        $res1 = $query2->result();
        $old_agenda = $res1[0]->old_agenda;

        $result = $this->checkifexist($_POST['datefrom'], $_POST['dateto'], $old_agenda);

        if($result != 0) {
            return 'error';
        } else {
            
            $query = $this->db->query("UPDATE ojl_agenda SET status = '".$stat."', is_old_agenda = 0 WHERE agenda_id = '".$agenda_id."'");
         $query3 = $this->db->query("UPDATE ojl_agenda set is_old_agenda = 1 where agenda_id = '".$old_agenda."'");
         return 'true';
        }
    	
        


    }


    // function suckseed($old_agenda, agenda_id) {
    //     if($old_agenda != 0) {
    //        
    //     }
    // }


    function getEvents() {
    	$user_id = $this->session->userdata('emp_id');
        $datenow = date('Y-m-d');
        if(isset($_POST['is_completion'])){
            $q = " and a.date_from <='".$datenow."' && a.status = 5";
        }
        else{   
            $q = '';
        }

        // AND a.is_old_agenda != 1
    	$query = $this->db->query("SELECT a.agenda_id as agenda_id, a.psr as title, a.date_from as start, a.date_to as end, a.status as status, a.type as type, a.step as step
    								FROM ojl_agenda as a
    								WHERE user_id = '".$user_id."' ".$q ." and is_old_agenda !=1");
    	$result = $query->result();
    	return $result;
    }

    function get_date() {
    	$id = $this->session->userdata('agenda_id');

    	$query = $this->db->query("SELECT date_from, date_to FROM ojl_agenda where agenda_id = '".$id."'");
    	$result = $query->result();
    	return $result;
    }

	
    function get_last_id($table) {
    	$query = $this->db->query("SELECT agenda_id FROM ".$table." ORDER BY agenda_id DESC LIMIT 1");
    	$result = $query->result();
    	return $result;
    }

    // function get_data($table) {
        // $query = $this->db->query("SELECT * FROM ".$table." where is_active = '1'");
        // $result = $query->result();
        // return $result;

    // }
	
	function get_data($table,$where = null,$orderby = null){

    	$this->db->select('*');

		$this->db->from($table);
		
		if($where != null)
		{
			  $this->db->where($where, NULL, FALSE); 
		}
		if($orderby != null)
		{
			$this->db->order_by($orderby);
		}
		
		$query = $this->db->get();
		
		return $query->result();
    }

	  function delete_data($table,$field_name,$field_data) {

        $this->db->where($field_name, $field_data);

        $this->db->delete($table);

    }
	
	function delete_dataIN($table,$field_name,$field_data) {

		// $value = array($field_data);
		// $this->db->where_in($field_name,$value);
		// $this->db->delete($table);
		// $array = array('lastname', 'email', 'phone');
		$value = implode(",", $field_data);
		$this->db->query("DELETE FROM ".$table." WHERE ".$field_name." IN(".$value.")");


    }
	
	 function insert_data($table,$data) {

        $inserted = $this->db->insert($table, $data);
		 $insert_id = $this->db->insert_id();
        return $insert_id;

    }   
	
	
	
    function count_record($table) {

        return $this->db->count_all($table);

    }

    function update_data($table,$data,$where=null) {

        if($where != null)
		{
			  $this->db->where($where, NULL, FALSE); 
		}

        $this->db->update($table, $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    return 0;
		}
		else
		{
			return 1;
		}

    }

    function get_sales_plan($agenda_id) {
       // $user_id = $this->session->userdata('user_id');
        $query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
        $res1 = $query1->result();


        $psr_id = $res1[0]->psr_id;
        // $this->session->set_userdata('agenda_psr', $psr_id);
        // $this->session->set_userdata('step', $res1[0]->step);

        $que = $this->db->query("SELECT * FROM ojl_SalesPlan where agenda_id = '".$agenda_id."' and psr_id = '".$psr_id."' order by record_id");
        $checks = $que->num_rows();

        if($checks == 0) {
            $query = $this->db->query("SELECT * FROM ojl_SalesPlan2 where psr_id = '".$psr_id."' order by record_id");
        } else {
             $query = $this->db->query("SELECT * FROM ojl_SalesPlan where psr_id = '".$psr_id."' AND agenda_id = '".$agenda_id."' order by record_id");
        }
       
        $result = $query->result();
        return $result;

    }

    function get_ds_st_iserv($sales_plan_id) {
        $query = $this->db->query("SELECT * FROM ojl_ds_st_iserv where sales_plan_id = '".$sales_plan_id."'");
        $result = $query->result();
        return $result;
    }

    function get_abig() {
        $user_id = $this->session->userdata('user_id'); 
        $query = $this->db->query("SELECT * FROM ojl_coverage_performance where user_id = '".$user_id."'");
        $result = $query->result();
        return $result;
    }

    function get_cycle($coverage_id) {
        $query = $this->db->query("SELECT * FROM ojl_coverage_cycle where coverage_id = '".$coverage_id."'");
        $result = $query->result();
        return $result;
    }

    function Getmpi() {
        $psr_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT a.*, b.username FROM ojl_marketing_programs as a
                                LEFT JOIN ojl_user as b on a.user_id = b.user_id
                                where a.user_id = (SELECT dm from ojl_dm_psr where psr = '".$psr_id."') and a.status = 2");
        $result = $query->result();
        return $result;
    }

    function Getmpi_where($mpi) {
       
        $query = $this->db->query("SELECT a.* FROM ojl_marketing_programs as a
                                where a.record_id = '".$mpi."'");
        $result = $query->result();
        return $result;
    }

    

    function GetPlanned($mp_id) {
        $query = $this->db->query("SELECT * FROM ojl_plan where mp_id = '".$mp_id."'");
        $result = $query->result();
        return $result;
    }

    function GetFunction_expertise($mp_id, $table) {
        $query = $this->db->query("SELECT * FROM ".$table." where mp_id = '".$mp_id."'");
        $result = $query->result();
        return $result;
    }

    function mp_conforme($mp_id) {
        $query = $this->db->query("UPDATE ojl_marketing_programs SET status = 3 WHERE record_id = '".$mp_id."'");
    }

    function getDm() {
        $user_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM ojl_user where user_id = '".$user_id."'");
        $result = $query->result();
        return $result;
    }

    function getPsr() {
        $dm = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM ojl_user where user_id = (SELECT psr from ojl_dm_psr where dm = '".$dm."')");
        $result = $query->result();
        return $result;
    }

    function getremarks() {
        $psr = $this->session->userdata('user_id');

        $query = $this->db->query("SELECT a.*, b.username FROM ojl_evaluation as a left join ojl_user as b on a.user_id = b.user_id where a.user_id = (SELECT dm from ojl_dm_psr where psr = '".$psr."') and a.status = '2'");
        $result = $query->result();
        return $result;
    }

    function getRemarksDetails($id) {
        $query = $this->db->query("SELECT a.*, b.username FROM ojl_evaluation as a LEFT JOIN ojl_user as b on a.user_id = b.user_id where a.record_id = '".$id."'");
        $result = $query->result();
        return $result;
    }

    function remarks_update($action_plan, $table, $record_id, $field) {
        // $this->db->where($field, $record_id);
        // $this->db->update($table, $data); 

        $query = $this->db->query("UPDATE ojl_evaluation SET psr_action_plan = '".$data."' WHERE record_id = '".$record_id."'");
    
    }

    function psr_territory($psr_id) {
        $query = $this->db->query("SELECT * FROM ojl_psr where psr_id = '".$psr_id."'");
        $result = $query->result();
        return $result;
    }

    function existing_agenda($psr_id) {
        $month = date('m');
        $query = $this->db->query("SELECT * FROM ojl_agenda where psr_id = '".$psr_id."' and (MID(date_from,6,2) = '".$month."' || MID(date_to,6,2) = '".$month."') AND is_old_agenda != 1 AND status = 1");
        $result = $query->num_rows();
        return $result;
    }

    function checkdates($datefrom, $dateto, $psr) {
        $query = $this->db->query("SELECT * FROM ojl_agenda where psr = '".$psr."' AND ((date_from = '".$datefrom."' || date_to = '".$datefrom."') || (date_from = '".$dateto."' || date_to = '".$dateto."')) AND is_old_agenda != 1 AND status = 1");
        //$query = $this->db->query("SELECT * FROM ojl_agenda");
        $result = $query->num_rows();
        return $result;
    }

    function checkifexist($datefrom, $dateto, $hid_agenda) {
        $dm = $this->session->userdata('emp_id');
        if($hid_agenda!=''){
            $q = " AND agenda_id !='".$hid_agenda."'";
        }
        else{
            $q = '';
        }
        $query = $this->db->query("SELECT * FROM ojl_agenda where  ((date_from <= '".$datefrom."' && date_to >= '".$datefrom."') || (date_from <= '".$dateto."' && date_to >= '".$dateto."')) AND is_old_agenda != 1 AND status !=0 and user_id = '".$dm."'".$q);

        $result = $query->num_rows();
        return $result;
    }

    function getprev($psr_id) {
        $query = $this->db->query("SELECT a.psr, c.om, a.dm, CONCAT(d.firstname, ' ', d.lastname) as om_name,
                                DATE_FORMAT(b.dm_date_from, '%M %d, %Y') as dmdatefrom,
                                DATE_FORMAT(b.dm_date_to, '%d, %Y') as dmdateto,
                                DATE_FORMAT(b.psr_date_from, '%M %d, %Y') as psrdatefrom,
                                DATE_FORMAT(b.psr_date_to, '%M %d, %Y') as psrdateto,
                                b.* FROM ojl_agenda as a 
                                LEFT JOIN  ojl_evaluation as b on a.agenda_id = b.agenda_id
                                LEFT JOIN ojl_dm_om as c on a.user_id = c.dm
                                LEFT JOIN ojl_user as d on c.om = d.empid
                                    WHERE psr_id = '".$psr_id."' AND a.status = 4 ORDER BY agenda_id DESC LIMIT 1");
        $result = $query->result();
        return $result;
    }

    function get_agenda($agenda_id) {
       $query = $this->db->query("SELECT a.*, b.salary_grade, CONCAT(b.firstname, ' ', b.lastname) as dm_name FROM ojl_agenda as a LEFT JOIN ojl_user as b on a.user_id = b.empid where a.agenda_id = '".$agenda_id."'"); 
       $result = $query->result();
       return $result;
    }



    function update_evaluation($data, $agenda_id) {
        $this->db->where('agenda_id', $agenda_id);
        $this->db->update('ojl_evaluation', $data); 
    }

    function get_evaluation($agenda_id) {
        $query = $this->db->query("SELECT * FROM ojl_evaluation where agenda_id = '".$agenda_id."'");
        $result = $query->result();
        return $result;
    }

    function forCompletion($agenda_id) {
        $this->db->query("UPDATE ojl_agenda set progress = 'For Completion' where agenda_id = '".$agenda_id."'");
    }

    function step_up($step) {
        $agenda_id = $this->session->userdata('agenda_id');
        $this->db->query("UPDATE ojl_agenda set step = '".$step."' where agenda_id = '".$agenda_id."'");

    }

    function create_emp_comp($last_id) {

        $query = $this->db->query("SELECT a.*, b.last_promotion_date FROM ojl_agenda as a left join ojl_user as b on a.psr_id = b.empid where agenda_id = '".$last_id."'");
        $last_agenda = $query->result();

        $date_from = date_create($last_agenda[0]->date_from);
        
        $date_to = date_create($last_agenda[0]->date_to);
        

        if($date_from == $date_to) {
            $daty = date_format($date_from, 'F d, Y');

        } else {
            $datefrom = date_format($date_from, 'F d -');
            $dateto = date_format($date_to, ' d, Y');
            $daty = $datefrom.$dateto;
        }


        $data = array(
            'agenda_id' => $last_agenda[0]->agenda_id,
            'user_id' => $last_agenda[0]->user_id,
            'psr_name' => $last_agenda[0]->psr,
            'salary_grade' => $last_agenda[0]->salary,
            'territory' => $last_agenda[0]->territory,
            'date_of_ojl' => $daty,
            'competency_standard' => $last_agenda[0]->competency_standards,
            'last_promotion_date' => $last_agenda[0]->last_promotion_date

            );
        $this->db->insert('ojl_employee_competency', $data); 

         $data2 = array(
            'date_from' => $last_agenda[0]->date_from,
            'date_to' => $last_agenda[0]->date_to,
            'agenda_id' => $last_agenda[0]->agenda_id,
            'user_id' => $last_agenda[0]->user_id
            );
         $this->db->insert('ojl_marketing_programs', $data2); 

         $data3 = array(
                'agenda_id' => $last_agenda[0]->agenda_id,
                'empid' => $this->session->userdata('emp_id')
            );

         $this->session->set_userdata("agenda_id", $last_agenda[0]->agenda_id);
         $this->session->set_userdata("agenda_psr", $last_agenda[0]->psr_id);
         $this->session->set_userdata("step", $last_agenda[0]->step);

        $this->Home_model->db_insert($data3, 'ojl_evaluation');
    }

    function get_salary_grade($psr_id) {
        $query = $this->db->query("SELECT a.salary_grade, CONCAT(b.care,b.grow,b.integrate,b.execute,b.transform) as competency FROM ojl_user as a 
                                LEFT JOIN ojl_competency_standard as b on a.salary_grade = b.salary_grade
                                    where a.empid = '".$psr_id."'");
        $result = $query->result();
        return $result;
    }

    function update_salesPlan($ds_id, $remarks) {

        $agenda_id = $_POST['agenda_id'];
        $psr_id = $_POST['psr_id'];
        $grossup_ytd_ds = $_POST['grossup_ytd_ds'];
        $grossup_ytd_st = $_POST['grossup_ytd_st'];
        $grossup_ytd_is = $_POST['grossup_ytd_is'];
        $quota_ytd = $_POST['quota_ytd'];
        $quota_fy = $_POST['quota_fy'];
        $quota_togo = $_POST['quota_togo'];


        

        // $query = $this->db->query("SELECT * FROM ojl_SalesPlan where agenda_id = '".$agenda_id."' AND psr_id = '".$psr_id."'");
        // $checks = $query->num_rows();

        

        // if($checks == 0) {
        //     $data = array("agenda_id"=>$agenda_id, 
        //                     "psr_id"=>$psr_id,
        //                     "remarks"=>$remarks,
        //                     "grossup_ytd_ds" => $grossup_ytd_ds,
        //                     "grossup_ytd_st" => $grossup_ytd_st,
        //                     "grossup_ytd_is" => $grossup_ytd_is,
        //                     "quota_ytd" => $quota_ytd,
        //                     "quota_fy" => $quota_fy,
        //                     "quota_togo" => $quota_togo
        //                 );
        //     $this->db->insert('ojl_SalesPlan', $data);
        // } else {
        //     $this->db->query("UPDATE ojl_SalesPlan set remarks = '".$remarks."' where agenda_id = '".$agenda_id."'");
        // }


        //$query = $this->db->query("DELETE FROM ojl_SalesPlan where agenda_id = '".$agenda_id."' AND psr_id = '".$psr_id."'");
       

        

       
            $data = array("agenda_id"=>$agenda_id, 
                            "psr_id"=>$psr_id,
                            "remarks"=>$remarks,
                            "grossup_ytd_ds" => $grossup_ytd_ds,
                            "grossup_ytd_st" => $grossup_ytd_st,
                            "grossup_ytd_is" => $grossup_ytd_is,
                            "quota_ytd" => $quota_ytd,
                            "quota_fy" => $quota_fy,
                            "quota_togo" => $quota_togo
                        );
            $this->db->insert('ojl_SalesPlan', $data);
       


        // $this->db->query("UPDATE ojl_SalesPlan2 set remarks = '".$remarks."' where record_id = '".$ds_id."'");
    }

    function get_action_plan($agenda_id) {
        $query = $this->db->query("SELECT a.*, b.agenda_name from ojl_ActionPlan as a 
                                    left join ojl_agenda_name as b on a.agenda_name_id = b.agenda_name_id
                                    where a.agenda_id = '".$agenda_id."'
                                    ");

        return $query->result();
    }

    function get_itn($agenda_id) {
        $query = $this->db->query("SELECT * FROM ojl_itenerary where agenda_id = '".$agenda_id."'");
        return $query->result();
    }

    function checkdate($date_from, $date_to) {
        $user_id = $this->session->userdata('emp_id');


        $this->db->select('*');
        $this->db->from('ojl_agenda');
        $this->db->where('((date_from <= "'.$date_from.'" AND date_to >= "'.$date_from.'") OR (date_from <= "'.$date_to.'" AND date_to >= "'.$date_to.'"))');
        $this->db->where('status', 1);
        $this->db->where('is_old_agenda !=', 1);

        if($_POST['hid_agenda'] != '') {
            $this->db->where('agenda_id !=', $_POST['hid_agenda']);
        }

        $this->db->where('user_id', $user_id);

        $result = $this->db->get()->result();

        return $result;

    }

    function today_agenda($date) {
        $user_id = $this->session->userdata('emp_id');
        $query = $this->db->query("SELECT * FROM ojl_agenda as a where a.user_id = '".$user_id."' AND (a.date_from = '".$date."' || a.date_to = '".$date."')");
        $result1 = $query->result();

        $agenda_id = $result1[0]->agenda_id;

        $query2 = $this->db->query("SELECT a.*, b.date_from as day1, b.date_to as day2 FROM ojl_itenerary as a
                                LEFT JOIN ojl_agenda as b on a.agenda_id = b.agenda_id
                                    where b.agenda_id = '".$agenda_id."'");

        return $query2->result();
    }

    function getcompletion($tableName, $agenda_id){

        if($tableName == 'ojl_client_engagement') {
            $arr = array();

            $data = $this->db->query("SELECT a.agenda_id, a.day, a.doctor, a.doctor_address, b.remarks, b.is_mobile FROM ojl_itenerary as a
                                    left join ojl_client_engagement as b on a.itenerary_id = b.itenerary_id
                                    where a.agenda_id = '".$agenda_id."'
                                    ");

            $data_ = $data->result();

            $data2 = $this->db->query("SELECT agenda_id, day, name_of_md as doctor, clinic_address as doctor_address, remarks, is_mobile
                                    FROM ojl_client_engagement where agenda_id = '".$agenda_id."' and is_mobile = 1
                                    ");

            $data2_ = $data2->result();

         
            $data123 = array_merge($data_, $data2_);
            
            return $data123;
        } else if($tableName == 'ojl_product_communication') {

            $data = $this->db->query("SELECT a.agenda_id, a.day, a.doctor, b.rating_per_md, b.biomedis_product, b.remarks, b.is_mobile FROM ojl_itenerary as a
                                    left join ojl_product_communication as b on a.itenerary_id = b.itenerary_id
                                    where a.agenda_id = '".$agenda_id."'
                                    ");

            $data_ = $data->result();

            $data2 = $this->db->query("SELECT agenda_id, day, name_of_md as doctor, rating_per_md, biomedis_product, remarks, is_mobile
                                    FROM ojl_product_communication where agenda_id = '".$agenda_id."' and is_mobile = 1
                                    ");
            $data2_ = $data2->result();

            $data123 = array_merge($data_, $data2_);

            return $data123;

        } else {
            $this->db->where('agenda_id', $agenda_id);
            $data = $this->db->get($tableName);
            return $data->result();

        }
       
        
    }


    function ojl_competency($agenda_id) {
        $query = $this->db->query("SELECT * FROM ojl_employee_competency where agenda_id = '".$agenda_id."'");
        return $query->result();
    }

    function get_idp($comp_id) {
        $query = $this->db->query("SELECT * FROM ojl_idp where competency_id = '".$comp_id."'");
        return $query->result();
    }

    function get_ulearn($comp_id) {
        $query = $this->db->query("SELECT * FROM ojl_ulearn where competency_id = '".$comp_id."'");
        return $query->result();
    }

}


