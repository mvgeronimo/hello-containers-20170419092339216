<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
	public function __construct() {

        parent::__construct();
        header('Content-Type: application/json');

        if(!$this->_validateRequestContentType()): //Accept form-urlencoded request headers only
          echo json_encode(array("status" => "failed", "msg" => "Invalid request header content type! Please make sure your request header is x-www-form-urlencoded."));
          exit();
        endif;
        
    }

    private function _validateRequestContentType()
      {
        return ($_SERVER['CONTENT_TYPE'] == 'application/x-www-form-urlencoded') ? TRUE : FALSE;
      }

    public function index() {
    	echo 'a';

    }

    public function dm_psr_config() {
        $empid = $_POST['empid'];
        $token = $_POST['token'];
        

        $sql = $this->db->query("SELECT * FROM ojl_user as a where empid IN (SELECT psr FROM ojl_dm_psr WHERE dm = '".$empid."')");
        $result = $sql->result();
        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo 'Error!';
        } else {
            echo json_encode($result); 
        }


    }

    public function getAgenda() {    // 1 
      // $q = $this->checkStatus($_REQUEST['status']);
    	$empid = $_REQUEST['empid'];
        $token = $_POST['token'];
        // $sql = $this->db->query("SELECT * FROM refpromo ".$q." order by updated_time");
        $sql = $this->db->query("SELECT * FROM ojl_agenda as a LEFT JOIN ojl_user as b on a.user_id = b.user_id WHERE b.empid = '".$empid."'");
        $res = $sql->result();
        $count = $sql->num_rows();

       $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo 'Error!';
        } else {
            echo json_encode($res); 
        }

    }

    public function get_itenerary() {
        $agenda_id = $_POST['agenda_id'];
        $token = $_POST['token'];
        $sql = $this->db->query("SELECT * FROM ojl_itenerary as a WHERE a.agenda_id = '".$agenda_id."'");
        $res = $sql->result();
        $count = $sql->num_rows();

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        
        if($valid == 0) {
            echo 'Error!';
        } else {
            echo json_encode($res); 
        }
    }

    public function get_cp_monitoring() {
        $agenda_id = $_REQUEST['agenda_id'];
        $token = $_REQUEST['token'];
        $data = array();
        $sql = $this->db->query("SELECT * FROM ojl_coverage_performance as a WHERE a.agenda_id = '".$agenda_id."'");

        $res1 = $sql->result();

        
        $cp_id = $res1[0]->coverage_id;
        $sql2 = $this->db->query("SELECT * FROM ojl_coverage_cycle as a WHERE a.coverage_id = '".$cp_id."'");
        $res2 = $sql2->result();

        $x['coverage'] = $res1;
        $x['cycle'] = $res2;

         array_push($data, $x);
        // echo '<pre>';
        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo 'Error!';
        } else {
            echo json_encode($data); 
        }
    }

    public function get_client_engagement() {
         $agenda_id = $_POST['agenda_id'];
         $token = $_POST['token'];

         $sql = $this->db->query("SELECT * FROM ojl_client_engagement as a WHERE a.agenda_id = '".$agenda_id."'");

        $result = $sql->result();
        
        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo 'Error!';
        } else {
            echo json_encode($result); 
        }
    }

    public function get_product_communication() {
        $agenda_id = $_REQUEST['agenda_id'];
        $token = $_REQUEST['token'];

        $sql = $this->db->query("SELECT * FROM ojl_product_communication as a WHERE a.agenda_id = '".$agenda_id."'");

        $result = $sql->result();
        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo 'Error!';
        } else {
            echo json_encode($result); 
        }
    }

    public function get_survey() {
        $agenda_id = $_POST['agenda_id'];
        $token = $_REQUEST['token'];

        $sql = $this->db->query("SELECT * FROM ojl_survey as a WHERE a.agenda_id = '".$agenda_id."'");

        $result = $sql->result();
        

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo 'Error!';
        } else {
            echo json_encode($result); 
        }
    }

    public function get_competitors_activity_report() {
        $agenda_id = $_REQUEST['agenda_id'];
        $token = $_REQUEST['token'];

        $sql = $this->db->query("SELECT * FROM ojl_competitors_activity as a WHERE a.agenda_id = '".$agenda_id."'");

        $result = $sql->result();

        $token = $this->db->query("SELECT * FROM ojl_token where token = '".$token."'");
        $valid = $token->num_rows();

        if($valid == 0) {
            echo 'Error!';
        } else {
            echo json_encode($result); 
        }
        
    }
}

