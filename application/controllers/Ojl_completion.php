<?php
if  ( ! defined('BASEPATH'))exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ojl_completion extends CI_Controller{
    //put your code here
     function __construct()
      {
        parent::__construct();
        $this->load->model('Ojl_completion_model','completion');
        $this->load->model('Login_model');
        $this->Login_model->checkAccess();
      }


      function index(){
       
            if(isset($_GET['id'])){
                $agenda_id = $_GET['id'];
                
                $query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
                $res1 = $query1->result();
                $this->session->set_userdata('agenda_id', $agenda_id);
                $this->session->set_userdata('agenda_psr', $res1[0]->psr_id);
                $this->session->set_userdata('step', $res1[0]->step);
                //$agenda_id = $_GET['id'];
            }
             $data['content']="completion/home";
             $this->load->view('template/layout', $data);
      }

      function change_session() {
        if(isset($_GET['id'])) {

            $agenda_id = $_GET['id'];
            $query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
                $res1 = $query1->result();
                $this->session->set_userdata('agenda_psr', $res1[0]->psr_id);
                $this->session->set_userdata('step', $res1[0]->step);
            $this->session->set_userdata('agenda_id', $agenda_id);
          }
      }

       function client_engagement(){
          $this->change_session();
             $data['content']="completion/client_engagement";
            $this->load->view('template/layout', $data);
      }

       function product_communication(){
        $this->change_session();
             $data['content']="completion/product_communication";
            $this->load->view('template/layout', $data);
      }


      function survey_drugstore_pharmacies(){
        $this->change_session();
        $data['content']="completion/survey_drugstore_pharmacies";
        $this->load->view('template/layout', $data);
      }

      function competitors_activity_report(){
        $this->change_session();
        $data['content']="completion/competitors_activity_report";
        $this->load->view('template/layout', $data);
      }

      function employee_compentency_development(){
        $this->change_session();
        if(isset($_GET['id'])){
          $agenda_id = $_GET['id'];
          $query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
          $res1 = $query1->result();
          $data['agenda_status'] = $res1[0]->status;
        }
        $data['content']="completion/employee_compentency_development";
        $this->load->view('template/layout', $data);
      }

      function activity_and_starts_monitoring_sheet(){
        $this->change_session();
        $data['content']="completion/activity_and_starts_monitoring_sheet";
        $this->load->view('template/layout', $data);
      }


      function deletePreviousData(){
             $comp_id = $this->input->post('comp_id');
             $table = $this->input->post('table');

             $query = $this->completion->removeData($table, $comp_id, 'competency_id');
      }

      function tempData(){
             $myArray = $_REQUEST['idpFirstData'];
             $myArrayDev = $_REQUEST['idpSecondData'];
             $comp_id = $this->input->post('comp_id');
             $item=array();
           
             $arrlength = count($myArray);
             for($i=0; $i<$arrlength; $i++ )
             {
               $data = array(
                'competency_id' => $comp_id,
                'skills_to_developed'=>$myArray[$i],
                'development_activity' => $myArrayDev[$i],
                'is_active' => 1
                );

               if($myArray[$i] != '' && $myArrayDev[$i] != '') {
                  $query = $this->completion->insert_ojl_completion("ojl_idp", $data);
               }
                
             }
      }


        function tempData2(){
             $myArrayDev1 = $_REQUEST['ulearFirstData'];
             $myArrayDev2 = $_REQUEST['ulearnSecondData'];
             $myArrayDev3 = $_REQUEST['ulearnThirdData'];
             $item=array();
              $comp_id = $this->input->post('comp_id');
             // foreach ($myArray as $key) {
             //  $item += $key;

             // }
             $arrlength = count($myArrayDev1);
             for($i=0; $i<$arrlength; $i++ )
             {
              $date = date_create($myArrayDev2[$i]);
              $dates = date_format($date, 'Y-m-d');
               $data = array(
                
               
                'course_title'=>$myArrayDev1[$i],
                'completion_date' => $dates,
                'learning_application' => $myArrayDev3[$i],
                'competency_id' => $comp_id
                );
               
               print_r($data);

               if($myArrayDev1[$i] != '' && $myArrayDev3[$i] != '') {
                  $query = $this->completion->insert_ojl_completion("ojl_ulearn", $data);
               }
                
           
             }
      }



      function start_ojl_completion()
    {

      if(isset($_GET['id'])) {

          $agenda_id = $_GET['id'];
          $query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
              $res1 = $query1->result();
              $this->session->set_userdata('agenda_psr', $res1[0]->psr_id);
              $this->session->set_userdata('step', $res1[0]->step);
          $this->session->set_userdata('agenda_id', $agenda_id);

          $date_from = date_create($res1[0]->date_from);
          $datefrom = date_format($date_from, 'd-M-Y');

          $date_to = date_create($res1[0]->date_to);
          $dateto = date_format($date_to, 'd-M-Y');
        }

    	if($this->session->userdata('is_logged')){
    	
    	$client_engagement = $this->completion->getClientEngageMent('ojl_client_engagement');
        $item="";

    	$item .= '<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
              <div class="col-md-12 no-padding" style="width:100%;overflow:hidden">
    						<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
    							<thead class="darkblue-bg">
	    							<tr>
	    								<th style="width:19%">'.$datefrom.'</th> 
	    								<th style="width:27%">Name of MD/Client </th> 
	    								<th style="width:27%"> Hospital/Clinic Address </th> 
	    								<th style="width:27%"> Remarks/Higlight of Visit </th> 
	    							</tr> 
    							</thead>
    							<tbody>';
                    $x = 1;
                    foreach ($client_engagement as $data) {
                        if($data['day'] == 1) {

                          if($x%2 != 0) {
                                  $item .= '<tr>';
                              } else {
                                  $item .= '<tr style="background-color:#dcdcdc">'; 
                              }      

                              $address = $data['doctor_address'];
                              if($address == '') {
                                $address = 'N/A';     
                               }                      
                                 $item .= '<td> '.$x.'</td>
                                            <td> '.$data['doctor'].' </td>
                                            <td> '.$address.' </td>
                                            <td> '.$data['remarks'].' </td>
                                          </tr>';  
                         $x++;   

                        }
                          

                      
                        }  
                                    

    	$item .=               '</tbody>

    						</table> </div>';



if($datefrom != $dateto) {

              $item .= '<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
              <div class="col-md-12 no-padding" style="width:100%;overflow:hidden">
                <table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
                  <thead class="darkblue-bg">
                    <tr>
                      <th style="width:19%">'.$dateto.'</th> 
                      <th style="width:27%">Name of MD/Client </th> 
                      <th style="width:27%"> Hospital/Clinic Address </th> 
                      <th style="width:27%"> Remarks/Higlight of Visit </th> 
                    </tr> 
                  </thead>
                  <tbody>';

                    $y = 1;
                    foreach ($client_engagement as $data) {
                        if($data['day'] == 2) {

                          if($y%2 != 0) {
                                  $item .= '<tr>';
                              } else {
                                  $item .= '<tr style="background-color:#dcdcdc">'; 
                              }                       

                               $address = $data['doctor_address'];
                              if($address == '') {
                                $address = 'N/A';     
                               }      


                                 $item .= '<td> '.$y.'</td>
                                            <td> '.$data['doctor'].' </td>
                                            <td> '.$address.' </td>
                                            <td> '.$data['remarks'].' </td>
                                          </tr>';  

                                          $y++;   
                        }
                          

                        
                        }  


                  $item .= '</tbody></table></div>';

                }
						 $item .= '<div class="col-sm-12 col-md-12 col-lg-12 no-padding btn-next" style="text-align:right">
							<div class="btn-next" style="margin-top:20px;"><a class="darkblue-bg darkblue-btn PCE-StoryTelling-page">
								Next </a>
							</div>
						</div>

    					</div>
    					  ';
              $data['pageTitle'] = "CLIENT ENGAGEMENT";
              $data['table']=$item;
              $data['engagement'] = $client_engagement;
            echo json_encode($data);

    	}
    	else{
		redirect(base_url());
		}
    }


    function product_communication_data(){

     // if(isset($_GET['id'])) {

          $agenda_id = $this->session->userdata('agenda_id');
          $query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
              $res1 = $query1->result();
              $this->session->set_userdata('agenda_psr', $res1[0]->psr_id);
              $this->session->set_userdata('step', $res1[0]->step);
          $this->session->set_userdata('agenda_id', $agenda_id);


           $date_from = date_create($res1[0]->date_from);
          $datefrom = date_format($date_from, 'd-M-Y');

          $date_to = date_create($res1[0]->date_to);
          $dateto = date_format($date_to, 'd-M-Y');
       // }
    	if($this->session->userdata('is_logged')){
        $product_communication = $this->completion->getClientEngageMent('ojl_product_communication');
        $item="";

    	$item .= '<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
    						<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
    							<thead class="darkblue-bg">
	    							<tr>
                      <th style="width:15%">'.$datefrom.'</th>
	    								<th style="width:25%">Name of MD/Client</th> 
	    								<th style="width:20%">Biomedis Product</th> 
	    								<th style="width:20%"> Rating per MD </th> 
	    								<th style="width:20%"> Remarks </th> 
	    							<!--	<th> Forgram </th> 
	    								<th> Ave. Rating per MD </th> -->
	    							</tr> 
    							</thead>
    					   <tbody>';
             $x = 1; foreach ($product_communication as $data ) {
                if($data['day'] == 1) {


                    $item .= '    <tr>
                                    <td>'.$x.'</td>
                                    <td>  '.$data['doctor']. ' </td>
                                    <td>  '.$data['biomedis_product']. ' </td>
                                    <td>  '.$data['rating_per_md']. ' </td>
                                    <td>  '.$data['remarks']. ' </td>
                                
                                  </tr>';

                     $x++; }

                     }

                    $item .= '      </tbody>

                              </table>
                              </div>';

                
                   


        if($datefrom != $dateto) {



            $item .= '<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
                <table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
                  <thead class="darkblue-bg">
                    <tr>
                      <th style="width:15%">'.$dateto.'</th>
                      <th style="width:25%">Name of MD/Client</th> 
                      <th style="width:20%">Biomedis Product</th> 
                      <th style="width:20%"> Rating per MD </th> 
                      <th style="width:20%"> Remarks </th> 
                    <!--  <th> Forgram </th> 
                      <th> Ave. Rating per MD </th> -->
                    </tr> 
                  </thead>
                 <tbody>';
                           $y = 1; foreach ($product_communication as $data ) {
                              
                              if($data['day'] == 2) {
                                   $item .= ' <tr>
                                                <td>'.$y.'</td>
                                                <td>  '.$data['doctor']. ' </td>
                                                <td>  '.$data['biomedis_product']. ' </td>
                                                <td>  '.$data['rating_per_md']. ' </td>
                                                <td>  '.$data['remarks']. ' </td>
                                            
                                              </tr>';
                                              $y++;
                              }
             
                      }
                $item .= '      </tbody>

                          </table>
                          </div>';




        }

        $item .= ' <div class="col-sm-12 col-md-12 col-lg-12 no-padding btn-next no-padding" style="text-align:right">
                  <div class="btn-next" style="margin-top:20px;"><a class="SDPharmacies darkblue-btn darkblue-bg">
                    Next</span> 
                  </a></div>
                </dvi>';  


    	$item .= '<div class="col-sm-12 col-md-8 col-lg-8 comments no-padding">
    					  <!-- <h4><span>Detailing Comments: </span></h4>
    					  <textarea class="form-control" rows="6" cols="50"> </textarea> -->
    					  </div>

    					   <div class="col-sm-12 col-md-4 col-lg-4 rating no-padding">
    					 	<ul>
    					 		<li> <h4 class="rating-system"> Rating System </h4> </li>
    					 		<li> 3 - full and completed E-Detailing </li>
    					 		<li> 2 - average and partial E-Detailing </li>
    					 		<li> 1 - poor Detailing </li>
    					 	</ul>
    					  

    					 

    					  </div>
    					  ';
        $data['prod_com'] = $product_communication;
        $data['pageTitle'] = "PRODUCT COMMUNICATION EXCERCISE";
        $data['content']="completion/prod_com";
         $data['table']=$item;         
    	echo json_encode($data);

    	// $this->load->view('template/layout', $data);
    }

    else{
		redirect(base_url());
	}

	}




	    function survey_drugstore_pharmacies_data(){

        if(isset($_GET['id'])) {

          $agenda_id = $_GET['id'];
          $query1 = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
              $res1 = $query1->result();
              $this->session->set_userdata('agenda_psr', $res1[0]->psr_id);
              $this->session->set_userdata('step', $res1[0]->step);
          $this->session->set_userdata('agenda_id', $agenda_id);

          $date_from = date_create($res1[0]->date_from);
          $datefrom = date_format($date_from, 'd-M-Y');

          $date_to = date_create($res1[0]->date_to);
          $dateto = date_format($date_to, 'd-M-Y');
        }

    	if($this->session->userdata('is_logged')){
        $survey = $this->completion->getClientEngageMent('ojl_survey');
    	$item="";  
    	$item .= '<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">

    						<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
    							<thead class="darkblue-bg">
	    							<tr>
	    								<th style="width:20%"> '.$datefrom.' </th> 
	    								<th> Outlet </th> 
	    								<th> Address </th> 
	    								<th style="width:30%"> Remarks </th> 
	    							</tr> 
    							</thead>
    							<tbody>';
                    $x = 1;
                      foreach ($survey as $data) {
                         if($data['day'] == 1){

                           $item .= '<tr>
                                      <td> '.$x.'      </td>
                                      <td> '.$data['outlet'].'   </td>
                                      <td> '.$data['address'].'  </td>
                                      <td> '.$data['remarks'].'  </td>
                                    </tr>';
                                    $x++;
                              }
                           

                         }

                          $item .= '</tbody>
                                      </table>';
         

                      if($datefrom != $dateto) {

                          $item .= '<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">

                                <table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
                                  <thead class="darkblue-bg">
                                    <tr>
                                      <th style="width:20%"> '.$dateto.' </th> 
                                      <th> Outlet </th> 
                                      <th> Address </th> 
                                      <th style="width:30%"> Remarks </th> 
                                    </tr> 
                                  </thead>
                                  <tbody>';


                                  $y = 1;
                                    foreach ($survey as $data) {
                                       if($data['day'] == 2){

                                         $item .= '<tr>
                                                    <td> '.$y.'      </td>
                                                    <td> '.$data['outlet'].'   </td>
                                                    <td> '.$data['address'].'  </td>
                                                    <td> '.$data['remarks'].'  </td>
                                                  </tr>';
                                                  $y++;
                                            }
                                         

                                       }


                                  $item .= '</tbody>
                                      </table>';
                      }



						$item .= '<div class="col-sm-12 col-md-12 col-lg-12 no-padding btn-next" style="text-align:right;margin-bottom:15px;">


							<div class="btn-next" style="margin-top:20px">
              <a class="Competitors-Activity-Report darkblue-bg darkblue-btn">Skip</a>
              <a class="Competitors-Activity-Report darkblue-bg darkblue-btn">Next</a>
                </div>
						</dvi>
    						
    					  </div>
    					  ';

        $data['pageTitle'] = "SURVEY ON DRUGSTORES AND PHARMACIES";
        $data['content']="completion/home";
        $data['table'] = $item;
    	echo json_encode($data);

    	}
    	else{
		redirect(base_url());
		}
    }


      function Competitors_Activity_Report_Data(){
    	if($this->session->userdata('is_logged')){
         $CAReport = $this->completion->getClientEngageMent('ojl_competitors_activity');

            $item = "";


            
            
    	$item .= '<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">

    						<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding" style="margin-bottom:10px;"> 
    							<thead class="darkblue-bg">
	    							<tr>
	    								<th> Company/Product </th> 
	    								<th> Details of Promotional Activities </th> 
	    								<th> Plan of Action </th> 
	    							 
	    							</tr> 
    							</thead>
    							<tbody>';
                                foreach ($CAReport as $data ) {
                                    $item .= '          <tr>
                      <td> '.$data['company'].'</td>
                      <td> '.$data['details'].' </td>
                      <td> '.$data['plan_of_action'].' </td>
                    </tr>';
                                }
    	

    	$item .= '				</tbody>
    						</table>

						<div class="col-sm-12 col-md-12 col-lg-12 no-padding btn-next" style="text-align:right">
							<div class="btn-next">
                <a class="EC-Development darkblue-bg darkblue-btn">Skip</a>
                <a class="EC-Development darkblue-bg darkblue-btn">Next</a>
              </div>
						</dvi>
    						
    					  </div>
    					  ';
        $data['pageTitle'] = "COMPETITOR'S ACTIVITY REPORT";
        $data['content']="completion/home";
        $data['table'] = $item;
    	echo json_encode($data);

    	}
    	else{
		redirect(base_url());
		}
    }


       function Employee_Compentency_Development_Data(){

    	if($this->session->userdata('is_logged')){
        $EmployeeData = $this->completion->ojl_competency();
        // $idp = $this->completion->get_idp($EmployeeData[0]['competency_id']);
         $idp = $this->completion->getData('competency_id', $EmployeeData[0]->competency_id,'ojl_idp');
        // print_r($idp);exit;
        $ulearn = $this->completion->getData('competency_id',$EmployeeData[0]->competency_id,'ojl_ulearn');
        //$id = $this->completion->get_idp();
        
        $data['EmployeeData'] = $EmployeeData;
        $data['pageTitle'] = "Employee Compentency Development";
        $data['content']="completion/home";    
        $data['table'] = $item;    
    	echo json_encode($data);

    	}
    	else{
		redirect(base_url());
		}
    }



     function Activity_and_Starts_Monitoring_Sheet_Data(){
        if($this->session->userdata('is_logged')){

        $user_id = $this->session->userdata('user_id');
        $agenda_id = $this->session->userdata('agenda_id');
        $data['mp'] = $this->completion->getMP($user_id);
        $data['planned'] = $this->completion->get_planned('ojl_plan',$data['mp'][0]->record_id);
        $data['thinks_customer'] = $this->completion->get_planned('ojl_competency_thinks_customer', $data['mp'][0]->record_id);
        $data['functional_expertise'] = $this->completion->get_planned('ojl_competency_functional_expertise', $data['mp'][0]->record_id);

        $data['agenda'] = $this->session->userdata('agenda_id');
        $query = $this->db->query("SELECT * FROM ojl_agenda where agenda_id = '".$agenda_id."'");
        $agenda = $query->result();

        $agenda_status = $agenda[0]->status;
        $data['agenda_status'] = $agenda_status;
        $mp_status = $data['mp'][0]->status;

        // if($agenda_status == 2 || $agenda_status == 3 || $agenda_status == 4) {
        //   $disabled = 'disabled';
        // } else {
        //   $disabled = '';
        // }


        if(count($data['functional_expertise'] != 0)) {
          foreach($data['functional_expertise'] as $key => $c) {
            $table_1_d1 = $c->situation_task;
            $table_1_d2 = $c->action;
            $table_1_d3 = $c->result;
          } 
        } else {
            $table_1_d1 = '';
            $table_1_d2 = '';
            $table_1_d3 = '';
        }

        if(count($data['thinks_customer'] != 0)) {
          foreach($data['thinks_customer'] as $key2 => $e) {

            if($e->table_number == 1) {
              $table_2_d1 = $e->situation_task;
              $table_2_d2 = $e->action;
              $table_2_d3 = $e->result;
              $table_2_d4 = $e->alternative_action;

            }

            if($e->table_number == 2) {
              $table_3_d1 = $e->situation_task;
              $table_3_d2 = $e->action;
              $table_3_d3 = $e->result;
              $table_3_d4 = $e->alternative_action;
            }

            if($e->table_number == 3) {
              $table_4_d1 = $e->situation_task;
              $table_4_d2 = $e->action;
              $table_4_d3 = $e->result;
              $table_4_d4 = $e->alternative_action;
            }

          }
        } else {

              $table_2_d1 = "";
              $table_2_d2 = "";
              $table_2_d3 = "";
              $table_2_d4 = "";

              $table_3_d1 = "";
              $table_3_d2 = "";
              $table_3_d3 = "";
              $table_3_d4 = "";

              $table_4_d1 = "";
              $table_4_d2 = "";
              $table_4_d3 = "";
              $table_4_d4 = "";

        }

        $datefrom = date_create($data['mp'][0]->date_from);
        
        $dateto = date_create($data['mp'][0]->date_to);

        $data['pageTitle'] = "ACTIVITY AND STARS MONITORING SHEET";
        $data['content']="completion/home";

        if($datefrom == $dateto) {
          $date_of = date_format($datefrom, 'F d, Y');
        } else {
          $datefrom = date_format($datefrom, 'F d -');
          $dateto = date_format($dateto, ' d, Y');
          $date_of = $datefrom.$dateto;
        }


        $item = '<input type="hidden" class="hidden_mp_id" value="'.$data['mp'][0]->record_id.'">
                  <input type="hidden" class="hidden_mp_status" value="'.$mp_status.'">
                  <input type="hidden" class="hidden_agenda_status" value="'.$agenda_status.'">
                <div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
                            <div class=""> <h4><b>MARKETING PROGRAMS IMPLEMENTATION</b> </h4> </div>
                            <div class=""> 
                            <h5>Period Covered: '.$date_of.'  </h5>  </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 no-padding"> <label class="form-label">Planned </label> </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 pad-0"> <button class="inputs_add darkblue-bg darkblue-btn AddLine AddLine-7-column right" aria-type="ASMSheet" > Add Line </button> </div>

                            <div class="col-md-12 pad-0" style="width:100%;overflow-x:scroll;margin-bottom:20px">
                                <table class="ASMSheet-table sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
                                    <thead class="darkblue-bg">
                                        <tr>
                                            <th> Product </th> 
                                            <th> Name of Program </th> 
                                            <th> Planned </th> 
                                            <th> Actual </th> 
                                            <th> %Perf </th> 
                                            <th> Date implemented </th> 
                                            <th> Remarks/Next Schedule </th>
                                            <th> </th>
                                        </tr> 
                                    </thead>
                                    <tbody class="tb_plan">';

                                    if(count($data['planned']) != 0) {
                                        $z = 0;

                                        if($agenda_status == 2 || $agenda_status ==3 || $agenda_status == 4) {

                                          if($mp_status == 1) {
                                            foreach($data['planned'] as $key => $c) {

                                              $date = date_create($c->date_impletemented);
                                              $dateimps = date_format($date, "m/d/Y");
                                               
                                                if($c->plan_type == 1) {
                                                     $z++;
                                                    $item .= '<tr style="display:none">
                                                    <td><input type="text" class="inputs planned_product planned_product_'.$z.'" value="'.$c->product.'"></td>
                                                    <td><input type="text" class="inputs planned_nop planned_nop_'.$z.'" value="'.$c->name_of_program.'"></td>
                                                    <td><input type="text" class="inputs planned_planned stars_perf planned_planned_'.$z.'" value="'.$c->planned.'"></td>
                                                    <td><input type="text" class="inputs planned_actual stars_perf planned_actual_'.$z.'" value="'.$c->actual.'"></td>
                                                    <td><input type="text" class="inputs planned_perf stars_perf planned_perf_'.$z.'" value="'.$c->perf.'"></td>
                                                    <td><input type="text" readonly="readonly" class="inputs planned_date_impletemented planned_date_impletemented_'.$z.'" value="'.$dateimps.'"></td>
                                                    <td><input type="text" class="inputs planned_remarks planned_remarks_'.$z.'" value="'.$c->remarks.'"></td>
                                                    <td class="no-padding-left no-border"> <span class="inputs_remove glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>
                                                    </tr>'; 
                                                }
                                                

                                            }
                                          } else {
                                            foreach($data['planned'] as $key => $c) {

                                              $date = date_create($c->date_impletemented);
                                              $dateimps = date_format($date, "m/d/Y");
                                               
                                                if($c->plan_type == 1) {
                                                     $z++;
                                                    $item .= '<tr>
                                                    <td><input type="text" class="inputs planned_product planned_product_'.$z.'" value="'.$c->product.'"></td>
                                                    <td><input type="text" class="inputs planned_nop planned_nop_'.$z.'" value="'.$c->name_of_program.'"></td>
                                                    <td><input type="text" class="inputs planned_planned stars_perf planned_planned_'.$z.'" value="'.$c->planned.'"></td>
                                                    <td><input type="text" class="inputs planned_actual stars_perf planned_actual_'.$z.'" value="'.$c->actual.'"></td>
                                                    <td><input type="text" class="inputs planned_perf stars_perf planned_perf_'.$z.'" value="'.$c->perf.'"></td>
                                                    <td><input type="text" readonly="readonly" class="inputs planned_date_impletemented planned_date_impletemented_'.$z.'" value="'.$dateimps.'"></td>
                                                    <td><input type="text" class="inputs planned_remarks planned_remarks_'.$z.'" value="'.$c->remarks.'"></td>
                                                    <td class="no-padding-left no-border"> <span class="inputs_remove glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>
                                                    </tr>'; 
                                                }
                                                

                                            }
                                          }
                                          
                                        } else {
                                          foreach($data['planned'] as $key => $c) {

                                            $date = date_create($c->date_impletemented);
                                            $dateimps = date_format($date, "m/d/Y");
                                             
                                              if($c->plan_type == 1) {
                                                   $z++;
                                                  $item .= '<tr>
                                                  <td><input type="text" class="inputs planned_product planned_product_'.$z.'" value="'.$c->product.'"></td>
                                                  <td><input type="text" class="inputs planned_nop planned_nop_'.$z.'" value="'.$c->name_of_program.'"></td>
                                                  <td><input type="text" class="inputs planned_planned stars_perf planned_planned_'.$z.'" value="'.$c->planned.'"></td>
                                                  <td><input type="text" class="inputs planned_actual stars_perf planned_actual_'.$z.'" value="'.$c->actual.'"></td>
                                                  <td><input type="text" class="inputs planned_perf stars_perf planned_perf_'.$z.'" value="'.$c->perf.'"></td>
                                                  <td><input type="text" readonly="readonly" class="inputs planned_date_impletemented planned_date_impletemented_'.$z.'" value="'.$dateimps.'"></td>
                                                  <td><input type="text" class="inputs planned_remarks planned_remarks_'.$z.'" value="'.$c->remarks.'"></td>
                                                  <td class="no-padding-left no-border"> <span class="inputs_remove glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>
                                                  </tr>'; 
                                              }
                                              

                                          }
                                        }
                                        
                                    } else {
                                        $z=0;
                                    }
                                    

            $item .=               '</tbody>
                                </table>
                                <input type="hidden" class="hid_plan_ctr" value="'.$z.'">
                            </div>
                            
                          </div>


                           <div class="col-sm-6 col-md-6 col-lg-6 no-padding" style="margin-top:20px;"> <label class="form-label">Programs implemented on Top of Planned </label> </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 pad-0" style="margin-top:20px"> <button class="inputs_add darkblue-btn darkblue-bg AddLine AddLine-7-column right" aria-type="PITPlanned" > Add Line </button> </div>
                            
                            <div class="col-md-12 pad-0" style="width:100%;overflow-x:scroll;margin-bottom:20px">
                                <table class="sales_plan_tbl PITPlanned-table col-sm-12 col-md-12 col-lg-12 no-padding"> 
                                    <thead class="darkblue-bg">
                                        <tr>
                                            <th> Product </th> 
                                            <th> Name of Program </th> 
                                            <th> Planned </th> 
                                            <th> Actual </th> 
                                            <th> %Perf </th> 
                                            <th> Date implemented </th> 
                                            <th> Remarks/Next Schedule </th>
                                            <th> </th>
                                        </tr> 
                                    </thead>
                                    <tbody class="tb_top_plan">';

                                     if(count($data['planned']) != 0) {
                                        $g = 0;

                                        if($agenda_status == 2 || $agenda_status ==3 || $agenda_status == 4) {
                                          
                                          if($mp_status == 1) {
                                              foreach($data['planned'] as $key => $c) {
                                                
                                              $date = date_create($c->date_impletemented);
                                              $dateimps = date_format($date, "m/d/Y");

                                                if($c->plan_type == 2) {
                                                     $g++;
                                                    $item .= '<tr style="display:none">
                                                    <td><input type="text" class="inputs top_planned_product top_planned_product_'.$g.'" value="'.$c->product.'"></td>
                                                    <td><input type="text" class="inputs top_planned_nop top_planned_nop_'.$g.'" value="'.$c->name_of_program.'"></td>
                                                    <td><input type="text" class="inputs top_planned_planned stars_perf top_planned_planned_'.$g.'" value="'.$c->planned.'"></td>
                                                    <td><input type="text" class="inputs top_planned_actual stars_perf top_planned_actual_'.$g.'" value="'.$c->actual.'"></td>
                                                    <td><input type="text" class="inputs top_planned_perf stars_perf top_planned_perf_'.$g.'" value="'.$c->perf.'"></td>
                                                    <td><input type="text" readonly="readonly" class="inputs top_planned_date_impletemented top_planned_date_impletemented_'.$g.'" value="'.$dateimps.'"></td>
                                                    <td><input type="text" class="inputs top_planned_remarks top_planned_remarks_'.$g.'" value="'.$c->remarks.'"></td>
                                                    <td class="no-padding-left no-border"> <span class="inputs_remove glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>
                                                    </tr>'; 
                                                }
                                                

                                            }

                                          } else {
                                              foreach($data['planned'] as $key => $c) {
                                            
                                              $date = date_create($c->date_impletemented);
                                              $dateimps = date_format($date, "m/d/Y");

                                                if($c->plan_type == 2) {
                                                     $g++;
                                                    $item .= '<tr>
                                                    <td><input type="text" class="inputs top_planned_product top_planned_product_'.$g.'" value="'.$c->product.'"></td>
                                                    <td><input type="text" class="inputs top_planned_nop top_planned_nop_'.$g.'" value="'.$c->name_of_program.'"></td>
                                                    <td><input type="text" class="inputs top_planned_planned stars_perf top_planned_planned_'.$g.'" value="'.$c->planned.'"></td>
                                                    <td><input type="text" class="inputs top_planned_actual stars_perf top_planned_actual_'.$g.'" value="'.$c->actual.'"></td>
                                                    <td><input type="text" class="inputs top_planned_perf stars_perf top_planned_perf_'.$g.'" value="'.$c->perf.'"></td>
                                                    <td><input type="text" readonly="readonly" class="inputs top_planned_date_impletemented top_planned_date_impletemented_'.$g.'" value="'.$dateimps.'"></td>
                                                    <td><input type="text" class="inputs top_planned_remarks top_planned_remarks_'.$g.'" value="'.$c->remarks.'"></td>
                                                    <td class="no-padding-left no-border"> <span class="inputs_remove glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>
                                                    </tr>'; 
                                                }
                                                

                                            }

                                          }


                                        } else {
                                          foreach($data['planned'] as $key => $c) {
                                            
                                          $date = date_create($c->date_impletemented);
                                          $dateimps = date_format($date, "m/d/Y");

                                            if($c->plan_type == 2) {
                                                 $g++;
                                                $item .= '<tr>
                                                <td><input type="text" class="inputs top_planned_product top_planned_product_'.$g.'" value="'.$c->product.'"></td>
                                                <td><input type="text" class="inputs top_planned_nop top_planned_nop_'.$g.'" value="'.$c->name_of_program.'"></td>
                                                <td><input type="text" class="inputs top_planned_planned stars_perf top_planned_planned_'.$g.'" value="'.$c->planned.'"></td>
                                                <td><input type="text" class="inputs top_planned_actual stars_perf top_planned_actual_'.$g.'" value="'.$c->actual.'"></td>
                                                <td><input type="text" class="inputs top_planned_perf stars_perf top_planned_perf_'.$g.'" value="'.$c->perf.'"></td>
                                                <td><input type="text" readonly="readonly" class="inputs top_planned_date_impletemented top_planned_date_impletemented_'.$g.'" value="'.$dateimps.'"></td>
                                                <td><input type="text" class="inputs top_planned_remarks top_planned_remarks top_planned_remarks_'.$g.'" value="'.$c->remarks.'"></td>
                                                <td class="no-padding-left no-border"> <span class="inputs_remove glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>
                                                </tr>'; 
                                            }
                                            

                                        }


                                        }
                                        
                                    } else {
                                        $g = 0;
                                    }

                                        
                $item .=            '</tbody>
                                </table>
                                <input type="hidden" class="hid_top_plan_ctr" value="'.$g.'">
                            </div>';

                    $item .=   '


                            
                          ';


        $data['table'] = $item;
        echo json_encode($data);

        }
        else{
        redirect(base_url());
        }
    }

    public function get_comps() {
      $user_id = $this->session->userdata('user_id');
        $data['mp'] = $this->completion->getMP($user_id);
        
        $data['functional_expertise'] = $this->completion->get_planned('ojl_competency_functional_expertise', $data['mp'][0]->record_id);

        echo json_encode($data['functional_expertise']);
    }

    public function update_mp_status() {
      $mp_id = $_POST['mp_id'];
      $type = $_POST['type'];

      $this->db->query("UPDATE ojl_marketing_programs set status = '".$type."' where record_id = '".$mp_id."'");
    }

    public function submit_competencies() {
        $fu_sit_data = $_REQUEST['fu_sit_data'];
        $fu_action_data = $_REQUEST['fu_action_data'];
        $fu_result_data = $_REQUEST['fu_result_data'];

        $fu_sitb_data = $_REQUEST['fu_sitb_data'];
        $fu_actionb_data = $_REQUEST['fu_actionb_data'];
        $fu_resultb_data = $_REQUEST['fu_resultb_data'];
        $fu_alternativeb_data = $_REQUEST['fu_alternativeb_data'];

        $fu_sitc_data = $_REQUEST['fu_sitc_data'];
        $fu_actionc_data = $_REQUEST['fu_actionc_data'];
        $fu_resultc_data = $_REQUEST['fu_resultc_data'];
        $fu_alternativec_data = $_REQUEST['fu_alternativec_data'];

        $fu_sitd_data = $_REQUEST['fu_sitd_data'];
        $fu_actiond_data = $_REQUEST['fu_actiond_data'];
        $fu_resultd_data = $_REQUEST['fu_resultd_data'];
        $fu_alternatived_data = $_REQUEST['fu_alternatived_data'];

        $mp_id = $_POST['mp_id'];

        $type = $_POST['type'];

        $query = $this->db->query("SELECT * FROM ojl_competency_thinks_customer where mp_id = '".$mp_id."'");
        $query2 = $this->db->query("SELECT * FROM ojl_competency_functional_expertise where mp_id = '".$mp_id."'");
        $count_comp = $query->num_rows();
        $count_comp2 = $query2->num_rows();



        $user_id = $this->session->userdata('user_id');

       
                 $data_ = array(
                  'mp_id' => $mp_id,
                  'user_id' => $user_id,
                  'situation_task' => $fu_sit_data,
                  'action' => $fu_action_data,
                  'result' => $fu_result_data,
                  'is_active' => 1
                  );

           if($count_comp == 0) {    
              $this->completion->insert_ojl_completion("ojl_competency_functional_expertise", $data_);
             } else {
                $this->db->where('mp_id', $mp_id);
                $this->db->update('ojl_competency_functional_expertise', $data_); 
             }



        
            $data = array(
                    'mp_id' => $mp_id,
                    'user_id' => $user_id,
                    'situation_task' => $fu_sitb_data,
                    'action' => $fu_actionb_data,
                    'result' => $fu_resultb_data,
                    'alternative_action' => $fu_alternativeb_data,
                    'table_number' => 1,
                    'is_active' => 1
                    );

            $data1 = array(
                    'mp_id' => $mp_id,
                    'user_id' => $user_id,
                    'situation_task' => $fu_sitc_data,
                    'action' => $fu_actionc_data,
                    'result' => $fu_resultc_data,
                    'alternative_action' => $fu_alternativec_data,
                    'table_number' => 2,
                    'is_active' => 1
                );

            $data2 = array(
                    'mp_id' => $mp_id,
                    'user_id' => $user_id,
                    'situation_task' => $fu_sitd_data,
                    'action' => $fu_actiond_data,
                    'result' => $fu_resultd_data,
                    'alternative_action' => $fu_alternatived_data,
                    'table_number' => 3,
                    'is_active' => 1
                );

        if($count_comp == 0) {

            $this->completion->insert_ojl_completion("ojl_competency_thinks_customer", $data);
            $this->completion->insert_ojl_completion("ojl_competency_thinks_customer", $data1);
            $this->completion->insert_ojl_completion("ojl_competency_thinks_customer", $data2);


        } else {

            $this->db->where('mp_id', $mp_id);
            $this->db->where('table_number', 1);
            $this->db->update('ojl_competency_thinks_customer', $data); 
            $this->db->where('table_number', 2);
            $this->db->update('ojl_competency_thinks_customer', $data1); 
            $this->db->where('table_number', 3);
            $this->db->update('ojl_competency_thinks_customer', $data2); 
            
    
        }

        $this->completion->update_mp_status($type, $mp_id);

        // $arrlength = count($fu_sit_data);
        // $user_id = $this->session->userdata('user_id');
        // for($x=0;$x<$arrlength;$x++) {
        //     $data = array(
        //             'mp_id' => $mp_id,
        //             'user_id' => $user_id,
        //             'situation_task' => $fu_sit_data[$x],
        //             'action' => $fu_action_data[$x],
        //             'result' => $fu_result_data[$x],
        //             'is_active' => 1
        //             );

        //     $data2 = array(
        //             'mp_id' => $mp_id,
        //             'user_id' => $user_id,
        //             'situation_task' => $fu_sitb_data[$x],
        //             'action' => $fu_actionb_data[$x],
        //             'result' => $fu_resultb_data[$x],
        //             'alternative_action' => $fu_alternativeb_data[$x],
        //             'is_active' => 1
        //             );

        //     $this->completion->insert_ojl_completion("ojl_competency_functional_expertise", $data);
        //     $this->completion->insert_ojl_completion("ojl_competency_thinks_customer", $data2);

        //     $this->completion->update_mp_status($type);
        // }

    }

    public function delete_comp() {
      $mp_id = $_POST['mp_id'];

      $this->db->query("DELETE FROM ojl_competency_functional_expertise where mp_id = '".$mp_id."'");
    }

    public function submit_competencies2() {
      $sit_task = $_POST['sit_task'];
      $action = $_POST['action'];
      $result = $_POST['result'];
      $com_type = $_POST['com_type'];
      $mp_id = $_POST['mp_id'];

      $user_id = $this->session->userdata('user_id');

      $data = array(
          'mp_id' => $mp_id,
          'user_id' => $user_id,
          'situation_task'=> $sit_task,
          'action' => $action,
          'result' => $result,
          'type' => $com_type
        );

      $this->completion->insert_ojl_completion("ojl_competency_functional_expertise", $data);
    }


public function get_plan() {
    $type = $_POST['type'];
    $plan = $this->completion->getPlan($type);
    echo json_encode($plan);
}

public function insert_planned() {
    $planned_product = $_POST['planned_product'];
    $planned_name_of_program = $_POST['planned_name_of_program'];
    $planned_planned = $_POST['planned_planned'];
    $planned_actual = $_POST['planned_actual'];
    $planned_perf = $_POST['planned_perf'];
    $planned_date_impletemented = $_POST['planned_date_impletemented'];

    $date = date_create($planned_date_impletemented);
    $dates = date_format($date, "Y-m-d");

    $planned_remarks = $_POST['planned_remarks'];
    $mp_id = $_POST['mp_id'];
    $type = $_POST['type'];

    $data = array(
            'mp_id' => $mp_id,
            'user_id' => $this->session->userdata('user_id'),
            'plan_type' => $type,
            'product' => $planned_product,
            'name_of_program' => $planned_name_of_program,
            'planned' => $planned_planned,
            'actual' => $planned_actual,
            'perf' => $planned_perf,
            'remarks' => $planned_remarks,
            'date_impletemented' => $dates,
            'is_active' => 1
            );

    //if($planned_product != '' && $planned_name_of_program != '' && $planned_planned != '' && $planned_actual != '' && $planned_perf != '' && $planned_remarks != '') {
      $this->completion->insert_ojl_completion('ojl_plan', $data);
   // }
    
}

public function delete_plan() {
    $mp_id = $_POST['mp_id'];
   $data = $this->completion->deletePlan($mp_id);
   if($data) {
    echo 'success';
   } else {
    echo 'failed';
   }

}

public function delete_competency() {
  $mp_id = $_POST['mp_id'];
  $this->completion->deleteCompetency($mp_id);
}

public function get_emp() {
   $EmployeeData = $this->completion->ojl_competency();
   echo json_encode($EmployeeData);
}

public function get_idp() {
  $competency_id = $_POST['competency_id'];
  $table = $_POST['table'];
  $idp = $this->completion->getData('competency_id', $competency_id,$table);
  // /$idp = $this->completion->getIDP($competency_id);
  echo json_encode($idp);
}

public function update_mp() {
  $comf_id = $_POST['comf_id'];
  $date = $_POST['datesss'];
  $areas = $_POST['areas'];
  $training_intervention = $_POST['training_intervention'];

  $date_a = date_create($date);
  $date_promotion = date_format($date_a, 'Y-m-d');

  $this->completion->updateMP($comf_id, $date_promotion, $areas,  $training_intervention);
}

public function check_is_api() {
  $result = $this->completion->check_isApi();
  echo $result;

}
	
}