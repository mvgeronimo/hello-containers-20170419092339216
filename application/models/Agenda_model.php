<?php

class Agenda_model extends CI_Model{

	function __construct() {
        parent::__construct();
    }

    function get_psr($agenda_id) {
        $query = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
        $result = $query->result();

        $this->session->set_userdata("psr_id", $result[0]->psr_id);
    }

    function getAgenda($agenda_id){
    	$query = $this->db->query("SELECT b.psr_name, c.territory_name, a.* FROM ojl_agenda as a
    							LEFT JOIN ojl_psr as b ON a.psr_id = b.psr_id
    							LEFT JOIN ojl_territory as c ON a.territory_id = c.territory_id
    							where agenda_id = '".$agenda_id."'");
    	$result = $query->result();
    	return $result;
    }

    function getActionPlan($agenda_id) {
    	$query = $this->db->query("SELECT b.agenda_name, a.* FROM ojl_ActionPlan as a
    							 LEFT JOIN ojl_agenda_name as b ON a.agenda_name_id = b.agenda_name_id
    							 WHERE a.agenda_id = '".$agenda_id."'");
    	$result = $query->result();
    	return $result;
    }

    function getItenerary($agenda_id) {
    	$query = $this->db->query("SELECT * FROM ojl_agenda as a
                                LEFT JOIN ojl_itenerary as b on a.agenda_id = b.agenda_id
    							 WHERE a.agenda_id = '".$agenda_id."'");
    	$result = $query->result();
    	return $result;
    }

    function UpdateAgenda($data, $id, $table) {
        $this->db->where('agenda_id', $id);
        $this->db->update($table, $data); 
    }

    function delete_action_plan($agenda_id, $table) {
        $this->db->query("DELETE FROM ".$table." where agenda_id = '".$agenda_id."'");

    }

    function insertBusiness($data, $table){
        

        $this->db->insert($table, $data); 
        
    }

    function get_summary() {
        $year = date('Y');

        $user_id = $this->session->userdata('emp_id');
        $query = $this->db->query("SELECT a.psr, a.* FROM ojl_agenda as a
                                where user_id = '".$user_id."' AND (LEFT(a.date_from, 4) = '".$year."' || LEFT(a.date_to, 4) = '".$year." ') AND a.status != 0");
        $result = $query->result();
        return $result;
    }

    function Agenda_for_psr() {

        $psr_id = $this->session->userdata('empid');
        $query = $this->db->query("SELECT agenda_id from ojl_agenda where psr_id = '".$psr_id."' ORDER BY agenda_id DESC limit 1");
        $result = $query->result();
        return $result;
    }

    function get_evaluation($agenda_id, $table) {
        $query = $this->db->query("SELECT * FROM ".$table." where agenda_id = '".$agenda_id."'");
        $result = $query->result();
        return $result;
    }

    function psrConforme($agenda_id, $psr_remarks) {
        $date_now = date("Y-m-d");
        $this->db->query('UPDATE ojl_evaluation set psr_action_plan = "'.$psr_remarks.'", psr_date_from = "'.$date_now.'" where agenda_id = "'.$agenda_id.'"');
    }

     function omConforme($agenda_id, $om_remarks) {
        $date_now = date("Y-m-d");
        $this->db->query('UPDATE ojl_evaluation set om_remarks = "'.$om_remarks.'", psr_date_to = "'.$date_now.'" where agenda_id = "'.$agenda_id.'"');
    }

    function agenda_for_om() {
        $om_id = $this->session->userdata('emp_id');

        $query = $this->db->query("SELECT agenda_id FROM ojl_agenda where user_id IN (SELECT dm from ojl_dm_om where om = '".$om_id."') ORDER BY agenda_id DESC LIMIT 1");
        $result = $query->result();

        $agenda_id = $result[0]->agenda_id;

        $query2 = $this->db->query("SELECT * from ojl_evaluation where agenda_id = '".$agenda_id."'");
        $result2 = $query2->result();
        return $result2;
    }

    function finishOjl($agenda_id) {
        $this->db->query("UPDATE ojl_agenda set progress = 'Completed' where agenda_id = '".$agenda_id."'");

    }

    function check_agenda_stat($agenda_id) {
        $query = $this->db->query("SELECT status FROM ojl_agenda where agenda_id = '".$agenda_id."'");
        $result = $query->result();
        return $result;
    }

    function delete_itenerary($table, $id) {
        $this->db->query("DELETE FROM ".$table." where itenerary_id = ".$id);
    }

}
