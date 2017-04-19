<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//  header('Access-Control-Allow-Origin: *');

// date_default_timezone_set('UTC');

class Generate_agenda extends CI_Controller {



    // Construct to define Media base folder
    public function __construct()
    {       
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Agenda_model');
        $this->load->model('Ojl_completion_model', 'completion');
    }

    public function index() {
    	
	}

	public function via_pdf($agenda_id) {
		$this->load->library("Pdf");


		$agenda = $this->Home_model->get_agenda($agenda_id);
		$action_plan = $this->Home_model->get_action_plan($agenda[0]->agenda_id);
		$itinerary = $this->Home_model->get_itn($agenda[0]->agenda_id);

		$date_from = date_create($agenda[0]->date_from);
		$datefrom = date_format($date_from, 'F d -');
		$date_to = date_create($agenda[0]->date_to);
		$dateto = date_format($date_to, ' d, Y');
		$datess = $datefrom.$dateto;

		// echo '<pre>';
		// print_r($agenda);
		// exit();

    	 $orientation = 'P';
        $unit = 'mm';
        $format = 'A4';
        $unicode = true;
        $encoding = 'UTF-8';

        $pdf = new Pdf($orientation, $unit, $format, $unicode, $encoding);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        $pdf->SetFont('helvetica', '', 10);

        //Set the coordinates
        $x = 0;
        $y = 10;

        $style = array('width' => 0, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));


        $pdf->AddPage();

     //    $pdf->SetFont('helvetica', 'B', 10);
     //    $pdf->Text($x+9, $y+5,"OJL SCHEDULE", 0, false);

    	// $pdf->Text($x+9, $y+25,"Name of District Manager", 0, false);   

    	// $pdf->SetFont('helvetica', 10);
    	// $pdf->Text($x+60, $y+25, $agenda[0]->dm, 0, false);    

    	$html = '<table>
    				<tr>
    					<td><b>Name of District Manager</b></td>
    					<td>'.$agenda[0]->dm.'</td>

    					<td><b>Territory</b></td>
    					<td>'.$agenda[0]->territory.'</td>
    				</tr>

    				<tr style="padding-top:5px;">
    					<td><b>Name of PSR</b></td>
    					<td>'.$agenda[0]->psr.'</td>

    					<td><b>Date of OJL</b></td>
    					<td>'.$datess.'</td>
    				</tr>

    				<tr style="margin-top:15px;">
    					<td><b>Salary Grade</b></td>
    					<td>'.$agenda[0]->salary.'</td>

    					<td><b>Competency Standards</b></td>
    					<td>'.$agenda[0]->competency_standards.'</td>
    				</tr>
    			
    			<table>';

    	$html .= '<br>';

    	$html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
    				<span><b>AGENDA</b></span>
    			  </div>';

    	$html .= '<br>';

    	$html .= '<table>
    				<thead>
    					<tr style="padding:3px;color:white;background-color:#6c6c6c">
	    					<th style="width:30%"><b>AGENDA</b></th>
	    					<th style="width:70%"><b>SPECIFIC PLANS</b></th>
	    				</tr>
    				</thead>';



    	$html .= '<tbody>

    				<tr>
    					<td style="color:#1a4485"><b>BUSINESS DEVELOPMENT</b></td>
    				</tr>
    			';


    			foreach($action_plan as $key => $c) {
    				if($c->actionPlanType == 1) {
    					$html .= '<tr>
			    					<td style="width:30%">'.$c->agenda_name.'</td>
			    					<td style="width:70%">'.$c->specific_plans.'</td>
			    				</tr>';
    				}
    			}

    	$html .= '<tr>
    					<td style="color:#1a4485"><b>PEOPLE DEVELOPMENT</b></td>
    				</tr>';

    			foreach($action_plan as $key => $c) {
    				if($c->actionPlanType == 2) {
    					$html .= '<tr>
			    					<td style="width:30%">'.$c->agenda_name.'</td>
			    					<td style="width:70%">'.$c->specific_plans.'</td>
			    				</tr>';
    				}
    			}

    	$html .= '</tbody></table>';	

    	$html .= '<br>';


    	$html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
			<span><b>ITINERARY</b></span>
		  </div>';

		$html .= '<br>';

		$html .= '<table>
    				<thead>
    					<tr style="padding:3px;color:white;background-color:#6c6c6c">
	    					<th style="width:30%;text-align:center;"></th>
	    					<th style="width:40%;text-align:center;"><b>ADDRESS</b></th>
	    					<th style="width:30%;text-align:center;"><b>FOCUS MD</b></th>
	    				</tr>
    				</thead>';

    	$html .= '<tbody>';

    		foreach($itinerary as $key => $d) {
    			if($d->day == 1) {
    					$html .= '<tr>
    								<td style="width:30%;text-align:center">Day 1</td>
			    					<td style="width:40%;text-align:center">'.$d->doctor_address.'</td>
			    					<td style="width:30%;text-align:center">'.$d->doctor.'</td>
			    				</tr>';
    				}
    		}

    		foreach($itinerary as $key => $d) {
    			if($d->day == 2) {
    					$html .= '<tr>
    								<td style="width:30%;text-align:center">Day 2</td>
			    					<td style="width:40%;text-align:center">'.$d->doctor_address.'</td>
			    					<td style="width:30%;text-align:center">'.$d->doctor.'</td>
			    				</tr>';
    				}
    		}

    	$html .= '</tbody></table>';




    	$pdf->writeHTML($html, true, false, true, false, '');	

       
        

        $pdf->Output('test.pdf', 'D');
	}

    public function training_dept_via_pdf($agenda_id){


        $data['agenda_id'] = $agenda_id;
        $this->load->view('pdf', $agenda_id);
    }

    public function get_agenda() {
        $agenda_id = $_POST['agenda_id'];
        $agenda = $this->Home_model->get_agenda($agenda_id);

        echo json_encode($agenda);
    }


    public function training_dept_via_pdf2($agenda_id=NULL, $header=NULL, $cycle=NULL) {
         $this->load->library("Pdf");

         $orientation = 'P';
        $unit = 'mm';
        $format = 'A4';
        $unicode = true;
        $encoding = 'UTF-8';

        $agenda = $this->Home_model->get_agenda($agenda_id);
        $action_plan = $this->Home_model->get_action_plan($agenda[0]->agenda_id);
        $itinerary = $this->Home_model->get_itn($agenda[0]->agenda_id);
        $sales_plan = $this->Home_model->get_sales_plan($agenda_id);

        $date_from = date_create($agenda[0]->date_from);


        
        $date_to = date_create($agenda[0]->date_to);
        


        $datefrom_ = date_format($date_from, 'd-M-Y');
        $dateto_ = date_format($date_to, 'd-M-Y');


        if($date_from == $date_to) {
            $datess = date_format($date_from, 'F d, Y');
        } else {
            $datefrom = date_format($date_from, 'F d -');
            $dateto = date_format($date_to, ' d, Y');
            $datess = $datefrom.$dateto;
        }
        


        $client_engagement = $this->Home_model->getcompletion('ojl_client_engagement', $agenda_id);
        $product_communication = $this->Home_model->getcompletion('ojl_product_communication', $agenda_id);
        $survey = $this->Home_model->getcompletion('ojl_survey', $agenda_id);
        $competitors_activity = $this->Home_model->getcompletion('ojl_competitors_activity', $agenda_id);

        $employee_competency = $this->Home_model->ojl_competency($agenda_id);

        $comp_id = $employee_competency[0]->competency_id;

        $idp = $this->Home_model->get_idp($comp_id);
        $ulearn = $this->Home_model->get_ulearn($comp_id);

        $evaluation = $this->Agenda_model->get_evaluation($agenda_id, 'ojl_evaluation');

        $then = date_format($date_to, 'Y-m-d');
        $om_submitted_date = date_create($evaluation[0]->dm_date_from); //the date when DM submitted the ojl to psr. 2-16-17
        $om_date = date_format($om_submitted_date, 'Y-m-d');

        if($om_date < date('Y-m-d')) {
            $what = 'less';
        } else {
            $what = 'greater';
        }

        
        $mp = $this->completion->getMP2($agenda[0]->agenda_id);
        $planned = $this->completion->get_planned('ojl_plan',$mp[0]->record_id);
        $thinks_customer = $this->completion->get_planned('ojl_competency_thinks_customer', $mp[0]->record_id);
        $functional_expertise = $this->completion->get_planned('ojl_competency_functional_expertise', $mp[0]->record_id);


        $year_today = date('Y');
        $year_minus2 = $year_today - 2;
        $year_plus1 = $year_today + 1;


        $query2 = $this->db->query("SELECT * FROM ojl_rating where empid = '".$agenda[0]->psr_id."' AND (year >= '".$year_minus2."' AND year <= '".$year_plus1."')  order by year, sem");
        $res2 = $query2->result();
        $data_array = array();
        foreach ($res2 as $key => $value) {
            $data_array[$value->year][$value->sem] = new stdClass();
            $data_array[$value->year][$value->sem]->rating = $value->rating;
        }

        $om_date_ = $om_date;
         $then = strtotime($then);
         $om_date = strtotime($om_date);
        $diff = ceil(abs($om_date - $then) / 86400);

        $pdf = new Pdf($orientation, $unit, $format, $unicode, $encoding);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        $pdf->SetFont('helvetica', '', 10);

        //Set the coordinates
        $x = 0;
        $y = 10;

        $style = array('width' => 0, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));


        $pdf->AddPage();

         $html = '';



        // if($what != 'less') {
            if($diff > 6) {
                $html .= '<div style="text-align:right;color:red"><b>LATE SUBMISSION</b></div>';
                $html .= '<br><br>';
            }
        // }

        
        

        $html .= '<table>
                    <tr>
                        <td><b>Name of District Manager:</b></td>
                        <td>'.$agenda[0]->dm.'</td>

                        <td><b>Territory:</b></td>
                        <td>'.$agenda[0]->territory.'</td>
                    </tr>

                    <tr style="padding-top:5px;">
                        <td><b>Name of PSR:</b></td>
                        <td>'.$agenda[0]->psr.'</td>

                        <td><b>Date of OJL:</b></td>
                        <td>'.$datess.'</td>
                    </tr>

                    <tr style="margin-top:15px;">
                        <td><b>Salary Grade:</b></td>
                        <td>'.$agenda[0]->salary.'</td>

                        <td><b>Competency Standards:</b></td>
                        <td>'.$agenda[0]->competency_standards.'</td>
                    </tr>
                
                <table>';

        $html .= '<br>';

        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
                    <span><b>AGENDA</b></span>
                  </div>';

        $html .= '<br>';

        $html .= '<table>
                    <thead>
                        <tr style="padding:3px;color:white;background-color:#6c6c6c">
                            <th style="width:30%"><b>AGENDA</b></th>
                            <th style="width:70%"><b>SPECIFIC PLANS</b></th>
                        </tr>
                    </thead>';



        $html .= '<tbody>

                    <tr>
                        <td style="color:#1a4485"><b>BUSINESS DEVELOPMENT</b></td>
                    </tr>
                ';


                foreach($action_plan as $key => $c) {
                    if($c->actionPlanType == 1) {
                        $html .= '<tr>
                                    <td style="width:30%">'.$c->agenda_name.'</td>
                                    <td style="width:70%">'.$c->specific_plans.'</td>
                                </tr>';
                    }
                }

        $html .= '<tr>
                        <td style="color:#1a4485"><b>PEOPLE DEVELOPMENT</b></td>
                    </tr>';

                foreach($action_plan as $key => $c) {
                    if($c->actionPlanType == 2) {
                        $html .= '<tr>
                                    <td style="width:30%">'.$c->agenda_name.'</td>
                                    <td style="width:70%">'.$c->specific_plans.'</td>
                                </tr>';
                    }
                }

        $html .= '</tbody></table>';    

        $html .= '<br>';


        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>ITINERARY</b></span>
          </div>';

        $html .= '<br>';

        $html .= '<table>
                    <thead>
                        <tr style="padding:3px;color:white;background-color:#6c6c6c">
                            <th style="width:30%;text-align:left;"></th>
                            <th style="width:40%;text-align:left;"><b>HOSPITAL / ADDRESS</b></th>
                            <th style="width:30%;text-align:left;"><b>FOCUS MD / CLIENT</b></th>
                        </tr>
                    </thead>';

        $html .= '<tbody>';

            foreach($itinerary as $key => $d) {
                if($d->day == 1) {
                        $html .= '<tr>
                                    <td style="width:30%;text-align:left">Day 1</td>
                                    <td style="width:40%;text-align:left">'.$d->doctor_address.'</td>
                                    <td style="width:30%;text-align:left">'.$d->doctor.'</td>
                                </tr>';
                    }
            }

            foreach($itinerary as $key => $d) {
                if($d->day == 2) {
                        $html .= '<tr>
                                    <td style="width:30%;text-align:left">Day 2</td>
                                    <td style="width:40%;text-align:left">'.$d->doctor_address.'</td>
                                    <td style="width:30%;text-align:left">'.$d->doctor.'</td>
                                </tr>';
                    }
            }

        $html .= '</tbody></table>';

        $html .= '<br>';

        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>SALES PLAN FOR THE MONTH</b></span>
          </div>';

        $html .= '<br>';

         $html .= '<table>
                <thead>
                    <tr style="padding:3px;color:white;background-color:#bd1a3d">
                        <th style=""><b>YTD DS</b></th>
                        <th style=""><b>YTD IS</b></th>
                        <th style=""><b>YTD ST</b></th>
                        <th style=""><b>YTD QUOTA</b></th>
                        <th style=""><b>YTD FY</b></th>
                        <th style=""><b>TO GO</b></th>
                        <th style=""><b>REMARKS</b></th>

                    </tr>
                </thead>';

        foreach($sales_plan as $key => $d) {
              
                        $html .= '<tr>
                                    <td style="">'.number_format($d->grossup_ytd_ds, 2, '.', ',').'</td>
                                    <td style="">'.number_format($d->grossup_ytd_is, 2, '.', ',').'</td>
                                    <td style="">'.number_format($d->grossup_ytd_st, 2, '.', ',').'</td>
                                    <td style="">'.number_format($d->quota_ytd, 2, '.', ',').'</td>
                                    <td style="">'.number_format($d->quota_fy, 2, '.', ',').'</td>
                                    <td style="">'.number_format($d->quota_togo, 2, '.', ',').'</td>
                                    <td style="">'.$d->remarks.'</td>
                                </tr>';
                    
            }


        $html .= '<tbody>';

        $html .= '</tbody></table>';

        $html .= '<br>';
        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>COVERAGE PERFORMANCE MONITORING</b></span>
          </div>';

          $html .= '<br>';

        $html .= '<table><tbody>';
            $html .= '<tr><td style="text-align:center;color:white;background-color: #012873;" colspan="'.$header.'"><b>CYCLE</b></td>';

            $html .= '</tr>';

            $html .= '<tr style="background-color:grey;color:white">';
                for($z=1;$z<=$header;$z++) {
                    $html .= '<td>'.$z.'</td>';
                }
            $html .= '</tr>';

            $ratess = $_GET['rate'];
            $aaaa = explode(',', $ratess); 
            
         

            $html .= '<tr>';
                for($c=0;$c<=$header-1;$c++) {
                    $html .= '<td>'.$aaaa[$c].'</td>';
                }
            $html .= '</tr>';

        $html .= '</tbody></table>';

        $html .= '<br>';

        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>EMPLOYEE COMPETENCY DEVELOPMENT</b></span>
          </div>';

          $html .= '<br>';

          $html .= '<table>';
            $html .= '<tr>';
                $html .= '<td><b>Name of PSR:</b></td>';
                $html .= '<td>'.$employee_competency[0]->psr_name.'</td>';
                $html .= '<td><b>Date of OJL:</b></td>';
                $html .= '<td>'.$employee_competency[0]->date_of_ojl.'</td>';
            $html .= '</tr>';

            $html .= '<tr>';
                $html .= '<td><b>Salary Grade:</b></td>';
                $html .= '<td>'.$employee_competency[0]->salary_grade.'</td>';
                $html .= '<td><b>Competency Standard:</b></td>';
                $html .= '<td>'.$employee_competency[0]->competency_standard.'</td>';
            $html .= '</tr>';

            $html .= '<tr>';
                $html .= '<td><b>Territory:</b></td>';
                $html .= '<td>'.$employee_competency[0]->territory.'</td>';
                $html .= '<td><b>Areas for Improvement:</b></td>';
                $html .= '<td>'.$employee_competency[0]->areas_of_improvement.'</td>';
            $html .= '</tr>';

            $html .= '<tr>';
                $html .= '<td><b>Last Promotion Date:</b></td>';
                    $html .= '<td>'.$employee_competency[0]->last_promotion_date;
                    $html .= '</td>';
                $html .= '<td><b>Training Intervention:</b></td>';
                $html .= '<td>'.$employee_competency[0]->training_intervention  .'</td>';
            $html .= '</tr>';

            $html .= '<tr>';
                $html .= '<td><b>Rating:</b></td>';
                    $html .= '<td></td>';
                $html .= '<td></td>';
                $html .= '<td></td>';
            $html .= '</tr>';

            $html .= '<tr>';
               // $html .= '<td></td>';
                    $html .= '<td colspan="2">';
                    $html .= '<table border="1" style="text-align: center;"><thead></thead><tbody><tr>';

                        $year_today = date('Y');
                        $year_minus2 = $year_today - 2;
                        $year_plus1 = $year_today + 1;

                        $year = $year_minus2;


                        for($x=1; $x<=4; $x++){
                            $y = 1;
                            while($y<=2){
                                $html .= '<td>S'.$y.' '.$year.'</td>';

                                if($y==2){
                                    $year++;
                                }
                                $y++;
                                if($year==$year_plus1){
                                    $y++;
                                }
                            }

                        }

                        $html .= '</tr><tr>';


                        $year_today = date('Y');
                        $year_minus2 = $year_today - 2;
                        $year_plus1 = $year_today + 1;

                        $year = $year_minus2;

                        for($x=1; $x<=4; $x++){
                                
                            $y = 1;
                            while($y<=2){
                                if(isset($data_array[$year][$y]->rating)){
                                    $dataval = $data_array[$year][$y]->rating;
                                }
                                else{
                                    $dataval = '';
                                }

                                $html .= '<td>'.$dataval.'</td>';
                                if($y==2){
                                    $year++;
                                }
                                    $y++;
                                    if($year==$year_plus1){
                                        $y++;
                                    }


                            }
                        }

                        $html .= '</tr></tbody>


                                    </table>';

                    $html .= '</td>';
                $html .= '<td></td>';
                $html .= '<td></td>';
            $html .= '</tr>';


          $html .= '</table>';

          $html .= '<br>';  

          $html .= '<br>';

          $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>INDIVIDUAL DEVELOPMENT PLAN</b></span>
          </div>';

           $html .= '<table>
                       <thead>
                                <tr style="padding:3px;color:white;background-color:#012873">
                                    <th style=""><b>   SKILLS TO BE DEVELOPED</b></th>
                                    <th style=""><b>DEVELOPMENTAL ACTIVITY</b></th>
                                    

                                </tr>
                            </thead><tbody>';

                    foreach($idp as $key => $c) {
                        $html .= '<tr>';
                            $html .= '<td>'.$c->skills_to_developed.'</td>';
                            $html .= '<td>'.$c->development_activity.'</td>';
                        $html .= '</tr>';
                    }


           $html .= '</tbody></table>';
          

        $html .= '<br>';

        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>ULEARN ACCOMPLISHMENT UPDATE</b></span>
          </div>';
          
            $html .= '<table>
                       <thead>
                                <tr style="padding:3px;color:white;background-color:#012873">
                                    <th style=""><b>   COURSE TITLE</b></th>
                                    <th style=""><b>COMPLETION DATE</b></th>
                                    <th style=""><b>LEARNING APPLICATION</b></th>

                                </tr>
                            </thead><tbody>';

                    foreach($ulearn as $key => $c) {
                        $html .= '<tr>';
                            $html .= '<td>'.$c->course_title.'</td>';
                            $html .= '<td>'.$c->completion_date.'</td>';
                            $html .= '<td>'.$c->learning_application.'</td>';
                        $html .= '</tr>';
                    }


           $html .= '</tbody></table>';

        $html .= '<br>';

        $examsss = $_GET['exams'];
            $bbbb = explode(',', $examsss); 
           
            // echo '<pre>';
            // print_r($bbbb);
            // exit();


        $html .= '<div>On-line Exam Monitoring</div>';

        $html .= '<table border="1"> 
            <tbody> 
                <tr style="">
                    <td rowspan="2"> </td> 
                    <td colspan="12" class="darkblue-bg" style="background-color:#012873;color:white;text-align:center"> Months </td>
                </tr> 
          
                <tr style="background-color:012873;color:white">
                    <td> 1 </td>
                    <td> 2 </td>
                    <td> 3 </td>
                    <td> 4 </td>
                    <td> 5 </td>
                    <td> 6 </td>
                    <td> 7 </td>
                    <td> 8 </td>
                    <td> 9 </td>
                    <td> 10 </td>
                    <td> 11 </td>
                    <td> 12 </td>
                </tr>

                <tr>
                    <td> % Perf </td>';

                    for($e=0;$e<=11;$e++) {
                        $cur_exam = '';
                         

                        foreach($bbbb as $key) {
                           if(substr($key, 0, 2) == $e+1) {
                                $cur_exam = substr($key,3);
                           } 
                            

                        }

                        $html .= '<td>'.$cur_exam.'</td>';
                    }
                    // <td class="month_1">  </td>
                    // <td class="month_2">  </td>
                    // <td class="month_3">  </td>
                    // <td class="month_4">  </td>
                    // <td class="month_5">  </td>
                    // <td class="month_6">  </td>
                    // <td class="month_7">  </td>
                    // <td class="month_8">  </td>
                    // <td class="month_9">  </td>
                    // <td class="month_10">  </td>
                    // <td class="month_11">  </td>
                    // <td class="month_12">  </td>


                $html .= '</tr>

            </tbody>
        </table>';

        $html .= '<br>';

        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>OJL COMPLETION</b></span>
          </div>';


        

        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>CLIENT ENGAGEMENT</b></span>
          </div>';

        $html .= '<br>';

        $html .= '<table>
                <thead>
                    <tr style="color:white;background-color:#6c6c6c; text-align:left">
                        <th style="text-align:left"><b>'.$datefrom_.'</b></th> 
                        <th style="text-align:left"><b>Name of MD/Client </b></th> 
                        <th style="text-align:left"><b> Hospital/Clinic Address </b></th> 
                        <th style="text-align:left"><b> Remarks/Higlight of Visit </b></th> 

                    </tr>
                </thead>';

        $html .= '<tbody>';

            $x = 1; foreach($client_engagement as $key => $c) { 
                        if($c->day == 1) {

                    $html .= '<tr style="text-align:left">
                                <td>'.$x.'</td>';
                    $html .= '<td>'.$c->doctor.'</td>';
                    $html .= '<td>'.$c->doctor_address.'</td>';
                    $html .= '<td>'.$c->remarks.'</td>';
                    $html .= '</tr>';


                $x++; } 

                }

        $html .= '</tbody></table>';


        if($datefrom_ != $dateto_) {

                    $html .= '<table>
                                <thead>
                                    <tr style="color:white;background-color:#6c6c6c; text-align:left">
                                        <th><b>'.$dateto_.'</b></th> 
                                        <th><b>Name of MD/Client </b></th> 
                                        <th><b> Hospital/Clinic Address </b></th> 
                                        <th><b> Remarks/Higlight of Visit </b></th> 

                                    </tr>
                                </thead>';

                        $html .= '<tbody>';

                            $y = 1; foreach($client_engagement as $key => $c) { 
                                        if($c->day == 2) {

                                    $html .= '<tr style="text-align:left">
                                                <td>'.$y.'</td>';
                                    $html .= '<td>'.$c->doctor.'</td>';
                                    $html .= '<td>'.$c->doctor_address.'</td>';
                                    $html .= '<td>'.$c->remarks.'</td>';
                                    $html .= '</tr>';


                                $y++; } 

                                }

                        $html .= '</tbody></table>';

        }


        $html .= '<br>';

        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>PRODUCT COMMUNICATION EXERCISE</b></span>
          </div>';




        $html .= '<br>';

        $html .= '<table>
                    <thead>
                        <tr style="color:white;background-color:#6c6c6c; text-align:left">
                            <th>'.$datefrom_.'</th>
                           <th><b>Name of MD/Client</b></th> 
                            <th><b>Biomedis Product</b></th> 
                            <th><b> Rating per MD </b></th> 
                            <th><b> Remarks </b></th> 
                        

                        </tr>
                    </thead>';

            $html .= '<tbody>';  

            $xx = 1;

            foreach ($product_communication as $key => $c) {
                if($c->day == 1) {
                    $html .= '<tr style="text-align:left">';
                        $html .= '<td>'.$xx.'</td>';
                        $html .= '<td>'.$c->doctor.'</td>';
                        $html .= '<td>'.$c->biomedis_product.'</td>';
                        $html .= '<td>'.$c->rating_per_md.'</td>';
                        $html .= '<td>'.$c->remarks.'</td>';
                    $html .= '</tr>';

                    $xx++;
                }

               
               
            }

        $html .= '</tbody></table>';


        if($datefrom_ != $dateto_) {
             $html .= '<table>
                    <thead>
                        <tr style="color:white;background-color:#6c6c6c; text-align:left">
                            <th>'.$dateto_.'</th>
                           <th><b>Name of MD/Client</b></th> 
                            <th><b>Biomedis Product</b></th> 
                            <th><b> Rating per MD </b></th> 
                            <th><b> Remarks </b></th> 
                        

                        </tr>
                    </thead>';

            $html .= '<tbody>';


             $xy = 1;

            foreach ($product_communication as $key => $c) {
                if($c->day == 2) {
                    $html .= '<tr style="text-align:left">';
                        $html .= '<td>'.$xy.'</td>';
                        $html .= '<td>'.$c->doctor.'</td>';
                        $html .= '<td>'.$c->biomedis_product.'</td>';
                        $html .= '<td>'.$c->rating_per_md.'</td>';
                        $html .= '<td>'.$c->remarks.'</td>';
                    $html .= '</tr>';

                    $xy++;
                }

               
               
            }

             $html .= '</tbody></table>';

        }




        $html .= '<br>';

        $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
            <span><b>SURVEY ON DRUGSTORES AND PHARMACIES</b></span>
          </div>';

        $html .= '<br>';


        $html .= '<table>
                    <thead>
                        <tr style="color:white;background-color:#6c6c6c; text-align:left">
                           <th><b>'.$datefrom_.'</b></th> 
                                <th><b> Outlet </b></th> 
                                <th><b> Address </b></th> 
                                <th><b> Remarks </b></th> 
                        

                        </tr>
                    </thead> 
                        
                    <tbody>';


                     $q = 1; foreach ($survey as $key => $c) {

                        if($c->day == 1) {

                            $html .= '<tr style="text-align:left">
                                        <td>'.$q.'</td>';
                            $html .= '<td>'.$c->outlet.'</td>';
                            $html .= '<td>'.$c->address.'</td>';
                            $html .= '<td>'.$c->remarks.'</td>';
                            $html .= '</tr>';

                            $q++;
                        }
                       
                    }

        $html .= '</tbody></table>';

        if($datefrom_ != $dateto_) {
            $html .= '<table>
                        <thead>
                            <tr style="color:white;background-color:#6c6c6c; text-align:left">
                               <th><b>'.$dateto_.'</b></th> 
                                    <th><b> Outlet </b></th> 
                                    <th><b> Address </b></th> 
                                    <th><b> Remarks </b></th> 
                            

                            </tr>
                        </thead> 
                            
                        <tbody>';


                         $w = 1; foreach ($survey as $key => $c) {

                            if($c->day == 2) {

                                $html .= '<tr style="text-align:left">
                                            <td>'.$w.'</td>';
                                $html .= '<td>'.$c->outlet.'</td>';
                                $html .= '<td>'.$c->address.'</td>';
                                $html .= '<td>'.$c->remarks.'</td>';
                                $html .= '</tr>';

                                $w++;
                            }
                           
                        }

            $html .= '</tbody></table>';

             }


            $html .= '<br>';

            $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">';
            $html .= "<span><b>COMPETITOR'S ACTIVITY REPORT</b></span></div>";
                

            $html .= '<br>';

            $html .= '<table>
                    <thead>
                        <tr style="color:white;background-color:#6c6c6c; text-align:left">
                           <th><b>Company/Product</b></th> 
                            <th><b>Details of Promotional Activities</b></th> 
                            <th><b>Plan of Action</b></th> 
                        

                        </tr>
                    </thead> 
                        
                    <tbody>';

                    foreach ($competitors_activity as $key => $c) {
                         $html .= '<tr style="text-align:left">';
                        $html .= '<td>'.$c->company.'</td>';
                        $html .= '<td>'.$c->details.'</td>';
                        $html .= '<td>'.$c->plan_of_action.'</td>';
                        $html .= '</tr>';

                       
                    }

            $html .= '</tbody></table>';

            $html .= '<br>';

            $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
                <span><b>ACTIVITY AND STARS MONITORING SHEET</b></span>
              </div>';

              $html .= '<br>';

            // $html .= '<div style="width:100%;margin:0px">MARKETING PROGRAMS IMPLEMENTATION</div>';
            // $html .= '<div style="width:100%;margin:0px">Period Covered: '.$employee_competency[0]->date_of_ojl.'</div>';

            $html .= '<table>
                    <thead>';

                    $html .= '<tr>';
                        $html .= '<td>MARKETING PROGRAMS IMPLEMENTATION</td>';
                    $html .= '</tr>';

                    $html .= '<tr>';
                        $html .= '<td>Period Covered: '.$employee_competency[0]->date_of_ojl.'</td>';
                    $html .= '</tr>';

            $html .= '</thead></table>';

            $html .= '<br>';
 
            $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
                <span><b>PLANNED</b></span>
              </div>';

               $html .= '<table>
                    <thead>
                        <tr style="color:white;background-color:#6c6c6c; text-align:left">
                           <th><b>Product</b></th> 
                            <th><b>Name of Program</b></th> 
                            <th><b>Planned</b></th> 
                            <th><b>Actual</b></th> 
                            <th><b>%Perf</b></th>
                            <th><b>Date Implemented</b></th>
                            <th><b>Remarks/Next Schedule</b></th>
                        </tr>
                    </thead> 
                        
                    <tbody>';

                    $mp_status = $mp[0]->status;

                    if($mp_status == 2) {
                        foreach ($planned as $key => $c) {

                            if($c->plan_type == 1){
                                $html .= '<tr style="text-align:left">';
                            $html .= '<td>'.$c->product.'</td>';
                            $html .= '<td>'.$c->name_of_program.'</td>';
                            $html .= '<td>'.$c->planned.'</td>';
                            $html .= '<td>'.$c->actual.'</td>';
                            $html .= '<td>'.$c->perf.'</td>';
                            $html .= '<td>'.$c->date_impletemented.'</td>';
                            $html .= '<td>'.$c->remarks.'</td>';
                            $html .= '</tr>';

                            }
                             
                           
                        }

                    }

                    

                $html .= '</tbody></table>';


            $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
                <span><b>PROGRAMS IMPLEMENTED ON TOP OF PLANNED</b></span>
              </div>';

              $html .= '<table>
                    <thead>
                        <tr style="color:white;background-color:#6c6c6c; text-align:left">
                           <th><b>Product</b></th> 
                            <th><b>Name of Program</b></th> 
                            <th><b>Planned</b></th> 
                            <th><b>Actual</b></th> 
                            <th><b>%Perf</b></th>
                            <th><b>Date Implemented</b></th>
                            <th><b>Remarks/Next Schedule</b></th>
                        </tr>
                    </thead> 
                        
                    <tbody>';

                    if($mp_status == 2) {
                        foreach ($planned as $key => $c) {

                            if($c->plan_type == 2){
                                $html .= '<tr style="text-align:left">';
                             $html .= '<td>'.$c->product.'</td>';
                            $html .= '<td>'.$c->name_of_program.'</td>';
                            $html .= '<td>'.$c->planned.'</td>';
                            $html .= '<td>'.$c->actual.'</td>';
                            $html .= '<td>'.$c->perf.'</td>';
                            $html .= '<td>'.$c->date_impletemented.'</td>';
                            $html .= '<td>'.$c->remarks.'</td>';
                            $html .= '</tr>';

                            }
                             
                           
                        }
                    }

                $html .= '</tbody></table>';

                if($mp_status == 2) {

                foreach($functional_expertise as $key => $c) {

                    if($c->type == 1) {
                        $heads = 'Care';
                    } else if($c->type == 2) {
                        $heads = 'Grow';
                    } else if($c->type == 3) {
                        $heads = 'Integrate';
                    } else if($c->type == 4) {
                        $heads = 'Execute';
                    } else if($c->type == 5) {
                        $heads = 'Transform';
                    } 

                    $html .= '<table>
                        <thead>
                        <tr  style="color:white;background-color:#012873; text-align:center">
                           <th colspan="2"><b>Competency Exhibit: '.$heads.'</b></th> 
                            
                        </tr>
                    </thead> <tbody>';

                    $html .= '<tr>';
                    $html .= '<td style="text-align:center">Situation/Task</td>';
                    $html .= '<td style="text-align:center">'.$c->situation_task.'</td>';
                   
                    $html .= '</tr>';

                    $html .= '<tr>';
                    $html .= '<td style="text-align:center">Action</td>';
                    $html .= '<td style="text-align:center">'.$c->action.'</td>';
                   
                    $html .= '</tr>';

                    $html .= '<tr>';
                    $html .= '<td style="text-align:center">Result</td>';
                    $html .= '<td style="text-align:center">'.$c->result.'</td>';
                   
                    $html .= '</tr>';
              

                    $html .= '</tbody></table>';
                }
            }

            $html .= '<br>';

            $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">
                <span><b>EVALUATION, AGREEMENTS AND DIRECTIONS</b></span>
              </div>';

            $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">';
            $html .= "<span><b>  DISTRICT MANAGER'S ACTION PLAN</b></span></div>";

            $html .= '<div style="">';
            $html .= "<span>".$evaluation[0]->dm_action_plan."</div>";

            $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">';
            $html .= "<span><b>  PSR'S ACTION PLAN</b></span></div>";

            $html .= '<div style="">';
            $html .= "<span>".$evaluation[0]->psr_action_plan."</div>";

            $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">';
            $html .= "<span><b>  OM'S REMARKS</b></span></div>";

            $html .= '<div style="">';
            $html .= "<span>".$evaluation[0]->om_remarks."</div>";

            $html .= '<div style="width:100%;height:20px;padding:3px;background-color:#012873;color:white">';
            $html .= "<span><b>  ISSUES AND CONCERNS</b></span></div>";

            $html .= '<div style="">';
            $html .= "<span>".$evaluation[0]->issues_and_remarks."</div>";

       

         $pdf->writeHTML($html, true, false, true, false, '');   

        $pdf->Output('test.pdf');
            

        }


}