<?php



class Ojl_completion_model extends CI_Model{


	function __construct() {
        parent::__construct();
    }

    function getClientEngageMent($tableName){
        $agenda_id = $this->session->userdata('agenda_id');

        if($tableName == 'ojl_client_engagement') {

            // $day = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
            // $days = $day->result();

            // if($days[0]->date_from != $days[0]->date_to) {

            // } else {
            //     for($x = 1; $x <=2; $x++) {

            //     }
            // }


            $arr = array();

            $data = $this->db->query("SELECT a.agenda_id, a.day, a.doctor, a.doctor_address, b.remarks, b.is_mobile FROM ojl_itenerary as a
                                    left join ojl_client_engagement as b on a.itenerary_id = b.itenerary_id
                                    where a.agenda_id = '".$agenda_id."'
                                    ");

            $data_ = $data->result_array();

            $data2 = $this->db->query("SELECT agenda_id, day, name_of_md as doctor, clinic_address as doctor_address, remarks, is_mobile
                                    FROM ojl_client_engagement where agenda_id = '".$agenda_id."' and is_mobile = 1
                                    ");

            $data2_ = $data2->result_array();

         
            $data123 = array_merge($data_, $data2_);
           
            return $data123;


        } else if($tableName == 'ojl_product_communication') {

            $data = $this->db->query("SELECT a.agenda_id, a.day, a.doctor, b.rating_per_md, b.biomedis_product, b.remarks, b.is_mobile FROM ojl_itenerary as a
                                    left join ojl_product_communication as b on a.itenerary_id = b.itenerary_id
                                    where a.agenda_id = '".$agenda_id."'
                                    ");

            $data_ = $data->result_array();

            $data2 = $this->db->query("SELECT agenda_id, day, name_of_md as doctor, rating_per_md, biomedis_product, remarks, is_mobile
                                    FROM ojl_product_communication where agenda_id = '".$agenda_id."' and is_mobile = 1
                                    ");
            $data2_ = $data2->result_array();

            $data123 = array_merge($data_, $data2_);

            return $data123;

        } else {
            $this->db->where('agenda_id', $agenda_id);
            $data = $this->db->get($tableName);
            return $data->result_array();
        }
        
    	
    }

    function ojl_competency() {
        $agenda_id = $this->session->userdata('agenda_id');
        $user_id = $this->session->userdata('emp_id');
        
        $query = $this->db->query("SELECT * FROM ojl_employee_competency where agenda_id = '".$agenda_id."' AND user_id = '".$user_id."'");
        return $query->result();
    }

    function insert_ojl_completion($tableName,$data){
    	$this->db->insert($tableName,$data);
    }	

    function removeData($table,$id,$where){
      $this->db->where($where, $id);
      $this->db->delete($table);

    }

    function getData($where, $id,$table){
        if($table == 'ojl_ulearn') {
           $query = $this->db->query("SELECT *, DATE_FORMAT(completion_date, '%m/%d/%Y') as comp_date FROM ojl_ulearn where competency_id = '".$id."'");
            $result = $query->result();
            return $result;
        } else {
            $this->db->where($where, $id);
            $data = $this->db->get($table);
            return $data->result();
        }

        
    }

    function getIDP($competency_id){
        $query = $this->db->query("SELECT * FROM ojl_idp where competency_id = '".$competency_id."'");
        $result = $query->result();
        return $result;
    }


    function getMP($user_id) {
        $agenda_id = $this->session->userdata('agenda_id');
        $query = $this->db->query("SELECT * FROM ojl_marketing_programs WHERE agenda_id = '".$agenda_id."'");
        $result = $query->result();
        return $result;


    }

    function getMP2($agenda_id) {
       
        $query = $this->db->query("SELECT * FROM ojl_marketing_programs WHERE agenda_id = '".$agenda_id."'");
        $result = $query->result();
        return $result;


    }

    function getPlan($type) {
        $user_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM ojl_plan where user_id = '".$user_id."' AND plan_type = '".$type."'");
        $result = $query->result();
        return $result;
    }

    function update_mp_status($type, $mp_id) {
        // $user_id = $this->session->userdata('user_id');
        
        $query = $this->db->query("UPDATE ojl_marketing_programs SET status = '".$type."' WHERE record_id = '".$mp_id."'");
        
    }

    function get_idp($id) {
        $query = $this->db->query("SELECT * FROM ojl_idp where competency_id = '".$id."'");
        $result = $query->result();
        return $result;
    }

    function get_planned($table, $mp_id) {
         $query = $this->db->query("SELECT * FROM ".$table." where mp_id = '".$mp_id."'");
        $result = $query->result();
        return $result;
    }

    function deletePlan($mp_id) {
        $query = $this->db->query("DELETE FROM ojl_plan where mp_id = '".$mp_id."'");
        if($query) {
            return true;
        } else {
            return false;
        }


    }

    function deleteCompetency($mp_id) {
        $this->db->query("DELETE FROM ojl_competency_functional_expertise where mp_id = '".$mp_id."'");
        $this->db->query("DELETE FROM ojl_competency_thinks_customer where mp_id = '".$mp_id."'");

    }

    function what_step($agenda_id) {
        $query = $this->db->query("SELECT * from ojl_agenda where agenda_id = '".$agenda_id."'");
        $result = $query->result();
        return $result;
    }

    function updateMP($comf_id, $date_promotion, $areas, $training_intervention) {
        $this->db->query("UPDATE ojl_employee_competency SET last_promotion_date = '".$date_promotion."', areas_of_improvement = '".$areas."', training_intervention = '".$training_intervention."' WHERE competency_id = '".$comf_id."'");
    }

    function check_isApi() {
        $agenda_id = $this->session->userdata('agenda_id');
        $query = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."' AND status in ('2', '3', '4' , '5')");
        return $query->num_rows();
    }

}