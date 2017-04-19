<?php



class Agenda_model extends CI_Model{



	function __construct() {

        parent::__construct();

    }



    function get_agenda_maintenance(){

    	$this->db->select ( '*' );

	    $this->db->from ( 'ojl_agenda_maintenance as a' );

	    $this->db->join('ojl_category_maintenance as b', 'a.cat_maintenance_id = b.cat_maintenance_id', 'left' );

	    $query = $this->db->get();

	    // $res = $query->result();

	    // echo json_encode($res);

	    return $query->result();

    }

    function get_cat_maintenance(){

    	$this->db->select ( '*' );

        $this->db->from ( 'ojl_category_maintenance' );

        $query = $this->db->get();

        return $query->result();
    }

    function db_insert($data, $table){

        $this->db->insert($table, $data); 

        if ($this->db->affected_rows() > 0) {

          return 1;

        } else {

          return 0;

        }

    }

    function load_data($condition, $agend_filter) {

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

        // $this->db->select ('*');

        // $this->db->from ('ojl_agenda_maintenance as a');

        // $this->db->join('ojl_category_maintenance as b', 'a.cat_maintenance_id = b.cat_maintenance_id', 'left' );

        // $this->db->where('a.agenda_maintenance_id', $agenda_id);

        $result = $query->result();

        return $result;

    }

    function db_update($data, $table, $agend_id){



        $this->db->where('agenda_maintenance_id', $agend_id);

        $this->db->update($table, $data);



        if ($this->db->affected_rows() > 0) {

          return 1;

        } else {

          return 0;

        }

                

    }


}



?>