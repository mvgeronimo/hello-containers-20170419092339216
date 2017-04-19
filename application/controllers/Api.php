<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{


	public function __construct() {

        parent::__construct();
        //header('Content-Type: application/x-www-form-urlencoded');
        // header('Content-Type: application/json');

        // if(!$this->_validateRequestContentType()): //Accept form-urlencoded request headers only
        //   echo json_encode(array("status" => "failed", "msg" => "Invalid request header content type! Please make sure your request header is x-www-form-urlencoded."));
        //   exit();
        // endif;
        
    }

    private function _validateRequestContentType()
      {
        return ($_SERVER['CONTENT_TYPE'] == 'application/x-www-form-urlencoded') ? TRUE : FALSE;
      }

    public function index() {
        
    	$cmdEvent = $_POST['cmdEvent'];

        if($cmdEvent == 'get_psr_per_dm') {
           $this->dm_psr_config();
        } 

        if($cmdEvent == 'get_agenda') {
            $this->getAgenda();
        }

        if($cmdEvent == 'get_itinerary') {
            $this->get_itenerary();
        }

        if($cmdEvent == 'get_coverage_performance_monitoring') {
            $this->get_cp_monitoring();
        }


        if($cmdEvent == 'get_client_engagement') {
            $this->get_client_engagement();
        }

        if($cmdEvent == 'get_product_communication') {
            $this->get_product_communication();
        }

        if($cmdEvent == 'get_survey') {
            $this->get_survey();
        }

        if($cmdEvent == 'get_competitors_activity_report') {
            $this->get_competitors_activity_report();
        }

        if($cmdEvent == 'get_salesplan') {
            $this->get_salesplan_report();
        }

        if($cmdEvent == 'post_client_engagement') {
            $this->post_client_engagement();
        }

        if($cmdEvent == 'post_product_communication_exercise') {
            $this->post_product_communication_exercise();
        }

        if($cmdEvent == 'post_survey') {
            $this->post_survey();
        }

        if($cmdEvent == 'post_competitors_activity_report') {
            $this->post_competitors_activity_report();
        }

        

    }

    public function dm_psr_config() {
        $empid = $_POST['empid'];
        $token = $_POST['token'];
        

        $sql = $this->db->query("SELECT * FROM ojl_user as a where empid IN (SELECT psr FROM ojl_dm_psr WHERE dm = '".$empid."')");
        $result = $sql->result();
        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            echo json_encode(array('result'=> $result)); 
        }


    }

    public function getAgenda() {    // 1 
      // $q = $this->checkStatus($_REQUEST['status']);
    	$empid = $_POST['empid'];
        $token = $_POST['token'];
        $modified_at = $_POST['modified_at'];

        // $sql = $this->db->query("SELECT * FROM refpromo ".$q." order by updated_time");

        $date_now = date('Y-m-d H:i:s');



        // $user = $this->db->query("SELECT user_id FROM ojl_user where empid1 = '".$empid."'");
        // $user_id = $user->result();

        // $user2 = $user_id[0]->user_id;




         $this->db->query("UPDATE ojl_agenda set modified_date = '".$date_now."' where user_id = '".$empid."'");


        $sql = $this->db->query("SELECT a.user_id as empid, 
                                        a.psr_id, 
                                        a.psr, 
                                        a.salary, 
                                        a.date_from, 
                                        a.date_to, 
                                        a.competency_standards, 
                                        a.status, 
                                        a.type,  
                                        a.territory,
                                        a.agenda_id,
                                        a.old_agenda
                                        /*CASE WHEN a.old_agenda !=0  THEN a.old_agenda ELSE a.agenda_id END AS agenda_id*/
                                       
                                        FROM ojl_agenda as a 
                                        LEFT JOIN ojl_user as b on a.user_id = b.user_id 
                                        WHERE a.user_id = '".$empid."'
                                        AND a.is_active = 1
                                        AND a.status != '0'
                                        AND a.is_old_agenda = '0' ");
        $res = $sql->result();


        $count = $sql->num_rows();

       $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            echo json_encode(array('result'=> $res, 'modified_at' => $date_now)); 
        }

    }

    public function get_itenerary() {
        //$agenda_id = $_POST['agenda_id'];
        $token = $_POST['token'];
        $empid = $_POST['empid'];

        $modified_at = $_POST['modified_at'];


        $date_now = date('Y-m-d H:i:s');
        $this->db->query("UPDATE ojl_itenerary as a 
                        LEFT JOIN ojl_agenda as b on a.agenda_id = b.agenda_id
                        set a.modified_date = '".$date_now."' where b.user_id = '".$empid."'");

        $sql = $this->db->query("SELECT 
                                a.itenerary_id,
                                a.agenda_id,
                                b.empid,
                                a.day,
                                a.doctor,
                                a.doctor_address
                                FROM ojl_itenerary as a 
                                LEFT JOIN ojl_user as b on a.user_id = b.user_id
                                LEFT JOIN ojl_agenda as c on a.agenda_id = c.agenda_id
                                WHERE c.user_id = '".$empid."' AND c.is_active = 1 AND c.status  != '0' AND is_old_agenda =0 ");
        $res = $sql->result();
        $count = $sql->num_rows();

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        
        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            echo json_encode(array('result'=> $res, 'modified_at' => $date_now)); 
        }
    }

    public function get_cp_monitoring() {
        //$agenda_id = $_POST['agenda_id'];
        $empid = $_POST['empid'];
        $token = $_POST['token'];
        $data = array();
        // $sql = $this->db->query("SELECT 
        //                         a.coverage_id,
        //                         b.empid,
        //                         a.abig_data
        //                         FROM ojl_coverage_performance as a 
        //                         LEFT JOIN ojl_user as b on a.user_id = b.user_id

        //                         WHERE a.agenda_id = '".$agenda_id."'");
        $sql = $this->db->query("SELECT 
                                a.coverage_id,
                                b.empid,
                                a.abig_data
                                FROM ojl_coverage_performance as a 
                                LEFT JOIN ojl_user as b on a.user_id = b.empid
                                LEFT JOIN ojl_agenda as c on a.agenda_id = c.agenda_id
                                WHERE c.user_id = '".$empid."' AND c.agenda_id = '".$agenda_id."'");
                                

        $res1 = $sql->result();

        
        $cp_id = $res1[0]->coverage_id;
        $sql2 = $this->db->query("SELECT 
                                a.record_id,
                                a.coverage_id,
                                a.cycle_number,
                                a.content
                                FROM ojl_coverage_cycle as a 
                                
                                WHERE a.coverage_id = '".$cp_id."'");
        $res2 = $sql2->result();

        $x['coverage'] = $res1;
        $x['cycle'] = $res2;

         array_push($data, $x);
        
        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            echo json_encode(array('result'=> $data)); 
        }
    }

    public function get_client_engagement() {
        $agenda_id = $_POST['agenda_id'];
        $empid = $_POST['empid'];
        $token = $_POST['token'];

        if($agenda_id == null) {
            $add_where = "";
        } else {
            $add_where = " AND b.agenda_id = '".$agenda_id."'";
        }

         $sql = $this->db->query("SELECT 
                                a.record_id,
                                a.agenda_id,
                                a.empid,
                                a.clinic_address,
                                a.day,
                                a.name_of_md,
                                a.remarks,
                                a.itenerary_id,
                                a.is_mobile
                                FROM ojl_client_engagement as a 
                                LEFT JOIN ojl_agenda as b on a.agenda_id = b.agenda_id
                                WHERE b.user_id = '".$empid."'".$add_where);

        $result = $sql->result();
        
        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            echo json_encode(array('result'=> $result)); 
        }
    }

    public function get_product_communication() {
        $agenda_id = $_POST['agenda_id'];

        $empid = $_POST['empid'];
        $token = $_POST['token'];

        if($agenda_id == null) {
            $add_where = "";
        } else {
            $add_where = " AND a.agenda_id = '".$agenda_id."'";
        }

        $sql = $this->db->query("SELECT 
                                a.record_id,
                                a.agenda_id,
                                a.name_of_md,
                                a.biomedis_product,
                                a.rating_per_md,
                                a.remarks,
                                a.empid,
                                a.itenerary_id,
                                a.is_mobile,
                                a.day
                                FROM ojl_product_communication as a 
                                LEFT JOIN ojl_agenda as b on a.agenda_id = b.agenda_id
                                WHERE b.user_id = '".$empid."'".$add_where);

        $result = $sql->result();
        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            echo json_encode(array('result'=> $result));  
        }
    }

    public function get_survey() {
        $agenda_id = $_POST['agenda_id'];
        $empid = $_POST['empid'];
        $token = $_POST['token'];

        if($agenda_id == null) {
            $add_where = "";
        } else {
            $add_where = " AND a.agenda_id = '".$agenda_id."'";
        }

        $sql = $this->db->query("SELECT
                                a.survey_id,
                                a.agenda_id,
                                a.day,
                                a.address,
                                a.outlet,
                                a.remarks,
                                a.empid
                                FROM ojl_survey as a 
                                WHERE a.empid = '".$empid."'".$add_where);

        $result = $sql->result();
        

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            echo json_encode(array('result'=> $result)); 
        }
    }

    public function get_competitors_activity_report() {
        $agenda_id = $_POST['agenda_id'];
        $empid = $_POST['empid'];
        $token = $_POST['token'];

        if($agenda_id == null) {
            $add_where = "";
        } else {
            $add_where = " AND a.agenda_id = '".$agenda_id."'";
        }


        $sql = $this->db->query("SELECT 
                                a.record_id,
                                a.agenda_id,
                                a.company,
                                a.details,
                                a.plan_of_action,
                                a.empid
                                FROM ojl_competitors_activity as a 
                                WHERE a.empid = '".$empid."'".$add_where);

        $result = $sql->result();

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            echo json_encode(array('result'=> $result)); 
        }
        
    }

     public function get_salesplan_report() {
        $agenda_id = $_POST['agenda_id'];
        $token = $_POST['token'];
        $sql = $this->db->query("SELECT a.psr_id, a.grossup_ytd_ds, a.grossup_ytd_is, a.grossup_ytd_st, a.quota_ytd, a.quota_fy, a.quota_togo FROM ojl_SalesPlan as a");
        $res = $sql->result();
        $count = $sql->num_rows();

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        
        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            echo json_encode(array('result'=> $res)); 
        }
    }

    public function post_client_engagement() {
        $token = $_POST['token'];
        $cmdEvent = $_POST['cmdEvent'];
        $agenda_id = $_POST['agenda_id'];
        $empid = $_POST['empid'];
        $clinic_address = $_POST['clinic_address'];
        $day = $_POST['day'];
        $name_of_md = $_POST['name_of_md'];
        $remarks = $_POST['remarks'];

        $itinerary_id = $_POST['itinerary_id'];
        $is_mobile = $_POST['is_mobile'];


        $data = array(
            'agenda_id' => $agenda_id,
            'empid' => $empid,
            'clinic_address' => $clinic_address,
            'day' => $day,
            'name_of_md' => $name_of_md,
            'remarks' => $remarks,
            'itenerary_id' => $itinerary_id,
            'is_mobile' => $is_mobile
            );


        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();





        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            if($is_mobile == 0 && $itinerary_id == '') {
                echo json_encode(array("message" => "You cannot insert a data without itinerary id while the field is_mobile has the value of 0",'result'=>'false', 'ojl_status' => 1));
            } else {

                $check_status = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
                $ojlStatus = $check_status->result();

                    if($ojlStatus[0]->status ==2 || $ojlStatus[0]->status ==3 || $ojlStatus[0]->status ==4){
                        echo json_encode(array('message'=>'The data can no longer be submitted as the OJL is for completion already.', 'result'=>'false', 'ojl_status' => 1));
                    }
                    else{
                        if($_POST['record_id']!=''){
                            $this->db->where('record_id', $_POST['record_id']);
                            $this->db->update('ojl_client_engagement', $data); 
                            $last_inserted_id = $_POST['record_id'];
                        }
                        else{
                            $this->db->insert('ojl_client_engagement', $data);
                            $last_inserted_id = $this->db->insert_id();
                        }
                    }

                    $data1 = $this->check_iffor_completion($agenda_id);
                    if($data1==1){
                        $data_array = array(
                            'agenda_id' => $agenda_id,
                            'status' => 5);
                        $this->db->where('agenda_id', $agenda_id);
                        $this->db->update('ojl_agenda', $data_array); 
                        $ojl_status = 1;
                    }
                    else{
                        $ojl_status = 0;
                    }

                    echo json_encode(array('message'=>'Success', 'result'=>'true', 'record_id' => $last_inserted_id, 'ojl_status' => $ojl_status));
                       

            }

            
        }

        
    }


    public function check_iffor_completion($agenda_id){
        $agenda_details = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
        $result101 = $agenda_details->result();
        if($result101[0]->date_from != $result101[0]->date_to){
            $x = 2;
        }
        else{
            $x = 1;
        }
        $agenda_details2 = $this->db->query("SELECT * FROM ojl_client_engagement where agenda_id = '".$agenda_id."' GROUP BY day order by day asc"); 
        $result102 = $agenda_details2->result();

        if(count($result102)>=$x){
            $pce = $this->db->query("SELECT * FROM ojl_product_communication where agenda_id = '".$agenda_id."'"); 
            $pce2 = $pce->result();
            if(count($pce2)>0){
                return 1;
            }
            else{
                return 0;
            }
            
        }
        else{
            return 0;
        }
    }

    public function post_product_communication_exercise() {
        $token = $_POST['token'];
        $cmdEvent = $_POST['cmdEvent'];
        $agenda_id = $_POST['agenda_id'];
        $biomedis_product = $_POST['biomedis_product'];
        $rating_per_md = $_POST['rating_per_md'];
        $remarks = $_POST['remarks'];
        $name_of_md = $_POST['name_of_md'];
        $empid = $_POST['empid'];

        $day = $_POST['day'];
        $itenerary_id = $_POST['itinerary_id'];
        $is_mobile = $_POST['is_mobile'];


         $data = array(
            'agenda_id' => $agenda_id,
            'biomedis_product' => $biomedis_product,
            'rating_per_md' => $rating_per_md,
            'remarks' => $remarks,
            'name_of_md' => $name_of_md,
            'empid' => $empid,
            'day' => $day,
            'itenerary_id' => $itenerary_id,
            'is_mobile' => $is_mobile
            );

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
             if($is_mobile == 0 && $itenerary_id == '') {
                echo json_encode(array("message" => "You cannot insert a data without itinerary id while the field is_mobile has the value of 0",'result'=>'false', 'ojl_status' => 1));
            } else {

                $check_status = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
                $ojlStatus = $check_status->result();

                    if($ojlStatus[0]->status ==2 || $ojlStatus[0]->status ==3 || $ojlStatus[0]->status ==4){
                        echo json_encode(array('message'=>'The data can no longer be submitted as the OJL is for completion already.', 'result'=>'false', 'ojl_status' => 1));
                    }
                    else{
                        if($_POST['record_id']!=''){
                            $this->db->where('record_id', $_POST['record_id']);
                            $this->db->update('ojl_product_communication', $data); 
                            $last_inserted_id = $_POST['record_id'];
                        }
                        else{
                            $this->db->insert('ojl_product_communication', $data);
                            $last_inserted_id = $this->db->insert_id();
                        }
                    }

                    $data1 = $this->check_iffor_completion($agenda_id);
                    if($data1==1){
                        $data_array = array(
                            'agenda_id' => $agenda_id,
                            'status' => 5);
                        $this->db->where('agenda_id', $agenda_id);
                        $this->db->update('ojl_agenda', $data_array);
                        $ojl_status = 1; 
                    }
                    else{
                        $ojl_status = 0;
                    }
                    echo json_encode(array('message'=>'Success', 'result'=>'true', 'record_id' => $last_inserted_id, 'ojl_status' => $ojl_status));
                    
            }

            

            
        }
    }

    public function post_survey() {
        $token = $_POST['token'];
        $cmdEvent = $_POST['cmdEvent'];
        $agenda_id = $_POST['agenda_id'];
        $day = $_POST['day'];
        $address = $_POST['address'];
        $outlet = $_POST['outlet'];
        $remarks = $_POST['remarks'];
        $empid = $_POST['empid'];

        $data = array(
            'agenda_id' => $agenda_id,
            'day' => $day,
            'address' => $address,
            'outlet' => $outlet,
            'remarks' => $remarks,
            'empid' => $empid
            );

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            $check_status = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
            $ojlStatus = $check_status->result();

            //if($ojlStatus[0]->status !=1){
            if($ojlStatus[0]->status ==2 || $ojlStatus[0]->status ==3 || $ojlStatus[0]->status ==4){
                echo json_encode(array('message'=>'The data can no longer be submitted as the OJL is for completion already.', 'result'=>'false', 'ojl_status' => 1));
            }
            else{
                if($_POST['record_id']!=''){

                    $this->db->where('survey_id', $_POST['record_id']);
                    $this->db->update('ojl_survey', $data); 
                    $last_inserted_id = $_POST['record_id'];
                }
                else{
                    $this->db->insert('ojl_survey', $data);
                    $last_inserted_id = $this->db->insert_id();
                }
                echo json_encode(array('message'=>'Success', 'result'=>'true', 'record_id' => $last_inserted_id));
            }
        }
    }

    public function post_competitors_activity_report() {
        $token = $_POST['token'];
        $cmdEvent = $_POST['cmdEvent'];
        $agenda_id = $_POST['agenda_id'];
        $company = $_POST['company'];
        $details = $_POST['details'];
        $plan_of_action = $_POST['plan_of_action'];
        $empid = $_POST['empid'];  

        $data = array(
            'agenda_id' => $agenda_id,
            'company' => $company,
            'details' => $details,
            'plan_of_action' => $plan_of_action,
            'empid' => $empid
            );

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo json_encode(array('result'=> 'Error')); 
        } else {
            //$check_status = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
            //$ojlStatus = $check_status->result();

           // if($ojlStatus[0]->status !=1){
            if($ojlStatus[0]->status ==2 || $ojlStatus[0]->status ==3 || $ojlStatus[0]->status ==4){
                echo json_encode(array('message'=>'The data can no longer be submitted as the OJL is for completion already.', 'result'=>'false', 'ojl_status' => 1));
            }
            else{
                if($_POST['record_id']!=''){
                    $this->db->where('record_id', $_POST['record_id']);
                    $this->db->update('ojl_competitors_activity', $data); 
                    $last_inserted_id = $_POST['record_id'];
                }
                else{
                    $this->db->insert('ojl_competitors_activity', $data);
                    $last_inserted_id = $this->db->insert_id();
                }
                echo json_encode(array('message'=>'Success', 'result'=>'true', 'record_id' => $last_inserted_id));
            }
        }
    }
}

