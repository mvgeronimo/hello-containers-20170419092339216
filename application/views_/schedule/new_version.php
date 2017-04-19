


<style type="text/css">
	.prog_agenda {
		color:blue;
	}


	.margintop-10 {
		margin-top:10px;
	}
	.psr, .territory {
		height: 25px !important;
		padding: 0px !important;
	}
	.asterisk {
		color:red;
	}
	.agenda_cont .agenda_cont3:first-child, .people_cont .people_cont3:first-child {
	    margin-top: 0px !important;
	}

	.agenda_cont .agenda_cont3, .people_cont .people_cont3 {
	    margin-top: 15px;
	}
</style>

<script type="text/javscript">
$(document).ready(function() {

   

})

</script>

<?php if($AgendaType == 2) {


		foreach($agenda as $value) {
	 		$agenda_id = $value->agenda_id;
	 		$dm = $value->dm;
	 		$psr_id = $value->psr_id;

	 		$date_from = $value->date_from;
	 		$datefrom = date_create($date_from);
	 		$day1 = date_format($datefrom, 'F d, Y');
	 		$datefrom = date_format($datefrom, 'F d');
	 		
	 		$date_to = $value->date_to;
	 		$dateto = date_create($date_to);
	 		$day2 = date_format($dateto, 'F d, Y');
	 		$dateto = date_format($dateto, 'd, Y');
	 		
	 		$date_of_ojl = $datefrom.'-'.$dateto;

	 		$psr = $value->psr_name;
	 		$territory = $value->territory_name;
	 		$salary = $value->salary;
	 		$competency = $value->competency_standards;

		 }
	}
?>

<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>

<input type="hidden" class="hidden_dm" value="<?=$this->session->userdata('emp_id');?>">
<input type="hidden" class="hidden_agenda" value="<?=$this->uri->segment(3);?>">
<div class="create_div col-md-12" style="background-color:white">

	<input type="hidden" class="input_next_id">
	
	<div class="col-md-2 progress_div">
		<?php include('progress.php'); ?>
	</div>

	<div class="col-md-10 agenda_div pad-0"> <!-- div for agenda -->
		<div class="col-md-12 pad-0">
			<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL SCHEDULE > NEW VERSION</p>
			<p class="darkblue-font page_title">AGENDA</p>
		</div>


<?php foreach($agenda as $key => $value) { ?>
<input type="hidden" class="hidden_psr" value="<?=$value->psr_id;?>">
		<div class="col-md-12 pad-0">
			<div class="col-md-6 pad-0 margintop-10" style="">
				<div class="col-md-4 pad-0">
					<b>Name of DM: </b>
				</div>

				<div class="col-md-6 pad-0">
					<?php if($AgendaType == 2) { ?>
						<p class="p_dm" dm="<?php echo $this->session->userdata('username'); ?>"><?=$dm;?></p>
					<?php } else { ?>
						<p class="p_dm" dm="<?php echo $this->session->userdata('username'); ?>"><?php echo $this->session->userdata('firstname').' '.$this->session->userdata('lastname'); ?></p>
					<?php } ?>

				</div>

				<div class="col-md-2"></div>

				<div class="col-md-4 pad-0 margintop-10">
					<b>Name of PSR: </b> <b class="asterisk">*</b>
				</div>

				<div class="col-md-6 pad-0 margintop-10">
					<select class="form-control psr" disabled>
						
					</select> 
				</div>

				<div class="col-md-2"></div>

				<div class="col-md-4 pad-0 margintop-10">
					<b>Salary Grade: </b>
				</div>

				<div class="col-md-6 pad-0 margintop-10">
					<b class="salary_grade_b"><?=$value->salary;?></b>
				</div>

				<div class="col-md-2"></div>

				<div class="col-md-4 pad-0 margintop-10">
					<b>Territory: </b>
				</div>

				<div class="col-md-6 pad-0 margintop-10">
					<span class="territory"><?=$value->territory;?></span>
				</div>

				<div class="col-md-2"></div>

			</div>

			<div class="col-md-6 pad-0">

				<div class="col-md-2"></div>
				<div class="col-md-4 pad-0 margintop-10">
					<b>Date From: </b>
				</div>

				<div class="col-md-6 pad-0 margintop-10">
					<?php include('date_from.php'); $datefr = date_create($value->date_from); $datef = date_format($datefr, 'm/d/Y'); ?>
					<input type='hidden' value="<?php echo $datef; ?>" class='form-control' id='date_from2' />
				</div>

				

				<div class="col-md-2"></div>

				<div class="col-md-4 pad-0 margintop-10">
					<b>Date To: </b>
				</div>
				<input type="hidden" value="2" id="createType" />
				<div class="col-md-6 pad-0 margintop-10">
				 <?php include('date_to.php');  $datett = date_create($value->date_to); $datet = date_format($datett, 'm/d/Y'); ?>
					
				</div>

				

				<div class="col-md-2"></div>

				<div class="col-md-4 pad-0 margintop-10">
					<b>Competency Standard: </b> <b class="asterisk">*</b>
				</div>

				<div class="col-md-6 pad-0 margintop-10">
					<!-- <input type="text" class="form-control" value="<?php echo $value->competency_standards; ?>" id="competency_standards"> -->
					<b id="competency_standards"><?=$value->competency_standards;?></b>
				</div>

				

			</div>

		</div>

		 <input type="hidden" class="datettt" value="<?=$datet;?>">
<?php } ?>
		<!-- div for business people-->

		<div class="col-md-12 pad-0" style="margin-top:25px;">
			<div class="col-md-12 pad-0 margintop-10">

				<div class="col-md-5 darkblue-bg" style="padding:5px">
					AGENDA
				</div>

				<div class="col-md-7 darkblue-bg" style="padding:5px;">
					SPECIFIC PLAN(S)
				</div>
			</div>

			<div class="col-md-12 pad-0 business_development_cont">

				<div class="col-md-12 pad-0">
					<div class="col-md-5" style="margin-top:15px">
						<div class="col-md-7 pad-0"><p class="darkblue-font" style="font-size:16px"><b>BUSINESS DEVELOPMENT</b></p></div>
						<div class="col-md-5 pad-0" style="text-align:right"><a class="add_agenda darkblue-font" style="cursor:pointer"><b>ADD</b></a></div>
					</div>

					<div class="col-md-7" style="margin-top:15px">
						
					</div>
				</div>

				<div class="col-md-12">
					<!-- <div class="col-md-5" style="margin-top:15px">
					
					</div>

					<div class="col-md-7" style="margin-top:15px">
						
					</div> -->
						<!-- <button class="btn btn-primary add_agenda">Add Agenda</button>  -->
				</div>
				<input type="hidden" id="businessCounter" value="1"/>
					<input type="hidden" id="offSetBusinessCounter" value="0"/>
				<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="businessAgendaDraft">
					
				</div>


			<form id="agenda_business_form">
				<div class="agenda_cont">

			<?php $x = 1; $count_business = 0;
			foreach($action_plan as $val) { 
				if($val->actionPlanType == 1) { $count_business++; ?>
					<div class="col-md-12 agenda_cont3 business_<?=$x;?>">
						<div class="col-md-5">
							<div class="col-md-10" style="padding:0px">
								<select name="agd_business[]" class="agenda_name form-control agd_<?=$x;?>">
								<?php foreach($dropdown as $key => $value) { 

									if($value->agenda_type == 1) {


									if($val->agenda_name_id == $value->agenda_name_id) {
										
								?>
									<option value="<?php echo $value->agenda_name_id; ?>" selected><?php echo $value->agenda_name; ?></option>
								<?php } else { ?>
									<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>
								<?php } } }?>
								</select>
							</div>

							<div class="col-md-2">
								<a class="minus_agenda" btn-num="1" style="height: 34px;width:40px;color:#a0a0a0;cursor:pointer">
									<i>Delete</i>
								</a>
							</div>
						</div>

						<div class="col-md-7">
							<input type="text" name="action_business[]" class="action_text action_plan_<?=$x;?> form-control" placeholder="Action Plan" value="<?= $val->specific_plans; ?>">
						</div>
					</div>

					<?php $x++;}  
						
					} ?>

				</div>
			</form>
				<div class="col-md-12">
					<div class="col-md-5" style="margin-top:15px">
						
					</div>

					<div class="col-md-7" style="margin-top:15px;text-align:right">
						<!-- <button class="btn btn-primary save_businessDraft" data-val="1">Save</button>  -->
					</div>
				</div>

			</div>


			<div class="col-md-12 pad-0 people_development_cont">

		
				<div class="col-md-12 pad-0">
					<div class="col-md-5" style="margin-top:15px">
						<div class="col-md-7 pad-0"><p class="darkblue-font" style="font-size:16px"><b>PEOPLE DEVELOPMENT</b></p></div>
						<div class="col-md-5 pad-0" style="text-align:right"><a class="add_people_agenda darkblue-font" style="cursor:pointer"><b>ADD</b></a></div>
					</div>

					<div class="col-md-7" style="margin-top:15px">
						
					</div>
				</div>

				<div class="col-md-12">
					<!-- <div class="col-md-5" style="margin-top:15px">
						
					</div>

					<div class="col-md-7" style="margin-top:15px">
						
					</div> -->
					<!-- <button class="btn btn-primary add_people_agenda">Add Agenda</button>  -->
				</div>
				<input type="hidden" id="peopleCounter" value="1"/>
				<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="peopleAgendaDraft">
					
				</div>
			<form id="agenda_ppl_form">
				<div class="people_cont">

		<?php $y = 1; $count_people = 0;
			foreach($action_plan as $val) { 
				if($val->actionPlanType == 2) { $count_people++; ?>
					<div class="col-md-12 people_cont3 ppl_<?=$y;?>">

						<div class="col-md-5">
							<div class="col-md-10" style="padding:0px">
								<!--<input type="text" class="agenda_name_people_1 form-control" placeholder="Agenda">!-->
								<select name="agd_ppl[]" class="agenda_name_people_<?=$y;?> form-control">
								<?php foreach($dropdown as $key => $value) { 
										if($value->agenda_type == 2) { 
										if($val->agenda_name_id == $value->agenda_name_id) {
											
									?>
										<option value="<?php echo $value->agenda_name_id; ?>" selected><?php echo $value->agenda_name; ?></option>
									<?php } else { ?>
										<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>
									<?php } } } ?>
								</select>
							</div>

							<div class="col-md-2">
								<a class="minus_ppl_agenda" btn-num="1" style="height: 34px;width:40px;color:#a0a0a0;cursor:pointer">
									<i>Delete</i>
								</a>
							</div>
							
						</div>

						<div class="col-md-7">
							<input type="text" name="action_ppl[]" class="people_text action_plan_people_<?=$y;?> form-control" placeholder="Action Plan" value="<?=$val->specific_plans;?>">
						</div>
					</div>

					<?php $y++; }  
							
						} ?>


				</div>
			</form>
				<div class="col-md-12">
					<div class="col-md-5" style="margin-top:15px">
						
					</div>

					<div class="col-md-7" style="margin-top:15px;text-align:right">
						<!-- <button class="btn btn-primary save_peopleDraft" data-val="2">Save</button>  -->
					</div>
				</div>


			</div>

			

		</div>

		<!-- end of business people -->
	</div> <!-- end for agenda -->

	


	<div class="col-md-12" style="text-align:right; margin-top:20px;margin-bottom: 15px">
			<?php $this->load->view('home_button'); ?><button class="darkblue-bg darkblue-btn btn-save" is-new="1">Next</button> 
		</div>

  <div class="col-md-12" style="text-align:right;display:none">
    <button class="btn btn-primary btn-save">Save</button>
  </div>

</div>

<script>
 $(document).ready(function() {

 	var empid = $('.hidden_dm').val();
	var ps_r = $('.hidden_psr').val();


	$('.biomedis-logo').css({'cursor':'pointer'});

	$('.biomedis-logo').click(function() {
		window.location = '<?=base_url();?>home';
	})


	$('#date_from').val($('#date_from2').val());
	$('#date_to').val($('.datettt').val());

	$.ajax({
	     type:'get',
	     url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/partialterritorialconfig/Get',
	     data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid':empid}
	    }).done(function(result) {
	    	var htm = '';
	    	var htm2 = '';
	    	$.each(result, function(x,y) {
	    		$.each(y, function(a,b) {
	    			if (a != 'EmployeeID' && a != 'Fullname' && a != 'Description') {

	    				if(b.EmployeeID == ps_r) {
	    					htm += '<option id="psr_drop_'+b.EmployeeID+'" value="'+b.EmployeeID+'" is_agree="1" selected>'+b.Fullname+'</option>';
	    				} else {
	    					htm += '<option id="psr_drop_'+b.EmployeeID+'" value="'+b.EmployeeID+'" is_agree="1">'+b.Fullname+'</option>';
	    				}
	    				
	    				//htm2 += '<option value="'+b.EmployeeID+'">'+b.Description+'</option>';
	    			}
	    		})
	    	})
	    	$('.psr').append(htm);
	    	
	    //	$('.territory').append(htm2);
	    })

	    $('.psr').on('change', function() {
	    	var psr_id = $(this).val();


	    	$.ajax({
			     type:'get',
			     url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/partialterritorialconfig/Get',
			     data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid':empid}
			    }).done(function(result) {
			    	var htm = '';
			    	var htm2 = '';
			    	$.each(result, function(x,y) {
			    		$.each(y, function(a,b) {
			    			if (a != 'EmployeeID' && a != 'Fullname' && a != 'Description') {
			    				if(b.EmployeeID == psr_id) {
			    					htm = b.Description;
			    				}
			    				//htm2 += '<option value="'+b.EmployeeID+'">'+b.Description+'</option>';
			    			}
			    		})
			    	})
			    	$('.territory').html(htm);
			  
			    })

			    $.ajax({
			        type:'post',
			        url:'<?=base_url();?>Ojl_schedule/get_salary',
			        data:{'psr_id':psr_id}
			      }).done(function(result) {
			        var obj = JSON.parse(result);

			        $.each(obj, function(x,y) {
			          
			          $('.salary_grade_b').html(y.salary_grade);
			        })
			      })
	    })


 	var path = '<?=base_url();?>';
 	$('.biomedis-logo').attr('src', path+'assets/images/biomedis-logo.png');
	$('.footer-login img').attr('src', path+'assets/images/biomedis-footer.png');

	$('.prog-img').attr('src', path+'assets/images/piatos-ol.png');
 	
	 // var dateTo = $('#datettt').val();
	 // var dateFrom = $('#date_from2').val();
	 // dateFrom = dateFrom.substr(5,2)+'/'+dateFrom.substr(8,2)+'/'+dateFrom.substr(0,4);
	 // dateTo = dateTo.substr(5,2)+'/'+dateTo.substr(8,2)+'/'+dateTo.substr(0,4);
	 // $('#date_to').val(dateTo);
	 // $('#date_from').val(dateFrom);
	$(document).on('click', '.save_businessDraft', function() {
		// alert($('.agenda_cont').text());
		// alert('a');
	var counter = $('#businessCounter').val();
	var divBusinness = '';
	// var a = 1;
	for(a=1;a<=counter;a++)
	{
		var agd = $('.agd_'+a).val();
		var agdText = $(".agd_"+a+" option[value='"+agd+"']").text()
		
		var actionPlan = $('.action_plan_'+a).val();
		if(actionPlan != '' && typeof actionPlan != 'undefined')
		{
			
			divBusinness += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				divBusinness += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';
				divBusinness += agdText;
				divBusinness += '</div>';
				divBusinness += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';
				divBusinness += actionPlan;
				divBusinness += '</div>';
			divBusinness += '</div>';
				$('.business_'+a).hide();
		$('.save_businessDraft').hide();
		}
	
			// alert(divBusinness);
	}
	$('#businessAgendaDraft').html(divBusinness);
	
	
	});
	
	
	$(document).on('click', '.save_peopleDraft', function() {
	var counter = $('#peopleCounter').val();
	// var a = 1;
	var divBusinness = '';
	for(a=1;a<=counter;a++)
	{
		var agd = $('.agenda_name_people_'+a).val();
		var agdText = $(".agenda_name_people_"+a+" option[value='"+agd+"']").text()

		var actionPlan = $('.action_plan_people_'+a).val();
		if(actionPlan != '' && typeof actionPlan != 'undefined')
		{
			
			divBusinness += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				divBusinness += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';
				divBusinness += agdText;
				divBusinness += '</div>';
				divBusinness += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';
				divBusinness += actionPlan;
				divBusinness += '</div>';
			divBusinness += '</div>';
			$('.save_peopleDraft').hide();
			$('.ppl_'+a).hide();
		}
		
	}
	$('#peopleAgendaDraft').html(divBusinness);
			
		
	});
	
	
	$(document).on('click', '.to_itenerarySave', function() {
	var businessAgendaDiv = $('.agenda_cont').text();
	var peopleAgendaDiv = $('.people_cont').text();
	if(businessAgendaDiv.trim() != '' || peopleAgendaDiv.trim() != '')
	{
		alert('Please Save All Pending Agenda First!');
	}
	
	});



	
 });
</script>