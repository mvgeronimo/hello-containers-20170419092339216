<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>

<?php 
		 //echo '<pre>'; print_r($agenda); 
		 //echo '<pre>'; print_r($action_plan); 
		//echo '<pre>'; print_r($itenerary);

		 foreach($agenda as $value) {
		 		$agenda_id = $value->agenda_id;
		 		$dm = $value->dm;

		 		$type = $value->type;


		 		$date_from = $value->date_from;
		 		$datefrom = date_create($date_from);
		 		$day1 = date_format($datefrom, 'F d, Y');
		 		
		 		
		 		$date_to = $value->date_to;
		 		$dateto = date_create($date_to);
		 		$day2 = date_format($dateto, 'F d, Y');
		 		

		 		if($date_from == $date_to) {
		 			$date_of_ojl = $day1;
		 		} else {
		 			$datefrom = date_format($datefrom, 'F d');
		 			$dateto = date_format($dateto, 'd, Y');
		 			$date_of_ojl = $datefrom.'-'.$dateto;
		 		}
		 		
		 		

		 		$psr = $value->psr;
		 		$territory = $value->territory;
		 		$salary = $value->salary;
		 		$competency = $value->competency_standards;

		 }



		 
        
?>

<style type="text/css">

	.pad-0 {
		padding:0px;
	}
	.margin-top-20 {
		margin-top:20px;
	}
	.business-div {
		border:1px solid white;
		border-bottom:none;
		/*background-color:#d0d8e8*/
	}
	.business-item {
		border:1px solid white;
		border-bottom:none;
		border-top: none;
		/*background-color:#d0d8e8*/
	}
	.people-div {
		border:1px solid white;
		border-bottom:none;
		/*background-color:#e9edf4*/
	}

	.people-item {
		border:1px solid white;
		border-bottom:none;
		border-top: none;
		/*background-color:#e9edf4*/
	}
	.bootbox-alert {
		top: 37px;
	}
</style>

<script type="text/javascript">
$(document).ready(function() {

	var agenda_type = $('.agenda_type').val();
	if(agenda_type == 1) {
		$('.btn_new_version').show();
	} else {
		$('.btn_new_version').hide();
	}

	$('.btn_conforme').click(function() {
		var psr_remarks = $('.psr_action_plan').val();
		var agenda_id = $('.agenda_id').val();
		var om_remarks = $('.om_action_plan').val();
		var user = $('.user').val();
		if(user == 'psr') {
			$.ajax({
				type:'post',
				url:'<?=base_url();?>home/psr_conforme',
				data:{'psr_action_plan':psr_remarks, 'agenda_id':agenda_id}
			}).done(function() {

				$.ajax({
					type:'post',
					url:'<?=base_url();?>Agenda/sendMail_psr',
					data:{'agenda_id':agenda_id}
				}).done(function() {
						$.ajax({
							type:'post',
							url:'<?=base_url();?>Agenda/sendMail_dm_by_psr',
							data:{'agenda_id':agenda_id}
						}).done(function() {
							
							bootbox.alert("<b>The OJL Report has been forwarded to OM for acknowledgment.</b>");
							location.reload();
						})
					
				
				})
				
			})
		} else {
			$.ajax({
				type:'post',
				url:'<?=base_url();?>home/om_aknowledge',
				data:{'om_remarks':om_remarks, 'agenda_id':agenda_id}
			}).done(function() {

				$.ajax({
					type:'post',
					url:'<?=base_url();?>Agenda/sendMail_om',
					data:{'agenda_id':agenda_id}
				}).done(function() {

						$.ajax({
							type:'post',
							url:'<?=base_url();?>Agenda/sendMail_dm_by_om',
							data:{'agenda_id':agenda_id}
						}).done(function() {
							bootbox.alert("<b>The OJL report has been forwarded to your division's training department.</b>");
							location.reload();
						})

				})
				
			})
		}
		
	})

	var dm = $('.hidden_dm').val();
	var psr = $('.hidden_psr').val();

	$.ajax({
	     type:'get',
	     url:'http://abig.unilab.ph/WebAPI_BiomedisOJL/api/performance/callrates',
	     data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'year':'2016'}
	    }).done(function(result) {
	    	var cycle = '';
	    	var rate = ''
	    	var header = 0;
	     	$.each(result, function(x,y) {
	     		cycle+='<td>'+y.Cycle+'</td>';
	     		rate += '<td>'+y.ActualCallRate+'</td>';
	     		header++;
	     	})

	     	$('.cycle').append(cycle);
	     	$('.rate').append(rate);
	     	$('.cycle_header').attr('colspan', header);

	    })



	$('.btn_to_calendar').click(function() {
		window.location = '<?=base_url();?>ojl_schedule';
	})

	get_rates();

	function get_rates() {
	var dm = $('.hidden_dm').val();
	var psr = $('.hidden_psr').val();
	$.ajax({
         type:'get',
         url:'http://abig.unilab.ph/WebAPI_BiomedisOJL/api/performance/exams',
         data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'year':'2016'}
        }).done(function(result) {
        	var htm = '';
        	var obj = result;
        	console.log(obj);
       		var agenda_status = $('.hidden_agenda_status').val();

        	$.each(obj, function(x,y) {
        		var mth = y.StartDateTime;
        		var month = mth.substring(5, 7);
        		var n = y.ExamAverage;
        		(Math.round( n * 100 )/100 ).toString();
				
        		
        		if(month == '01') {
        			$('.month_1').html(n);
        		} else if(month == '02') {
        			$('.month_2').html(n.toFixed(2));
        		} else if(month == '03') {
        			$('.month_3').html(n.toFixed(2));
        		} else if(month == '04') {
        			$('.month_4').html(n.toFixed(2));
        		} else if(month == '05') {
        			$('.month_5').html(n.toFixed(2));
        		} else if(month == '06') {
        			$('.month_6').html(n.toFixed(2));
        		} else if(month == '07') {
        			$('.month_7').html(n.toFixed(2));
        		} else if(month == '08') {
        			$('.month_8').html(n.toFixed(2));
        		} else if(month == '09') {
        			$('.month_9').html(n.toFixed(2));
        		} else if(month == '10') {
        			$('.month_10').html(n.toFixed(2));
        		} else if(month == '11') {
        			$('.month_11').html(n.toFixed(2));
        		} else if(month == '12') {
        			$('.month_12').html(n.toFixed(2));
        		}
        	})


			
        })
}
})
</script>

<?php //echo '<pre>'; print_r($itenerary); ?>

<input type="hidden" class="agenda_id" value="<?=$agenda_id?>">
<input type="hidden" class="agenda_type" value="<?=$type?>">
<input type="hidden" class="hidden_dm" value="<?=$agenda[0]->user_id;?>">
<input type="hidden" class="hidden_psr" value="<?=$agenda[0]->psr_id;?>">

<input type="hidden" class="user" value="<?=$user;?>">

<div class="col-md-12 new_version_container" style="background-color:white">
	<div class="col-md-12">
		<div class="col-md-2"></div>

		<div class="col-md-10" style="margin-bottom:10px;">
			<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL SCHEDULE</p>
			<p class="darkblue-font" style="font-size:50px"><?=($user=='psr') ? "PSR'S VIEW" : "OM'S VIEW"?></p>
		</div>
	</div>

	<div class="col-md-6">
		<!-- <button class="darkblue-bg darkblue-btn btn_to_calendar"><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp; Back</button> -->
	</div>
	<div class="col-md-6" style="text-align:right">
		<!-- <button class="darkblue-bg darkblue-btn btn_new_version">New Version</button> -->
	</div>

	<div class="col-md-12" style="text-align:right">
		<?php 

		$then = date('Y-m-d', strtotime($date_to));

		//$then = date_format($date_to, 'Y-m-d');
        $subdate = date_create($evaluation[0]->dm_date_from);
        $submitted_date = date_format($subdate, 'Y-m-d');

        if($submitted_date < date('Y-m-d')) {
            $what = 'less';
        } else {
            $what = 'greater';
        }


        $then = strtotime($then);
         $om_date = strtotime($submitted_date);
        $diff = ceil(abs($om_date - $then) / 86400);



			//if($what != 'less') {
	            if($diff > 6) {
	            	if($user == 'om') {
	     ?>
	     	<b style="color:red"><?//=$subdate;?>LATE SUBMISSION</b>
	    <?php
	    			}
	            }
	  //      }

		?>
	</div>

	<div class="col-md-12">

		<div class="col-md-12 pad-0 agenda_details margin-top-20">
			<div class="col-md-2 margin-top-20px"><b>Name of District Manager: </b></div>
			<div class="col-md-4 margin-top-20px"><?= $dm; ?></div>
			<div class="col-md-2 margin-top-20px"><b>Date of OJL: </b></div>
			<div class="col-md-4 margin-top-20px"><?= $date_of_ojl; ?></div>

			<div class="col-md-2 margin-top-20px"><b>Name of PSR: </b></div>
			<div class="col-md-4 margin-top-20px"><?= $psr; ?></div>
			<div class="col-md-2 margin-top-20px"><b>Name of Territory: </b></div>
			<div class="col-md-4 margin-top-20px"><?= $territory; ?></div>

			<div class="col-md-2 margin-top-20px"><b>Salary Grade: </b></div>
			<div class="col-md-4 margin-top-20px"><?= $salary; ?></div>
			<div class="col-md-2 margin-top-20px"><b>Competency Standards: </b></div>
			<div class="col-md-4 margin-top-20px"><?= $competency; ?></div>
		</div>

		<div class="col-md-12 margin-top-20 darkblue-bg darkblue-btn">
			<b>AGENDA</b>
		</div>

		<div class="col-md-12 pad-0" style="margin-top:10px">
			<div class="col-md-4 darkblue-bg darkblue-btn" style="background-color:#6c6c6c"><b>AGENDA</b></div>
			<div class="col-md-8 darkblue-bg darkblue-btn" style="background-color:#6c6c6c"><b>SPECIFIC ACTION PLANS</b></div>

			<div class="col-md-12 business-div darkblue-font" style="font-size:17px"><b>BUSINESS DEVELOPMENT</b></div>
			

			<?php foreach($action_plan as $val) { 
				if($val->actionPlanType == 1) {
				?>

				<div class="col-md-4 business-item" style="margin-bottom:30px"><?= $val->agenda_name; ?></div>
				<div class="col-md-8 business-item" style="margin-bottom:30px"><?= $val->specific_plans; ?></div>

			<?php } }?>

			<div class="col-md-12 people-div darkblue-font" style="font-size:17px"><b>PEOPLE DEVELOPMENT</b></div>
			

			<?php foreach($action_plan as $val) { 
				if($val->actionPlanType == 2) {
				?>

				<div class="col-md-4 people-item" style="margin-bottom:30px"><?= $val->agenda_name; ?></div>
				<div class="col-md-8 people-item" style="margin-bottom:30px"><?= $val->specific_plans; ?></div>

			<?php } }?>

		</div>

		<div class="col-md-12 margin-top-20 darkblue-btn darkblue-bg">
			<b>ITINERARY</b>
		</div>

		<div class="col-md-12 pad-0">
			
			<table class="dotors_table margintop-10">
				<thead class="darkblue-btn darkblue-bg" style="background-color:#6c6c6c;margin-top:10px">
					<th></th>
					<th>HOSPITAL / ADDRESS</th>
				<!-- 	<th>HOSPITAL</th> -->
					<th>FOCUS MD / CLIENT</th>
				</thead>

				<tbody>
					<?php $x=1; foreach($itenerary as $val) { 
						if($val->day == 1) {
						?>
						<tr>
							<td>DAY 1</td>
							<td><?= $val->doctor_address; ?></td>
						<!-- 	<td>HOSPITAL<?= $x; ?></td>
 -->							<td><?= $val->doctor; ?></td>
						</tr>
				
					<?php $x++; } } ?>

					<?php $x=1; foreach($itenerary as $val) { 
						if($val->day == 2) {
						?>
						<tr>
							<td>DAY 2</td>
							<td><?=  $val->doctor_address; ?></td>
							<!-- <td>HOSPITAL<?= $x; ?></td> -->
							<td><?=  $val->doctor; ?></td>
						</tr>
				
					<?php $x++; } } ?>
				</tbody>
			</table>

		</div>

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>SALES PLAN FOR THE MONTH</b>
		</div>

		<div class="col-md-12 pad-0">
			<table class="sales_plan_tbl margintop-10">
				<thead class="darkblue-btn darkblue-bg" style="background-color:#bd1a3d;margin-top:10px">
					<th>YTD DS</th>
					<th>YTD IS</th>
					<th>YTD ST</th>
					<th>YTD QUOTA</th>
					<th>YTD FY</th>
					<th>TO GO</th>
					<th>REMARKS</th>
				</thead>

				<tbody>
					<?php foreach($sales_plan as $key => $c) { ?>
						<tr>
							<td><?=number_format($c->grossup_ytd_ds, 2, '.', ',') ?></td>
							<td><?=number_format($c->grossup_ytd_is, 2, '.', ',') ?></td>
							<td><?=number_format($c->grossup_ytd_st, 2, '.', ',')?></td>
							<td><?=number_format($c->quota_ytd, 2, '.', ',') ?></td>
							<td><?=number_format($c->quota_fy, 2, '.', ',')?></td>
							<td><?=number_format($c->quota_togo, 2, '.', ',') ?></td>
							<td><?=$c->remarks; ?></td>
						</tr>
					<?php } ?>
				</tbody>

			</table>
		</div>

		 <div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>COVERAGE PERFORMANCE MONITORING</b>
		</div>

		<div class="col-md-12 pad-0">
			<table class="cp_monitoring_table sales_plan_tbl col-sm-12 col-md-12 col-lg-12 margintop-10">

				<tbody>
					<tr>
						
						<td class="cycle_header darkblue-bg" colspan=""><b>CYCLE</b></th>
					</tr>

					<tr class="cycle" style="background-color:grey">
					</tr> 

					<tr class="rate">
					</tr>
				</tbody>
			</table>
		</div>

		<br>

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>EMPLOYEE COMPETENCY DEVELOPMENT</b>
		</div>

		<br>

		<div class="col-md-12 margin-top-20">
			<div class="col-md-2">
				<b>Name of PSR:</b>
			</div>

			<div class="col-md-4">
				<?= $employee_competency[0]->psr_name; ?>
			</div>

			<div class="col-md-2">
				<b>Date of OJL:</b>
			</div>

			<div class="col-md-4">
				<?= $employee_competency[0]->date_of_ojl; ?>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
				<b>Salary Grade:</b>
			</div>
			
			<div class="col-md-4">
				<?= $employee_competency[0]->salary_grade; ?>
			</div>

			<div class="col-md-2">
				<b>Competency Standard:</b>
			</div>

			<div class="col-md-4">
				<?= $employee_competency[0]->competency_standard; ?>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
				<b>Territory:</b>
			</div>
			
			<div class="col-md-4">
				<?= $employee_competency[0]->territory; ?>
			</div>

			<div class="col-md-2">
				<b>Areas for Improvement:</b>
			</div>

			<div class="col-md-4">
				<?= $employee_competency[0]->areas_of_improvement; ?>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
				<b>Last Promotion Date:</b>
			</div>
			
			<div class="col-md-4">
				<?= $employee_competency[0]->last_promotion_date; ?>
			</div>

			<div class="col-md-2">
				<b>Training Intervention:</b>
			</div>

			<div class="col-md-4">
				<?= $employee_competency[0]->training_intervention; ?>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
				<b>Rating:</b>
			</div>
			
			<div class="col-md-4">
				<table border="1" style="text-align: center;">
                    <thead></thead>
                    <tbody>
                    <tr>
                    <?php
                        $year_today = date('Y');
                        $year_minus2 = $year_today - 2;
                        $year_plus1 = $year_today + 1;

                        $year = $year_minus2;
                        
                        for($x=1; $x<=4; $x++){
                            
                        $y = 1;
                        while($y<=2){
                            
                    ?>
                    <td>S<?=$y." ".$year?></td>
                    <?php 
                    if($y==2){
                        $year++;
                    }
                        $y++;
                        if($year==$year_plus1){
                            $y++;
                        }
                    } ?>

                    <?php } ?>
                    </tr>
                   <tr>
                    <?php
                        $year_today = date('Y');
                        $year_minus2 = $year_today - 2;
                        $year_plus1 = $year_today + 1;

                        $year = $year_minus2;
                        
                        for($x=1; $x<=4; $x++){
                            
                        $y = 1;
                        while($y<=2){
                            
                    ?>
                    <td><?=(isset($rating_data[$year][$y]->rating)) ? $rating_data[$year][$y]->rating : ''?></td>
                    <?php 
                    if($y==2){
                        $year++;
                    }
                        $y++;
                        if($year==$year_plus1){
                            $y++;
                        }
                    } ?>

                    <?php } ?>
                    </tr>


                    </tbody>


                </table>

			</div>

			<div class="col-md-2">
				
			</div>

			<div class="col-md-4">
				
			</div>
		</div>

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20" style="text-align:center">
			<b>INDIVIDUAL DEVELOPMENT PLAN</b>
		</div>

		<div class="col-md-6 darkblue-btn darkblue-bg margin-top-20" style="text-align:center">
			<b>SKILLS TO BE DEVELOPED</b>
		</div>

		<div class="col-md-6 darkblue-btn darkblue-bg margin-top-20" style="text-align:center">
			<b>DEVELOPMENTAL ACTIVITY</b>
		</div>

		<?php foreach($idp as $key => $c) { ?>
			<div class="col-md-6" style="text-align:center">
				<?=$c->skills_to_developed;?>
			</div>

			<div class="col-md-6" style="text-align:center">
				<?=$c->development_activity;?>
			</div>

		<?php } ?>

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20" style="text-align:center">
			<b>ULEARN ACCOMPLISHMENT UPDATE</b>
		</div>

		<div class="col-md-4 darkblue-btn darkblue-bg margin-top-20" style="text-align:center">
			<b>COURSE TITLE</b>
		</div>

		<div class="col-md-4 darkblue-btn darkblue-bg margin-top-20" style="text-align:center">
			<b>COMPLETION DATE</b>
		</div>

		<div class="col-md-4 darkblue-btn darkblue-bg margin-top-20" style="text-align:center">
			<b>LEARNING APPLICATION</b>
		</div>

		<?php foreach($ulearn as $key => $c) { ?>
			<div class="col-md-4" style="text-align:center">
				<?=$c->course_title;?>
			</div>

			<div class="col-md-4" style="text-align:center">
				<?=$c->completion_date;?>
			</div>

			<div class="col-md-4" style="text-align:center">
				<?=$c->learning_application;?>
			</div>

		<?php } ?>


		<div class="clear">
            <div class="col-sm-12 col-md-6 col-lg-6 no-padding">
                <label class="form-label"><h4>On-line Exam Monitoring</h4></label>
            </div>
        </div>

        <table class="table table-bordered col-sm-12 col-md-12 col-lg-12 OLE-Monitoring-table no-padding"> 
            <tbody> 
                <tr>
                    <td rowspan="2"> </td> 
                    <td colspan="13" class="darkblue-bg" style="text-align:center"> Months </td>
                </tr> 
          
                <tr>
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
                    <td> % Perf </td>
                    <td class="month_1">  </td>
                    <td class="month_2">  </td>
                    <td class="month_3">  </td>
                    <td class="month_4">  </td>
                    <td class="month_5">  </td>
                    <td class="month_6">  </td>
                    <td class="month_7">  </td>
                    <td class="month_8">  </td>
                    <td class="month_9">  </td>
                    <td class="month_10">  </td>
                    <td class="month_11">  </td>
                    <td class="month_12">  </td>
                </tr>

            </tbody>
        </table>


		<br>

		 <div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>OJL COMPLETION</b>
		</div>

		 <div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>CLIENT ENGAGEMENT</b>
		</div>

		<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
			<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
				<thead class="darkblue-bg">
					<tr>
						<th style="width:19%"><?= $datefrom_; ?></th> 
						<th style="width:27%">Name of MD/Client </th> 
						<th style="width:27%"> Hospital/Clinic Address </th> 
						<th style="width:27%"> Remarks/Higlight of Visit </th> 
					</tr> 
				</thead>

				<tbody>

					<?php $x = 1; foreach($client_engagement as $key => $c) { 
						if($c->day == 1) {
						?>
						<tr>
							<td><?=$x;?></td>
                            <td><?=$c->doctor;?></td>
                            <td><?=$c->doctor_address;?></td>
                            <td><?=$c->remarks;?></td>
						</tr>
							
					<?php $x++; } } ?>

				</tbody>

			</table>

			<?php if($datefrom_ != $dateto_) { ?>
				<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
					<thead class="darkblue-bg">
						<tr>
							<th style="width:19%"><?= $dateto_; ?></th> 
							<th style="width:27%">Name of MD/Client </th> 
							<th style="width:27%"> Hospital/Clinic Address </th> 
							<th style="width:27%"> Remarks/Higlight of Visit </th> 
						</tr> 
					</thead>

					<tbody>

						<?php $y = 1; foreach($client_engagement as $key => $c) { 
							if($c->day == 2) {
							?>
							<tr>
								<td><?=$y;?></td>
	                            <td><?=$c->doctor;?></td>
	                            <td><?=$c->doctor_address;?></td>
	                            <td><?=$c->remarks;?></td>
							</tr>
								
						<?php $y++; } } ?>

					</tbody>

				</table>

			<?php } ?>
		</div>

	

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>PRODUCT COMMUNICATION EXERCISE</b>
		</div>

		<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
			<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
				<thead class="darkblue-bg">
					<tr>
						<th style="width:20%"><?=$datefrom_;?></th>
						<th style="width:20%">Name of MD/Client</th> 
						<th style="width:20%">Biomedis Product</th> 
						<th style="width:20%"> Rating per MD </th> 
						<th style="width:20%"> Remarks </th> 
					
					</tr> 
				</thead>


				   <tbody>
				   	<?php $x = 1; foreach ($product_communication as $key => $c): 
				   		if($c->day == 1) {

				   	?>
				   		
				   		<tr>
				   			<td><?=$x;?></td>
							<td><?= $c->doctor; ?> </td>
							<td><?= $c->biomedis_product; ?></td>
							<td><?= $c->rating_per_md; ?></td>
							<td><?= $c->remarks; ?></td>
    								
    					</tr>
				   	<?php 

				   	$x++; }
				   	endforeach ?>

				  </tbody>
    		</table>


    		<?php if($datefrom_ != $dateto_) { ?>

    			<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
					<thead class="darkblue-bg">
						<tr>
							<th style="width:20%"><?=$dateto_;?></th>
							<th style="width:20%">Name of MD/Client</th> 
							<th style="width:20%">Biomedis Product</th> 
							<th style="width:20%"> Rating per MD </th> 
							<th style="width:20%"> Remarks </th> 
						
						</tr> 
					</thead>


					   <tbody>
					   	<?php $y = 1; foreach ($product_communication as $key => $c): 
					   		if($c->day == 2) {

					   	?>
					   		
					   		<tr>
					   			<td><?=$y;?></td>
								<td><?= $c->doctor; ?> </td>
								<td><?= $c->biomedis_product; ?></td>
								<td><?= $c->rating_per_md; ?></td>
								<td><?= $c->remarks; ?></td>
	    								
	    					</tr>
					   	<?php 

					   	$y++; }
					   	endforeach ?>

					  </tbody>
	    		</table>

    		<?php } ?>

		</div>

		<br>

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>SURVEY ON DRUGSTORES AND PHARMACIES</b>
		</div>

		<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
			<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
				<thead class="darkblue-bg">
					<tr>
						<th style="width:20%"><?=$datefrom_;?></th> 
						<th style="width:26%"> Outlet </th> 
						<th style="width:27%"> Address </th> 
						<th style="width:27%"> Remarks </th> 
					</tr> 
				</thead>

				<tbody>

					<?php $q = 1; foreach ($survey as $key => $c): 
						if($c->day == 1) {
					?>
						<tr>
                          <td><?= $q; ?></td>
                          <td><?=$c->outlet;?></td>
                          <td><?=$c->address;?></td>
                          <td><?=$c->remarks;?></td>
                        </tr>
					<?php $q++; } endforeach ?>

				</tbody>

    		</table>

    		<?php if($datefrom_ != $dateto_) { ?>
    			<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
				<thead class="darkblue-bg">
					<tr>
						<th style="width:20%"><?=$dateto_;?></th> 
						<th style="width:26%"> Outlet </th> 
						<th style="width:27%"> Address </th> 
						<th style="width:27%"> Remarks </th> 
					</tr> 
				</thead>

				<tbody>

					<?php $w = 1; foreach ($survey as $key => $c): 
						if($c->day == 2) {
					?>
						<tr>
                          <td><?= $w; ?></td>
                          <td><?=$c->outlet;?></td>
                          <td><?=$c->address;?></td>
                          <td><?=$c->remarks;?></td>
                        </tr>
					<?php $w++; } endforeach ?>

				</tbody>

    		</table>

    		<?php } ?>

		</div>

		<br>

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>COMPETITOR'S ACTIVITY REPORT</b>
		</div>

		<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
			<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
				<thead class="darkblue-bg">
					<tr>
						<th> Company/Product </th> 
						<th> Details of Promotional Activities </th> 
						<th> Plan of Action </th> 
					 
					</tr> 
				</thead>
				<tbody>

					<?php foreach ($competitors_activity as $key => $c): ?>
						<tr>
	                      <td><?= $c->company; ?></td>
	                      <td><?= $c->details; ?></td>
	                      <td><?= $c->plan_of_action; ?></td>
	                    </tr>
					<?php endforeach ?>

				</tbody>

    		</table>


		</div>

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>ACTIVITY AND STARS MONITORING</b>
		</div>


		<div class="col-md-12 margin-top-20">
			<p><b>MARKETING PROGRAMS IMPLEMENTATION</b></p>
			<p>Period Covered: <?=$employee_competency[0]->date_of_ojl?></p>
		</div>

		<div class="col-md-12 darkblue-btn darkblue-bg">
			<b>PLANNED</b>
		</div>
		 

		<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
			<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
				<thead class="darkblue-bg">
					<tr>
						<th><b>Product</b></th> 
                        <th><b>Name of Program</b></th> 
                        <th><b>Planned</b></th> 
                        <th><b>Actual</b></th> 
                        <th><b>%Perf</b></th>
                        <th><b>Date Implemented</b></th>
                        <th><b>Remarks / Next Schedule</b></th>
					</tr> 
				</thead>
				<tbody>


					<?php if($mp_status == 2) {

					 foreach ($planned as $key => $c) {
						if($c->plan_type==1) {
					?>
						<tr>
	                      <td><?= $c->product; ?></td>
	                      <td><?= $c->name_of_program; ?></td>
	                      <td><?= $c->planned; ?></td>
	                      <td><?= $c->actual; ?></td>
	                      <td><?= $c->perf; ?></td>
	                      <td><?= $c->date_impletemented; ?></td>
	                      <td><?= $c->remarks; ?></td>
	                    </tr>
					<?php } } } ?>

				</tbody>

    		</table>


		</div>

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>PROGRAMS IMPLEMENTED ON TOP OF PLANNED</b>
		</div>
		 

		<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
			<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
				<thead class="darkblue-bg">
					<tr>
						<th><b>Product</b></th> 
                        <th><b>Name of Program</b></th> 
                        <th><b>Planned</b></th> 
                        <th><b>Actual</b></th> 
                        <th><b>%Perf</b></th>
                        <th><b>Date Implemented</b></th>
                        <th><b>Remarks / Next Schedule</b></th>
					</tr> 
				</thead>
				<tbody>

					
					<?php if($mp_status == 2) {

					 foreach ($planned as $key => $c) {
						if($c->plan_type==2) {
					?>
						<tr>
	                      <td><?= $c->product; ?></td>
	                      <td><?= $c->name_of_program; ?></td>
	                      <td><?= $c->planned; ?></td>
	                      <td><?= $c->actual; ?></td>
	                      <td><?= $c->perf; ?></td>
	                      <td><?= $c->date_impletemented; ?></td>
	                      <td><?= $c->remarks; ?></td>
	                    </tr>
					<?php } } } ?>

				</tbody>

    		</table>


		</div>

		<?php if($mp_status == 2) {
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
		?>
			<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 no-padding"> 
				<thead class="darkblue-bg">
					<tr>
						 <tr  style="color:white;background-color:#012873; text-align:center">
                           <th colspan="2"><b>Competency Exhibit: <?=$heads;?></b></th> 
                            
                        </tr>
					</tr> 
				</thead>

				<tbody>

					 <tr style="background-color:#f3f2f0">
                		<td style="text-align:center;width:50%">Situation/Task</td>
                  		<td style="text-align:center"><?=$c->situation_task;?></td>
                    </tr>

                    <tr style="background-color:#dcd9d5">
                		<td style="text-align:center;width:50%">Action</td>
                  		<td style="text-align:center"><?=$c->action;?></td>
                    </tr>

                    <tr style="background-color:#f3f2f0">
                		<td style="text-align:center;width:50%">Result</td>
                  		<td style="text-align:center"><?=$c->result;?></td>
                    </tr>

				</tbody>

			</table>



		<?php } }?>

		<div class="col-md-12 darkblue-btn darkblue-bg margin-top-20">
			<b>EVALUATION, AGREEMENTS AND DIRECTIONS</b>
		</div>

		

		<div class="col-md-12 pad-0 margin-top-20">
			<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DISTRICT MANAGER'S ACTION PLAN</b></div>

			<div class="col-md-12 pad-0">
				<textarea style="width:100%" rows="5" class="dm_action_plan" disabled><?=$evaluation[0]->dm_action_plan;?></textarea>
			</div>

			<!-- <div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DATE RANGE</b></div> -->
			
			<!--<div class="col-md-12 pad-0" style="padding: 15px 0px 0px 0px;border: 1px solid rgb(169, 169, 169);">
				<p class="dm_date"></p> <p class="dm_to"></p> 

			</div>-->
		</div>

		<div class="col-md-12 pad-0">
			<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>PSR'S ACTION PLAN</b></div>

			<div class="col-md-12 pad-0">
				<?php if($user == 'psr'){ 
						if($agenda[0]->status == 2) {
					?>
					<textarea style="width:100%" rows="5" class="psr_action_plan"><?=$evaluation[0]->psr_action_plan;?></textarea>
				<?php } else { ?>
					<textarea style="width:100%" rows="5" class="psr_action_plan" disabled><?=$evaluation[0]->psr_action_plan;?></textarea>
				<?php }

				 } else { ?>
					<textarea style="width:100%" rows="5" class="psr_action_plan" disabled><?=$evaluation[0]->psr_action_plan;?></textarea>
				<?php } ?>
			</div>

			<!-- <div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DATE RANGE</b></div> -->

			

			<!-- <div class="col-md-12 pad-0" style="padding: 15px 0px 0px 0px;border: 1px solid rgb(169, 169, 169);">
				<p class="psr_date"></p>

			</div> -->
		</div>

		<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>OM'S REMARKS</b></div>

		<div class="col-md-12 pad-0" style="margin-bottom:10px">
			<?php if($user == 'om'){ 
					if($agenda[0]->status == 3) {
				?>
				<textarea style="width:100%" rows="5" class="om_action_plan"><?=$evaluation[0]->om_remarks;?></textarea>
			<?php } else { ?>
					<textarea style="width:100%" rows="5" class="om_action_plan" disabled><?=$evaluation[0]->om_remarks;?></textarea>

			<?php } 
				}else { ?>
				<textarea style="width:100%" rows="5" class="om_action_plan" disabled><?=$evaluation[0]->om_remarks;?></textarea>
			<?php } ?>
		</div>

		<div class="col-md-12 pad-0" style="margin-bottom:25px">
			<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>ISSUES AND CONCERNS</b></div>

			<div class="col-md-12 pad-0">
				<textarea style="width:100%" rows="5" class="issues_and_remarks" disabled><?=$evaluation[0]->issues_and_remarks;?></textarea>
			</div>

		
		</div>



		<div class="col-md-6">
			
		</div>
		<div class="col-md-6 pad-0" style="text-align:right;margin-bottom:15px;">
			<?php if($user == 'om'){ 

					if($agenda[0]->status == 3) {
				?>
						<button class="darkblue-bg darkblue-btn btn_conforme">Acknowledge</button>
			<?php 
					} else { ?>
						<!-- <button class="darkblue-bg darkblue-btn btn_conforme" style="pointer-events:none">Acknowledge</button> -->
			<?php	}
				} else { 
					if($agenda[0]->status == 2) { ?>
						<button class="darkblue-bg darkblue-btn btn_conforme">Submit</button>
			<?php	} else { ?>
						<!-- <button class="darkblue-bg darkblue-btn btn_conforme" style="pointer-events:none">Submit</button> -->
			<?php } }?>
		</div>


	</div>
	
</div>