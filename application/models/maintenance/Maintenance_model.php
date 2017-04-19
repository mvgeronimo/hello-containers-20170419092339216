<?php

class Maintenance_model extends CI_Model{

function __construct() {
       parent::__construct();
}

/* Start of user maintenance */
function get_user(){

    	$this->db->select ( '*' );
	    $this->db->from ( 'ojl_user_maintenance' );
	    $query = $this->db->get();
	    $res = $query->result();
	    echo json_encode($res);

}

function load_data($condition,$filter) {

        foreach($filter as $search => $value) {
            if($search == 'role') { $role = $value; }
            if($search == 'status'){ $status = $value; }
            if($search == 'sort'){ $sort = $value; }
            if($search == 'keyword'){ $keyword = $value; }
            if($search == 'filter_by'){ $filter_by = $value; }
            if($search == 'sorted_by'){ $sorted_by = $value; }
            if($search == 'jobname'){ $jobname = $value; }
            if($search == 'territory'){ $territory = $value; }
        }

        if($sorted_by == '' || $sorted_by == null || $sorted_by == undefined){ $sorted_by = "user_id"; }
        if($sort == '' || $sort == null || $sort == undefined){ $sort = "DESC"; }       

		$limit = $_POST['limit'];
        $start = ($_POST['page']-1) * $limit;
        $table = $_POST['table'];

        if($condition=='count'){ 
            $this->db->select( 'count(*) as count'); 
        } else {
            $this->db->select ( 'a.* ,a.is_active as status, r.* , r.role_name AS roles, t.* , t.territory_name AS territories,j.* ,j.job_name AS jobs' );
        }

        if($condition!='count'){ $this->db->limit($limit,$start); }

        $this->db->from('ojl_user_maintenance as a');

            if($filter_by == 'jobname'){
                $this->db->order_by('j.job_name',$sort);
            } else if($filter_by == 'territory'){
                $this->db->order_by('t.territory_name',$sort);
            } else if($filter_by == 'role'){
                $this->db->or_like("r.role_name", $keyword, 'both');
            } else {
                $this->db->order_by($sorted_by,$sort);
            }

        $this->db->join ( 'ojl_role r', 'a.role = r.role_id');
        $this->db->join ( 'ojl_job_names j ', 'a.jobname = j.job_id');
        $this->db->join ( 'ojl_territory t ', 'a.territory = t.territory_id');

        if($jobname != ''){ $this->db->where('a.jobname', $jobname); }   
        if($territory != ''){ $this->db->where('a.territory', $territory); }  
        if($status != ''){ $this->db->where('a.is_active', $status); }  
        if($role != ''){ $this->db->where('a.role', $role); } 
        if($keyword != '' && $filter_by != ''){ 

            if($filter_by == 'jobname'){
                $this->db->or_like("j.job_name", $keyword, 'both');
            }
            else if($filter_by == 'territory'){
                $this->db->or_like("t.territory_name", $keyword, 'both');
            }
            else if($filter_by == 'role'){
                $this->db->or_like("r.role_name", $keyword, 'both');
            } else {
                $this->db->like($filter_by, $keyword, 'both' ); 
            }
        }

        if($keyword != '' && $filter_by == ''){ 
            $this->db->group_start();
            $this->db->like("j.job_name", $keyword, 'both');
            $this->db->or_like("t.territory_name", $keyword, 'both');
            $this->db->or_like("r.role_name", $keyword, 'both');
            $this->db->or_like("a.username", $keyword, 'both' );
            $this->db->or_like("a.empid", $keyword, 'both');
            $this->db->or_like("a.firstname", $keyword, 'both');
            $this->db->or_like("a.middlename", $keyword, 'both');
            $this->db->or_like("a.lastname", $keyword, 'both');
            $this->db->or_like("a.email", $keyword, 'both');
            $this->db->group_end();
        }

        $query = $this->db->get();
        //var_dump(  $this->db->last_query() );
        $res = $query->result();
        return $res;
}

function get_data($table,$where = null,$orderby = null){

    	$this->db->select('*');
		$this->db->from($table);
		if($where != null){ $this->db->where($where, NULL, FALSE); }
		if($orderby != null){ $this->db->order_by($orderby); }
		$query = $this->db->get();
		return $query->result();

}

function get_user_details($user_id) {

        $query = $this->db->query("SELECT * FROM ojl_user_maintenance where user_id = '".$user_id."'");
        $result = $query->result();
        return $result;

}

function db_insert($data, $table){
        
        $this->db->insert($table, $data); 
        if ($this->db->affected_rows() > 0) { 
            return 1;
        } else {
            return 0;
        }
                
}

function db_update($data, $table, $userid, $field){

        $this->db->where($field, $userid);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
                
}

function if_exist($check){

    $query = $this->db->query("SELECT * FROM ojl_user_maintenance where empid = '".$check."'");
    return $query->num_rows();

}

function if_exist_emp($empID){

    $query = $this->db->query("SELECT * FROM ojl_user_maintenance where empid = '".$empID."'");
    return $query->num_rows();

}

/* End of user maintenance */

/* Start of Job */

function load_job($condition,$filter,$table) {

        foreach($filter as $search => $value) {
            if($search == 'status'){ $status = $value; }
            if($search == 'sort'){ $sort = $value; }
            if($search == 'keyword'){ $keyword = $value; }
            if($search == 'filter_by'){ $filter_by = $value; }
            if($search == 'sorted_by'){ $sorted_by = $value; }
            if($search == 'jobname'){ $jobname = $value; }
   
        }

        if($sorted_by == '' || $sorted_by == null || $sorted_by == undefined){ $sorted_by = "user_id"; }
        if($sort == '' || $sort == null || $sort == undefined){ $sort = "DESC"; }       

        $limit = $_POST['limit'];
        $start = ($_POST['page']-1) * $limit;
        $table = $_POST['table'];

        if($condition=='count'){ 
            $this->db->select( 'count(*) as count'); 
        } else {
            $this->db->select ( '*' );
        }

        if($condition!='count'){ $this->db->limit($limit,$start); }

        $this->db->from($table);

        if($status != ''){ $this->db->where('a.is_active', $status); }  
    
        if($keyword != '' && $filter_by == ''){ 
            $this->db->group_start();
            $this->db->like("job_name", $keyword, 'both');
            $this->db->group_end();
        }

        $query = $this->db->get();
        //var_dump(  $this->db->last_query() );
        $res = $query->result();
        return $res;
}


/*  End of Job */

/* Start of Agenda */
    function get_agenda_maintenance(){

        $this->db->select ( '*' );
        $this->db->from ( 'ojl_agenda_maintenance as a' );
        $this->db->join('ojl_category_maintenance as b', 'a.cat_maintenance_id = b.cat_maintenance_id', 'left' );
        $query = $this->db->get();
        return $query->result();

    }

    function get_cat_maintenance(){

        $this->db->select ( '*' );
        $this->db->from ( 'ojl_category_maintenance' );
        $query = $this->db->get();
        return $query->result();
    }



    function load_agenda($condition, $agend_filter) {

        foreach ($agend_filter as $agend_search => $value) {
            if($agend_search == 'cat_filter' ){ $cat_filter = $value; }
            if($agend_search == 'status_filter' ){ $status_filter = $value; }
            if($agend_search == 'sort' ){ $sort = $value; }
            if($agend_search == 'sorted_all' ){ $sorted_all = $value; }
        }

        if($sorted_all == '' || $sorted_all == null || $sorted_all == undefined){ $sorted_all = "agenda_maintenance_id"; }
        if($sort == '' || $sort == null || $sort == undefined){ $sort = "DESC"; }  
        $limit = $_POST['limit'];
        $start = ($_POST['page']-1) * $limit;
        $table = $_POST['table'];
        if($condition=='count'){
            $this->db->select( 'count(*) as count');
        }
        else{
            $this->db->select('*');
        }

        if($condition!='count'){
            $this->db->limit($limit,$start);
        }


        $this->db->from('ojl_agenda_maintenance as a');
        $this->db->join('ojl_category_maintenance as b', 'a.cat_maintenance_id = b.cat_maintenance_id', 'left' );
        if($cat_filter != ''){ $this->db->where('a.cat_maintenance_id', $cat_filter); }
        if($status_filter != ''){ $this->db->where('a.is_active', $status_filter); }
        $this->db->order_by($sorted_all,$sort);
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }


    function get_agenda_details($agenda_id) {

        $query = $this->db->query("SELECT * FROM ojl_agenda_maintenance as a join ojl_category_maintenance as b on a.cat_maintenance_id = b.cat_maintenance_id where agenda_maintenance_id = '".$agenda_id."'");
        $result = $query->result();
        return $result;

    }

/* End of Agenda */



}

?>